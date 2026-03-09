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
                        <img src="../img/galicia.png" class="logo-interna">
                        <p class="text-white font13 mb-0">/COMUNICACIÓN INTERNA/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Galicia <br> Evento Aprender del error</h1>
                </div>
                <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                    <p class="text-white text-uppercase font13 lh-21">Campaña 360 interna que promueve aprender del error como motor de crecimiento.</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 embed-container">
                    <iframe
                        src="https://www.youtube.com/embed/y9ldAtclBuM?autoplay=1&mute=1&loop=1&playsinline=1&modestbranding=1&rel=0"
                        style="width: 100%;" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
                        title="Galicia - Aprender del error">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mt-7 mt-lg-0">
                    <img src="../img/trabajos/galicia_aprenderdelerror-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-5 offset-lg-1 offset-xl-2 col-xl-4">
                    <p class="text-white txt-trabajo-20 mb-0">Banco Galicia nos llamó para acompañar el lanzamiento de su campaña “Error”, una pieza que cambia el eje convencional de defensa del cliente por reconocer fallas propias y promover la transparencia institucional.</p>
                </div>

                <div class="col-12 col-lg-6 mt-5">
                    <img src="../img/trabajos/galicia_aprenderdelerror-2.jpg" class="img-fluid">
                </div>

                <div class="col-12 col-lg-6 mt-5">
                    <img src="../img/trabajos/galicia_aprenderdelerror-3.jpg" class="img-fluid">
                </div>

               

                <div class="col-12 col-lg-5 col-xl-4 mt-7 mt-lg-0">
                    <p class="text-white txt-trabajo-20 mb-0">La campaña parte de un gesto arriesgado: visibilizar el error como motor de mejora. Con ese enfoque diseñamos los mensajes, las piezas y los soportes que acompañan esa idea de humildad institucional que conecta desde la honestidad.</p>
                </div>

                <div class="col-12 col-lg-6 offset-xl-2 offset-lg-1 mt-5">
                   <img src="../img/trabajos/galicia_aprenderdelerror-4.jpg" class="img-fluid">
                </div>

                <div class="col-12 col-lg-10 offset-lg-1 mt-15 text-center mb-5">
                <p class="text-white txt-trabajo-20 mb-0">El resultado es una comunicación más cercana, confiable y humana. Esta campaña ayudó a reforzar el branding institucional de Galicia como un banco que escucha, aprende, se comunica y se compromete con sus clientes.</p>    
                </div>
            </div>
        </div>
    </section>

    <?php include_once("../templates/trabajos/anterior-siguiente-section.php"); ?>

    <div id="footer-spacer" aria-hidden="true"></div>
</main>

<?php include_once("../templates/home/footer.php"); ?>



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
items.forEach((item)=>observer.observe(item))});
</script>
</body>
</html>
