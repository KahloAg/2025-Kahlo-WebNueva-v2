<?php
include_once("../_general.php");
$PAGE_URL = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Alsa";
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
                        <img src="../img/alsa.svg" class="logo-interna">
                        <p class="text-white font13 mb-0">/MARCA EMPLEADORA/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Alsa <br> Web Marca Empleadora</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">Web de marca empleadora rediseñada con navegación intuitiva e integración para facilitar postulaciones.</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 embed-container">
                    <iframe src="https://player.vimeo.com/video/500983246?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0" style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-10 offset-lg-1 text-center">
                    <p class="text-white txt-trabajo-20 mb-0">El desafío digital: Alsa, líder en transporte de personas en España, nos pidió renovar su portal de empleo para alinearlo con su rebranding. El objetivo: mostrar su propuesta de valor como empleador de forma moderna y atractiva.</p>
                  
                </div>
                <div class="col-12 mt-5">
                    <img src="../img/trabajos/alsa_marcaempleadora-1.png" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <div class="col-12 mt-7">
                <img src="../img/trabajos/alsa_marcaempleadora-2.jpg" class="img-fluid">
            </div>
        </div>

        <div class="container mt-7">
            <div class="row align-items-center">
                <div class="col-12 col-lg-10 offset-lg-1 text-center">
                    <p class="text-white txt-trabajo-20">Rediseñamos la plataforma con una navegación intuitiva, contenidos frescos y un lenguaje juvenil. Integramos la sección de trabajos con Cornerstone, la plataforma líder de búsqueda laboral, para mejorar la experiencia de postulación.</p>
                </div>
                <div class="col-12">
                    <img src="../img/trabajos/alsa_marcaempleadora-2.png" class="img-fluid">
                </div>
                <div class="col-12 col-lg-10 offset-lg-1 text-center mb-5">
                    <p class="text-white txt-trabajo-20 mb-0">El resultado fue una web ágil, atractiva y funcional que potencia el recruiting de nuevos talentos. Con una estética coherente con la marca y titulares con juego de categoría, logramos dinamismo y eficacia para quienes desean postularse.</p>
                </div>
                <div class="col-12 mt-5 mb-7">
                    <img src="../img/trabajos/alsa_marcaempleadora-3.png" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <?php include_once("../templates/trabajos/anterior-siguiente-section.php"); ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>


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
const menuToggle=document.getElementById("menuToggle");
const mobileNav=document.getElementById("mobileNav");
const mobileLinks=mobileNav?mobileNav.querySelectorAll("a"):[];
const header=document.querySelector("header");
if(menuToggle&&mobileNav){menuToggle.addEventListener("click",()=>{menuToggle.classList.toggle("active");mobileNav.classList.toggle("open")});mobileLinks.forEach(link=>{link.addEventListener("click",()=>{menuToggle.classList.remove("active");mobileNav.classList.remove("open")})})}
const mediaQuery=window.matchMedia("(max-width: 992px)");
function handleScroll(){if(!header)return;if(mediaQuery.matches){if(window.scrollY>50){header.classList.add("scrolled")}else{header.classList.remove("scrolled")}}else{header.classList.remove("scrolled")}}
window.addEventListener("scroll",handleScroll);
window.addEventListener("resize",handleScroll);
handleScroll();
function ajustarAlturaFooter(){const footer=document.querySelector("footer.footer");const main=document.querySelector("main");if(footer&&main){const footerHeight=footer.offsetHeight;main.style.marginBottom=footerHeight+"px"}}
window.addEventListener("load",ajustarAlturaFooter);
window.addEventListener("resize",ajustarAlturaFooter);
document.addEventListener("DOMContentLoaded",()=>{const items=document.querySelectorAll("footer .fade-item");const observer=new IntersectionObserver((entries)=>{entries.forEach((entry)=>{if(entry.isIntersecting){entry.target.classList.add("visible")}})},{root:null,threshold:0.1});items.forEach((item)=>observer.observe(item))});
</script>
</body>
</html>
