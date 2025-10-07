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
$pages = SelectQuery('pages')->Order('page_index', 'ASC')->Run();
if (!is_array($pages)) $pages = [];
?>
<div class="rts-case-studies-three rts-section-gap mb-0" id="trabajos">
    <div class="container-fluid">
        <div class="row g-24 align-items-center mt--90 mt_md--50 mt_sm--0">
            <?php foreach ($pages as $row):
                $href = k_href($row['page_url'] ?? '', $B);
                $video = k_video($row['page_video'] ?? '', $B);
                $logo  = k_logo($row['page_logo_overlay'] ?? '', $B);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                    <a href="<?= htmlspecialchars($href) ?>" class="pli-image-link">
                        <div class="pli-image-holder">
                            <figure class="pli-image">
                                <?php if ($video): ?>
                                <video class="w-100 image-blur-target" autoplay loop muted playsinline disableRemotePlayback src="<?= htmlspecialchars($video) ?>" data-src="<?= htmlspecialchars($video) ?>" alt="image"></video>
                                <?php elseif ($logo): ?>
                                <img class="image-blur-target" src="<?= htmlspecialchars($logo) ?>" data-src="<?= htmlspecialchars($logo) ?>" alt="image">
                                <?php endif; ?>
                            </figure>
                            <?php if ($logo): ?>
                            <div class="logo-overlay">
                                <img src="<?= htmlspecialchars($logo) ?>" class="logo-image">
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
