<?php
include_once("_general.php");
?>

<?php include_once("templates/head-info.php"); ?>
<link rel="stylesheet" href="css/index.css">
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

    <script src="js/index.js"></script>
</body>
</html>
