<?php
$B = rtrim(BASEURL, '/');
$TITLE = isset($PAGE_TITLE) ? $PAGE_TITLE : 'Kahlo Agencia';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<base href="<?= $B ?>/">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<title><?= htmlspecialchars($TITLE, ENT_QUOTES, 'UTF-8') ?></title>

<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link rel="preload" href="fonts/sharpgrotesk-book20-webfont.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="fonts/sharpgrotesk-medium20-webfont.woff2" as="font" type="font/woff2" crossorigin>

<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap"></noscript>

<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"></noscript>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<link rel="preload" href="css/metismenu.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="css/metismenu.css"></noscript>

<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></noscript>

<link rel="preload" href="css/fontawesome-6.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="css/fontawesome-6.css"></noscript>

<meta property="og:title" content="Kahlo Agencia">
<meta property="og:type" content="website">
<meta property="og:image" content="https://kahloagencia.com/img/metadata_2025.jpg">
<meta property="og:url" content="https://kahloagencia.com/2025/kahlo_web_v2/">
<meta property="og:description" content="Somos una agencia creativa global que construye, con corazón y cabeza, conversaciones de valor entre las marcas y sus diferentes audiencias.">

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40531441-1"></script>
<script>
window.dataLayer=window.dataLayer||[];
function gtag(){dataLayer.push(arguments);}
gtag('js',new Date());
gtag('config','UA-40531441-1');
</script>

<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init','534850576708032');
fbq('track','PageView');
fbq('track','Lead');
</script>
<noscript>
<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=534850576708032&ev=PageView&noscript=1">
</noscript>
