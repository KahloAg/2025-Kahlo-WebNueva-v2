<?php
$B = rtrim(BASEURL, '/');
?>
<div class="rts-case-studies-three rts-section-gap mb-0 position-relative" id="trabajos" data-api="<?= htmlspecialchars($B, ENT_QUOTES, 'UTF-8') ?>/api/pages.php" style="z-index:2">
    <div class="container-fluid">
        <div class="row g-24 align-items-center mt--90 mt_md--50 mt_sm--0">
        </div>
    </div>
</div>

<style>
.video-wrap{position:relative}
.proj-video{display:block;width:100%;height:auto;background:#000;object-fit:cover}
</style>

<script>
window.BASEURL = "<?= htmlspecialchars($B, ENT_QUOTES, 'UTF-8') ?>";
window.API_PAGES_URL = "<?= htmlspecialchars($B, ENT_QUOTES, 'UTF-8') ?>/api/pages.php";
</script>
