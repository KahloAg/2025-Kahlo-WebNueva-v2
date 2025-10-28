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
    do { $name = bin2hex(random_bytes(8)).'.'.$ext; } while(file_exists($name));
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
    $fi = finfo_open(FILEINFO_MIME_TYPE); $mime = finfo_file($fi,$tmp); finfo_close($fi);
    $ok_mimes = ['image/png','image/jpeg','image/svg+xml'];
    if (!in_array($mime,$ok_mimes)) { if ($ext !== 'svg') { $error = 'bad_img_type'; return null; } }
    $dir = __DIR__.'/pages_img'; ensure_dir($dir);
    $final = random_filename($ext); $abs = $dir.'/'.$final;
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
    $allowed_ext = ['mp4','jpg','jpeg','png'];
    if (!in_array($ext,$allowed_ext)) { $error = 'bad_vid_type'; return null; }
    $fi = finfo_open(FILEINFO_MIME_TYPE); $mime = finfo_file($fi,$tmp); finfo_close($fi);
    $ok = false;
    if ($ext === 'mp4' && ($mime === 'video/mp4' || $mime === 'application/octet-stream')) $ok = true;
    if (($ext === 'jpg' || $ext === 'jpeg') && $mime === 'image/jpeg') $ok = true;
    if ($ext === 'png' && $mime === 'image/png') $ok = true;
    if (!$ok) { $error = 'bad_vid_type'; return null; }
    $dir = __DIR__.'/pages_videos'; ensure_dir($dir);
    $final = random_filename($ext); $abs = $dir.'/'.$final;
    if (!move_uploaded_file($tmp, $abs)) { $error = 'error_vid'; return null; }
    return $final;
}

