<?php
$PAGE = 'admin-pages';
include('../_general.php');

function get_page_by_id($id){
    $rows = SelectQuery('pages')->Condition('page_id =', 'i', (int)$id)->Limit(1)->Run();
    return $rows ? array_values($rows)[0] : null;
}

function page_url_exists($url, $exclude_id = 0){
    $q = SelectQuery('pages')->Condition('page_url =', 's', $url);
    if ($exclude_id > 0) $q->Condition('page_id <>', 'i', (int)$exclude_id);
    $r = $q->Limit(1)->Run();
    return !empty($r);
}

function ensure_dir($dir){
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

function random_filename($ext){
    do {
        $name = bin2hex(random_bytes(8)).'.'.$ext;
    } while(file_exists($name));
    return $name;
}

function handle_image_upload($field,&$error){
    $error = '';
    if (!isset($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { $error = 'error_img'; return null; }
    $tmp = $_FILES[$field]['tmp_name'];
    $orig = $_FILES[$field]['name'];
    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    $allowed = ['png','jpg','jpeg','svg'];
    if (!in_array($ext,$allowed)) { $error = 'bad_img_type'; return null; }
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fi,$tmp);
    finfo_close($fi);
    $ok_mimes = ['image/png','image/jpeg','image/svg+xml'];
    if (!in_array($mime,$ok_mimes)) {
        if ($ext !== 'svg') { $error = 'bad_img_type'; return null; }
    }
    $dir = __DIR__.'/pages_img';
    ensure_dir($dir);
    $final = random_filename($ext);
    $abs = $dir.'/'.$final;
    if (!move_uploaded_file($tmp, $abs)) { $error = 'error_img'; return null; }
    return $final;
}

function handle_video_upload($field,&$error){
    $error = '';
    if (!isset($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { $error = 'error_vid'; return null; }
    $tmp = $_FILES[$field]['tmp_name'];
    $orig = $_FILES[$field]['name'];
    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    if ($ext !== 'mp4') { $error = 'bad_vid_type'; return null; }
    $fi = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($fi,$tmp);
    finfo_close($fi);
    if ($mime !== 'video/mp4' && $mime !== 'application/octet-stream') { $error = 'bad_vid_type'; return null; }
    $dir = __DIR__.'/pages_videos';
    ensure_dir($dir);
    $final = random_filename($ext);
    $abs = $dir.'/'.$final;
    if (!move_uploaded_file($tmp, $abs)) { $error = 'error_vid'; return null; }
    return $final;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $page_url = trim($_POST['page_url'] ?? '');
        $page_name = trim($_POST['page_name'] ?? '');
        $page_url = preg_replace('#^trabajos/#', '', $page_url);
        $page_url = basename($page_url);
        if ($page_url === '' || $page_name === '') { header('Location: pages.php?m=invalid'); exit; }
        if (page_url_exists($page_url)) { header('Location: pages.php?m=dup'); exit; }

        $imgErr = ''; $vidErr = '';
        $uploaded_img = handle_image_upload('page_logo_overlay_file',$imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: pages.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: pages.php?m=uploadimg'); exit; }

        $uploaded_vid = handle_video_upload('page_video_file',$vidErr);
        if ($vidErr === 'bad_vid_type') { header('Location: pages.php?m=badvid'); exit; }
        if ($vidErr === 'error_vid') { header('Location: pages.php?m=uploadvid'); exit; }

        InsertQuery('pages')
            ->Value('page_url', 's', $page_url)
            ->Value('page_name', 's', $page_name)
            ->Value('page_logo_overlay', 's', $uploaded_img ?? '')
            ->Value('page_video', 's', $uploaded_vid ?? '')
            ->Run();
        global $conn;
        $new_id = mysqli_insert_id($conn);
        if ($new_id > 0) {
            UpdateQuery('pages')->Value('page_index', 'i', $new_id)->Condition('page_id =', 'i', $new_id)->Run();
        }
        header('Location: pages.php?m=created'); exit;

    } elseif ($action === 'update') {
        $page_id = (int)($_POST['page_id'] ?? 0);
        $page_url = trim($_POST['page_url'] ?? '');
        $page_name = trim($_POST['page_name'] ?? '');
        $page_url = preg_replace('#^trabajos/#', '', $page_url);
        $page_url = basename($page_url);
        if ($page_id <= 0 || $page_url === '' || $page_name === '') { header('Location: pages.php?m=invalid'); exit; }
        if (page_url_exists($page_url, $page_id)) { header('Location: pages.php?m=dup'); exit; }

        $current = get_page_by_id($page_id);
        $keep_img = $current ? ($current['page_logo_overlay'] ?? '') : '';
        $keep_vid = $current ? ($current['page_video'] ?? '') : '';

        $imgErr = ''; $vidErr = '';
        $uploaded_img = handle_image_upload('page_logo_overlay_file',$imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: pages.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: pages.php?m=uploadimg'); exit; }

        $uploaded_vid = handle_video_upload('page_video_file',$vidErr);
        if ($vidErr === 'bad_vid_type') { header('Location: pages.php?m=badvid'); exit; }
        if ($vidErr === 'error_vid') { header('Location: pages.php?m=uploadvid'); exit; }

        UpdateQuery('pages')
            ->Value('page_url', 's', $page_url)
            ->Value('page_name', 's', $page_name)
            ->Value('page_logo_overlay', 's', $uploaded_img !== null ? $uploaded_img : $keep_img)
            ->Value('page_video', 's', $uploaded_vid !== null ? $uploaded_vid : $keep_vid)
            ->Condition('page_id =', 'i', $page_id)
            ->Run();
        header('Location: pages.php?m=updated'); exit;

    } elseif ($action === 'delete') {
        $page_id = (int)($_POST['page_id'] ?? 0);
        if ($page_id > 0) {
            DeleteQuery('pages')->Condition('page_id =', 'i', $page_id)->Run();
        }
        header('Location: pages.php?m=deleted'); exit;

    } elseif ($action === 'move') {
        $ajax = isset($_POST['ajax']);
        $page_id = (int)($_POST['page_id'] ?? 0);
        $dir = $_POST['dir'] ?? '';
        $cur = get_page_by_id($page_id);
        if ($cur) {
            $curIdx = (int)$cur['page_index'];
            if ($dir === 'up') {
                $prev = SelectQuery('pages')->Condition('page_index <', 'i', $curIdx)->Order('page_index', 'DESC')->Limit(1)->Run();
                $prev = $prev ? array_values($prev)[0] : null;
                if ($prev) {
                    $prevIdx = (int)$prev['page_index'];
                    UpdateQuery('pages')->Value('page_index', 'i', $prevIdx)->Condition('page_id =', 'i', $cur['page_id'])->Run();
                    UpdateQuery('pages')->Value('page_index', 'i', $curIdx)->Condition('page_id =', 'i', $prev['page_id'])->Run();
                }
            } elseif ($dir === 'down') {
                $next = SelectQuery('pages')->Condition('page_index >', 'i', $curIdx)->Order('page_index', 'ASC')->Limit(1)->Run();
                $next = $next ? array_values($next)[0] : null;
                if ($next) {
                    $nextIdx = (int)$next['page_index'];
                    UpdateQuery('pages')->Value('page_index', 'i', $nextIdx)->Condition('page_id =', 'i', $cur['page_id'])->Run();
                    UpdateQuery('pages')->Value('page_index', 'i', $curIdx)->Condition('page_id =', 'i', $next['page_id'])->Run();
                }
            }
        }
        if ($ajax) {
            $ordered = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
            $ids = [];
            foreach ($ordered as $r) $ids[] = (int)$r['page_id'];
            header('Content-Type: application/json');
            echo json_encode(['ok'=>true,'order'=>$ids]);
            exit;
        } else {
            header('Location: pages.php?m=reordered'); exit;
        }
    }
}

$pages = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
if (!is_array($pages)) $pages = [];

$trabajos_dir = realpath(__DIR__ . '/../trabajos');
$page_files = [];
if ($trabajos_dir && is_dir($trabajos_dir)) {
    $patterns = ['/*.php','/*.html','/*.htm'];
    foreach ($patterns as $pat) {
        foreach ((array)glob($trabajos_dir . $pat) as $file) {
            if (is_file($file)) $page_files[] = basename($file);
        }
    }
}
$page_files = array_values(array_unique($page_files));
natcasesort($page_files);
$page_files = array_values($page_files);

$page_options_only = '';
foreach ($page_files as $pf) {
    $page_options_only .= '<option value="'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'</option>';
}
$page_options_create = '<option value="" disabled selected>Seleccioná una página</option>' . $page_options_only;

$existing_urls = array_values(array_column($pages, 'page_url'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title>Kahlo Web 2.0 - Páginas</title>
    <link rel="icon" type="image/jpeg" href="img/favicon.jpg">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/admin.css" type="text/css">
    <style>
        .badge-path{font-size:11px;background:#f5f5f5;border:1px solid #e2e2e2;color:#333}
        .mini-thumb{width:56px;height:40px;object-fit:contain;border:1px solid #eee;border-radius:4px;
            background:
              conic-gradient(#eee 0 25%, #f7f7f7 0 50%) 0 0/12px 12px,
              conic-gradient(#f7f7f7 0 25%, #eee 0 50%) 6px 6px/12px 12px}
        .mini-thumb[src$=".png"]{
            background:
              conic-gradient(#cfcfcf 0 25%, #e7e7e7 0 50%) 0 0/12px 12px,
              conic-gradient(#e7e7e7 0 25%, #cfcfcf 0 50%) 6px 6px/12px 12px}
        .btn-move{padding:4px 8px}
        .arrow-only{width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;font-size:16px;line-height:1}
        .moving-out{opacity:.3; transform:translateY(-6px); transition:opacity .25s ease, transform .25s ease}
        .moving-out.down{transform:translateY(6px)}
        .moving-in{animation:flashRow .25s ease}
        @keyframes flashRow{0%{background:#fff4cc}100%{background:transparent}}
        .dup-hint{display:none;margin-top:8px}
        .dup-hint.show{display:block}
        .table td,.table th{vertical-align:middle}
        .help-text{font-size:12px;color:#6c757d;margin-top:4px}
    </style>
</head>
<body>
    <?php ShowAdminNavBar('nav-pages'); ?>
    <div class="area"></div>
    <div class="contenidoAdmin">
        <div class="inicioAdmin jumbotron">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Páginas</h2>
                <button class="btn btn-primary" type="button" id="btnCreate">Nueva página</button>
            </div>

            <?php if (isset($_GET['m']) && $_GET['m'] === 'created'): ?>
                <div class="alert alert-success" style="margin-top:15px">Página creada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'updated'): ?>
                <div class="alert alert-info" style="margin-top:15px">Página actualizada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'deleted'): ?>
                <div class="alert alert-warning" style="margin-top:15px">Página eliminada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'reordered'): ?>
                <div class="alert alert-info" style="margin-top:15px">Orden actualizado</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'dup'): ?>
                <div class="alert alert-danger" style="margin-top:15px">Ya existe una página con esa URL.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'invalid'): ?>
                <div class="alert alert-danger" style="margin-top:15px">Datos incompletos.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badimg'): ?>
                <div class="alert alert-danger" style="margin-top:15px">Formato de imagen inválido. Permitidos: jpg, jpeg, png, svg.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadimg'): ?>
                <div class="alert alert-danger" style="margin-top:15px">No se pudo subir la imagen.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badvid'): ?>
                <div class="alert alert-danger" style="margin-top:15px">Formato de video inválido. Permitido: mp4.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadvid'): ?>
                <div class="alert alert-danger" style="margin-top:15px">No se pudo subir el video.</div>
            <?php endif; ?>

            <div style="margin-top:20px; overflow-x:auto">
                <table class="table table-bordered table-hover" id="pagesTable">
                    <thead>
                        <tr>
                            <th>Página</th>
                            <th>Nombre</th>
                            <th style="width:120px">Logo</th>
                            <th style="width:120px">Video</th>
                            <th style="width:220px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="pagesBody">
                    <?php if (count($pages) === 0): ?>
                        <tr>
                            <td colspan="5">No hay páginas cargadas</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pages as $row): ?>
                            <tr data-id="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                <td><?= htmlspecialchars(preg_replace('#^trabajos/#','',$row['page_url'] ?? '')) ?></td>
                                <td><?= htmlspecialchars($row['page_name'] ?? '') ?></td>
                                <td><?php if (!empty($row['page_logo_overlay'])): ?><img src="../admin/pages_img/<?= htmlspecialchars($row['page_logo_overlay']) ?>" class="mini-thumb"><?php endif; ?></td>
                                <td><?php if (!empty($row['page_video'])): ?><span class="badge badge-path"><?= htmlspecialchars($row['page_video']) ?></span><?php endif; ?></td>
                                <td>
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="up">
                                        <button class="btn btn-sm btn-outline-secondary btn-move arrow-only" title="Subir" type="submit">▲</button>
                                    </form>
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="down">
                                        <button class="btn btn-sm btn-outline-secondary btn-move arrow-only" title="Bajar" type="submit">▼</button>
                                    </form>

                                    <button
                                        class="btn btn-sm btn-secondary btn-edit"
                                        data-id="<?= htmlspecialchars($row['page_id'] ?? '') ?>"
                                        data-url="<?= htmlspecialchars($row['page_url'] ?? '') ?>"
                                        data-name="<?= htmlspecialchars($row['page_name'] ?? '') ?>"
                                        data-logo="<?= htmlspecialchars($row['page_logo_overlay'] ?? '') ?>"
                                        data-video="<?= htmlspecialchars($row['page_video'] ?? '') ?>"
                                        type="button"
                                    >Editar</button>

                                    <form method="post" action="pages.php" style="display:inline" onsubmit="return confirm('¿Eliminar esta página?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="width:100px; height: 50px"></div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="pages.php" class="modal-content" id="createForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="createLabel">Nueva página</h5>
            <button type="button" class="close btn-close close-create" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="action" value="create">
              <div class="form-group">
                  <label>Página</label>
                  <select name="page_url" id="create_url" class="form-control" required>
                      <?= $page_options_create ?>
                  </select>
                  <div class="alert alert-danger dup-hint" id="dupCreate">Ya existe una página con esa URL.</div>
              </div>
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="page_name" id="create_name" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Logo overlay (jpg, jpeg, png, svg)</label>
                  <input type="file" name="page_logo_overlay_file" id="create_logo_file" class="form-control" accept=".jpg,.jpeg,.png,.svg,image/jpeg,image/png,image/svg+xml">
                  <div class="help-text">Se guarda en admin/pages_img/ (DB: solo nombre de archivo)</div>
                  <div class="alert alert-danger dup-hint" id="badImgCreate">Formato inválido. Permitidos: jpg, jpeg, png, svg.</div>
              </div>
              <div class="form-group">
                  <label>Video (mp4)</label>
                  <input type="file" name="page_video_file" id="create_video_file" class="form-control" accept=".mp4,video/mp4">
                  <div class="help-text">Se guarda en admin/pages_videos/ (DB: solo nombre de archivo)</div>
                  <div class="alert alert-danger dup-hint" id="badVidCreate">Formato inválido. Permitido: mp4.</div>
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
        <form method="post" action="pages.php" class="modal-content" id="editForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Editar página</h5>
            <button type="button" class="close btn-close close-edit" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="page_id" id="edit_id">
              <div class="form-group">
                  <label>Página</label>
                  <select name="page_url" id="edit_url" class="form-control" required>
                      <?= $page_options_only ?>
                  </select>
                  <div class="alert alert-danger dup-hint" id="dupEdit">Ya existe una página con esa URL.</div>
              </div>
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="page_name" id="edit_name" class="form-control" required>
              </div>
              <div class="form-group">
                  <label>Logo overlay (jpg, jpeg, png, svg)</label>
                  <input type="file" name="page_logo_overlay_file" id="edit_logo_file" class="form-control" accept=".jpg,.jpeg,.png,.svg,image/jpeg,image/png,image/svg+xml">
                  <div class="help-text">Dejar vacío para mantener el actual (DB guarda solo nombre)</div>
                  <div class="alert alert-danger dup-hint" id="badImgEdit">Formato inválido. Permitidos: jpg, jpeg, png, svg.</div>
                  <div id="edit_logo_preview" style="margin-top:8px"></div>
              </div>
              <div class="form-group">
                  <label>Video (mp4)</label>
                  <input type="file" name="page_video_file" id="edit_video_file" class="form-control" accept=".mp4,video/mp4">
                  <div class="help-text">Dejar vacío para mantener el actual (DB guarda solo nombre)</div>
                  <div class="alert alert-danger dup-hint" id="badVidEdit">Formato inválido. Permitido: mp4.</div>
                  <div id="edit_video_preview" style="margin-top:8px"></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light cancel-edit" data-dismiss="modal" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="btnEditSave">Actualizar</button>
          </div>
        </form>
      </div>
    </div>

    <script>
    window.EXISTING_URLS = <?php echo json_encode($existing_urls, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
    function escapeHtml(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');}
    function validateExt(name, allowed){ if(!name) return true; var ext = name.split('.').pop().toLowerCase(); return allowed.indexOf(ext) !== -1; }

    $(function(){
        var isBS5 = typeof bootstrap !== 'undefined' && typeof bootstrap.Modal === 'function';
        var createEl = document.getElementById('createModal');
        var editEl = document.getElementById('editModal');
        var createModal = isBS5 ? new bootstrap.Modal(createEl) : null;
        var editModal = isBS5 ? new bootstrap.Modal(editEl) : null;

        $('#btnCreate').on('click', function(){
            $('#dupCreate,#badImgCreate,#badVidCreate').removeClass('show');
            $('#createForm')[0].reset();
            if (isBS5) createModal.show(); else $('#createModal').modal('show');
        });
        $('.close-create, .cancel-create').on('click', function(){
            if (isBS5) createModal.hide(); else $('#createModal').modal('hide');
        });

        $('.btn-edit').on('click', function(){
            $('#dupEdit,#badImgEdit,#badVidEdit').removeClass('show');
            var id = $(this).data('id');
            var url = $(this).data('url');
            var name = $(this).data('name');
            var logo = $(this).data('logo');
            var video = $(this).data('video');
            var urlPlain = String(url).replace(/^trabajos\//,'');
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            var $sel = $('#edit_url');
            if ($sel.find('option[value="'+urlPlain+'"]').length === 0 && urlPlain !== '') {
                $sel.prepend('<option value="'+escapeHtml(urlPlain)+'">'+escapeHtml(urlPlain)+'</option>');
            }
            $sel.val(urlPlain);
            $('#edit_url').data('original', urlPlain).trigger('input');

            if (logo) {
                $('#edit_logo_preview').html('<img class="mini-thumb" src="../admin/pages_img/'+escapeHtml(logo)+'"> <span class="badge badge-path">'+escapeHtml(logo)+'</span>');
            } else { $('#edit_logo_preview').empty(); }
            if (video) {
                $('#edit_video_preview').html('<span class="badge badge-path">'+escapeHtml(video)+'</span>');
            } else { $('#edit_video_preview').empty(); }

            if (isBS5) editModal.show(); else $('#editModal').modal('show');
        });
        $('.close-edit, .cancel-edit').on('click', function(){
            if (isBS5) editModal.hide(); else $('#editModal').modal('hide');
        });

        function isDup(url, excludeUrl){
            url = String(url || '').trim();
            excludeUrl = String(excludeUrl || '').trim();
            var src = window.EXISTING_URLS;
            var urls = Array.isArray(src) ? src.slice() : Object.values(src || {});
            if (excludeUrl) urls = urls.filter(function(u){ return String(u) !== excludeUrl; });
            return urls.indexOf(url) !== -1;
        }

        $('#create_url').on('change input', function(){
            var val = $(this).val();
            var dup = isDup(val, '');
            $('#dupCreate').toggleClass('show', dup);
            toggleCreateBtn();
        });

        $('#edit_url').on('change input', function(){
            var val = $(this).val();
            var original = $('#edit_url').data('original') || '';
            var dup = isDup(val, original);
            $('#dupEdit').toggleClass('show', dup);
            toggleEditBtn();
        });

        function toggleCreateBtn(){
            var dup = $('#dupCreate').hasClass('show');
            var badImg = $('#badImgCreate').hasClass('show');
            var badVid = $('#badVidCreate').hasClass('show');
            $('#btnCreateSave').prop('disabled', dup || badImg || badVid);
        }
        function toggleEditBtn(){
            var dup = $('#dupEdit').hasClass('show');
            var badImg = $('#badImgEdit').hasClass('show');
            var badVid = $('#badVidEdit').hasClass('show');
            $('#btnEditSave').prop('disabled', dup || badImg || badVid);
        }

        $('#create_logo_file').on('change', function(){
            var ok = validateExt(this.value, ['jpg','jpeg','png','svg']);
            $('#badImgCreate').toggleClass('show', !ok);
            toggleCreateBtn();
        });
        $('#create_video_file').on('change', function(){
            var ok = validateExt(this.value, ['mp4']);
            $('#badVidCreate').toggleClass('show', !ok);
            toggleCreateBtn();
        });
        $('#edit_logo_file').on('change', function(){
            if (!this.value) { $('#badImgEdit').removeClass('show'); toggleEditBtn(); return; }
            var ok = validateExt(this.value, ['jpg','jpeg','png','svg']);
            $('#badImgEdit').toggleClass('show', !ok);
            toggleEditBtn();
        });
        $('#edit_video_file').on('change', function(){
            if (!this.value) { $('#badVidEdit').removeClass('show'); toggleEditBtn(); return; }
            var ok = validateExt(this.value, ['mp4']);
            $('#badVidEdit').toggleClass('show', !ok);
            toggleEditBtn();
        });

        function animateMove($row, dir){
            $row.addClass('moving-out' + (dir === 'down' ? ' down' : ''));
            setTimeout(function(){
                if (dir === 'up') {
                    var $prev = $row.prev('tr');
                    if ($prev.length) $row.insertBefore($prev);
                } else {
                    var $next = $row.next('tr');
                    if ($next.length) $row.insertAfter($next);
                }
                $row.removeClass('moving-out down').addClass('moving-in');
                setTimeout(function(){ $row.removeClass('moving-in'); }, 250);
            }, 250);
        }

        $('#pagesBody').on('submit', '.moveForm', function(ev){
            ev.preventDefault();
            var $f = $(this);
            var dir = $f.find('input[name="dir"]').val();
            var $row = $f.closest('tr');
            var data = $f.serialize() + '&ajax=1';
            $.post('pages.php', data, function(resp){
                if (!resp || !resp.ok) return;
                animateMove($row, dir);
            }, 'json');
        });
    });
    </script>
</body>
</html>
