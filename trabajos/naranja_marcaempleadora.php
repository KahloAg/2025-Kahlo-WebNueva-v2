<?php
// trabajos/naranjax_marca_empleadora.php
include_once("../_general.php");

$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Naranja X";
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
                        <img src="../img/naranjax.svg" class="logo-interna" alt="Naranja X">
                        <p class="text-white font13 mb-0">/MARCA EMPLEADORA/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Naranja X <br> Expandiendo los límites de lo posible</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                        Portal de marca empleadora que refleja la cultura interna y potencia la atracción de talento.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section aria-label="Video principal">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 embed-container">
                    <iframe
                        src="https://player.vimeo.com/video/1107835652?autoplay=1&muted=1&loop=1&autopause=0&byline=0&title=0&portrait=0&transparent=0&dnt=1"
                        style="width: 100%;" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
                        title="Naranja X — Marca Empleadora">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12 text-center">
                    <p class="text-white mb-0 txt-trabajo-20">
                        El desafío: Naranja X necesitaba redefinir su sitio de marca empleadora para reflejar su evolución como compañía tecnológica y su cultura única. El objetivo: crear un espacio digital que traduzca su propuesta de valor y la experiencia de sus colaboradores.
                    </p>
                </div>

                <!-- Desktop hero mock -->
                <div class="col-12 mt-5 d-none d-md-block text-center">
                    <img src="../img/trabajos/naranja_marcaempleadora-1.png" class="img-fluid" alt="Landing Marca Empleadora NX — Desktop" loading="lazy" decoding="async">
                </div>

                <!-- Mobile hero mock -->
                <div class="col-12 mt-5 d-block d-md-none text-center">
                    <img src="../img/trabajos/naranja_marcaempleadora-5.png" class="img-fluid" alt="Landing Marca Empleadora NX — Mobile" loading="lazy" decoding="async">
                </div>

                <div class="col-12 col-lg-6 col-xl-5">
                    <p class="text-white mb-0 txt-trabajo-20">
                        El propósito: Más que rediseñar una web, nos propusimos fortalecer la marca empleadora desde adentro hacia afuera: mostrar quiénes son, cómo trabajan y por qué su forma de hacer las cosas es diferente.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-1 mt-7 mt-lg-0">
                    <img src="../img/trabajos/naranja_marcaempleadora-2.png" class="img-fluid" alt="Sección equipos y cultura NX" loading="lazy" decoding="async">
                </div>

                <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                    <video playsinline loop autoplay muted class="w-100" aria-label="Animación de interacción del sitio NX">
                        <source src="../img/trabajos/naranja_marcaempleadora-3.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="col-12 col-lg-5 offset-lg-1 col-xl-4 offset-xl-2 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20">
                        La experiencia: Creamos un portal de marca empleadora que combina diseño, storytelling y tecnología para que cualquier visitante pueda sentir lo que significa trabajar en Naranja X. Cada sección refleja los valores, los equipos y la energía que impulsa su cultura.
                    </p>
                </div>

                <div class="col-12 col-lg-4 col-xl-4 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20">
                        El resultado: El nuevo sitio integra identidad visual, tono humano y claridad estratégica. Un espacio ágil, fresco y alineado al universo NX que transforma la cultura organizacional en una experiencia digital auténtica.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-5">
                    <video playsinline loop autoplay muted class="w-100" aria-label="Microinteracciones del portal NX">
                        <source src="../img/trabajos/naranja_marcaempleadora-4.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="col-12 mt-7 text-center">
                    <p class="text-white mb-5 txt-trabajo-20">Navegá la web y conocé la experiencia NX</p>
                    <div class="embed-container hmob-video">
                        <iframe
                            src="https://careers.naranjax.com/"
                            name="careersNX" width="100%" height="480" scrolling="yes"
                            title="Careers — Naranja X" loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin">
                        </iframe>
                    </div>
                    <p class="mt-3">
                        <a class="underline text-white" href="https://careers.naranjax.com/" target="_blank" rel="noopener">Abrir en nueva pestaña</a>
                    </p>
                </div>

                <div class="col-12 col-lg-10 offset-lg-1 mb-7 mt-7 text-center">
                    <p class="text-white txt-trabajo-20 mb-0">
                        La conexión: Hoy, la marca empleadora de Naranja X se vive y se navega. Una plataforma pensada para atraer talento, inspirar orgullo interno y mostrar al mundo cómo se construye una cultura con propósito.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <?php include_once("../templates/trabajos/anterior-siguiente-section.php"); ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>

<!-- Scripts -->
<script defer src="../js/jquery.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="../js/waypoint.js"></script>
<script defer src="../js/imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script defer src="../js/smoothscroll-varticle.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script defer src="../js/scrolltoplugin.js"></script>
<script defer src="../js/splittext.js"></script>
    <script defer src="../js/scrollmagic.js"></script>
<script defer src="../js/counterup.js"></script>
<script defer src="../js/waw.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
    <script defer src="../js/main.js"></script>

<script>
// Menú móvil con chequeos defensivos
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

// Efecto de header al hacer scroll (sólo mobile)
const header = document.querySelector("header");
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

// Altura del footer dinámica
function ajustarAlturaFooter() {
            const footer = document.querySelector("footer.footer");
            const main = document.querySelector("main");
            if (footer && main) {
                if (window.innerWidth > 991) {
                    const footerHeight = footer.offsetHeight;
                    main.style.marginBottom = footerHeight + "px";
                } else {
                    main.style.marginBottom = "0px";
                }
            }
        }

        window.addEventListener("load", ajustarAlturaFooter);
window.addEventListener("resize", ajustarAlturaFooter);

// Fade-in de ítems del footer
document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll("footer .fade-item");
  const observer = new IntersectionObserver(
    entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add("visible"); }),
    { root: null, threshold: 0.1 }
  );
  items.forEach(item => observer.observe(item));
});
</script>

</body>
</html>
