<?php
// trabajos/personalpay_audiologo.php  (ajusta el nombre/slug si corresponde)
include_once("../_general.php");

// Variables para <head> dinámico y para navegación prev/next
$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']); // p.ej. personalpay_audiologo.php
$PAGE_TITLE = "Kahlo Agencia - Personal Pay";
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
                        <img src="../img/personal-pay.png" class="logo-interna" alt="Personal Pay logo">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Personal Pay <br> Audiologo</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                     Video animado que acompaña un “audiologo” para reforzar identidad sonora en la app.
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
                        src="https://player.vimeo.com/video/900195771?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0"
                        style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen
                        title="Personal Pay - Audiologo"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center mt-5">
                    <p class="text-white">EL DESAFÍO</p>
                    <p class="text-white txt-trabajo-20">
                 Personal Pay lanzó su nuevo audiologo corporativo y nos convocó para crear la animación que lo acompañara. El objetivo fue amplificar su presencia en el entorno digital, integrando sonido, movimiento y marca en una experiencia coherente y moderna.</p>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-7">
            <div class="row">
                <div class="col-12 p-0">
                    <img src="../img/trabajos/personalpay_audiologo-1.jpg" class="img-fluid" alt="Frame Audiologo 1">
                </div>
            </div>
        </div>

        <div class="container mt-7">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 col-xl-4">
                    <p class="text-white">LA PROPUESTA CREATIVA</p>
                    <p class="text-white txt-trabajo-20 mb-0">
                        Diseñamos una animación de audiologo que refleja la energía y el dinamismo de la marca. Cada movimiento fue pensado para potenciar su identidad auditiva, reforzar su branding digital y mejorar la experiencia de usuario dentro de la app.

                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-7 mt-lg-0">
                    <img src="../img/trabajos/personalpay_audiologo-2.png" class="img-fluid" alt="Frame Audiologo 2">
                </div>

                <div class="col-12 col-lg-6 mt-5">
                    <img src="../img/trabajos/personalpay_audiologo-3.png" class="img-fluid" alt="Frame Audiologo 3">
                </div>

                <div class="col-12 col-lg-5 offset-lg-1 offset-xl-2 col-xl-4 mt-7 mt-lg-0">
                    <p class="text-white">EL ENFOQUE TÉCNICO Y ESTÉTICO</p>
                    <p class="text-white txt-trabajo-20 mb-0">
                       A partir del ritmo y los matices del sonido de marca, desarrollamos una pieza de motion graphics sincronizada con precisión. Líneas, colores y pulsos visuales se combinan para construir una identidad audiovisual clara, ágil y memorable.

                    </p>
                </div>

                       <div class="col-12 text-center mb-7 mt-7">
                    <p class="text-white">EL RESULTADO</p>
                    <p class="text-white txt-trabajo-20">
                 El nuevo audiologo animado de Personal Pay consolida su marca sonora en el ecosistema digital, aportando reconocimiento, consistencia y recordación. Una animación breve, moderna y efectiva que fortalece la conexión entre sonido, imagen y marca.</p>
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
