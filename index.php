<?php
include_once("_general.php");
?>

<?php include_once("templates/home/head-info.php"); ?>
<link rel="preload" href="img/bg-home.mp4" as="video" type="video/mp4" fetchpriority="high">
<link rel="stylesheet" href="css/index.css">
<style>
.footer {opacity: 0; pointer-events: none}
</style>

</head>

<body class="index-six">
    <div class="trail-wrapper"></div>

    <?php include_once("templates/home/navbar.php"); ?>

    <?php include_once("templates/home/navbar_video_section.php"); ?>

    <?php include_once("sections/home/frases-animadas.php"); ?>

    <?php include_once("sections/home/cards-3-main-section.php"); ?>

    <?php include_once("sections/home/projectos-section.php"); ?>

    <?php include_once("sections/home/logos-section.php"); ?>

    <?php include_once("sections/home/marcas-section.php"); ?>

    <div id="footer-sentinel"></div>

    <?php include_once("templates/home/footer-index.php"); ?>

    <?php include_once("templates/home/loading-miscelaneos.php"); ?>

    <script defer src="js/jquery.min.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="js/waypoint.js"></script>
    <script defer src="js/imagesloaded.pkgd.min.js"></script>
    <script defer src="js/smoothscroll-varticle.js"></script>
    <script defer src="js/smoothscroll.js"></script>
    <script defer src="js/scrolltoplugin.js"></script>
    <script defer src="js/splittext.js"></script>
    <script defer src="js/scrollmagic.js"></script>
    <script defer src="js/animate-scrollmagic.js"></script>
    <script defer src="js/counterup.js"></script>
    <script defer src="js/waw.js"></script>
    <script defer src="js/main.js"></script>
    <script defer src="js/metismenu.js"></script>

    <script>
    window.CARDS_IMAGES = <?php echo json_encode($cardsImages, JSON_UNESCAPED_SLASHES); ?>;
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
    gsap.registerPlugin(ScrollTrigger);

    const menuToggle = document.getElementById("menuToggle");
    const mobileNav = document.getElementById("mobileNav");
    const mobileLinks = mobileNav ? mobileNav.querySelectorAll("a") : [];
    const header = document.querySelector("header");

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

    const mqMobile = window.matchMedia("(max-width: 992px)");

    function handleScrollHeader() {
      if (!header) return;
      if (mqMobile.matches) {
        if (window.scrollY > 50) {
          header.classList.add("scrolled");
        } else {
          header.classList.remove("scrolled");
        }
      } else {
        header.classList.remove("scrolled");
      }
    }

    window.addEventListener("scroll", handleScrollHeader);
    window.addEventListener("resize", handleScrollHeader);
    handleScrollHeader();

    function ajustarAlturaFooter() {
      const footer = document.querySelector("footer.footer");
      const main = document.querySelector("#main");
      if (!footer || !main) return;
      if (window.matchMedia("(min-width: 993px)").matches) {
        const h = footer.offsetHeight;
        main.style.marginBottom = h + "px";
      } else {
        main.style.marginBottom = "0";
      }
    }

    function refrescarLayout() {
      ajustarAlturaFooter();
      ScrollTrigger.refresh();
    }

    window.addEventListener("load", refrescarLayout);
    window.addEventListener("resize", refrescarLayout);

    if (typeof imagesLoaded === "function") {
      imagesLoaded(document.body, function() {
        refrescarLayout();
      });
    }

    const footerEl = document.querySelector("footer.footer");
    if (footerEl && typeof ResizeObserver !== "undefined") {
      const ro = new ResizeObserver(() => {
        refrescarLayout();
      });
      ro.observe(footerEl);
    }

    ScrollTrigger.create({
      trigger: "#footer-sentinel",
      start: "top bottom",
      onEnter: () => gsap.to("footer.footer", { opacity: 1, pointerEvents: "auto", duration: 0.8, ease: "power2.out" }),
      onLeaveBack: () => gsap.to("footer.footer", { opacity: 0, pointerEvents: "none", duration: 0.3, ease: "power2.in" }),
      invalidateOnRefresh: true
    });
    </script>

    <script src="api/cards_images_feed.php"></script>
    <script src="js/index.js"></script>
</body>
</html>
