<?php
$PAGE = 'admin-card-images';
include('../_general.php');

function ensure_dir($dir){
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

function random_filename($ext){
    do { $name = bin2hex(random_bytes(8)).'.'.$ext; } while(file_exists($name));
    return $name;
}

function list_dir_files($dir, $allowed_ext){
    $out = [];
    if ($dir && is_dir($dir)) {
        foreach ((array)glob($dir.'/*') as $f) {
            if (is_file($f)) {
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, $allowed_ext)) $out[] = basename($f);
            }
        }
    }
    natcasesort($out);
    return array_values(array_unique($out));
}

function detect_mime($path){
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $fi ? finfo_file($fi,$path) : '';
    if ($fi) finfo_close($fi);
    return $mime ?: '';
}

function load_image_resource($path, $mime){
    if ($mime === 'image/jpeg') return imagecreatefromjpeg($path);
    if ($mime === 'image/png') return imagecreatefrompng($path);
    return false;
}

function fix_orientation_if_jpeg($path, $img, $mime){
    if ($mime !== 'image/jpeg') return $img;
    if (!function_exists('exif_read_data')) return $img;
    $exif = @exif_read_data($path);
    if (!$exif || empty($exif['Orientation'])) return $img;
    $o = (int)$exif['Orientation'];
    if ($o === 3) $img = imagerotate($img, 180, 0);
    elseif ($o === 6) $img = imagerotate($img, -90, 0);
    elseif ($o === 8) $img = imagerotate($img, 90, 0);
    return $img;
}

function maybe_downscale($src, $maxDim){
    $w = imagesx($src); $h = imagesy($src);
    $largest = max($w,$h);
    if ($largest <= $maxDim) return $src;
    $ratio = $w/$h;
    if ($w >= $h){ $nw = $maxDim; $nh = (int)round($maxDim/$ratio); }
    else { $nh = $maxDim; $nw = (int)round($maxDim*$ratio); }
    $dst = imagecreatetruecolor($nw,$nh);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h);
    imagedestroy($src);
    return $dst;
}

function png_has_alpha_fast($img){
    $w = imagesx($img); $h = imagesy($img);
    $stepX = max(1, (int)floor($w/50));
    $stepY = max(1, (int)floor($h/50));
    for ($y=0; $y<$h; $y+=$stepY){
        for ($x=0; $x<$w; $x+=$stepX){
            $rgba = imagecolorat($img,$x,$y);
            $a = ($rgba & 0x7F000000) >> 24;
            if ($a > 0) return true;
        }
    }
    return false;
}

function quantize_png_palette(&$img, $colors = 256){
    if (function_exists('imagetruecolortopalette')){
        imagetruecolortopalette($img, true, max(2, min(256, (int)$colors)));
        if (function_exists('imagepalettetotruecolor')) {}
    }
}

function reencode_image_to_best($srcPath, $destDir, $srcMime, $preferPngWhenAlpha = true){
    $MAX_DIM = 1920;
    $JPEG_QUALITY = 82;
    $PNG_COMPRESSION = 9;
    $img = load_image_resource($srcPath, $srcMime);
    if (!$img) return [null, 'error_img'];
    $img = fix_orientation_if_jpeg($srcPath, $img, $srcMime);
    $img = maybe_downscale($img, $MAX_DIM);
    $finalExt = 'jpg';
    if ($srcMime === 'image/png'){
        $hasAlpha = png_has_alpha_fast($img);
        if ($hasAlpha && $preferPngWhenAlpha){
            quantize_png_palette($img, 256);
            ensure_dir($destDir);
            $finalExt = 'png';
            $final = random_filename($finalExt);
            $abs = rtrim($destDir,'/').'/'.$final;
            imagealphablending($img, false);
            imagesavealpha($img, true);
            $ok = imagepng($img, $abs, $PNG_COMPRESSION);
            imagedestroy($img);
            if (!$ok) return [null, 'error_img'];
            return [$final, ''];
        } else {
            $w = imagesx($img); $h = imagesy($img);
            $bg = imagecreatetruecolor($w,$h);
            $white = imagecolorallocate($bg,255,255,255);
            imagefilledrectangle($bg,0,0,$w,$h,$white);
            imagealphablending($bg, true);
            imagecopy($bg,$img,0,0,0,0,$w,$h);
            imagedestroy($img);
            $img = $bg;
            $finalExt = 'jpg';
        }
    } else {
        $finalExt = 'jpg';
    }
    ensure_dir($destDir);
    $final = random_filename($finalExt);
    $abs = rtrim($destDir,'/').'/'.$final;
    if ($finalExt === 'jpg'){
        $ok = imagejpeg($img, $abs, $JPEG_QUALITY);
    } else {
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $ok = imagepng($img, $abs, $PNG_COMPRESSION);
    }
    imagedestroy($img);
    if (!$ok) return [null, 'error_img'];
    return [$final, ''];
}

