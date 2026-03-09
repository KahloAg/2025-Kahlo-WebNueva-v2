<?php
// trabajos/stylestore_hacelo_con_style.php
include_once("../_general.php");

$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Style Store";
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
                        <img src="../img/style-store.png" class="logo-interna" alt="Style Store">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Style Store <br> Campaña hacelo con style</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                    Campaña que posiciona nuevos productos bajo el mismo estilo premium con un llamado claro a la acción.
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
                        src="https://player.vimeo.com/video/1054582657?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0"
                        style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen
                        title="Style Store - Hacelo con Style"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p class="text-white txt-trabajo-20">
                      El desafío: Style Store buscaba ampliar su presencia en el mercado incorporando tecnología y electrodomésticos sin perder su identidad premium y de lifestyle. Nuestro desafío fue desarrollar una estrategia de branding y comunicación retail que integrara estas nuevas categorías sin romper la coherencia de marca.

                    </p>
                </div>

                <div class="col-12 mt-7">
                    <img src="../img/trabajos/stylestore_haceloconstyle-1.jpg" class="img-fluid" alt="Hacelo con Style - key visual 1">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/stylestore_haceloconstyle-2.jpg" class="img-fluid" alt="Hacelo con Style - key visual 2">
                </div>

                <div class="col-12 col-lg-5 col-xl-4">
                    <p class="text-white txt-trabajo-20">
                      La idea: Creamos el concepto “Hacelo con Style”, una campaña que conecta moda, hogar y tecnología bajo un mismo mensaje. El claim invita a vivir cada elección con estilo, reforzando el posicionamiento aspiracional de la marca.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-5">
                    <img src="../img/trabajos/stylestore_haceloconstyle-3.jpg" class="img-fluid" alt="Hacelo con Style - vía pública">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/stylestore_haceloconstyle-4.jpg" class="img-fluid" alt="Hacelo con Style - piezas digitales">
                </div>

                <div class="col-12 col-lg-5 col-xl-4">
                    <p class="text-white txt-trabajo-20">
                     La implementación: Desarrollamos un spot de lanzamiento de alto impacto, más de 50 piezas digitales y presencia en vía pública y redes sociales. Una acción de comunicación omnicanal pensada para generar reconocimiento y deseo en distintos públicos.</p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-5">
                    <video class="w-100" playsinline loop autoplay muted aria-label="Hacelo con Style pieza motion 1">
                     <source src="../img/trabajos/stylestore_haceloconstyle-5.mp4" type="video/mp4">
                    </video> 
                </div>

                <div class="col-12 col-lg-6 mt-5">
                    <video class="w-100" playsinline loop autoplay muted aria-label="Hacelo con Style pieza motion 2">
                        <source src="../img/trabajos/stylestore_haceloconstyle-6.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="col-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                    <p class="text-white txt-trabajo-20">
                     El resultado: La campaña potenció la expansión de Style Store hacia nuevas categorías, consolidando su imagen como retailer integral de lifestyle, moda y tecnología. Un ejemplo de cómo el branding estratégico y la creatividad pueden impulsar crecimiento sin perder identidad.</p>
                </div>

                <div class="col-12 mt-15"></div>

                
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
// Menú móvil / efectos defensivos
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

// Altura footer dinámica
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

// Fade-in ítems footer
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
