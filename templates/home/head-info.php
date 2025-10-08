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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

<link rel="stylesheet" href="css/fontawesome-6.css">
<link rel="stylesheet" href="css/metismenu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
