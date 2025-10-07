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
                        <p class="text-white text-uppercase font13 lh-21">Campaña 360 estilo documental testimonial con
                            motivo del Día Internacional de la Mujer</p>
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
                    <div class="col-12 col-lg-6 col-xl-5">
                        <p class="text-white txt-trabajo-20">¿Sabías que el trabajo doméstico y de cuidado no remunerado
                            equivale al 15,9% de nuestro PBI?<br><br>
                            Esto implica que es el sector de mayor peso dentro de la industria nacional.
                        </p>
                        <p class="text-white mb-0">OBJETIVO<br>
                            Demostrar que las personas somos mucho más que nuestras experiencias laborales, y que todas
                            nuestras vivencias contribuyen a formarnos como profesionales</p>
                    </div>

                    <div class="col-12 col-lg-6 offset-xl-1 mt-7 mt-lg-0">
                        <img src="../img/trabajos/adecco_elcvquenoseve-1.jpg" class="img-fluid">
                    </div>

                    <div class="col-12 col-lg-6 mt-7 mt-lg-5">
                        <video playsinline autoplay muted loop class="w-100">
                            <source src="../img/trabajos/adecco_elcvquenoseve-2.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="col-12 col-lg-6 offset-xl-1 col-xl-5 mt-7 mt-lg-0">
                        <p class="text-white txt-trabajo-20">El 43% de los empleadores afirma que las habilidades
                            blandas que desarrollan los gamers son difíciles de enseñar a sus equipos.</p>
                        <p class="text-white">SOLUCIÓN<br>
                            Desarrollamos una herramienta capaz de traducir experiencias personales en habilidades para
                            el CV. Desde deportistas hasta gamers, cada quién tiene habilidades útiles para aportar, y a
                            través de esta plataforma, las personas pueden seleccionar su actividad y elegir en qué se
                            especializan.</p>
                        <p class="text-white">De forma automática la herramienta traducirá dichas experiencias en
                            habilidades para el CV.
                        </p>
                        <p class="text-white mb-0">El traductor le brinda la oportunidad a cada persona de ponerle el
                            valor que corresponde a sus vivencias, y reinsertarse en el mercado laboral.
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
        const menuToggle = document.getElementById("menuToggle");
        const mobileNav = document.getElementById("mobileNav");
        const mobileLinks = mobileNav.querySelectorAll("a");
        const header = document.querySelector("header");

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
                const footerHeight = footer.offsetHeight;
                main.style.marginBottom = footerHeight + "px";
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