function handle_poster_upload($field,&$error){
    $error = '';
    if (!isset($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) { $error = 'error_poster'; return null; }
    $tmp = $_FILES[$field]['tmp_name'];
    $orig = $_FILES[$field]['name'];
    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png'];
    if (!in_array($ext,$allowed)) { $error = 'bad_poster_type'; return null; }
    $fi = finfo_open(FILEINFO_MIME_TYPE); $mime = finfo_file($fi,$tmp); finfo_close($fi);
    if (!in_array($mime, ['image/jpeg','image/png'])) { $error = 'bad_poster_type'; return null; }
    $dir = __DIR__.'/pages_videos'; ensure_dir($dir);
    $final = random_filename($ext); $abs = $dir.'/'.$final;
    if (!move_uploaded_file($tmp, $abs)) { $error = 'error_poster'; return null; }
    return $final;
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

function copy_choice_to_store($base_rel, $filename, $dest_subdir, $allowed_ext, &$error){
    $error = '';
    $filename = trim($filename ?? '');
    if ($filename === '') return null;
    if (basename($filename) !== $filename) return null;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_ext)) { $error = 'bad_type'; return null; }
    $src_dir = realpath(__DIR__.'/../'.$base_rel);
    if (!$src_dir) { $error = 'bad_path'; return null; }
    $src = $src_dir.'/'.$filename;
    if (!is_file($src)) { $error = 'bad_path'; return null; }
    $dest_dir = __DIR__.'/'.$dest_subdir; ensure_dir($dest_dir);
    $final = random_filename($ext); $dest = $dest_dir.'/'.$final;
    if (!copy($src, $dest)) { $error = 'copy_error'; return null; }
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

        $imgErr = ''; $vidErr = ''; $posterErr = '';

        $uploaded_img = handle_image_upload('page_logo_overlay_file',$imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: pages.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: pages.php?m=uploadimg'); exit; }

        $logoChoiceErr = ''; $copied_logo = null;
        if ($uploaded_img === null) {
            if (!empty($_POST['page_logo_overlay_choice'])) {
                $copied_logo = copy_choice_to_store('img/logos', $_POST['page_logo_overlay_choice'], 'pages_img', ['png','jpg','jpeg','svg'], $logoChoiceErr);
            } elseif (!empty($_POST['page_logo_overlay_choice_img'])) {
                $copied_logo = copy_choice_to_store('img', $_POST['page_logo_overlay_choice_img'], 'pages_img', ['png','jpg','jpeg','svg'], $logoChoiceErr);
            }
            if ($logoChoiceErr === 'bad_type') { header('Location: pages.php?m=badimg'); exit; }
            if ($logoChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadimg'); exit; }
        }

        $uploaded_vid = handle_video_upload('page_video_file',$vidErr);
        if ($vidErr === 'bad_vid_type') { header('Location: pages.php?m=badvid'); exit; }
        if ($vidErr === 'error_vid') { header('Location: pages.php?m=uploadvid'); exit; }

        $imgChoiceErr = ''; $copied_fondo = null;
        if ($uploaded_vid === null) {
            if (!empty($_POST['page_video_choice'])) {
                $copied_fondo = copy_choice_to_store('img', $_POST['page_video_choice'], 'pages_videos', ['jpg','jpeg','png','mp4'], $imgChoiceErr);
            }
            if ($imgChoiceErr === 'bad_type') { header('Location: pages.php?m=badvid'); exit; }
            if ($imgChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadvid'); exit; }
        }

        $uploaded_poster = handle_poster_upload('page_video_poster_file',$posterErr);
        if ($posterErr === 'bad_poster_type') { header('Location: pages.php?m=badposter'); exit; }
        if ($posterErr === 'error_poster') { header('Location: pages.php?m=uploadposter'); exit; }

        $posterChoiceErr = ''; $copied_poster = null;
        if ($uploaded_poster === null) {
            if (!empty($_POST['page_video_poster_choice'])) {
                $copied_poster = copy_choice_to_store('img', $_POST['page_video_poster_choice'], 'pages_videos', ['jpg','jpeg','png'], $posterChoiceErr);
            }
            if ($posterChoiceErr === 'bad_type') { header('Location: pages.php?m=badposter'); exit; }
            if ($posterChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadposter'); exit; }
        }

        $final_logo = $uploaded_img !== null ? $uploaded_img : ($copied_logo ?? '');
        $final_video = $uploaded_vid !== null ? $uploaded_vid : ($copied_fondo ?? '');
        $final_poster = $uploaded_poster !== null ? $uploaded_poster : ($copied_poster ?? '');

        InsertQuery('pages')
            ->Value('page_url', 's', $page_url)
            ->Value('page_name', 's', $page_name)
            ->Value('page_logo_overlay', 's', $final_logo)
            ->Value('page_video', 's', $final_video)
            ->Value('page_video_poster', 's', $final_poster)
            ->Value('page_active', 'i', 0)
            ->Run();
        global $conn; $new_id = mysqli_insert_id($conn);
        if ($new_id > 0) UpdateQuery('pages')->Value('page_index', 'i', $new_id)->Condition('page_id =', 'i', $new_id)->Run();
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
        $keep_poster = $current ? ($current['page_video_poster'] ?? '') : '';

        $imgErr = ''; $vidErr = ''; $posterErr = '';

        $uploaded_img = handle_image_upload('page_logo_overlay_file',$imgErr);
        if ($imgErr === 'bad_img_type') { header('Location: pages.php?m=badimg'); exit; }
        if ($imgErr === 'error_img') { header('Location: pages.php?m=uploadimg'); exit; }

        $logoChoiceErr = ''; $copied_logo = null;
        if ($uploaded_img === null) {
            if (!empty($_POST['page_logo_overlay_choice'])) {
                $copied_logo = copy_choice_to_store('img/logos', $_POST['page_logo_overlay_choice'], 'pages_img', ['png','jpg','jpeg','svg'], $logoChoiceErr);
            } elseif (!empty($_POST['page_logo_overlay_choice_img'])) {
                $copied_logo = copy_choice_to_store('img', $_POST['page_logo_overlay_choice_img'], 'pages_img', ['png','jpg','jpeg','svg'], $logoChoiceErr);
            }
            if ($logoChoiceErr === 'bad_type') { header('Location: pages.php?m=badimg'); exit; }
            if ($logoChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadimg'); exit; }
        }

        $uploaded_vid = handle_video_upload('page_video_file',$vidErr);
        if ($vidErr === 'bad_vid_type') { header('Location: pages.php?m=badvid'); exit; }
        if ($vidErr === 'error_vid') { header('Location: pages.php?m=uploadvid'); exit; }

        $imgChoiceErr = ''; $copied_fondo = null;
        if ($uploaded_vid === null) {
            if (!empty($_POST['page_video_choice'])) {
                $copied_fondo = copy_choice_to_store('img', $_POST['page_video_choice'], 'pages_videos', ['jpg','jpeg','png','mp4'], $imgChoiceErr);
            }
            if ($imgChoiceErr === 'bad_type') { header('Location: pages.php?m=badvid'); exit; }
            if ($imgChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadvid'); exit; }
        }

        $uploaded_poster = handle_poster_upload('page_video_poster_file',$posterErr);
        if ($posterErr === 'bad_poster_type') { header('Location: pages.php?m=badposter'); exit; }
        if ($posterErr === 'error_poster') { header('Location: pages.php?m=uploadposter'); exit; }

        $posterChoiceErr = ''; $copied_poster = null;
        if ($uploaded_poster === null) {
            if (!empty($_POST['page_video_poster_choice'])) {
                $copied_poster = copy_choice_to_store('img', $_POST['page_video_poster_choice'], 'pages_videos', ['jpg','jpeg','png'], $posterChoiceErr);
            }
            if ($posterChoiceErr === 'bad_type') { header('Location: pages.php?m=badposter'); exit; }
            if ($posterChoiceErr === 'copy_error') { header('Location: pages.php?m=uploadposter'); exit; }
        }

        $final_logo = $uploaded_img !== null ? $uploaded_img : ($copied_logo !== null ? $copied_logo : $keep_img);
        $final_video = $uploaded_vid !== null ? $uploaded_vid : ($copied_fondo !== null ? $copied_fondo : $keep_vid);
        $final_poster = $uploaded_poster !== null ? $uploaded_poster : ($copied_poster !== null ? $copied_poster : $keep_poster);

        UpdateQuery('pages')
            ->Value('page_url', 's', $page_url)
            ->Value('page_name', 's', $page_name)
            ->Value('page_logo_overlay', 's', $final_logo)
            ->Value('page_video', 's', $final_video)
            ->Value('page_video_poster', 's', $final_poster)
            ->Condition('page_id =', 'i', $page_id)
            ->Run();
        header('Location: pages.php?m=updated'); exit;

    } elseif ($action === 'delete') {
        $page_id = (int)($_POST['page_id'] ?? 0);
        if ($page_id > 0) DeleteQuery('pages')->Condition('page_id =', 'i', $page_id)->Run();
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
            } elseif ($dir === 'top') {
                $minRow = SelectQuery('pages')->Order('page_index', 'ASC')->Limit(1)->Run();
                $minRow = $minRow ? array_values($minRow)[0] : null;
                $minIdx = $minRow ? (int)$minRow['page_index'] : 0;
                if ($curIdx > $minIdx) UpdateQuery('pages')->Value('page_index', 'i', $minIdx - 1)->Condition('page_id =', 'i', $cur['page_id'])->Run();
            } elseif ($dir === 'bottom') {
                $maxRow = SelectQuery('pages')->Order('page_index', 'DESC')->Limit(1)->Run();
                $maxRow = $maxRow ? array_values($maxRow)[0] : null;
                $maxIdx = $maxRow ? (int)$maxRow['page_index'] : 0;
                if ($curIdx < $maxIdx) UpdateQuery('pages')->Value('page_index', 'i', $maxIdx + 1)->Condition('page_id =', 'i', $cur['page_id'])->Run();
            }
        }
        if ($ajax) {
            $ordered = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
            $ids = []; foreach ($ordered as $r) $ids[] = (int)$r['page_id'];
            header('Content-Type: application/json'); echo json_encode(['ok'=>true,'order'=>$ids]); exit;
        } else { header('Location: pages.php?m=reordered'); exit; }
    } elseif ($action === 'toggle_active') {
        $ajax = isset($_POST['ajax']);
        $page_id = (int)($_POST['page_id'] ?? 0);
        $cur = get_page_by_id($page_id);
        if ($cur) {
            $curVal = isset($cur['page_active']) ? (int)$cur['page_active'] : 0;
            $newVal = $curVal === 0 ? 1 : 0;
            UpdateQuery('pages')->Value('page_active', 'i', $newVal)->Condition('page_id =', 'i', $page_id)->Run();
            if ($ajax) { header('Content-Type: application/json'); echo json_encode(['ok'=>true,'new'=>$newVal,'label'=>$newVal===0?'Activo':'Inactivo']); exit; }
            header('Location: pages.php'); exit;
        } else {
            if ($ajax) { header('Content-Type: application/json'); echo json_encode(['ok'=>false]); exit; }
            header('Location: pages.php'); exit;
        }
    }
}

$pages = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
if (!is_array($pages)) $pages = [];

$trabajos_dir = realpath(__DIR__ . '/../trabajos');
$page_files = [];
if ($trabajos_dir && is_dir($trabajos_dir)) {
    foreach (['/*.php','/*.html','/*.htm'] as $pat) {
        foreach ((array)glob($trabajos_dir . $pat) as $file) if (is_file($file)) $page_files[] = basename($file);
    }
}
$page_files = array_values(array_unique($page_files)); natcasesort($page_files); $page_files = array_values($page_files);

$existing_urls = array_values(array_column($pages, 'page_url'));
$available_for_create = array_values(array_diff($page_files, $existing_urls));

$page_options_only = '';
foreach ($page_files as $pf) $page_options_only .= '<option value="'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'</option>';

$page_options_create = '<option value="" disabled selected>Seleccioná una página</option>';
foreach ($available_for_create as $pf) $page_options_create .= '<option value="'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($pf, ENT_QUOTES, 'UTF-8').'</option>';

function is_image_ext($filename){
    $e = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($e, ['jpg','jpeg','png']);
}

$logos_dir_abs = realpath(__DIR__.'/../img/logos');
$logos_files = list_dir_files($logos_dir_abs ?: '', ['png','jpg','jpeg','svg']);

$img_dir_abs = realpath(__DIR__.'/../img');
$img_files = list_dir_files($img_dir_abs ?: '', ['jpg','jpeg','png','mp4','svg']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .page-toolbar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:8px 0 14px}
        .page-toolbar h2{margin:0;font-weight:700;color:#111;display:block!important}
        .badge-path{font-size:12px;background:#f3f4f6;border:1px solid #e5e7eb;color:#374151}
        .mini-thumb{width:84px;height:60px;object-fit:contain;border:1px solid #d0d5dd;border-radius:6px;background:conic-gradient(#d7dbe3 0 25%, #eef0f4 0 50%) 0 0/12px 12px,conic-gradient(#eef0f4 0 25%, #d7dbe3 0 50%) 6px 6px/12px 12px}
        .mini-thumb[src$=".png"]{background:conic-gradient(#c6ccd7 0 25%, #e3e7ee 0 50%) 0 0/12px 12px,conic-gradient(#e3e7ee 0 25%, #c6ccd7 0 50%) 6px 6px/12px 12px}
        .logo-bg{background:#cbd2e1;border-radius:8px;padding:2px;display:inline-block}
        .table td,.table th{vertical-align:middle}
        .help-text{font-size:12px;color:#6b7280;margin-top:4px}
        .modal-dialog{max-width:980px}
        .picker-split-3{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}
        .picker-split{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .option-card{border:1px solid #e5e7eb;border-radius:12px;background:#fafbfc;padding:12px}
        .option-head{display:flex;align-items:center;gap:8px;margin-bottom:8px}
        .option-badge{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:999px;background:#111827;color:#fff;font-weight:600;font-size:13px}
        .option-title{font-weight:600}
        .gallery-panel{position:fixed;top:80px;right:16px;width:560px;max-width:92vw;height:72vh;background:#fff;border:1px solid #cfd4dc;border-radius:10px;box-shadow:0 12px 44px rgba(17,24,39,.22);display:none;z-index:2000;overflow:auto}
        .gallery-head{display:flex;justify-content:space-between;align-items:center;padding:10px 14px;border-bottom:1px solid #d6dbe3}
        .gallery-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px;padding:12px}
        .gallery-item{border:1px solid #cfd4dc;border-radius:10px;padding:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;height:110px;background:#e1e4ea;transition:transform .08s ease;font-size:12px;color:#111}
        .gallery-item:hover{transform:scale(1.02)}
        .gallery-item img{max-width:100%;max-height:96px;object-fit:contain}
        .gallery-footer{padding:8px 12px;border-top:1px solid #d6dbe3;font-size:12px;color:#4b5563;background:#f8fafc}
        .close-x{border:none;background:transparent;font-size:22px;line-height:1}
        .btn-move{padding:0}
        .icon-only{width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;font-size:14px;line-height:1}
        .icon-btn{width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;padding:0}
        .status-btn{min-width:92px}
        .moving-out{opacity:.3; transform:translateY(-6px); transition:opacity .25s ease, transform .25s ease}
        .moving-out.down{transform:translateY(6px)}
        .moving-in{animation:flashRow .25s ease}
        @keyframes flashRow{0%{background:#fff4cc}100%{background:transparent}}
        .dup-hint{display:none !important;margin-top:8px}
        .dup-hint.show{display:block !important}
    </style>
</head>
<body>
    <?php ShowAdminNavBar('nav-pages'); ?>

    <div class="contenidoAdmin">
        <div class="inicioAdmin jumbotron">
            <div class="page-toolbar">
                <h2>Páginas</h2>
                <button class="btn btn-danger" type="button" id="btnCreate">Nueva página</button>
            </div>

            <?php if (isset($_GET['m']) && $_GET['m'] === 'created'): ?>
                <div class="alert alert-success" style="margin-top:10px">Página creada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'updated'): ?>
                <div class="alert alert-info" style="margin-top:10px">Página actualizada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'deleted'): ?>
                <div class="alert alert-warning" style="margin-top:10px">Página eliminada</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'reordered'): ?>
                <div class="alert alert-info" style="margin-top:10px">Orden actualizado</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'dup'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Ya existe una página con esa URL.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'invalid'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Datos incompletos.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badimg'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Formato de imagen inválido. Permitidos: jpg, jpeg, png, svg.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadimg'): ?>
                <div class="alert alert-danger" style="margin-top:10px">No se pudo subir la imagen.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badvid'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Formato inválido. Permitidos: mp4, jpg, jpeg, png.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadvid'): ?>
                <div class="alert alert-danger" style="margin-top:10px">No se pudo subir el archivo.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'badposter'): ?>
                <div class="alert alert-danger" style="margin-top:10px">Poster inválido. Permitidos: jpg, jpeg, png.</div>
            <?php elseif (isset($_GET['m']) && $_GET['m'] === 'uploadposter'): ?>
                <div class="alert alert-danger" style="margin-top:10px">No se pudo subir el poster.</div>
            <?php endif; ?>

            <div style="margin-top:10px; overflow-x:auto">
                <table class="table table-bordered table-hover" id="pagesTable">
                    <thead>
                        <tr>
                            <th>Página</th>
                            <th>Nombre</th>
                            <th style="width:160px">Logo</th>
                            <th style="width:180px">Video/Imagen</th>
                            <th style="width:160px">Poster</th>
                            <th style="width:220px">Acciones</th>
                            <th style="width:120px">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="pagesBody">
                    <?php if (count($pages) === 0): ?>
                        <tr><td colspan="7">No hay páginas cargadas</td></tr>
                    <?php else: foreach ($pages as $row): ?>
                        <tr data-id="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                            <td><?= htmlspecialchars(preg_replace('#^trabajos/#','',$row['page_url'] ?? '')) ?></td>
                            <td><?= htmlspecialchars($row['page_name'] ?? '') ?></td>
                            <td>
                                <?php if (!empty($row['page_logo_overlay'])): ?>
                                    <?php $logoVal = $row['page_logo_overlay']; $logoSrc = strpos($logoVal,'/') !== false ? '../'.ltrim($logoVal,'/') : '../admin/pages_img/'.htmlspecialchars($logoVal); ?>
                                    <span class="logo-bg"><img src="<?= htmlspecialchars($logoSrc) ?>" class="mini-thumb"></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($row['page_video'])): ?>
                                    <?php
                                        $vidVal = $row['page_video']; $isPath = strpos($vidVal,'/') !== false;
                                        $isImg = $isPath ? preg_match('/\.(jpg|jpeg|png)$/i',$vidVal) : is_image_ext($vidVal);
                                        if ($isImg) {
                                            $src = $isPath ? '../'.ltrim($vidVal,'/') : '../admin/pages_videos/'.htmlspecialchars($vidVal);
                                            echo '<img src="'.htmlspecialchars($src).'" class="mini-thumb"> <span class="badge badge-path">'.htmlspecialchars(basename($vidVal)).'</span>';
                                        } else {
                                            echo '<span class="badge badge-path">'.htmlspecialchars(basename($vidVal)).'</span>';
                                        }
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($row['page_video_poster'])): ?>
                                    <?php
                                        $posVal = $row['page_video_poster'];
                                        $posSrc = strpos($posVal,'/') !== false ? '../'.ltrim($posVal,'/') : '../admin/pages_videos/'.htmlspecialchars($posVal);
                                        echo '<img src="'.htmlspecialchars($posSrc).'" class="mini-thumb"> <span class="badge badge-path">'.htmlspecialchars(basename($posVal)).'</span>';
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Mover">
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="up">
                                        <button class="btn btn-sm btn-outline-secondary btn-move icon-only" title="Subir" type="submit"><i class="fa-solid fa-chevron-up"></i></button>
                                    </form>
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="down">
                                        <button class="btn btn-sm btn-outline-secondary btn-move icon-only" title="Bajar" type="submit"><i class="fa-solid fa-chevron-down"></i></button>
                                    </form>
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="top">
                                        <button class="btn btn-sm btn-outline-secondary btn-move icon-only" title="Subir al tope" type="submit"><i class="fa-solid fa-angles-up"></i></button>
                                    </form>
                                    <form method="post" action="pages.php" class="d-inline moveForm">
                                        <input type="hidden" name="action" value="move">
                                        <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                        <input type="hidden" name="dir" value="bottom">
                                        <button class="btn btn-sm btn-outline-secondary btn-move icon-only" title="Bajar al final" type="submit"><i class="fa-solid fa-angles-down"></i></button>
                                    </form>
                                </div>

                                <button class="btn btn-sm btn-outline-secondary icon-btn btn-edit"
                                    data-id="<?= htmlspecialchars($row['page_id'] ?? '') ?>"
                                    data-url="<?= htmlspecialchars($row['page_url'] ?? '') ?>"
                                    data-name="<?= htmlspecialchars($row['page_name'] ?? '') ?>"
                                    data-logo="<?= htmlspecialchars($row['page_logo_overlay'] ?? '') ?>"
                                    data-video="<?= htmlspecialchars($row['page_video'] ?? '') ?>"
                                    data-poster="<?= htmlspecialchars($row['page_video_poster'] ?? '') ?>"
                                    type="button" title="Editar"><i class="fa-solid fa-pen"></i></button>

                                <form method="post" action="pages.php" style="display:inline" onsubmit="return confirm('¿Eliminar esta página?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                    <button class="btn btn-sm btn-outline-danger icon-btn" type="submit" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                            <td>
                                <?php $isInactive = isset($row['page_active']) ? (int)$row['page_active'] === 1 : false; ?>
                                <form method="post" action="pages.php" class="d-inline toggleActiveForm">
                                    <input type="hidden" name="action" value="toggle_active">
                                    <input type="hidden" name="page_id" value="<?= htmlspecialchars($row['page_id'] ?? '') ?>">
                                    <button type="submit" class="btn btn-sm status-btn <?= $isInactive ? 'btn-outline-secondary' : 'btn-success' ?> toggle-active-btn">
                                        <?= $isInactive ? 'Inactivo' : 'Activo' ?>
                                    </button>
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
                  <div class="alert alert-danger dup-hint" id="dupCreate" style="display:none">Ya existe una página con esa URL.</div>
              </div>
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="page_name" id="create_name" class="form-control" required>
              </div>

              <div class="form-group">
                  <label>Logo overlay</label>
                  <div class="picker-split-3">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_logo_overlay_file" id="create_logo_file" class="form-control" accept=".jpg,.jpeg,.png,.svg,image/jpeg,image/png,image/svg+xml">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí de /img/logos</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="logos" data-target="create_logo_choice">Abrir galería</button>
                          <div class="help-text" id="create_logo_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_logo_overlay_choice" id="create_logo_choice">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">C</div><div class="option-title">Elegí de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="logos_img" data-target="create_logo_choice_img">Abrir galería</button>
                          <div class="help-text" id="create_logo_choice_img_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_logo_overlay_choice_img" id="create_logo_choice_img">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badImgCreate" style="display:none">Formato inválido. Permitidos: jpg, jpeg, png, svg.</div>
              </div>

              <div class="form-group">
                  <label>Video o imagen</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_video_file" id="create_video_file" class="form-control" accept=".mp4,.jpg,.jpeg,.png,video/mp4,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí imagen o video de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="fondos" data-target="create_video_choice">Abrir galería</button>
                          <div class="help-text" id="create_video_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_video_choice" id="create_video_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badVidCreate" style="display:none">Formato inválido. Permitidos: mp4, jpg, jpeg, png.</div>
              </div>

              <div class="form-group">
                  <label>Poster del video</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_video_poster_file" id="create_poster_file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí imagen de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="posters" data-target="create_poster_choice">Abrir galería</button>
                          <div class="help-text" id="create_poster_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_video_poster_choice" id="create_poster_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badPosterCreate" style="display:none">Poster inválido. Permitidos: jpg, jpeg, png.</div>
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
                  <div class="alert alert-danger dup-hint" id="dupEdit" style="display:none">Ya existe una página con esa URL.</div>
              </div>
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="page_name" id="edit_name" class="form-control" required>
              </div>

              <div class="form-group">
                  <label>Logo overlay</label>
                  <div class="picker-split-3">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_logo_overlay_file" id="edit_logo_file" class="form-control" accept=".jpg,.jpeg,.png,.svg,image/jpeg,image/png,image/svg+xml">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí de /img/logos</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="logos" data-target="edit_logo_choice">Abrir galería</button>
                          <div class="help-text" id="edit_logo_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_logo_overlay_choice" id="edit_logo_choice">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">C</div><div class="option-title">Elegí de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="logos_img" data-target="edit_logo_choice_img">Abrir galería</button>
                          <div class="help-text" id="edit_logo_choice_img_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_logo_overlay_choice_img" id="edit_logo_choice_img">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badImgEdit" style="display:none">Formato inválido. Permitidos: jpg, jpeg, png, svg.</div>
                  <div id="edit_logo_preview" style="margin-top:8px"></div>
              </div>

              <div class="form-group">
                  <label>Video o imagen</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_video_file" id="edit_video_file" class="form-control" accept=".mp4,.jpg,.jpeg,.png,video/mp4,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí imagen o video de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="fondos" data-target="edit_video_choice">Abrir galería</button>
                          <div class="help-text" id="edit_video_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_video_choice" id="edit_video_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badVidEdit" style="display:none">Formato inválido. Permitidos: mp4, jpg, jpeg, png.</div>
                  <div id="edit_video_preview" style="margin-top:8px"></div>
              </div>

              <div class="form-group">
                  <label>Poster del video</label>
                  <div class="picker-split">
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">A</div><div class="option-title">Elegí del ordenador</div></div>
                          <input type="file" name="page_video_poster_file" id="edit_poster_file" class="form-control" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                      </div>
                      <div class="option-card">
                          <div class="option-head"><div class="option-badge">B</div><div class="option-title">Elegí imagen de /img</div></div>
                          <button type="button" class="btn btn-outline-secondary w-100 choose-btn" data-gallery="posters" data-target="edit_poster_choice">Abrir galería</button>
                          <div class="help-text" id="edit_poster_choice_label" style="margin-top:6px"></div>
                          <input type="hidden" name="page_video_poster_choice" id="edit_poster_choice">
                      </div>
                  </div>
                  <div class="alert alert-danger dup-hint" id="badPosterEdit" style="display:none">Poster inválido. Permitidos: jpg, jpeg, png.</div>
                  <div id="edit_poster_preview" style="margin-top:8px"></div>
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

    <script id="data-existing-urls" type="application/json"><?= json_encode($existing_urls, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
    <script id="data-logos" type="application/json"><?= json_encode($logos_files, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
    <script id="data-fondos" type="application/json"><?= json_encode($img_files, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
    window.EXISTING_URLS = JSON.parse(document.getElementById('data-existing-urls').textContent || '[]');
    window.K_LOGOS = JSON.parse(document.getElementById('data-logos').textContent || '[]');
    window.K_FONDOS = JSON.parse(document.getElementById('data-fondos').textContent || '[]');

    function escapeHtml(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');}
    function validateExt(name, allowed){ if(!name) return true; var ext = name.split('.').pop().toLowerCase(); return allowed.indexOf(ext) !== -1; }
    function setAlert(id, show){ var $el=$('#'+id); if(show){ $el.addClass('show').show(); } else { $el.removeClass('show').hide(); } }

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
            $('#createForm')[0].reset();
            setAlert('dupCreate', false);
            setAlert('badImgCreate', false);
            setAlert('badVidCreate', false);
            setAlert('badPosterCreate', false);
            $('#create_logo_choice_label,#create_logo_choice_img_label,#create_video_choice_label,#create_poster_choice_label').text('');
            openModal(document.getElementById('createModal'));
        });
        $('.close-create, .cancel-create').on('click', function(){ closeModal(document.getElementById('createModal')); hideGallery(); });

        $('.btn-edit').on('click', function(){
            setAlert('dupEdit', false);
            setAlert('badImgEdit', false);
            setAlert('badVidEdit', false);
            setAlert('badPosterEdit', false);
            var id = $(this).data('id'), url = $(this).data('url'), name = $(this).data('name');
            var logo = $(this).data('logo'), video = $(this).data('video'), poster = $(this).data('poster');
            var urlPlain = String(url).replace(/^trabajos\//,'');
            $('#edit_id').val(id); $('#edit_name').val(name);
            var $sel = $('#edit_url');
            if ($sel.find('option[value="'+urlPlain+'"]').length === 0 && urlPlain !== '') $sel.prepend('<option value="'+escapeHtml(urlPlain)+'">'+escapeHtml(urlPlain)+'</option>');
            $sel.val(urlPlain); $('#edit_url').data('original', urlPlain).trigger('input');

            if (logo) {
                var logoSrc = logo.indexOf('/') !== -1 ? '../'+logo.replace(/^\/+/,'') : '../admin/pages_img/'+logo;
                $('#edit_logo_preview').html('<span class="logo-bg"><img class="mini-thumb" src="'+escapeHtml(logoSrc)+'"></span> <span class="badge badge-path">'+escapeHtml(logo.split('/').pop())+'</span>');
            } else { $('#edit_logo_preview').empty(); }
            if (video) {
                var isImg = /\.(jpg|jpeg|png)$/i.test(video);
                var vidSrc = video.indexOf('/') !== -1 ? '../'+video.replace(/^\/+/,'') : '../admin/pages_videos/'+video;
                if (isImg) $('#edit_video_preview').html('<img class="mini-thumb" src="'+escapeHtml(vidSrc)+'"> <span class="badge badge-path">'+escapeHtml(video.split('/').pop())+'</span>');
                else $('#edit_video_preview').html('<span class="badge badge-path">'+escapeHtml(video.split('/').pop())+'</span>');
            } else { $('#edit_video_preview').empty(); }
            if (poster) {
                var posSrc = poster.indexOf('/') !== -1 ? '../'+poster.replace(/^\/+/,'') : '../admin/pages_videos/'+poster;
                $('#edit_poster_preview').html('<img class="mini-thumb" src="'+escapeHtml(posSrc)+'"> <span class="badge badge-path">'+escapeHtml(poster.split('/').pop())+'</span>');
            } else { $('#edit_poster_preview').empty(); }

            $('#edit_logo_choice_label,#edit_logo_choice_img_label,#edit_video_choice_label,#edit_poster_choice_label').text('');
            openModal(document.getElementById('editModal'));
        });
        $('.close-edit, .cancel-edit').on('click', function(){ closeModal(document.getElementById('editModal')); hideGallery(); });

        function isDup(url, excludeUrl){
            url = String(url || '').trim(); excludeUrl = String(excludeUrl || '').trim();
            var urls = Array.isArray(window.EXISTING_URLS) ? window.EXISTING_URLS.slice() : Object.values(window.EXISTING_URLS || {});
            if (excludeUrl) urls = urls.filter(function(u){ return String(u) !== excludeUrl; });
            return urls.indexOf(url) !== -1;
        }
        $('#create_url').on('change input', function(){ setAlert('dupCreate', isDup($(this).val(), '')); toggleCreateBtn(); });
        $('#edit_url').on('change input', function(){ var orig = $('#edit_url').data('original') || ''; setAlert('dupEdit', isDup($(this).val(), orig)); toggleEditBtn(); });

        function toggleCreateBtn(){ $('#btnCreateSave').prop('disabled', $('#dupCreate').hasClass('show') || $('#badImgCreate').hasClass('show') || $('#badVidCreate').hasClass('show') || $('#badPosterCreate').hasClass('show')); }
        function toggleEditBtn(){ $('#btnEditSave').prop('disabled', $('#dupEdit').hasClass('show') || $('#badImgEdit').hasClass('show') || $('#badVidEdit').hasClass('show') || $('#badPosterEdit').hasClass('show')); }

        $('#create_logo_file').on('change', function(){
            var ok = validateExt(this.value, ['jpg','jpeg','png','svg']); setAlert('badImgCreate', !ok);
            if (ok && this.files && this.files[0]) { $('#create_logo_choice,#create_logo_choice_img').val(''); $('#create_logo_choice_label,#create_logo_choice_img_label').text(''); }
            toggleCreateBtn();
        });
        $('#create_video_file').on('change', function(){
            var ok = validateExt(this.value, ['mp4','jpg','jpeg','png']); setAlert('badVidCreate', !ok);
            if (ok && this.files && this.files[0]) { $('#create_video_choice').val(''); $('#create_video_choice_label').text(''); }
            toggleCreateBtn();
        });
        $('#create_poster_file').on('change', function(){
            var ok = validateExt(this.value, ['jpg','jpeg','png']); setAlert('badPosterCreate', !ok);
            if (ok && this.files && this.files[0]) { $('#create_poster_choice').val(''); $('#create_poster_choice_label').text(''); }
            toggleCreateBtn();
        });
        $('#edit_logo_file').on('change', function(){
            if (!this.value) { setAlert('badImgEdit', false); toggleEditBtn(); return; }
            var ok = validateExt(this.value, ['jpg','jpeg','png','svg']); setAlert('badImgEdit', !ok);
            if (ok && this.files && this.files[0]) { $('#edit_logo_choice,#edit_logo_choice_img').val(''); $('#edit_logo_choice_label,#edit_logo_choice_img_label').text(''); }
            toggleEditBtn();
        });
        $('#edit_video_file').on('change', function(){
            if (!this.value) { setAlert('badVidEdit', false); toggleEditBtn(); return; }
            var ok = validateExt(this.value, ['mp4','jpg','jpeg','png']); setAlert('badVidEdit', !ok);
            if (ok && this.files && this.files[0]) { $('#edit_video_choice').val(''); $('#edit_video_choice_label').text(''); }
            toggleEditBtn();
        });
        $('#edit_poster_file').on('change', function(){
            if (!this.value) { setAlert('badPosterEdit', false); toggleEditBtn(); return; }
            var ok = validateExt(this.value, ['jpg','jpeg','png']); setAlert('badPosterEdit', !ok);
            if (ok && this.files && this.files[0]) { $('#edit_poster_choice').val(''); $('#edit_poster_choice_label').text(''); }
            toggleEditBtn();
        });

        function animateMove($row, dir){
            $row.addClass('moving-out' + (dir === 'down' || dir === 'bottom' ? ' down' : ''));
            setTimeout(function(){
                if (dir === 'up') {
                    var $prev = $row.prev('tr'); if ($prev.length) $row.insertBefore($prev);
                } else if (dir === 'down') {
                    var $next = $row.next('tr'); if ($next.length) $row.insertAfter($next);
                } else if (dir === 'top') {
                    var $tbody = $row.parent(); $row.prependTo($tbody);
                } else if (dir === 'bottom') {
                    var $tbody2 = $row.parent(); $row.appendTo($tbody2);
                }
                $row.removeClass('moving-out down').addClass('moving-in');
                setTimeout(function(){ $row.removeClass('moving-in'); }, 250);
            }, 250);
        }

        $('#pagesBody').on('submit', '.moveForm', function(ev){
            ev.preventDefault();
            var $f=$(this), dir=$f.find('input[name="dir"]').val(), $row=$f.closest('tr');
            $.post('pages.php', $f.serialize()+'&ajax=1', function(resp){ if (!resp || !resp.ok) return; animateMove($row, dir); }, 'json');
        });

        $('#pagesBody').on('submit', '.toggleActiveForm', function(ev){
            ev.preventDefault();
            var $f=$(this), $btn=$f.find('.toggle-active-btn');
            $.post('pages.php', $f.serialize()+'&ajax=1', function(resp){
                if (!resp || !resp.ok) return;
                var isActive = resp.new === 0;
                $btn.text(isActive ? 'Activo' : 'Inactivo');
                $btn.toggleClass('btn-success', isActive).toggleClass('btn-outline-secondary', !isActive);
            }, 'json');
        });

        var galleryPanel = $('#galleryPanel'), galleryGrid = $('#galleryGrid'), galleryTitle = $('#galleryTitle'), galleryHint = $('#galleryHint'), currentTargetInput = null;
        function isMp4(name){ return /\.mp4$/i.test(name); }
        function showGallery(type, targetInputId){
            currentTargetInput = $('#'+targetInputId); galleryGrid.empty();
            var items, basePath, title, hint;
            if (type === 'logos'){ items = window.K_LOGOS || []; basePath = '../img/logos/'; title = 'Logos'; hint = 'Origen: /img/logos'; }
            else if (type === 'logos_img'){ items = (window.K_FONDOS || []).filter(function(n){ return !isMp4(n); }); basePath = '../img/'; title = 'Logos desde /img'; hint = 'Origen: /img'; }
            else if (type === 'posters'){ items = (window.K_FONDOS || []).filter(function(n){ return !isMp4(n); }); basePath = '../img/'; title = 'Posters (imágenes)'; hint = 'Origen: /img'; }
            else { items = window.K_FONDOS || []; basePath = '../img/'; title = 'Imágenes/Videos'; hint = 'Origen: /img'; }
            galleryTitle.text(title); galleryHint.text(hint);
            items.forEach(function(name){
                var card = $('<div class="gallery-item"></div>');
                if (isMp4(name) && type !== 'posters') card.text(name); else card.append($('<img>').attr('src', basePath + name));
                card.on('click', function(){
                    currentTargetInput.val(name);
                    $('#'+targetInputId+'_label').text(name);
                    if (targetInputId.indexOf('logo_choice_img') !== -1){
                        var other = targetInputId.indexOf('create') === 0 ? $('#create_logo_choice') : $('#edit_logo_choice');
                        other.val(''); $('#'+other.attr('id')+'_label').text('');
                        var fileInput = targetInputId.indexOf('create') === 0 ? $('#create_logo_file') : $('#edit_logo_file'); fileInput.val('');
                    } else if (targetInputId.indexOf('logo_choice') !== -1){
                        var other2 = targetInputId.indexOf('create') === 0 ? $('#create_logo_choice_img') : $('#edit_logo_choice_img');
                        other2.val(''); $('#'+other2.attr('id')+'_label').text('');
                        var fileInput2 = targetInputId.indexOf('create') === 0 ? $('#create_logo_file') : $('#edit_logo_file'); fileInput2.val('');
                    } else if (targetInputId.indexOf('poster_choice') !== -1){
                        var fileInput3 = targetInputId.indexOf('create') === 0 ? $('#create_poster_file') : $('#edit_poster_file'); fileInput3.val('');
                    } else {
                        var fileInput4 = targetInputId.indexOf('create') === 0 ? $('#create_video_file') : $('#edit_video_file'); fileInput4.val('');
                    }
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
