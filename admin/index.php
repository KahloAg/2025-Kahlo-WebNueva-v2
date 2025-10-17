<?php
$PAGE = 'admin-index';
include('../_general.php');

$pages_count = 0;
$pages = SelectQuery('pages')->Limit(1000000)->Run();
if (is_array($pages)) {
    $pages_count = count($pages);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kahlo Web 2.0 - Admin</title>
    <link rel="icon" type="image/jpeg" href="img/favicon.jpg">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/all.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.theme.css" type="text/css">
    <link rel="stylesheet" href="css/admin.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php ShowAdminNavBar('nav-index'); ?>
    <div class="area"></div>
    <div class="contenidoAdmin">
        <div class="inicioAdmin jumbotron">
            <br><br>
            <h2>Panel de administración de Kahlo Web 2.0</h2>
            <p>Usá el menú izquierdo para acceder a las distintas secciones y funciones del administrador.</p><br>
            <br><br><br><br><br><br><br>
            <h3 style="margin-top:50px;">Estadísticas</h3>
            <ul class="list-group">
                <li class="list-group-item" style="color: black; padding: 10px;">
                    <span class="badge" style="width: 50px; color: black; padding: 10px;"><?= $pages_count ?></span>
                    Páginas cargadas
                </li>
            </ul>
        </div>
    </div>
    <div style="width:100px; height: 50px"></div>
</body>
</html>
