<?php
// trabajos/renault_diversidad_inclusion.php
include_once("../_general.php");

$PAGE_URL   = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Renault Group";
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
                        <img src="../img/renault-group.svg" class="logo-interna" alt="Renault Group">
                        <p class="text-white font13 mb-0">/PÚBLICO INTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Renault Group <br> Diversidad e Inclusión</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">
                     Proyecto de branding interno que celebra la diversidad e integra gráficamente la inclusión.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0">
                    <img src="../img/trabajos/renault_diversidadeinclusion-1.png" class="img-fluid" alt="Renault Diversidad e Inclusión pieza principal">
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                    <img src="../img/trabajos/renault_diversidadeinclusion-2.gif" class="img-fluid" alt="Animación sistema gráfico diversidad Renault">
                </div>
                <div class="col-12 col-lg-5 offset-xl-2 offset-xl-1 col-xl-4">
                    <p class="text-white txt-trabajo-20 mb-0">
                        El planteo: Construir el branding interno del Programa de Diversidad e Inclusión de Renault nos llevó a cuestionar: ¿qué es verdaderamente la inclusión? ¿Cómo representarla de manera genuina dentro de la compañía?

                    </p>
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/renault_diversidadeinclusion-3.jpg" class="img-fluid" alt="Aplicaciones del sistema de diversidad Renault">
                </div>

                <div class="col-12 col-lg-5 col-xl-4 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20 mb-0">
                        La propuesta: Desarrollamos un sistema conceptual, gráfico y literario donde cada elemento —con sus diferencias— se integra y dialoga. La propuesta invita a celebrar la diversidad y visibilizar la igualdad de oportunidades como parte de la cultura corporativa.
                    </p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-5">
                    <img src="../img/trabajos/renault_diversidadeinclusion-4.gif" class="img-fluid" alt="Animación multiplicar mensaje inclusión Renault">
                </div>

                 <div class="col-12 col-lg-10 offset-lg-1 mt-7 text-center">
                    <p class="text-white txt-trabajo-20 mb-0">
                        El impacto deseado: El desafío fue acompañar la transformación cultural de Renault y motivar a sus colaboradores a apropiarse y multiplicar el mensaje. Buscamos un branding que empodere el sentido de inclusión y refuerce el compromiso interno con la igualdad.
                   </p>
                </div>

                <div class="col-12 mt-7 mb-7 d-flex flex-column gap-4">
                    <img src="../img/trabajos/renault_diversidadeinclusion-5.gif" class="img-fluid" alt="Variación de piezas diversidad Renault 1">
                    <img src="../img/trabajos/renault_diversidadeinclusion-6.gif" class="img-fluid" alt="Variación de piezas diversidad Renault 2">
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
  if (footer && main) main.style.marginBottom = footer.offsetHeight + "px";
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
