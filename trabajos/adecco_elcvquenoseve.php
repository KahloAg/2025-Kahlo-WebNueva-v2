<?php
    include_once("../_general.php");
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
                            <img src="../img/adecco.svg" class="logo-interna">
                            <p class="text-white font13 mb-0">/PÚBLICO INTERNO/</p>
                        </div>
                        <h1 class="mt-6 mb-0">Adecco <br> El CV que no se ve </h1>
                    </div>
                    <div class="col-9 col-sm-8 col-lg-3 offset-lg-9 mt-5 mt-lg-0">
                        <p class="text-white text-uppercase font13 lh-21">Campaña que visibiliza historias reales y revaloriza la experiencia humana en el trabajo.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 embed-container">
                        <iframe src="https://player.vimeo.com/video/734781183?autoplay=1&amp;loop=1&amp;byline=0&amp;title=0&amp;muted=1&amp;potrait=0&amp;transparent=0" style="width: 100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </section>

        <section class="spacer d-flex align-items-center my-50">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-10 offset-lg-1 text-center txt-trabajo-sub mt-7 mb-7">
                        <p class="text-white">¿Sabías que el trabajo doméstico y de cuidado no remunerado
                            equivale al 15,9% de nuestro PBI?<br><br>
                            Esto implica que es el sector de mayor peso <br> dentro de la industria nacional.
                        </p>
                    </div>
                    <div class="col-12 col-lg-5 col-xl-4">

                        
                        <p class="text-white mb-0">OBJETIVO<br>
                            Demostrar que las personas somos mucho más que nuestras experiencias laborales, y que todas
                            nuestras vivencias contribuyen a formarnos como profesionales</p>
                    </div>

                    <div class="col-12 col-lg-6 offset-lg-1 offset-xl-2 mt-7 mt-lg-0">
                        <img src="../img/trabajos/adecco_elcvquenoseve-1.jpg" class="img-fluid">
                    </div>

                    <div class="col-12 col-lg-6 mt-7 mt-lg-5">
                        <video playsinline autoplay muted loop class="w-100">
                            <source src="../img/trabajos/adecco_elcvquenoseve-2.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="col-12 col-lg-5 offset-lg-1 offset-xl-2 col-xl-4 mt-7 mt-lg-0">
                        
                        <p class="text-white">SOLUCIÓN<br>
                           Desarrollamos una herramienta que traduce experiencias personales en habilidades para el CV.</br>
Deportistas, gamers y más pueden elegir su actividad y especialización, y el sistema convierte automáticamente esas vivencias en competencias laborales.</p>
<p class="text-white">Así, cada persona puede valorizar su recorrido y reinsertarse en el mercado laboral.</p>
                        </p>
                    </div>

                    <div class="col-12 col-md-6 mt-5">
                        <img src="../img/trabajos/adecco_elcvquenoseve-3.png" class="img-fluid">
                    </div>

                    <div class="col-12 col-md-6 mt-5">
                        <img src="../img/trabajos/adecco_elcvquenoseve-4.jpg" class="img-fluid">
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
        
        const header = document.querySelector("header");
        const mediaQuery = window.matchMedia("(max-width: 992px)");

        function handleScroll() {
            if (mediaQuery.matches) {
                if (window.scrollY > 50) {
                    header.classList.add("scrolled");
                } else {
                    header.classList.remove("scrolled");
                }
            } else {
                header.classList.remove("scrolled");
            }
        }

        window.addEventListener("scroll", handleScroll);
        window.addEventListener("resize", handleScroll);
        handleScroll();

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

        document.addEventListener("DOMContentLoaded", () => {
            const items = document.querySelectorAll("footer .fade-item");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                        }
                    });
                },
                {
                    root: null,
                    threshold: 0.1,
                }
            );

            items.forEach((item) => observer.observe(item));
        });
    </script>
</body>
</html>
