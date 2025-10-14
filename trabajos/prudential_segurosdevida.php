<?php
// trabajos/prudential_vivir.php  (ajusta el nombre/slug si corresponde)
include_once("../_general.php");

// Variables para <head> dinámico y para navegación prev/next
$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']); // p.ej. prudential_vivir.php
$PAGE_TITLE = "Kahlo Agencia - Prudential";
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
                        <img src="../img/prudential.svg" class="logo-interna" alt="Prudential logo">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Prudential <br> Que tu única preocupación sea vivir</h1>
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
                <div class="col-12 embed-container">
                    <iframe
                        src="https://player.vimeo.com/video/391560523?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0"
                        style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen
                        title="Prudential - Que tu única preocupación sea vivir"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 col-xl-5">
                    <p class="text-white">
                        El desafío era irrumpir en un mercado de baja concientización con un mensaje positivo y virar la conversación de un producto complejo, que centraba su comunicación en la vida después de la muerte.
                    </p>
                    <p class="text-white mb-0">
                        Para conseguirlo incorporamos el concepto “Que tu única preocupación sea vivir” a través de 3 comerciales de TV donde el protagonista, un Life Planner que aparece en momentos inesperados, aconseja a las personas disfrutar de su vida y de su familia, sin preocuparse por el futuro, ya que de esto se ocupa Prudential.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-1 mt-7 mt-lg-0">
                    <img src="../img/trabajos/prudential_segurosdevida-1.jpg" class="img-fluid" alt="Key visual Prudential 1">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/prudential_segurosdevida-2.jpg" class="img-fluid" alt="Key visual Prudential 2">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/prudential_segurosdevida-3.jpg" class="img-fluid" alt="Key visual Prudential 3">
                </div>
            </div>
        </div>
    </section>

    <?php
    // Sección Anterior / Siguiente (dinámica desde la DB)
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
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102" aria-hidden="true">
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
const menuToggle  = document.getElementById("menuToggle");
const mobileNav   = document.getElementById("mobileNav");
const mobileLinks = mobileNav ? mobileNav.querySelectorAll("a") : [];
const header      = document.querySelector("header");

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
    const main   = document.querySelector("main");
    if (footer && main) {
        const footerHeight = footer.offsetHeight;
        main.style.marginBottom = footerHeight + "px";
    }
}
window.addEventListener("load", ajustarAlturaFooter);
window.addEventListener("resize", ajustarAlturaFooter);

// Fade-in ítems footer
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll("footer .fade-item");
    const observer = new IntersectionObserver(
        (entries) => { entries.forEach((e) => { if (e.isIntersecting) e.target.classList.add("visible"); }); },
        { root: null, threshold: 0.1 }
    );
    items.forEach((item) => observer.observe(item));
});
</script>

</body>
</html>
