<?php
// trabajos/supervielle_surfers_transformacion.php
include_once("../_general.php");

$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Supervielle";
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
                        <img src="../img/supervielle.svg" class="logo-interna" alt="Banco Supervielle">
                        <p class="text-white font13 mb-0">/PÚBLICO INTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Banco Supervielle <br> Surfers de la Transformación</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                   Serie documental interna que expone el proceso de transformación digital desde dentro.
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
                        src="https://www.youtube.com/embed/0J-XXTNHpY4?autoplay=1&mute=1&loop=1&playlist=0J-XXTNHpY4&playsinline=1&modestbranding=1&rel=0"
                        style="width: 100%;" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
                        title="Banco Supervielle — Surfers de la Transformación">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                    <img src="../img/trabajos/supervielle_transformacion-1.jpg" class="img-fluid" alt="Surfers de la Transformación - capítulo 1">
                </div>

                <div class="col-12 col-lg-5 col-xl-4 offset-xl-2 offset-lg-1">
                    <p class="text-white mb-0">
                        La transformación digital es el nuevo desafío que enfrentan todas las las grandes corporaciones. Para Banco Supervielle, creamos #SurfersDeLaTransformación, la primera serie documental interna exclusiva para LinkedIn, que muestra su camino hacia la modernización.

                    </p>
                </div>

                <div class="col-12 col-lg-5 col-xl-4 mt-7 mt-lg-5">
                    <p class="text-white mb-0">
                        Diseñamos una serie de 5 capítulos protagonizados por líderes y colaboradores del banco. Cada episodio revela procesos, reflexiones y acciones concretas de cambio en Supervielle, usando un formato atractivo para audiencias internas y externas.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-2 offset-lg-1 mt-lg-5">
                    <img src="../img/trabajos/supervielle_transformacion-2.jpg" class="img-fluid" alt="Surfers de la Transformación - making of">
                </div>

                <div class="col-12 col-lg-10 offset-lg-1 text-center mt-15 mb-15">
                   <p class="text-white txt-trabajo-20 mb-0">
                     Con un despliegue robusto de producción y postproducción, la serie fue publicada semanalmente en LinkedIn y generó elevados niveles de interacción. Una estrategia de comunicación organizacional que convierte transformación digital en contenido relevante y motivador.
                    </p> 
                </div>

                
            </div>
        </div>
    </section>

    <?php include_once("../templates/trabajos/anterior-siguiente-section.php"); ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>

<!-- Loader -->
<div class="loading-screen" id="loading-screen" aria-hidden="true">
    <span class="bar top-bar"></span>
    <span class="bar down-bar"></span>
    <span class="progress-line"></span>
    <span class="loading-counter"> </span>
</div>

<div class="bg-noise" aria-hidden="true"></div>

<!-- back to top -->
<div class="progress-wrap" aria-hidden="true">
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
  const main   = document.querySelector("main");
  if (footer && main) main.style.marginBottom = footer.offsetHeight + "px";
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
