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

function k_logo($file, $B) { return k_asset($file, 'pages_img', $B); }
function k_video($file, $B) { return k_asset($file, 'pages_videos', $B); }

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

$pages = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
if (!is_array($pages)) $pages = [];
?>
<div class="rts-case-studies-three rts-section-gap mb-0 position-relative" id="trabajos" style="z-index:2">
    <div class="container-fluid">
        <div class="row g-24 align-items-center mt--90 mt_md--50 mt_sm--0">
            <?php foreach ($pages as $row):
                $href = k_href($row['page_url'] ?? '', $B);
                $videoFile = $row['page_video'] ?? '';
                $videoUrl  = k_video($videoFile, $B);
                $logoUrl   = k_logo($row['page_logo_overlay'] ?? '', $B);
                $isImgBg   = k_is_image_bg($videoFile);
                $isVidBg   = k_is_video_bg($videoFile);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                    <a href="<?= htmlspecialchars($href) ?>" class="pli-image-link">
                        <div class="pli-image-holder">
                            <figure class="pli-image">
                                <?php if ($videoUrl && $isVidBg): ?>
                                    <video class="w-100 image-blur-target" autoplay loop muted playsinline disableRemotePlayback src="<?= htmlspecialchars($videoUrl) ?>" data-src="<?= htmlspecialchars($videoUrl) ?>"></video>
                                <?php elseif ($videoUrl && $isImgBg): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($videoUrl) ?>" data-src="<?= htmlspecialchars($videoUrl) ?>" alt="image">
                                <?php elseif ($logoUrl): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($logoUrl) ?>" data-src="<?= htmlspecialchars($logoUrl) ?>" alt="image">
                                <?php endif; ?>
                            </figure>
                            <?php if ($logoUrl): ?>
                            <div class="logo-overlay">
                                <img src="<?= htmlspecialchars($logoUrl) ?>" class="logo-image" alt="logo">
                            </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
