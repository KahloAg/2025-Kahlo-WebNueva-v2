<?php
include_once("../_general.php");
$PAGE_URL = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Despegar";
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
                        <img src="../img/despegar.png" class="logo-interna">
                        <p class="text-white font13 mb-0">/PÚBLICO INTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Despegar <br> Comunicación Interna</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">Campaña 360 estilo documental testimonial con motivo del Día Internacional de la Mujer</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <img src="../img/trabajos/santander_diamujer-1.jpg" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                    <img src="../img/trabajos/despegar_beneficios-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 offset-xl-1 col-xl-5">
                    <p class="text-white txt-trabajo-20 mb-0">Nuestro desafío fue llevar este nuevo concepto, mucho más emocional y sensorial, a toda su comunicación interna para revalorizar la experiencia de exploración, aprendizaje y recorrido que los colaboradores viven día a día dentro de la compañía.</p>
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/despegar_beneficios-2.jpg" class="img-fluid">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/despegar_beneficios-3.jpg" class="img-fluid">
                </div>

                <div class="col-12 mt-5">
                    <img src="../img/trabajos/despegar_beneficios-4.jpg" class="img-fluid">
                </div>

                <div class="col-12 col-lg-6 col-xl-5 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20 mb-0">Resultados: <br>Una comunicación más fortalecida, dinámica, actualizada y coherente. Donde los mensajes para colaboradores continúan con la estructura visual, conceptual y estética de la campaña externa.</p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-1 mt-5">
                    <video playsinline autoplay muted loop class="w-100">
                        <source src="../img/trabajos/despegar_beneficios-5.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </section>

    <?php include_once("../templates/trabajos/anterior-siguiente-section.php"); ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>

<div class="loading-screen" id="loading-screen">
    <span class="bar top-bar"></span>
    <span class="bar down-bar"></span>
    <span class="progress-line"></span>
    <span class="loading-counter"> </span>
</div>

<div class="bg-noise"></div>

<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

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
