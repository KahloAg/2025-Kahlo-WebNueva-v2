<?php
$B = rtrim(BASEURL, '/');

function k_href($url, $B) {
    if (!$url) return '#';
    if (preg_match('~^https?://~i', $url)) return $url;
    $u = ltrim($url, '/');
    if (strpos($u, 'trabajos/') !== 0) $u = 'trabajos/' . $u;
    return $B . '/' . $u;
}

function k_asset($file, $subdir, $B) {
    if (!$file) return '';
    $p = trim($file);
    if (preg_match('~^https?://~i', $p)) return $p;
    if ($p[0] === '/') return $B . $p;
    if (strpos($p, '/') !== false) return $B . '/' . $p;
    return $B . '/admin/' . $subdir . '/' . $p;
}

function k_logo($file, $B) {
    return k_asset($file, 'pages_img', $B);
}

function k_video($file, $B) {
    return k_asset($file, 'pages_videos', $B);
}

function k_is_image_bg($file) {
    if (!$file) return false;
    $path = parse_url($file, PHP_URL_PATH);
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg','jpeg','png']);
}

function k_is_video_bg($file) {
    if (!$file) return false;
    $path = parse_url($file, PHP_URL_PATH);
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    return $ext === 'mp4';
}

$current_slug = '';
if (isset($PAGE_URL) && $PAGE_URL !== '') {
    $current_slug = $PAGE_URL;
} else {
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $uri = $uri ? strtok($uri, '?') : '';
    $current_slug = $uri ? basename($uri) : basename($_SERVER['SCRIPT_NAME'] ?? '');
}
$current_slug = preg_replace('~^trabajos/~', '', $current_slug);
$current_slug_noext = pathinfo($current_slug, PATHINFO_EXTENSION) === 'php' ? pathinfo($current_slug, PATHINFO_FILENAME) : $current_slug;

$cur = SelectQuery('pages')->Condition('page_url =', 's', $current_slug)->Limit(1)->Run();
if (empty($cur)) {
    $cur = SelectQuery('pages')->Condition('page_url =', 's', $current_slug_noext)->Limit(1)->Run();
}
$cur = $cur ? array_values($cur)[0] : null;
if (!$cur) return;

$cur_idx = (int)$cur['page_index'];

$next = SelectQuery('pages')->Condition('page_index >', 'i', $cur_idx)->Order('page_index', 'ASC')->Limit(1)->Run();
$next = $next ? array_values($next)[0] : null;
if (!$next) {
    $next = SelectQuery('pages')->Order('page_index', 'ASC')->Limit(1)->Run();
    $next = $next ? array_values($next)[0] : null;
}

$prev = SelectQuery('pages')->Condition('page_index <', 'i', $cur_idx)->Order('page_index', 'DESC')->Limit(1)->Run();
$prev = $prev ? array_values($prev)[0] : null;
if (!$prev) {
    $prev = SelectQuery('pages')->Order('page_index', 'DESC')->Limit(1)->Run();
    $prev = $prev ? array_values($prev)[0] : null;
}

$prev_media_file = $prev['page_video'] ?? '';
$prev_media_url  = $prev ? k_video($prev_media_file, $B) : '';
$prev_is_img_bg  = k_is_image_bg($prev_media_file);
$prev_is_vid_bg  = k_is_video_bg($prev_media_file);
$prev_logo  = $prev ? k_logo($prev['page_logo_overlay'] ?? '', $B) : '';
$prev_href  = $prev ? k_href($prev['page_url'] ?? '#', $B) : '#';
$prev_name  = $prev['page_name'] ?? '';

$next_media_file = $next['page_video'] ?? '';
$next_media_url  = $next ? k_video($next_media_file, $B) : '';
$next_is_img_bg  = k_is_image_bg($next_media_file);
$next_is_vid_bg  = k_is_video_bg($next_media_file);
$next_logo  = $next ? k_logo($next['page_logo_overlay'] ?? '', $B) : '';
$next_href  = $next ? k_href($next['page_url'] ?? '#', $B) : '#';
$next_name  = $next['page_name'] ?? '';
?>
<section class="spacer bg-white h-mob-auto d-flex align-items-center position-relative" style="z-index: 2;">
    <div class="container h-100 h-mob-auto py-5 my-5 my-sm-0">
        <div class="row justify-content-sm-between justify-content-center align-items-center h-100">
            <div class="col-md-5 col-sm-6 col-6">
                <div class="single-case-main-wrapper hidden-xs">
                    <a href="<?= htmlspecialchars($prev_href) ?>" class="pli-image-link">
                        <div class="pli-image-holder">
                            <figure class="pli-image">
                                <?php if ($prev_media_url && $prev_is_vid_bg): ?>
                                    <video class="w-100 image-blur-target" autoplay loop muted playsinline disableRemotePlayback src="<?= htmlspecialchars($prev_media_url) ?>"></video>
                                <?php elseif ($prev_media_url && $prev_is_img_bg): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($prev_media_url) ?>" alt="image">
                                <?php elseif ($prev_logo): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($prev_logo) ?>" alt="image">
                                <?php endif; ?>
                            </figure>
                            <?php if ($prev_logo): ?>
                            <div class="logo-overlay">
                                <img src="<?= htmlspecialchars($prev_logo) ?>" class="logo-image" style="height: 34px;" alt="logo">
                            </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column text-start">
                    <p class="txt-next mb-4 text-black">
                        <a class="underline" href="<?= htmlspecialchars($prev_href) ?>">
                            <img src="<?= $B ?>/img/arrow-left-black.svg" class="me-4" style="height: 25px;">VER
                            ANTERIOR<br>PROYECTO
                        </a>
                    </p>
                    <p class="fs-3 text-black mb-0"><?= htmlspecialchars($prev_name) ?></p>
                </div>
            </div>

            <div class="col-md-5 col-sm-6 col-6">
                <div class="single-case-main-wrapper hidden-xs">
                    <a href="<?= htmlspecialchars($next_href) ?>" class="pli-image-link">
                        <div class="pli-image-holder">
                            <figure class="pli-image">
                                <?php if ($next_media_url && $next_is_vid_bg): ?>
                                    <video class="w-100 image-blur-target" autoplay loop muted playsinline disableRemotePlayback src="<?= htmlspecialchars($next_media_url) ?>"></video>
                                <?php elseif ($next_media_url && $next_is_img_bg): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($next_media_url) ?>" alt="image">
                                <?php elseif ($next_logo): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($next_logo) ?>" alt="image">
                                <?php endif; ?>
                            </figure>
                            <?php if ($next_logo): ?>
                            <div class="logo-overlay">
                                <img src="<?= htmlspecialchars($next_logo) ?>" class="logo-image" style="height: 40px;" alt="logo">
                            </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column text-md-end">
                    <p class="txt-next mb-4 text-black">
                        <a href="<?= htmlspecialchars($next_href) ?>" class="underline">
                            <img src="<?= $B ?>/img/arrow-right-black.svg" class="me-4" style="height: 25px;">VER
                            SIGUIENTE<br>PROYECTO
                        </a>
                    </p>
                    <p class="fs-3 text-black mb-0"><?= htmlspecialchars($next_name) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
