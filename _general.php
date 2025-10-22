<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once("conn/cfg.php");
require_once("conn/sql_latest.php");
require_once("conn/functions.php");
require_once("conn/load-globals.php");
require_once("conn/sed.php");
require_once("conn/get-time.php");

mysqli_report(MYSQLI_REPORT_ERROR);
($conn = mysqli_connect(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME)) || salir_mant();
mysqli_set_charset($conn, 'utf8mb4');
mysqli_query($conn, "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
$_SESSION["conn"] = $conn;

$admin_username = 'admin';
$admin_password = 'Q3mZ8p1L6vB2a9T4yR7X5';

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

function ShowAdminNavBar($selected)
{
    echo '<nav class="main-menu">
    <ul>
        <li>
            <a id="nav-index" href="index.php">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">Inicio</span>
            </a>
        </li>
        <li>
            <a id="nav-pages" href="pages.php">
                <i class="far fa-file-alt fa-2x"></i>
                <span class="nav-text">Páginas</span>
            </a>
        </li>
        <li>
            <a id="nav-card-images" href="card_images.php">
                <i class="fa fa-images fa-2x"></i>
                <span class="nav-text">Imágenes de Cards</span>
            </a>
        </li>
    </ul>
    <ul class="logout">
        <li>
            <a href="logout.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">Salir</span>
            </a>
        </li>
    </ul>
  </nav>
  <script>document.getElementById("'.$selected.'").classList.add("btactivo");</script>';
}


if (!isset($PAGE)) {
    $PAGE = '';
}

$is_admin_page = strncmp($PAGE, 'admin-', 6) === 0;
if ($is_admin_page && $PAGE !== 'admin-login' && empty($_SESSION['admin_user'])) {
    header('Location: login.php');
    exit;
}
