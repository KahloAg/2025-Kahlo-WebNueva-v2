<?php
function getImages($relativeDir) {
    $path = __DIR__ . '/' . $relativeDir;
    $images = [];
    $patterns = ['*.jpg','*.jpeg','*.png','*.JPG','*.JPEG','*.PNG'];
    foreach ($patterns as $p) {
        foreach (glob($path . '/' . $p) as $file) {
            $images[] = $relativeDir . '/' . basename($file);
        }
    }
    return $images;
}
$cardsImages = [
    'publi' => getImages('img/cards/publi'),
    'comu'  => getImages('img/cards/comu'),
    'marca' => getImages('img/cards/marca'),
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <title>Kahlo Agencia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Estilos existentes -->
    <link rel="stylesheet" href="css/fontawesome-6.css">
    <link rel="stylesheet" href="css/metismenu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Estilos para el efecto de estela de imágenes -->
    <style>
        .trail-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

       .trail-piece {
        position: fixed;
        left: 0;
        top: 0;
        transform: translate(-50%, -50%) scale(1);
        width: auto;
        height: auto;
        max-width: 260px;
        max-height: 260px;
        object-fit: contain;
        opacity: 1;
        pointer-events: none;
        will-change: transform, opacity;
    }

        .trail-piece.animate {
            animation: fadeScale 3s forwards;
        }

        @keyframes fadeScale {
            to {
                opacity: 0;
                transform: translate(-50%, -50%) scale(2.5);
            }
        }
    </style>
</head>

<body class="index-six">
    <!-- contenedor para las piezas de la estela -->
    <div class="trail-wrapper"></div>

    <!-- header area start -->
    <header class="header-area header-one position-absolute start-0 py-4">
        <div class="container">
            <div class="header-wrapper">
                <a href="index.html" class="logo">
                    <img src="img/logo-white.svg" alt="logo">
                </a>
                <div class="header-right">
                    <nav class="nav-area">
                        <ul class="navbar-nav-1">
                            <li class="menu-item main-nav-on">
                                <a class="menu-link" href="#"><span class="rolling-text">Trabajos</span></a>
                            </li>
                            <li class="menu-item main-nav-on">
                                <a class="menu-link" href="#"><span class="rolling-text">Clientes</span></a>
                            </li>
                            <li class="menu-item main-nav-on">
                                <a href="#" class="rts-btn btn-radious btn-white text-black">Contactanos</a>
                            </li>
                            <li class="menu-item main-nav-on">
                                <a class="menu-link" href="https://www.instagram.com/kahloagencia/" target="_blank"><img
                                        src="img/ig.svg" height="25"></a>
                            </li>
                            <li class="menu-item main-nav-on">
                                <a class="menu-link" href="https://www.instagram.com/kahloagencia/" target="_blank"><img
                                        src="img/in.svg" height="25"></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    
    <!-- header area end -->
    <div class="rts-banner-area-7 bg_image rts-scroll-down-circle-wrapper-3 degrade vh-100">
        <video loop muted autoplay playsinline class="video-bg">
            <source src="img/bg-home.mp4" type="video/mp4">
        </video>
        <div class="black-overlay"></div>
    </div>

    <!-- rts banner area 7 end -->

    <!-- team style here -->
    <div
        class="team-area-start-elements rts-team__area rts-section-gap rts-banner-area-7 rts-scroll-down-circle-wrapper-3 next-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <!--  <div class="top-center-image rts-scroll-down-circle-wrapper-5">
                        <a href="" class="speen-shape scroll-down-circle-5">
                            <img src="img/1.png" style="height: 80px;">
                        </a>
                    </div> -->
                    <div class="team-title-4">
                        <h2 class="title rts-has-mask-fill-2">Somos una agencia <br>
                            creativa <img src="img/icon-creatividad.svg" class="magic-image" style="height: 40px"
                                alt=""> <img src="img/x-creatividad.svg" class="magic-image2" style="height: 35px"
                                alt=""> global <img src="img/innovacion.svg" class="magic-image3" style="height: 19px"
                                alt=""> <br>
                            que construye <img src="img/icon-construye.svg" class="magic-image" style="height: 40px"
                                alt=""> <img src="img/x-construye.svg" class="magic-image2" style="height: 35px" alt="">
                            <img src="img/creatividad.svg" class="magic-image3" style="height: 13px" alt=""> <br>
                            conversaciones de valor <br>
                            entre las marcas <br>
                            y las personas <img src="img/icon-personas.svg" class="magic-image" style="height: 40px"
                                alt=""> <img src="img/x-personas.svg" class="magic-image2" style="height: 35px" alt="">
                            <img src="img/audacia.svg" class="magic-image3" style="height: 12px" alt=""></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <!-- project area start -->
    <div class="rts-project-area-7 rts-section-gap rts-team__area">
        <div class="container mt--100">
            <div class="row">
                <div class="col-lg-5 col-xl-4 offset-xl-2">
                    <a class="thumbnail rts-team__item">
                        <div class="card card-servicios bg-celeste p-5 rounded-4 justify-content-between card-1" data-category="publi">
                            <div class="text-start mb-4">
                                <img src="img/icon-01.svg" style="height: 55px;">
                            </div>
                            <div class="content-card">
                                <p class="text-black mb-3">01.</p>
                                <h2 class="card-title mb-4">Publicidad y redes</h2>
                                <!-- Texto que aparece al hacer hover -->
                                <h2 class="card-title-alt mb-0">Estrategias creativas 360° que conectan de manera
                                    significativa con los
                                    públicos.</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-xl-4 offset-xl-6 col-lg-7 offset-lg-5">
                    <a class="thumbnail rts-team__item">
                        <div class="card card-servicios bg-green p-5 rounded-4 justify-content-between card-2" data-category="comu">
                            <div class="text-start mb-4">
                                <img src="img/icon-02.svg" style="height: 55px;">
                            </div>
                            <div class="content-card">
                                <p class="mb-3">02.</p>
                                <h2 class="card-title mb-4">Comunicación interna</h2>
                                <h2 class="card-title-alt mb-0">Estrategias que alinean a las personas con los objetivos
                                    del
                                    negocio.</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-xl-4 offset-xl-2">
                    <a class="thumbnail rts-team__item">
                        <div class="card card-servicios bg-violeta p-5 rounded-4 justify-content-between card-3" data-category="marca">
                            <div class="text-start mb-4">
                                <img src="img/icon-03.svg" style="height: 55px;">
                            </div>
                            <div class="content-card">
                                <p class="mb-3">03.</p>
                                <h2 class="card-title mb-4">Marca empleadora</h2>
                                <h2 class="card-title-alt mb-0">Experiencias auténticas que atren y fidelizan al talento
                                    en
                                    todo el ciclo
                                    de vida.</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- project area end -->

    <!-- case studies start -->
    <div class="rts-case-studies-three rts-section-gap mb-0">
        <div class="container-full">
            <div class="col-lg-12">
                <div class="main-wrapper-case-studies scrolltext-wrapper">
                    <div class="scrollingText">
                        <h2 class="title">
                            PROYECTOS <span>PROYECTOS</span> PROYECTOS .
                            PROYECTOS <span>PROYECTOS</span> PROYECTOS .
                            PROYECTOS <span>PROYECTOS</span> PROYECTOS .
                            PROYECTOS <span>PROYECTOS</span> PROYECTOS .
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row g-24 align-items-center mt--90 mt_md--50 mt_sm--0">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/liliana.mp4"
                                        data-src="img/liliana.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/liliana.svg" class="logo-image" style="height: 40px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                   <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/adecco.mp4"
                                        data-src="img/adecco.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/adecco.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>    
           
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay loop muted src="img/naranjax.mp4"
                                        data-src="img/naranjax.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/naranjax.svg" class="logo-image" style="height: 35px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>  
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop
                                        src="img/naranjax-ebook.mp4" data-src="img/naranjax-ebook.mp4"
                                        alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/naranjax.svg" class="logo-image" style="height:35px;">
                                </div>
                            </div>
                        </a>

                    </div>  
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/tigo.jpg"
                                        data-src="img/tigo.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/tigo.svg" class="logo-image" style="height: 60px;">
                                </div>
                            </div>
                        </a>

                    </div>   
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay loop muted src="img/mercadolibre.mp4"
                                        data-src="img/mercadolibre.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/mercado-libre.png" class="logo-image" style="height: 40px;">
                                </div>
                            </div>
                        </a>

                    </div>   
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop
                                        src="img/santander-8m.mp4" data-src="img/santander-8m.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>    
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/style-store.mp4"
                                        data-src="img/style-store.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/style-store.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>

                    </div>    
                </div>  


                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/personalpay.mp4"
                                        data-src="img/personalpay.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/personal-pay.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
    
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target"
                                        src="img/prudential.jpg" data-src="img/prudential.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/prudential.svg" class="logo-image" style="height: 40px;">
                                </div>
                            </div>
                        </a>

                    </div>    
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/renault.mp4"
                                        data-src="img/renault.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/renault-group.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>

                    </div>    
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/nerdearla.mp4"
                                        data-src="img/nerdearla.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>   
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/buena-tuya.jpg"
                                        data-src="img/buena-tuya.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>    
                </div>  

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/naranja-marcaempleadora.mp4"
                                        data-src="img/naranja-marcaempleadora.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/renault-group.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/liliana-censo.jpg"
                                        data-src="img/liliana-censo.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/liliana.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/adecco-ami.jpg"
                                        data-src="img/adecco-ami.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/adecco.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/efecto-santander.jpg"
                                        data-src="img/efecto-santander.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/renault-reporte.jpg"
                                        data-src="img/renault-reporte.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/renault-group.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/arcor.jpg"
                                        data-src="img/arcor.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/life-seguros-cybermonday.jpg"
                                        data-src="img/life-seguros-cybermonday.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/fuera-de-serie.mp4"
                                        data-src="img/fuera-de-serie.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/renault-group.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/despegar.jpg"
                                        data-src="img/despegar.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/galicia-diversidad.jpg"
                                        data-src="img/galicia-diversidad.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/holiday.jpg"
                                        data-src="img/holiday.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/liliana-calefaccion.jpg"
                                        data-src="img/liliana-calefaccion.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/supervielle-transformacion.jpg"
                                        data-src="img/supervielle-transformacion.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/alsa.jpg"
                                        data-src="img/alsa.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/galicia-roadtrip.jpg"
                                        data-src="img/galicia-roadtrip.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                 
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <video class="w-100 image-blur-target" autoplay muted loop src="img/santander-diversidad.mp4"
                                        data-src="img/santander-diversidad.mp4" alt="image"></video>
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/renault-group.svg" class="logo-image" style="height: 50px;">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/liliana-redes.jpg"
                                        data-src="img/liliana-redes.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/supervielle-players.jpg"
                                        data-src="img/supervielle-players.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/naranja-branding.jpg"
                                        data-src="img/naranja-branding.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/mcdonalds-ardelasenda.jpg"
                                        data-src="img/mcdonalds-ardelasenda.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/bienconvino.jpg"
                                        data-src="img/bienconvino.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                 <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/adecco-match-perfecto.jpg"
                                        data-src="img/adecco-match-perfecto.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/prudential-redes.jpg"
                                        data-src="img/prudential-redes.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    
                    <div class="single-case-main-wrapper">
                        <a href="#" class="pli-image-link">
                            <div class="pli-image-holder">
                                <figure class="pli-image">
                                    <img class="image-blur-target" src="img/consensus.jpg"
                                        data-src="img/consensus.jpg" alt="image">
                                </figure>
                                <div class="logo-overlay">
                                    <img src="img/santander.svg" class="logo-image" style="height: 34px;">
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
                


                <!--  <a href="#" class="learn-more-btn text-center">Ver todos <i class="fa-solid fa-arrow-up-right"></i></a> -->
            </div>
        </div>
    </div>
    <!-- case studies end -->


    <section class="section-logos">
        <div class="blur-overlay"></div>

        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xl-11 d-flex align-items-center flex-column h-100 justify-content-center text-center">
                    <p class="before-title lila mb-5 w1000">A LA EXCELENCIA, Y MÁS ALLÁ!</p>
                    <h3>Avanzamos cada proyecto midiendo la <i class="lila">satisfacción</i> de nuestros clientes</h3>
                    <p class="before-title w600 mt-5 mb-0">en:&nbsp;&nbsp; Atención + Tiempo + Creatividad + Estrategia
                    </p>
                </div>
            </div>
        </div>

        <div class="animated-element p-4 element1">
            <div class="d-flex align-items-center justify-content-center">
                <img src="img/mercado-libre.png">
                <div class="score ms-3">
                    <h4 class="mb-0">4.5</h4>
                    <i class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-regular fa-star-half-stroke"></i>
                </div>
            </div>
        </div>
        <div class="animated-element p-4 element2">
            <div class="d-flex align-items-center justify-content-center">
                <img src="img/mercado-libre.png">
                <div class="score ms-3">
                    <h4 class="mb-0">4.5</h4>
                    <i class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-regular fa-star-half-stroke"></i>
                </div>
            </div>
        </div>
        <div class="animated-element p-4 element3">
            <div class="d-flex align-items-center justify-content-center">
                <img src="img/mercado-libre.png">
                <div class="score ms-3">
                    <h4 class="mb-0">4.5</h4>
                    <i class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-regular fa-star-half-stroke"></i>
                </div>
            </div>
        </div>
        <div class="animated-element p-4 element4">
            <div class="d-flex align-items-center justify-content-center">
                <img src="img/mercado-libre.png">
                <div class="score ms-3">
                    <h4 class="mb-0">4.5</h4>
                    <i class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-regular fa-star-half-stroke"></i>
                </div>
            </div>
        </div>
        <div class="animated-element p-4 element5">
            <div class="d-flex align-items-center justify-content-center">
                <img src="img/mercado-libre.png">
                <div class="score ms-3">
                    <h4 class="mb-0">4.5</h4>
                    <i class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-solid fa-star white me-1"></i><i class="fa-solid fa-star white me-1"></i><i
                        class="fa-regular fa-star-half-stroke"></i>
                </div>
            </div>
        </div>
    </section>

    <div id="main" style="position: relative; z-index:99">
    <div class="vh-100 d-flex justify-content-center flex-column position-relative bg-white logos-slide">
        <section class="container1" style="overflow: hidden">
            <div class="list-clients" id="slide1" name="slide_type_1" onmouseover="myToggleFunction(1)"
                onmouseout="myToggleFunctionOff(1)">
                <div class="item align-items-center d-flex align-items-center">
                    <span class="item-txt card-clients">
                    <img src="img/logos/renault.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/swissmedical.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/quilmes.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/edenor.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/telecom.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/ypf.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
            <div class="list-clients" id="slide2" name="slide_type_1" onmouseover="myToggleFunction(1)"
                onmouseout="myToggleFunctionOff(1)">
                 <div class="item align-items-center d-flex align-items-center">
                    <span class="item-txt card-clients">
                    <img src="img/logos/renault.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/swissmedical.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/quilmes.png" class="img-fluid w-100">
                    </span>
                   <span class="item-txt card-clients">
                    <img src="img/logos/edenor.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/telecom.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/ypf.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
        </section>

        <section class="container2" style="overflow: hidden;">
            <div class="list-clients" id="slide3" style="animation-direction: reverse !important;" name="slide_type_2"
                onmouseover="myToggleFunction(2)" onmouseout="myToggleFunctionOff(2)">
                <div class="item align-items-center d-flex align-items-center">
                     <span class="item-txt card-clients">
                    <img src="img/logos/omint.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/payway.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/personalpay.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/fate.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/flybondi.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/gire.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/lanacion.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/clarin.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
            <div class="list-clients" id="slide4" style="animation-direction: reverse !important;" name="slide_type_2"
                onmouseover="myToggleFunction(2)" onmouseout="myToggleFunctionOff(2)">
               <div class="item align-items-center d-flex align-items-center">
                     <span class="item-txt card-clients">
                    <img src="img/logos/omint.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/payway.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/personalpay.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/fate.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/flybondi.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/gire.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/lanacion.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/clarin.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
        </section>

        <section class="container3" style="overflow: hidden;">
            <div class="list-clients" id="slide5" name="slide_type_3" onmouseover="myToggleFunction(3)"
                onmouseout="myToggleFunctionOff(3)">
                <div class="item d-flex align-items-center">
            
                    <span class="item-txt card-clients">
                    <img src="img/logos/brubank.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/alsa.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/humano.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/getnet.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/naranjax.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/mercadolibre.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/iol.png" class="img-fluid w-100">
                    </span>
                    
                </div>
            </div>
            <div class="list-clients" id="slide6" name="slide_type_3" onmouseover="myToggleFunction(3)"
                onmouseout="myToggleFunctionOff(3)">
                <div class="item align-items-center d-flex align-items-center">
                   <span class="item-txt card-clients">
                    <img src="img/logos/brubank.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/alsa.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/humano.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/getnet.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/naranjax.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/mercadolibre.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/iol.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
        </section>

         <section class="container4" style="overflow: hidden;">
            <div class="list-clients" id="slide7" style="animation-direction: reverse !important;" name="slide_type_4" onmouseover="myToggleFunction(4)"
                onmouseout="myToggleFunctionOff(4)">
                <div class="item d-flex align-items-center">
                 <span class="item-txt card-clients">
                    <img src="img/logos/tigo.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/adecco.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/supervielle.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/mc.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/santander.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/natura.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/stylestore.png" class="img-fluid w-100">
                    </span>
                    
                </div>
            </div>
            <div class="list-clients" id="slide8" style="animation-direction: reverse !important;" name="slide_type_4" onmouseover="myToggleFunction(4)"
                onmouseout="myToggleFunctionOff(4)">
                <div class="item align-items-center d-flex align-items-center">
                   <span class="item-txt card-clients">
                    <img src="img/logos/tigo.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/adecco.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/supervielle.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/mc.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/santander.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/natura.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/stylestore.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
        </section>

        <section class="container5" style="overflow: hidden;">
            <div class="list-clients" id="slide9" name="slide_type_5" onmouseover="myToggleFunction(5)"
                onmouseout="myToggleFunctionOff(5)">
                <div class="item d-flex align-items-center">
                 <span class="item-txt card-clients">
                    <img src="img/logos/dia.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/galicia.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/liliana.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/ledesma.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/axion.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/rapipago.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/despegar.png" class="img-fluid w-100">
                    </span>
                    
                </div>
            </div>
            <div class="list-clients" id="slide10"  name="slide_type_5" onmouseover="myToggleFunction(5)" onmouseout="myToggleFunctionOff(5)">
                <div class="item align-items-center d-flex align-items-center">
                    <span class="item-txt card-clients">
                    <img src="img/logos/dia.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/galicia.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/liliana.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/ledesma.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/axion.png" class="img-fluid w-100">
                    </span>
                    <span class="item-txt card-clients">
                    <img src="img/logos/rapipago.png" class="img-fluid w-100">
                    </span>
                     <span class="item-txt card-clients">
                    <img src="img/logos/despegar.png" class="img-fluid w-100">
                    </span>
                </div>
            </div>
        </section>

        
    </div>
    <!-- our trusted clients area start -->
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="container py-5">
                <div class="row align-items-end gx-5">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <p class="mb-0 border-bottom pb-4"><a href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." target="_blank"
                                class="d-flex align-items-center justify-content-between">CONTACTANOS <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <p class="mb-3"><a target="_blank" href="https://api.whatsapp.com/send?phone=541132905198&text=Hola!%20Me%20gustar%C3%ADa%20averiguar..." class="d-flex align-items-center"><span>WHATSAPP</span> <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                        <p class="mb-3"><a href="https://www.linkedin.com/company/kahlo-agencia/" target="_blank" class="d-flex align-items-center"><span>LINKEDIN</span> <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                        <p class="mb-0"><a href="https://www.instagram.com/kahloagencia" target="_blank" class="d-flex align-items-center"><span>INSTAGRAM</span> <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <p class="mb-3"><a href="#" class="d-flex align-items-center"><span>TRABAJOS</span> <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                        <p class="mb-0"><a href="#" class="d-flex align-items-center"><span>CLIENTES</span> <img
                                    src="img/arrow-right.svg" style="height: 25px;"></a></p>
                    </div>


                    <div class="col-12 col-sm-6 col-lg-3 text-end">
                        <p class="mb-4">BUENOS AIRES <br>
                            Aguirre 540 2ºB <br> 1425 Buenos Aires <br> ARGENTINA</p>

                        <p class="mb-0">MADRID<br>
                            Calle Campo Real, 9, <br>28039 Madrid<br>ESPAÑA</p>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <img src="img/logo-footer.svg" class="img-fluid">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts style two -->
    <div class="loading-screen" id="loading-screen">
        <span class="bar top-bar"></span>
        <span class="bar down-bar"></span>
        <span class="progress-line"></span>
        <span class="loading-counter"> </span>
    </div>

    <div class="bg-noise"></div>

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <!-- back to top end -->

    <!-- pre loader start -->
    <div class="rts-cursor cursor-outer" data-default="yes" data-link="yes" data-slider="no">
        <span class="fn-cursor"></span>
    </div>
    <div class="rts-cursor cursor-inner" data-default="yes" data-link="yes" data-slider="no">
        <span class="fn-cursor">
            <span class="fn-left"></span>
            <span class="fn-right"></span>
        </span>
    </div>
    <!-- pre loader end -->

    <!-- Scripts externos existentes -->
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
    <!-- title opacity scroll magic -->
    <script defer src="js/scrollmagic.js"></script>
    <script defer src="js/animate-scrollmagic.js"></script>
    <!-- title opacity scroll magic end -->
    <script defer src="js/counterup.js"></script>
    
    <script defer src="js/waw.js"></script>
    <!-- custom javascripts -->
    <script defer src="js/main.js"></script>
    <script defer src="js/metismenu.js"></script>

    <script>
        window.CARDS_IMAGES = <?php echo json_encode($cardsImages, JSON_UNESCAPED_SLASHES); ?>;
    </script>

    <script>
        window.addEventListener("load", function () {
            gsap.registerPlugin(ScrollTrigger);

            gsap.to(".video-bg", {
                filter: "blur(12px) brightness(0.2)",
                scale: 1.05,
                opacity: 0,
                scrollTrigger: {
                    trigger: ".degrade",
                    start: "top top",
                    endTrigger: ".next-section",
                    end: "top top",
                    scrub: true,
                    pin: true,
                    pinSpacing: false,

                }
            });

            gsap.to(".black-overlay", {
                opacity: 1,
                scrollTrigger: {
                    trigger: ".degrade",
                    endTrigger: ".next-section",
                    start: "top top",
                    end: "top top",
                    scrub: true
                }
            });
        });
    </script>


    <!-- SCRIPT: SECTION LOGOS -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.registerPlugin(ScrollTrigger);

            const blurOverlay = document.querySelector(".blur-overlay");

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: ".section-logos",
                    start: "top top",
                    end: "+=300%",
                    scrub: true,
                    pin: true,
                    pinSpacing: true,
                    onUpdate: (self) => {
                        blurOverlay.style.opacity = self.progress > 0.5 ? 1 : 0;
                    }
                }
            });

            tl.to(".section-logos", {
                backgroundColor: "#ffffff",
                duration: 0.2
            }, 0);

