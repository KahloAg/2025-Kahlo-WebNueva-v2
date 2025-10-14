<?php
// trabajos/holliday_scott.php  (o el nombre que prefieras dentro de /trabajos)
include_once("../_general.php");

// Para que head-info.php pueda setear <title> y meta
$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']); // p.ej. holliday_scott.php
$PAGE_TITLE = "Kahlo Agencia - Holliday";
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
                        <img src="../img/holliday.png" class="logo-interna" alt="Holliday Scott">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Holliday <br> Scott Campaña Digital</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                    Campaña de concientización sobre cardiopatía canina con llamado a prevención y auscultas.
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
                        src="https://player.vimeo.com/video/766600321?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0"
                        style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12 col-lg-6 col-xl-5">
                    <p class="text-white">
                        Para lograr el objetivo lanzamos en primera instancia la campaña de concientización
                        <strong>#CuidaloConElCorazón</strong>, dirigida a dueños de mascotas y veterinarios, promoviendo
                        la auscultación frecuente del corazón de perros de pequeño porte. En segunda instancia comunicamos
                        los medicamentos de la marca que tratan esta problemática.
                    </p>
                    <p class="text-white">
                        De esta manera logramos impactar a estos públicos con un fuerte mensaje de prevención y pusimos a
                        la marca en un rol relevante, liderando la conversación sobre la prevención y el tratamiento de la
                        cardiopatía canina.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-1 mt-7 mt-lg-0">
                    <img src="../img/trabajos/holliday_scott-1.jpg" class="img-fluid" alt="Holliday Scott 1">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/holliday_scott-2.jpg" class="img-fluid" alt="Holliday Scott 2">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/holliday_scott-3.jpg" class="img-fluid" alt="Holliday Scott 3">
                </div>

            </div>
        </div>
    </section>

    <?php
    // Prev / Next dinámico desde DB (usa page_index para el orden y apunta a /trabajos/slug)
    include_once("../templates/trabajos/anterior-siguiente-section.php");
    ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>

<!-- Loader / decor -->
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
// JS defensivo para el menú móvil y efectos (por si el markup viene del include)
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

// Ajuste de altura del footer
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

// Fade-in de items en footer
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll("footer .fade-item");
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) entry.target.classList.add("visible");
            });
        },
        { root: null, threshold: 0.1 }
    );
    items.forEach((item) => observer.observe(item));
});
</script>

</body>
</html>
