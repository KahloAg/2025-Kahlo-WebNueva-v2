<?php
$B = rtrim(BASEURL, '/');

$__IS_ARG = false;
if (function_exists('detectar_origen')) {
    ob_start();
    $__res = detectar_origen('esp');
    ob_end_clean();
    $__IS_ARG = ($__res === 'si');
}

$__FOOTER_LOGO_SRC = $__IS_ARG ? ($B . '/img/logo-kahlo-dra.svg') : ($B . '/img/logo-footer.svg');
$__FOOTER_LOGO_CLASS = 'footer-logo footer-logo--wide';
?>
<style>
.footer .footer-logo{display:block;width:auto;max-width:100%}
.footer .footer-logo--wide{height:auto!important;width:88vw!important;max-width:none;margin-left:auto;margin-right:auto;transform:translateX(-3vw)}
@media (max-width:991px){
  .footer .footer-logo--wide{width:94vw!important;transform:translateX(-2vw)}
}
.footer .madrid-wrap{position:relative;display:inline-block;text-align:right}
.footer .madrid-badge{position:absolute;left:100%;top:50%;transform:translateY(-50%);margin-left:12px;width:62px;height:auto;z-index:2;cursor:pointer}
@media (max-width:991px){
  .footer .madrid-badge{width:49px;margin-left:8px;top:0;transform:none}
  .footer .madrid-wrap{padding-right:54px}
}
</style>

<footer class="footer" id="footer">
    <div class="footer-container">
        <div class="container py-5">
            <div class="row align-items-end gx-5 pt-5">
                <div class="col-12 col-sm-4 col-md-3 mb-5 mb-sm-0">
                    <p class="mb-0 fade-item">
                        <a href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." target="_blank" class="d-flex align-items-center justify-content-between rts-btn btn-radious btn-white text-black">
                            Contactanos
                        </a>
                    </p>
                </div>

                <div class="col-6 col-sm-4 col-md-3">
                    <p class="mb-3 fade-item">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." class="d-flex align-items-center">
                            <span>WHATSAPP</span>
                            <img src="<?= $B ?>/img/arrow-right.svg" class="img-footer" style="height: 25px;">
                        </a>
                    </p>
                    <p class="mb-3 fade-item">
                        <a href="https://www.linkedin.com/company/kahlo-agencia/" target="_blank" class="d-flex align-items-center">
                            <span>LINKEDIN</span>
                            <img src="<?= $B ?>/img/arrow-right.svg" class="img-footer" style="height: 25px;">
                        </a>
                    </p>
                    <p class="mb-0 fade-item">
                        <a href="https://www.instagram.com/kahloagencia" target="_blank" class="d-flex align-items-center">
                            <span>INSTAGRAM</span>
                            <img src="<?= $B ?>/img/arrow-right.svg" class="img-footer" style="height: 25px;">
                        </a>
                    </p>
                </div>

                <div class="col-6 col-sm-4 col-md-3">
                    <p class="mb-3 fade-item ps-3 ps-sm-0">
                        <a href="<?= $B ?>/index.php#trabajos" class="d-flex align-items-center">
                            <span>TRABAJOS</span>
                            <img src="<?= $B ?>/img/arrow-right.svg" class="img-footer" style="height: 25px;">
                        </a>
                    </p>
                    <p class="mb-0 fade-item ps-3 ps-sm-0">
                        <a href="<?= $B ?>/index.php#clientes" class="d-flex align-items-center">
                            <span>CLIENTES</span>
                            <img src="<?= $B ?>/img/arrow-right.svg" class="img-footer" style="height: 25px;">
                        </a>
                    </p>
                </div>

                <div class="col-12 col-md-3 text-md-end mt-5 mt-md-0 d-flex-mob justify-content-between">
                    <p class="mb-4 d-flex-mob align-items-start fade-item">BUENOS AIRES <br>
                        Aguirre 540 2ºB <br> ARGENTINA</p>
                    <div class="madrid-wrap fade-item">
                        <p class="mb-0 d-flex-mob align-items-start">MADRID<br>
                            Calle Campo Real, 9 <br>ESPAÑA</p>
                        <a href="https://drahouse.com/" target="_blank" rel="noopener" aria-label="Abrir sitio de Dra. House">
                            <img src="<?= $B ?>/img/dra_house.png" alt="Dra. House" class="madrid-badge" decoding="async" loading="lazy">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <a href="<?= $B ?>/index.php">
                    <img
                        src="<?= htmlspecialchars($__FOOTER_LOGO_SRC, ENT_QUOTES, 'UTF-8') ?>"
                        class="fade-item <?= $__FOOTER_LOGO_CLASS ?>"
                        alt="Kahlo Agencia"
                        decoding="async"
                        loading="lazy">
                </a>
            </div>
        </div>
    </div>
</footer>
