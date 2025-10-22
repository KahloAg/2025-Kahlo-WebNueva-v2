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
function k_poster($file, $B) { return k_asset($file, 'pages_videos', $B); }

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
                $href       = k_href($row['page_url'] ?? '', $B);
                $videoFile  = $row['page_video'] ?? '';
                $posterFile = $row['page_video_poster'] ?? '';
                $videoUrl   = k_video($videoFile, $B);
                $posterUrl  = k_poster($posterFile, $B);
                $logoUrl    = k_logo($row['page_logo_overlay'] ?? '', $B);
                $isImgBg    = k_is_image_bg($videoFile);
                $isVidBg    = k_is_video_bg($videoFile);
                $hasPoster  = k_is_image_bg($posterFile);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                    <a href="<?= htmlspecialchars($href) ?>" class="pli-image-link">
                        <div class="pli-image-holder">
                            <figure class="pli-image">
                                <?php if ($videoUrl && $isVidBg): ?>
                                    <div class="video-wrap">
                                        <?php if ($hasPoster): ?>
                                            <img class="poster-overlay" src="<?= htmlspecialchars($posterUrl) ?>" alt="">
                                        <?php endif; ?>
                                        <video class="proj-video w-100 image-blur-target"
                                               playsinline
                                               muted
                                               loop
                                               preload="metadata"
                                               data-src="<?= htmlspecialchars($videoUrl) ?>">
                                        </video>
                                    </div>
                                <?php elseif ($videoUrl && $isImgBg): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($videoUrl) ?>" data-src="<?= htmlspecialchars($videoUrl) ?>" alt="image">
                                <?php elseif ($hasPoster): ?>
                                    <img class="image-blur-target" src="<?= htmlspecialchars($posterUrl) ?>" data-src="<?= htmlspecialchars($posterUrl) ?>" alt="image">
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

<style>
.video-wrap{position:relative}
.video-wrap img.poster-overlay{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:opacity .2s;pointer-events:none}
.video-wrap.playing img.poster-overlay{opacity:0}
.proj-video{display:block;width:100%;height:auto;background:#000}
</style>

<script>
document.addEventListener('DOMContentLoaded',function(){
  var wraps=document.querySelectorAll('.video-wrap');

  function bootVideo(w){
    var v=w.querySelector('video');
    if(v.dataset.started) return;
    v.dataset.started=1;

    v.loop = true;          // forzamos loop por JS
    v.muted = true;         // asegura autoplay
    v.playsInline = true;   // iOS inline

    if(!v.src && v.dataset.src){ v.src=v.dataset.src; }
    v.addEventListener('playing',function(){ w.classList.add('playing'); });
    v.addEventListener('waiting',function(){ w.classList.remove('playing'); });

    // fallback extra: si por algo no respeta loop
    v.addEventListener('ended', function(){
      try{ v.currentTime = 0; v.play().catch(function(){}); }catch(e){}
    });

    v.addEventListener('canplay',function(){ v.play().catch(function(){}); },{once:true});
    v.load();
  }

  if(!('IntersectionObserver' in window)){
    wraps.forEach(bootVideo);
    return;
  }

  var io=new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(!entry.isIntersecting) return;
      bootVideo(entry.target);
    });
  },{threshold:0.5});

  wraps.forEach(function(w){ io.observe(w); });
});
</script>
