<?php
$B = rtrim(BASEURL, '/');

$__IS_ARG = false;
if (function_exists('detectar_origen')) {
    ob_start();
    $__res = detectar_origen('esp');
    ob_end_clean();
    $__IS_ARG = ($__res === 'si');
}

$__LOGO_SRC = $__IS_ARG ? ($B . '/img/logo-kahlo-dra.png') : ($B . '/img/logo-white.svg');
$__LOGO_SRCSET = $__IS_ARG ? ($B . '/img/logo-kahlo-dra@2x.png 2x') : '';
?>
<style>
.header-area .logo img.logo-img{display:block;height:44px;width:auto;max-width:100%}
@media (max-width:991px){.header-area .logo img.logo-img{height:36px}}
</style>

<header class="header-area header-one py-4">
    <div class="container">
        <div class="header-wrapper">
            <a href="<?= $B ?>/index.php" class="logo">
                <img src="<?= htmlspecialchars($__LOGO_SRC, ENT_QUOTES, 'UTF-8') ?>" <?= $__LOGO_SRCSET ? 'srcset="'.htmlspecialchars($__LOGO_SRCSET, ENT_QUOTES, 'UTF-8').'"' : '' ?> alt="logo" decoding="async" loading="eager" class="logo-img" height="44">
            </a>
            <div class="header-right desktop-menu">
                <nav class="nav-area">
                    <ul class="navbar-nav-1">
                        <li class="menu-item main-nav-on">
                            <a class="menu-link" href="<?= $B ?>/index.php#trabajos"><span class="rolling-text">Trabajos</span></a>
                        </li>
                        <li class="menu-item main-nav-on">
                            <a class="menu-link" href="<?= $B ?>/index.php#clientes"><span class="rolling-text">Clientes</span></a>
                        </li>
                        <li class="menu-item main-nav-on">
                            <a href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." target="_blank" class="rts-btn btn-radious btn-white text-black">Contactanos</a>
                        </li>
                        <li class="menu-item main-nav-on">
                            <a class="menu-link" href="https://www.instagram.com/kahloagencia/" target="_blank">
                                <img src="<?= $B ?>/img/ig.svg" height="22" alt="Instagram">
                            </a>
                        </li>
                        <li class="menu-item main-nav-on">
                            <a class="menu-link" href="https://www.linkedin.com/company/kahlo-agencia/" target="_blank">
                                <img src="<?= $B ?>/img/in.svg" height="22" alt="LinkedIn">
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>

<div class="mobile-nav" id="mobileNav">
    <ul>
        <li><a href="<?= $B ?>/index.php#trabajos">Trabajos</a></li>
        <li><a href="<?= $B ?>/index.php#clientes">Clientes</a></li>
        <li><a href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." target="_blank">Contactanos</a></li>
        <li><a href="https://www.instagram.com/kahloagencia/" target="_blank">Instagram</a></li>
        <li><a href="https://www.linkedin.com/company/kahlo-agencia/" target="_blank">LinkedIn</a></li>
    </ul>
</div>

<script>
(function() {
  var header = document.querySelector('header.header-area');
  var OFFSET_PX = { trabajos: 320, clientes: 0 };

  function headerHeight() {
    if (!header) return 0;
    return Math.round(header.getBoundingClientRect().height);
  }

  function targetTop(el, id) {
    var y = el.getBoundingClientRect().top + window.pageYOffset;
    var extra = OFFSET_PX[id] || 0;
    return y - headerHeight() + extra;
  }

  function easeInOutCubic(t) {
    return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
  }

  function animateScrollTo(to, duration) {
    var start = window.pageYOffset;
    var diff = to - start;
    if (diff === 0 || duration <= 0) { window.scrollTo(0, to); return; }
    var startTime = performance.now();
    function step(now) {
      var elapsed = now - startTime;
      var t = Math.min(1, elapsed / duration);
      var eased = easeInOutCubic(t);
      window.scrollTo(0, start + diff * eased);
      if (t < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  function settleScroll(el, id, deadlineMs) {
    var start = performance.now();
    function tick() {
      var desired = targetTop(el, id);
      var diff = desired - window.pageYOffset;
      if (Math.abs(diff) <= 2) return;
      window.scrollTo(0, window.pageYOffset + diff * 0.3);
      if (performance.now() - start < deadlineMs) requestAnimationFrame(tick);
      else window.scrollTo(0, desired);
    }
    requestAnimationFrame(tick);
  }

  function durationFor(id, to) {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return 0;
    var distance = Math.abs(to - window.pageYOffset);
    var perPx = 0.6;
    var base = distance * perPx;
    var mult = 1.1;
    var dur = base * mult;
    var min = 700, max = 1400;
    return Math.max(min, Math.min(max, dur));
  }

  function smoothTo(el, id) {
    var to = targetTop(el, id);
    var dur = durationFor(id, to);
    animateScrollTo(to, dur);
    setTimeout(function() { settleScroll(el, id, 600); }, Math.max(100, dur - 50));
  }

  function handleClick(e) {
    var link = e.currentTarget;
    var url = new URL(link.href, window.location.href);
    if (!url.hash || url.origin !== window.location.origin) return;
    var id = url.hash.slice(1);
    var target = document.getElementById(id);
    if (!target) return;
    e.preventDefault();
    smoothTo(target, id);
    var menuToggle = document.getElementById('menuToggle');
    var mobileNav = document.getElementById('mobileNav');
    if (menuToggle && mobileNav) { menuToggle.classList.remove('active'); mobileNav.classList.remove('open'); }
    if (history.pushState) history.pushState(null, '', '#' + id);
  }

  var links = document.querySelectorAll('.navbar-nav-1 a[href*="#"], #mobileNav a[href*="#"]');
  links.forEach(function(a) { a.addEventListener('click', handleClick); });

  function onLoadHash() {
    if (!location.hash) return;
    var id = location.hash.slice(1);
    var target = document.getElementById(id);
    if (!target) return;
    setTimeout(function() { smoothTo(target, id); }, 0);
  }
  window.addEventListener('load', onLoadHash);

  window.addEventListener('resize', function() {
    if (!location.hash) return;
    var id = location.hash.slice(1);
    var target = document.getElementById(id);
    if (!target) return;
    window.scrollTo(0, targetTop(target, id));
  });
})();
</script>
