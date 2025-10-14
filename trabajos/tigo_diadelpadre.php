<?php
include_once("../_general.php");
$PAGE_URL = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Tigo";
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
                        <img src="../img/tigo.svg" class="logo-interna">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Tigo <br>Día del Padre</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">Campaña del Día del Padre que celebra sus antojos con humor y emoción cotidiana.</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <img src="../img/trabajos/tigo_diadelpadre-1.jpg" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 col-xl-4">
                    <p class="text-white">La empresa líder en telefonía de Colombia confió en nosotros para potenciar sus promociones del Día del Padre. Bajo el concepto “Papá también tiene antojos”, lanzamos una campaña que conectó con humor y empatía, mostrando que los padres también desean lo mejor.</p>
<p class="text-white mb-0">Con Rigo, una de las figuras más queridas del país, desarrollamos piezas para redes, puntos de venta y medios digitales que impulsaron las ventas y reforzaron el vínculo con la marca.</p>
                    
                </div>
                <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-7 mt-lg-0">
                    <img src="../img/trabajos/tigo_diadelpadre-2.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-md-6 mt-5">
                    <img src="../img/trabajos/tigo_diadelpadre-3.jpg" class="img-fluid">
                    <img src="../img/trabajos/tigo_diadelpadre-5.jpg" class="img-fluid mt-5">
                </div>
                <div class="col-12 col-md-6 mt-5">
                    <img src="../img/trabajos/tigo_diadelpadre-4.jpg" class="img-fluid">
                    <img src="../img/trabajos/tigo_diadelpadre-6.jpg" class="img-fluid mt-5">
                </div>

                <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2 txt-trabajo-sub mb-7 mt-7 text-center">
                <p class="text-white">Gracias a esta colaboración, logramos conectar con una amplia audiencia, generando un alto nivel de interacción y visibilidad para la marca.</p>    
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
