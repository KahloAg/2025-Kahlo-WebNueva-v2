<?php
include_once("../_general.php");
$PAGE_URL = basename($_SERVER['SCRIPT_NAME']);
$PAGE_TITLE = "Kahlo Agencia - Mercado Libre";
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
                        <img src="../img/mercado-libre.png" class="logo-interna">
                        <p class="text-white font13 mb-0">/PÚBLICO EXTERNO/</p>
                    </div>
                    <h1 class="mt-6 mb-0">Mercado Libre <br>Día Internacional de la Mujer</h1>
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
                <div class="col-12 embed-container">
                    <iframe src="https://player.vimeo.com/video/922563915?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0" style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="spacer d-flex align-items-center my-50">
        <div class="container">
            <div class="row">
                <div class="col-12 txt-trabajo-sub">
                    <p class="text-white">En América Latina, a pesar de los avances significativos hacia la igualdad de género, aún persisten barreras significativas para las mujeres en el ámbito laboral y emprendedor. Incluso, a menudo enfrentan disparidades salariales y limitaciones para alcanzar posiciones de liderazgo.</p>
                    <p class="text-white">Enfocamos nuestra búsqueda en preguntas que nos permitieran explorar las historias de las colaboradoras, con el propósito de inspirar, motivar y transmitir la autenticidad de sus experiencias.</p>
                    <p class="text-white mb-0">Asumimos un desafío ambicioso. Con jornadas de rodaje en tres países distintos y más de 50 horas de entrevistas, superamos nuestros propios límites y logramos presentar una narrativa poderosa y transformadora que evidencia el compromiso de MELI con la creación de un ambiente más diverso, equitativo e inclusivo, valores que funcionan como impulsores claves de la innovación y el éxito empresarial.</p>
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