tl.to(".section-logos .before-title:first-of-type", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, 0.3);

tl.to(".section-logos h3", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, "+=0.1");

tl.to(".section-logos .before-title:last-of-type", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, "+=0.2");

            tl.to(".animated-element", {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.3
            }, 1.8);
        });


    </script>
    <!-- Script inline para animaciones de scroll -->
    <script>
        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", function () {
            const mainElement = document.querySelector("main");
            const footerElement = document.querySelector("footer");

            // Altura del footer
            let footerHeight = footerElement.offsetHeight;

            // Altura de la última sección del main
            const lastSection = mainElement.querySelector("section:last-of-type");
            let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
            let viewportHeight = window.innerHeight;

            // Ajuste dinámico: cuánto se "ve" la última sección desde el viewport
            let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

            gsap.to(mainElement, {
                y: -(footerHeight + adjustment),
                ease: "none",
                scrollTrigger: {
                    trigger: mainElement,
                    start: "bottom bottom",
                    end: "bottom top",
                    scrub: true,
                }
            });

            document.body.style.overflowX = 'hidden';
        });
    </script>

    <!-- Script inline para efecto de estela de imágenes en las tarjetas -->
    <script>
        const wrapper = document.querySelector('.trail-wrapper');
        const cards = document.querySelectorAll('.card-servicios');
        let lastTime = 0;

        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const now = Date.now();
                if (now - lastTime > 100) {
                    const category = card.dataset.category || '';
                    createTrailPieceForCard(e.clientX, e.clientY, category);
                    lastTime = now;
                }
            });
        });

        function pickImageForCategory(category) {
            try {
                if (window.CARDS_IMAGES && category && Array.isArray(CARDS_IMAGES[category]) && CARDS_IMAGES[category].length > 0) {
                    const arr = CARDS_IMAGES[category];
                    const idx = Math.floor(Math.random() * arr.length);
                    return arr[idx];
                }
            } catch (e) {}
            const index = Math.floor(Math.random() * 15) + 1;
            return `img/${index}.jpg`;
        }

