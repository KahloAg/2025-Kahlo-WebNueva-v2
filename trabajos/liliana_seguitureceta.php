<?php
// trabajos/liliana_seguitureceta.php  (ajusta el nombre si usás otro slug)
// Carga config general, DB, helpers, constantes (BASEURL), etc.
include_once("../_general.php");

// Variables para <head> dinámico y para detección de página en "anterior-siguiente-section.php"
$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']); // p.ej. liliana_seguitureceta.php
$PAGE_TITLE = "Kahlo Agencia - Liliana";
?>

<?php include_once("../templates/trabajos/head-info.php"); ?>
</head>

<body class="index-six">

<?php include_once("../templates/home/navbar.php"); ?>

<main>
    <section class="d-flex align-items-center min-hv">
        <div class="container mt-83">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="d-flex align-items-center justify-content-between col-xl-8">
                        <img src="../img/liliana.png" class="logo-interna" alt="Liliana">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Liliana <br> Seguí tu receta </h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                        Campaña 360 estilo documental testimonial con motivo del Día Internacional de la Mujer
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <img src="../img/trabajos/santander_diamujer-1.jpg" class="img-fluid" alt="Hero">
                </div>
            </div>
        </div>
    </section>

    <section class="d-flex align-items-center my-50">
        <div class="container">
            <div class="row">
                <div class="col-12 txt-trabajo-sub text-start">
                    <p class="text-white">
                        Con los resultados de dicha investigación, desarrollamos una campaña que invitaba a los usuarios
                        de Liliana a seguir su propia receta, en la cocina y en la vida. Este concepto creció hasta llegar
                        a un comercial y se abrió, luego, a vía pública, refugios, transporte público, shoppings, pauta en web
                        y redes sociales, y PNTs en televisión abierta y por cable.<br><br>
                        La campaña tuvo una recepción positiva en todas las plataformas en las que fue replicada.
                    </p>
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <img src="../img/trabajos/liliana_seguitureceta-1.jpg" class="img-fluid" alt="Pieza 1">
                </div>

                <div class="col-12 col-md-6 mt-5">
                    <img src="../img/trabajos/liliana_seguitureceta-2.jpg" class="img-fluid" alt="Pieza 2">
                </div>
            </div>
        </div>
    </section>

    <?php
    // Prev / Next dinámico desde la DB (usa page_index para el orden)
    // Genera URLs como /trabajos/{page_url} y media desde /admin/pages_img y /admin/pages_videos
    include_once("../templates/trabajos/anterior-siguiente-section.php");
    ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>

<!-- Loader -->
<div class="loading-screen" id="loading-screen">
    <span class="bar top-bar"></span>
    <span class="bar down-bar"></span>
    <span class="progress-line"></span>
    <span class="loading-counter"> </span>
</div>

<div class="bg-noise"></div>

<!-- back to top -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

<!-- Scripts -->
<script defer src="../js/jquery.min.js"></script>
<script defer src="../js/bootstrap.min.js"></script>
<script defer src="../js/waypoint.js"></script>
<script defer src="../js/imagesloaded.pkgd.min.js"></script>
<script src="../js/gsap.js"></script>
<script defer src="../js/smoothscroll-varticle.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script defer src="../js/scrolltoplugin.js"></script>
<script defer src="../js/splittext.js"></script>
<script defer src="../js/counterup.js"></script>
<script defer src="../js/waw.js"></script>
<script defer src="../js/main.js"></script>

<script>
// Menú móvil y efectos (defensivo por si el markup viene del include)
const menuToggle = document.getElementById("menuToggle");
const mobileNav  = document.getElementById("mobileNav");
const mobileLinks = mobileNav ? mobileNav.querySelectorAll("a") : [];
const header = document.querySelector("header");

if (menuToggle && mobileNav) {
    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        mobileNav.classList.toggle("open");
    });
    mobileLinks.forEach(link => {
        link.addEventListener("click", () => {
            menuToggle.classList.remove("active");
            mobileNav.classList.remove("open");
        });
    });
}

const mediaQuery = window.matchMedia("(max-width: 992px)");
function handleScroll() {
    if (!header) return;
    if (mediaQuery.matches) {
        if (window.scrollY > 50) header.classList.add("scrolled");
        else header.classList.remove("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
}
window.addEventListener("scroll", handleScroll);
window.addEventListener("resize", handleScroll);
handleScroll();

// Altura footer dinámica
function ajustarAlturaFooter() {
    const footer = document.querySelector("footer.footer");
    const main = document.querySelector("main");
    if (footer && main) {
        const footerHeight = footer.offsetHeight;
        main.style.marginBottom = footerHeight + "px";
    }
}
window.addEventListener("load", ajustarAlturaFooter);
window.addEventListener("resize", ajustarAlturaFooter);

// Fade-in de items del footer
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll("footer .fade-item");
    const observer = new IntersectionObserver(
        (entries) => entries.forEach((e) => { if (e.isIntersecting) e.target.classList.add("visible"); }),
        { root: null, threshold: 0.1 }
    );
    items.forEach((item) => observer.observe(item));
});
</script>

</body>
</html>
