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

function geo_is_public_ip($ip){
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) return true;
    return false;
}

function geo_client_ip(){
    $cands = [];
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) $cands[] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    if (!empty($_SERVER['HTTP_TRUE_CLIENT_IP'])) $cands[] = $_SERVER['HTTP_TRUE_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        foreach (explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']) as $p) $cands[] = trim($p);
    }
    if (!empty($_SERVER['REMOTE_ADDR'])) $cands[] = $_SERVER['REMOTE_ADDR'];

    foreach ($cands as $ip) if (geo_is_public_ip($ip)) return $ip;
    foreach ($cands as $ip) if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
    return '';
}

function geo_fetch_country_code_remote($ip){
    $code = '';

    $fetch = function($url){
        $resp = '';
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 2,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_HTTPHEADER => ['Accept: application/json']
            ]);
            $resp = curl_exec($ch);
            curl_close($ch);
        } else {
            $ctx = stream_context_create(['http'=>['timeout'=>2,'ignore_errors'=>true,'header'=>"Accept: application/json\r\n"]]);
            $resp = @file_get_contents($url, false, $ctx);
        }
        return $resp ?: '';
    };

    $r1 = $fetch('https://ipapi.co/'.rawurlencode($ip).'/json/');
    if ($r1) {
        $j = json_decode($r1, true);
        if (is_array($j) && !empty($j['country']) && strlen($j['country']) === 2) {
            $code = strtoupper($j['country']);
        }
    }
    if ($code === '') {
        $r2 = $fetch('https://ipwho.is/'.rawurlencode($ip));
        if ($r2) {
            $j = json_decode($r2, true);
            if (is_array($j) && !empty($j['success']) && !empty($j['country_code']) && strlen($j['country_code']) === 2) {
                $code = strtoupper($j['country_code']);
            }
        }
    }
    return $code;
}

/**
 * detectar_origen('arg') o detectar_origen('esp') → devuelve y echo: 'si'/'no'
 * $forceRefresh = true para ignorar cache de sesión y recalcular.
 */
function detectar_origen($pais, $forceRefresh = false){
    if (session_status() !== PHP_SESSION_ACTIVE) @session_start();

    $map = ['arg' => 'AR', 'esp' => 'ES'];
    $p = strtolower(trim($pais));
    $target = $map[$p] ?? (strlen($p) === 2 ? strtoupper($p) : '');

    $cc = '';
    if (!$forceRefresh && !empty($_SESSION['geo_country_code']) && strlen($_SESSION['geo_country_code']) === 2) {
        $cc = strtoupper($_SESSION['geo_country_code']);
    } else {
        if (!empty($_SERVER['HTTP_CF_IPCOUNTRY']) && strlen($_SERVER['HTTP_CF_IPCOUNTRY']) === 2) {
            $cc = strtoupper($_SERVER['HTTP_CF_IPCOUNTRY']);
        } else {
            $ip = geo_client_ip();
            if ($ip !== '' && !in_array($ip, ['127.0.0.1','::1'], true)) {
                $cc = geo_fetch_country_code_remote($ip);
            }
        }
        if ($cc !== '' && strlen($cc) === 2) $_SESSION['geo_country_code'] = $cc;
    }

    $ok = ($target !== '' && $cc === $target);
    $out = $ok ? 'si' : 'no';
    echo $out;
    return $out;
}



