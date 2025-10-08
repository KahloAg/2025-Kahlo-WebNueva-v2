<?php $B = rtrim(BASEURL, '/'); ?>
<header class="header-area header-one py-4">
    <div class="container">
        <div class="header-wrapper">
            <a href="<?= $B ?>/index.php" class="logo">
                <img src="<?= $B ?>/img/logo-white.svg" alt="logo">
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
                                <img src="<?= $B ?>/img/ig.svg" height="25" alt="Instagram">
                            </a>
                        </li>
                        <li class="menu-item main-nav-on">
                            <a class="menu-link" href="https://www.linkedin.com/company/kahlo-agencia/" target="_blank">
                                <img src="<?= $B ?>/img/in.svg" height="25" alt="LinkedIn">
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