function handle_image_upload($field,&$error){
    $error = '';
    if (!isset($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { $error = 'error_img'; return null; }
    $tmp = $_FILES[$field]['tmp_name'];
    $orig = $_FILES[$field]['name'];
    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    $allowed = ['png','jpg','jpeg'];
    if (!in_array($ext,$allowed)) { $error = 'bad_img_type'; return null; }
    $mime = detect_mime($tmp);
    if (!in_array($mime, ['image/jpeg','image/png'], true)) { $error = 'bad_img_type'; return null; }
    [$stored, $err] = reencode_image_to_best($tmp, __DIR__.'/cards_images', $mime, true);
    if ($err) { $error = $err; return null; }
    return $stored;
}

function copy_choice_to_store_optimized($base_rel, $filename, $dest_subdir, &$error){
    $error = '';
    $filename = trim($filename ?? '');
    if ($filename === '') return null;
    if (basename($filename) !== $filename) return null;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($ext, ['png','jpg','jpeg'])) { $error = 'bad_type'; return null; }
    $src_dir = realpath(__DIR__.'/../'.$base_rel);
    if (!$src_dir) { $error = 'bad_path'; return null; }
    $src = $src_dir.'/'.$filename;
    if (!is_file($src)) { $error = 'bad_path'; return null; }
    $mime = detect_mime($src);
    if (!in_array($mime, ['image/jpeg','image/png'], true)) { $error = 'bad_type'; return null; }
    [$stored, $err] = reencode_image_to_best($src, __DIR__.'/'.$dest_subdir, $mime, true);
    if ($err) { $error = 'copy_error'; return null; }
    return $stored;
}

function get_image_by_id($id){
    $rows = SelectQuery('card_images')->Condition('img_id =', 'i', (int)$id)->Limit(1)->Run();
    return $rows ? array_values($rows)[0] : null;
}

function format_size_kb_label($img_url){
    $path = '';
    if (!$img_url) return '';
    if (strpos($img_url, '/') !== false) {
        $cand = realpath(__DIR__.'/../'.ltrim($img_url,'/'));
        if ($cand && is_file($cand)) $path = $cand;
    } else {
        $cand = __DIR__.'/cards_images/'.$img_url;
        if (is_file($cand)) $path = $cand;
    }
    if ($path === '') return '';
    $kb = filesize($path) / 1024;
    $val = (int)round($kb);
    return $val.' KB';
}

$card_types = ['publicidad','comunicacion','marca'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $img_card_type = trim($_POST['img_card_type'] ?? '');
        if (!in_array($img_card_type, $card_types, true)) { header('Location: card_images.php?m=invalid'); exit; }

        $imgErr = '';
        $uploaded_img = handle_image_upload('img_file', $imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: card_images.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: card_images.php?m=uploadimg'); exit; }

        $choiceErr = ''; $copied_img = null;
        if ($uploaded_img === null) {
            if (!empty($_POST['img_choice'])) {
                $copied_img = copy_choice_to_store_optimized('img', $_POST['img_choice'], 'cards_images', $choiceErr);
            }
            if ($choiceErr === 'bad_type') { header('Location: card_images.php?m=badimg'); exit; }
            if ($choiceErr === 'copy_error') { header('Location: card_images.php?m=uploadimg'); exit; }
        }

        $final_img = $uploaded_img !== null ? $uploaded_img : ($copied_img ?? '');
        if ($final_img === '') { header('Location: card_images.php?m=invalid'); exit; }

        InsertQuery('card_images')
            ->Value('img_url', 's', $final_img)
            ->Value('img_card_type', 's', $img_card_type)
            ->Run();

        header('Location: card_images.php?m=created'); exit;

    } elseif ($action === 'update') {
        $img_id = (int)($_POST['img_id'] ?? 0);
        $img_card_type = trim($_POST['img_card_type'] ?? '');
        if ($img_id <= 0 || !in_array($img_card_type, $card_types, true)) { header('Location: card_images.php?m=invalid'); exit; }

        $current = get_image_by_id($img_id);
        $keep_img = $current ? ($current['img_url'] ?? '') : '';

        $imgErr = '';
        $uploaded_img = handle_image_upload('img_file', $imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: card_images.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: card_images.php?m=uploadimg'); exit; }

        $choiceErr = ''; $copied_img = null;
        if ($uploaded_img === null) {
            if (!empty($_POST['img_choice'])) {
                $copied_img = copy_choice_to_store_optimized('img', $_POST['img_choice'], 'cards_images', $choiceErr);
            }
            if ($choiceErr === 'bad_type') { header('Location: card_images.php?m=badimg'); exit; }
            if ($choiceErr === 'copy_error') { header('Location: card_images.php?m=uploadimg'); exit; }
        }

        $final_img = $uploaded_img !== null ? $uploaded_img : ($copied_img !== null ? $copied_img : $keep_img);

        UpdateQuery('card_images')
            ->Value('img_url', 's', $final_img)
            ->Value('img_card_type', 's', $img_card_type)
            ->Condition('img_id =', 'i', $img_id)
            ->Run();

        header('Location: card_images.php?m=updated'); exit;

    } elseif ($action === 'delete') {
        $img_id = (int)($_POST['img_id'] ?? 0);
        if ($img_id > 0) DeleteQuery('card_images')->Condition('img_id =', 'i', $img_id)->Run();
        header('Location: card_images.php?m=deleted'); exit;
    }
}

$images = SelectQuery('card_images')->Order('img_id', 'DESC')->Run();
if (!is_array($images)) $images = [];

$img_dir_abs = realpath(__DIR__.'/../img');
$img_files = list_dir_files($img_dir_abs ?: '', ['jpg','jpeg','png']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title>Kahlo Web 2.0 - Imágenes de Cards</title>
    <link rel="icon" type="image/jpeg" href="img/favicon.jpg">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/admin.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .page-toolbar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:8px 0 14px}
        .page-toolbar h2{margin:0;font-weight:700;color:#111;display:block!important}
        .mini-thumb{width:120px;height:80px;object-fit:cover;border:1px solid #d0d5dd;border-radius:6px;background:#f3f4f6}
        .badge-path{font-size:12px;background:#f3f4f6;border:1px solid #e5e7eb;color:#374151}
        .table td,.table th{vertical-align:middle}
        .modal-dialog{max-width:860px}
        .picker-split{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .option-card{border:1px solid #e5e7eb;border-radius:12px;background:#fafbfc;padding:12px}
        .option-head{display:flex;align-items:center;gap:8px;margin-bottom:8px}
        .option-badge{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:999px;background:#111827;color:#fff;font-weight:600;font-size:13px}
        .option-title{font-weight:600}
        .gallery-panel{position:fixed;top:80px;right:16px;width:520px;max-width:92vw;height:70vh;background:#fff;border:1px solid #cfd4dc;border-radius:10px;box-shadow:0 12px 44px rgba(17,24,39,.22);display:none;z-index:2000;overflow:auto}
        .gallery-head{display:flex;justify-content:space-between;align-items:center;padding:10px 14px;border-bottom:1px solid #d6dbe3}
        .gallery-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;padding:12px}
        .gallery-item{border:1px solid #cfd4dc;border-radius:10px;padding:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;height:110px;background:#e1e4ea;transition:transform .08s ease;font-size:12px;color:#111}
        .gallery-item:hover{transform:scale(1.02)}
        .gallery-item img{max-width:100%;max-height:96px;object-fit:contain}
        .gallery-footer{padding:8px 12px;border-top:1px solid #d6dbe3;font-size:12px;color:#4b5563;background:#f8fafc}
        .close-x{border:none;background:transparent;font-size:22px;line-height:1}
    </style>
</head>
<body>
    <?php ShowAdminNavBar('nav-card-images'); ?>

    <div class="contenidoAdmin">
        <div class="inicioAdmin jumbotron">
            <div class="page-toolbar">
                <h2>Imágenes de Cards</h2>
                <button class="btn btn-danger" type="button" id="btnCreate">Nueva imagen</button>
            </div>

            <?php if (isset($_GET['m']) && $_GET['m'] === 'created'): ?>
                <div class="alert alert-success" style="margin-top:10px">Imagen creada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'updated'): ?>
                <div class="alert alert-info" style="margin-top:10px">Imagen actualizada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'deleted'): ?>
                <div class="alert alert-warning" style="margin-top:10px">Imagen eliminada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badimg'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Formato inválido. Permitidos: jpg, jpeg, png.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadimg'): ?>
                <div class="alert alert-danger" style="margin-top:10px">No se pudo procesar la imagen.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'invalid'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Datos incompletos.</div>
            <?php endif; ?>

            <div style="margin-top:10px; overflow-x:auto">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:150px">Imagen</th>
                            <th>Archivo</th>
                            <th>Peso (KB)</th>
                            <th>Tipo</th>
                            <th style="width:220px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($images) === 0): ?>
                            <tr><td colspan="5">No hay imágenes cargadas</td></tr>
                        <?php else: foreach ($images as $row): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($row['img_url'])): ?>
                                        <img src="<?= htmlspecialchars('../admin/cards_images/'.($row['img_url'])) ?>" class="mini-thumb">
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-path"><?= htmlspecialchars(basename($row['img_url'] ?? '')) ?></span></td>
                                <td><?= htmlspecialchars(format_size_kb_label($row['img_url'] ?? '')) ?></td>
                                <td><?= htmlspecialchars($row['img_card_type'] ?? '') ?></td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-secondary btn-edit"
                                        data-id="<?= htmlspecialchars($row['img_id'] ?? '') ?>"
                                        data-url="<?= htmlspecialchars($row['img_url'] ?? '') ?>"
                                        data-type="<?= htmlspecialchars($row['img_card_type'] ?? '') ?>"
                                        type="button">Editar</button>

                                    <form method="post" action="card_images.php" style="display:inline" onsubmit="return confirm('¿Eliminar esta imagen?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="img_id" value="<?= htmlspecialchars($row['img_id'] ?? '') ?>">
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="width:100px; height:50px"></div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="card_images.php" class="modal-content" id="createForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="createLabel">Nueva imagen</h5>
            <button type="button" class="close btn-close close-create" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="action" value="create">

              <div class="form-group">
                  <label>Tipo</label>
                  <select name="img_card_type" id="create_type" class="form-control" required>
                      <option value="" disabled selected>Seleccioná un tipo</option>
                      <option value="publicidad">publicidad</option>
                      <option value="comunicacion">comunicacion</option>
                      <option value="marca">marca</option>
                  </select>
              </div>

              <div class="form-group">
                  <label>Imagen</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="img_file" id="create_img_file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="fondos" data-target="create_img_choice">Abrir galería</button>
                          <div class="help-text" id="create_img_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="img_choice" id="create_img_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badImgCreate" style="display:none;margin-top:8px">Formato inválido. Permitidos: jpg, jpeg, png.</div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light cancel-create" data-dismiss="modal" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnCreateSave">Guardar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="card_images.php" class="modal-content" id="editForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Editar imagen</h5>
            <button type="button" class="close btn-close close-edit" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="img_id" id="edit_id">

              <div class="form-group">
                  <label>Tipo</label>
                  <select name="img_card_type" id="edit_type" class="form-control" required>
                      <option value="publicidad">publicidad</option>
                      <option value="comunicacion">comunicacion</option>
                      <option value="marca">marca</option>
                  </select>
              </div>

              <div class="form-group">
                  <label>Imagen</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="img_file" id="edit_img_file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="fondos" data-target="edit_img_choice">Abrir galería</button>
                          <div class="help-text" id="edit_img_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="img_choice" id="edit_img_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badImgEdit" style="display:none;margin-top:8px">Formato inválido. Permitidos: jpg, jpeg, png.</div>
                  <div id="edit_img_preview" style="margin-top:8px"></div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light cancel-edit" data-dismiss="modal" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnEditSave">Actualizar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="gallery-panel" id="galleryPanel">
        <div class="gallery-head">
            <div id="galleryTitle"></div>
        <button class="close-x" id="galleryClose">×</button>
        </div>
        <div class="gallery-grid" id="galleryGrid"></div>
        <div class="gallery-footer" id="galleryHint"></div>
    </div>

    <script>
    window.K_FONDOS = <?php echo json_encode($img_files, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
    function escapeHtml(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');}
    function validateExt(name, allowed){ if(!name) return true; var ext = name.split('.').pop().toLowerCase(); return allowed.indexOf(ext) !== -1; }

    function fallbackShowModal(el){
        var $el = $(el);
        if ($el.data('__fallback')) { $el.show(); return; }
        $el.addClass('show').css('display','block').attr('aria-modal','true').removeAttr('aria-hidden');
        var $back = $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
        $el.data('__fallback', $back);
    }
    function fallbackHideModal(el){
        var $el = $(el), $back = $el.data('__fallback');
        $el.removeClass('show').css('display','none').attr('aria-hidden','true').removeAttr('aria-modal');
        if ($back) $back.remove();
        $el.removeData('__fallback');
    }

    $(function(){
        var hasBS5 = (typeof bootstrap !== 'undefined' && typeof bootstrap.Modal === 'function');
        function openModal(el){
            if (hasBS5){ new bootstrap.Modal(el).show(); return; }
            if (typeof $(el).modal === 'function'){ $(el).modal('show'); return; }
            fallbackShowModal(el);
        }
        function closeModal(el){
            if (hasBS5){
                var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                m.hide(); return;
            }
            if (typeof $(el).modal === 'function'){ $(el).modal('hide'); return; }
            fallbackHideModal(el);
        }

        $('#btnCreate').on('click', function(){
            $('#badImgCreate').hide();
            $('#createForm')[0].reset();
            $('#create_img_choice_label').text('');
            openModal(document.getElementById('createModal'));
        });
        $('.close-create, .cancel-create').on('click', function(){ closeModal(document.getElementById('createModal')); hideGallery(); });

        $('.btn-edit').on('click', function(){
            $('#badImgEdit').hide();
            var id = $(this).data('id'), url = $(this).data('url'), type = $(this).data('type');
            $('#edit_id').val(id);
            $('#edit_type').val(type);
            if (url) {
                var src = '../admin/cards_images/'+url;
                $('#edit_img_preview').html('<img class="mini-thumb" src="'+escapeHtml(src)+'"> <span class="badge badge-path">'+escapeHtml(url.split('/').pop())+'</span>');
            } else {
                $('#edit_img_preview').empty();
            }
            $('#edit_img_choice_label').text('');
            openModal(document.getElementById('editModal'));
        });
        $('.close-edit, .cancel-edit').on('click', function(){ closeModal(document.getElementById('editModal')); hideGallery(); });

        $('#create_img_file').on('change', function(){
            var ok = validateExt(this.value, ['jpg','jpeg','png']);
            $('#badImgCreate').toggle(!ok);
            if (ok && this.files && this.files[0]) { $('#create_img_choice').val(''); $('#create_img_choice_label').text(''); }
        });
        $('#edit_img_file').on('change', function(){
            if (!this.value) { $('#badImgEdit').hide(); return; }
            var ok = validateExt(this.value, ['jpg','jpeg','png']);
            $('#badImgEdit').toggle(!ok);
            if (ok && this.files && this.files[0]) { $('#edit_img_choice').val(''); $('#edit_img_choice_label').text(''); }
        });

        var galleryPanel = $('#galleryPanel'), galleryGrid = $('#galleryGrid'), galleryTitle = $('#galleryTitle'), galleryHint = $('#galleryHint'), currentTargetInput = null;
        function showGallery(type, targetInputId){
            currentTargetInput = $('#'+targetInputId); galleryGrid.empty();
            var items = window.K_FONDOS || []; var basePath = '../img/'; var title = 'Imágenes'; var hint = 'Origen: /img';
            galleryTitle.text(title); galleryHint.text(hint);
            items.forEach(function(name){
                var card = $('<div class="gallery-item"></div>');
                card.append($('<img>').attr('src', basePath + name));
                card.on('click', function(){
                    currentTargetInput.val(name);
                    $('#'+targetInputId+'_label').text(name);
                    var fileInput = targetInputId.indexOf('create') === 0 ? $('#create_img_file') : $('#edit_img_file');
                    fileInput.val('');
                    hideGallery();
                });
                galleryGrid.append(card);
            });
            galleryPanel.show();
        }
        function hideGallery(){ galleryPanel.hide(); }
        $(document).on('click','.choose-btn',function(){ showGallery($(this).data('gallery'), $(this).data('target')); });
        $('#galleryClose').on('click', hideGallery);
        $(window).on('keydown', function(e){ if (e.key === 'Escape') hideGallery(); });
    });
    </script>
</body>
</html>
