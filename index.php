<?php
include_once("_general.php");
?>

<?php include_once("templates/home/head-info.php"); ?>
<link rel="preload" href="img/bg-home.mp4" as="video" type="video/mp4" fetchpriority="high">
<link rel="stylesheet" href="css/index.css">
<style>
.footer{opacity:0;visibility:hidden;pointer-events:none}
#footer-sentinel{display:block;width:100%;height:1px}
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

    <div id="footer-sentinel" aria-hidden="true"></div>
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

    function ajustarAlturaFooter(){
      const footer=document.querySelector("footer.footer");
      const main=document.querySelector("#main");
      if(footer&&main){
        if(window.matchMedia("(min-width: 993px)").matches){
          const h=footer.offsetHeight;
          main.style.marginBottom=h+"px";
        }else{
          main.style.marginBottom="0";
        }
      }
      if(window.ScrollTrigger) ScrollTrigger.refresh();
    }

    window.addEventListener("load",ajustarAlturaFooter);
    window.addEventListener("resize",ajustarAlturaFooter);
    if("fonts" in document){document.fonts&&document.fonts.ready&&document.fonts.ready.then(ajustarAlturaFooter)}
    (function(){const imgs=[...document.images];if(!imgs.length){ajustarAlturaFooter();return}let c=0;const done=()=>{c++;if(c===imgs.length)ajustarAlturaFooter()};imgs.forEach(i=>{if(i.complete){done()}else{i.addEventListener("load",done,{once:true});i.addEventListener("error",done,{once:true})}})})();

    gsap.registerPlugin(ScrollTrigger);

    const footer=document.querySelector("footer.footer");
    const sentinel=document.getElementById("footer-sentinel");
    gsap.set(footer,{opacity:0,visibility:"hidden",pointerEvents:"none"});

    const FADE_END_OFFSET="top 60%";

    gsap.to(footer,{
      opacity:1,
      ease:"none",
      scrollTrigger:{
        trigger:sentinel,
        start:"top bottom",
        end:FADE_END_OFFSET,
        scrub:true,
        invalidateOnRefresh:true,
        onUpdate:self=>{
          const visible=self.progress>0.02;
          footer.style.visibility=visible?"visible":"hidden";
          footer.style.pointerEvents=visible?"auto":"none";
        }
      }
    });

    window.addEventListener("hashchange",()=>ScrollTrigger.refresh(),{passive:true});

    const footerEl=document.querySelector("footer.footer");
    if(window.ResizeObserver&&footerEl){
      const ro=new ResizeObserver(()=>{ajustarAlturaFooter()});
      ro.observe(footerEl);
    }
    </script>

    <script src="api/cards_images_feed.php"></script>
    <script src="js/index.js"></script>
</body>
</html>
