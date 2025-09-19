<?php
include_once("_general.php");
?>

<?php include_once("templates/head-info.php"); ?>
<link rel="stylesheet" href="css/index.css">
<style>
.footer {opacity: 0}
</style>

</head>

<body class="index-six">
    <div class="trail-wrapper"></div>

    <?php include_once("templates/navbar.php"); ?>

    
    <?php include_once("templates/navbar_video_section.php"); ?>

    
    <?php include_once("sections/home/frases-animadas.php"); ?>

    <?php include_once("sections/home/cards-3-main-section.php"); ?>

    <?php include_once("sections/home/projectos-section.php"); ?>

    <?php include_once("sections/home/logos-section.php"); ?>

    <?php include_once("sections/home/marcas-section.php"); ?>


    <?php include_once("templates/footer.php"); ?>

    <?php include_once("templates/loading-miscelaneos.php"); ?>

    <script defer src="js/jquery.min.js"></script>
    <script defer src="js/bootstrap.min.js"></script>
    <script defer src="js/waypoint.js"></script>
    <script defer src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/gsap.js"></script>
    <script defer src="js/smoothscroll-varticle.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
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
  const menuToggle = document.getElementById("menuToggle");
  const mobileNav = document.getElementById("mobileNav");
  const mobileLinks = mobileNav.querySelectorAll("a");
  const header = document.querySelector("header");

  // --- Abrir/cerrar con hamburguesa ---
  menuToggle.addEventListener("click", () => {
    menuToggle.classList.toggle("active");
    mobileNav.classList.toggle("open");
  });

  // --- Cerrar al hacer click en un link del menú ---
  mobileLinks.forEach(link => {
    link.addEventListener("click", () => {
      menuToggle.classList.remove("active");
      mobileNav.classList.remove("open");
    });
  });

  // --- Header scrolled solo en mobile ---
  const mediaQuery = window.matchMedia("(max-width: 992px)");

  function handleScroll() {
    if (mediaQuery.matches) {
      if (window.scrollY > 50) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    } else {
      header.classList.remove("scrolled"); // reset en desktop
    }
  }

  window.addEventListener("scroll", handleScroll);
  window.addEventListener("resize", handleScroll);
  handleScroll(); // ejecutar al cargar

  // --- Ajustar altura footer dinámicamente ---
  function ajustarAlturaFooter() {
    const footer = document.querySelector("footer.footer");
    const main = document.querySelector("#main");
    if (footer && main) {
      const footerHeight = footer.offsetHeight;
      main.style.marginBottom = footerHeight + "px";
    }
  }

  window.addEventListener("load", ajustarAlturaFooter);
  window.addEventListener("resize", ajustarAlturaFooter);

  // --- Fade reveal del footer con ScrollTrigger ---
  gsap.registerPlugin(ScrollTrigger);

  ScrollTrigger.create({
    trigger: "#main",
    start: "bottom bottom", // cuando el final del main toca el bottom del viewport
    onEnter: () => gsap.to("footer.footer", { 
      opacity: 1, 
      duration: 0.8, 
      ease: "power2.out" 
    }),
    onLeaveBack: () => gsap.to("footer.footer", { 
      opacity: 0, 
      duration: 0.3, 
      ease: "power2.in" 
    })
  });
</script>




    <script src="js/index.js"></script>
</body>
</html>