function createTrailPieceForCard(x, y, category) {
    const url = pickImageForCategory(category);
    const piece = new Image();
    piece.className = 'trail-piece';
    piece.style.left = x + 'px';
    piece.style.top = y + 'px';
    piece.src = url;
    piece.decoding = 'async';
    piece.loading = 'eager';

    wrapper.appendChild(piece);

    piece.addEventListener('load', () => {
        const maxW = 260;
        const maxH = 260;
        const w = piece.naturalWidth || maxW;
        const h = piece.naturalHeight || maxH;
        const ratio = Math.min(maxW / w, maxH / h, 1);

        piece.style.width = (w * ratio) + 'px';
        piece.style.height = (h * ratio) + 'px';

        piece.classList.add('animate');
    });

    piece.addEventListener('animationend', () => {
        piece.remove();
    });
}
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clasesIn = {
                'magic-image': ['animate__animated', 'animate__zoomIn'],
                'magic-image2': ['animate__animated', 'animate__rotateIn'],
                'magic-image3': ['animate__animated', 'animate__bounceIn']
            };
            const clasesOut = {
                'magic-image': ['animate__animated', 'animate__zoomOut'],
                'magic-image2': ['animate__animated', 'animate__rotateOut'],
                'magic-image3': ['animate__animated', 'animate__bounceOut']
            };
            const inView = new Set();
            const animating = new WeakMap();
            let lastScrollY = window.pageYOffset;
            let scrollDir = 'down';

            function animateIn(el, key) {
                animating.set(el, true);
                el.classList.remove(...clasesOut[key]);
                el.classList.add(...clasesIn[key]);
                el.addEventListener('animationend', function handler() {
                    animating.set(el, false);
                    el.removeEventListener('animationend', handler);
                });
            }

            function animateOut(el, key) {
                animating.set(el, true);
                el.classList.remove(...clasesIn[key]);
                el.classList.add(...clasesOut[key]);
                el.addEventListener('animationend', function handler() {
                    animating.set(el, false);
                    el.removeEventListener('animationend', handler);
                });
            }

            window.addEventListener('scroll', function () {
                const currentY = window.pageYOffset;
                scrollDir = currentY > lastScrollY ? 'down' : 'up';
                lastScrollY = currentY;
                inView.forEach(function (el) {
                    if (animating.get(el)) return;
                    const key = Array.from(el.classList).find(c => clasesIn[c]);
                    if (!key) return;
                    const inClass = clasesIn[key][1];
                    const outClass = clasesOut[key][1];
                    if (scrollDir === 'down' && !el.classList.contains(inClass)) {
                        animateIn(el, key);
                    } else if (scrollDir === 'up' && !el.classList.contains(outClass)) {
                        animateOut(el, key);
                    }
                });
            });

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.intersectionRatio >= 0.1) inView.add(entry.target);
                    else inView.delete(entry.target);
                });
            }, { threshold: [0.1] });

            document
                .querySelectorAll('.magic-image, .magic-image2, .magic-image3')
                .forEach(function (el) {
                    animating.set(el, false);
                    observer.observe(el);
                });
        });
    </script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", function () {
            const mainElement = document.querySelector("#main");
            const footerElement = document.querySelector("footer");

            // Altura del footer
            let footerHeight = footerElement.offsetHeight;

            // Altura de la última sección del main
            const lastSection = mainElement.querySelector("section:last-of-type");
            let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
            let viewportHeight = window.innerHeight;

            // Ajuste dinámico: cuánto se "ve" la última sección desde el viewport
            let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

            gsap.to(mainElement, {
                y: -(footerHeight + adjustment),
                ease: "none",
                scrollTrigger: {
                    trigger: mainElement,
                    start: "bottom bottom",
                    end: "bottom top",
                    scrub: true,
                }
            });

            document.body.style.overflowX = 'hidden';
        });
    </script>
    <script>
 console.clear();
gsap.registerPlugin(ScrollTrigger);

const cardsWrappers = gsap.utils.toArray(".card-wrapper");
const tarjetas = gsap.utils.toArray(".tarjeta");

cardsWrappers.forEach(function(wrapper, i) {
  const tarjeta = tarjetas[i];
  let scale = 1;
  let rotation = 0;

  if (i !== tarjetas.length - 1) {
    scale = 0.9 + 0.025 * i;
    rotation = -10;
  }

  gsap.to(tarjeta, {
    scale: scale,
    rotationX: rotation,
    transformOrigin: "top center",
    ease: "none",
    scrollTrigger: {
      trigger: wrapper,
      start: "top " + (80 + 10 * i),
      end: "bottom 550",
      endTrigger: ".wrapper",
      scrub: true,
      pin: wrapper,
      pinSpacing: false,
      onUpdate: (self) => {
  if (i === tarjetas.length - 1) {
    tarjeta.style.filter = "none";
  } else {
    const blurAmount = gsap.utils.mapRange(0, 1, 0, 3, self.progress);
    tarjeta.style.filter = `blur(${blurAmount}px)`;
  }
},
      markers: false,
      id: i + 1
    }
  });
});
    </script>
</body>

</html>
