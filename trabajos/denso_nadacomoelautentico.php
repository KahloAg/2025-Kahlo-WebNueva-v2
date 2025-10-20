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
                        <img src="../img/denso.png" class="logo-interna">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Denso <br> Nada como el auténtico</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">Campaña para remarcar la importancia de adquirir inyectores auténticos a los verdaderos amantes de la Hilux</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 embed-container">
                    <iframe src="https://player.vimeo.com/video/1128951339?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0" style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                </div>
                 <div class="col-12 embed-container">
                    <iframe src="https://player.vimeo.com/video/1128951398?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0" style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                </div>
                
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-10 offset-lg-1 mb-7">
                <p class="text-white txt-trabajo-20">Junto a Denso, líder mundial en tecnología de combustión automotriz, desarrollamos una campaña para comunicar que, cuando se trata de inyectores, no hay nada como lo auténtico.</p>

<p class="text-white txt-trabajo-20">La marca detectó que se estaban vendiendo e instalando un alto número de inyectores falsos como originales. Esto afectaba la confiabilidad de Denso y, por supuesto, el rendimiento de las Hilux. Por eso, se desarrolló una etiqueta escaneable que garantizara la autenticidad del inyector.</p>

<p class="text-white txt-trabajo-20 mb-0">Para comunicarlo, realizamos una campaña 360 con “el doble de Leo”, un personaje que muestra que las copias pueden parecerse, pero nunca van a igualar al verdadero.</p>        
                </div>
                <div class="col-12 col-lg-6">
                    <img src="../img/trabajos/denso_nadacomoelautentico-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-5 offset-lg-1 offset-xl-2 col-xl-4">
                    <p class="text-white txt-trabajo-20">Tuvimos presencia en medios nacionales</p>
                    <p class="text-white mb-0">Cartelería en zona estratégica de Gran Buenos Aires y Córdoba y presencia en redes sociales, YouTube y Programmatic.</p>
                </div>

               

                <div class="col-12 col-lg-5 col-xl-4 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20">La campaña se planificó con foco en Awareness</p>
<p class="text-white mb-0">Y superamos todos los benchmarks:<br>
Más de 5M de impresiones, superando +10,3 % a lo estimado.<br>
Logramos un +18,9 % sobre la meta prevista, con más de 38K clics al sitio.</p>
                </div>

                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-5">
                     <img src="../img/trabajos/denso_nadacomoelautentico-2.jpg" class="img-fluid">
                    
                </div>

                 <div class="col-12 mt-5 mb-7">
                 <img src="../img/trabajos/denso_nadacomoelautentico-3.gif" class="img-fluid">
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
