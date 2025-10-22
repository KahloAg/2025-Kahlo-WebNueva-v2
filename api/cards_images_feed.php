<?php
header('Content-Type: application/javascript; charset=UTF-8');
include(__DIR__ . '/../_general.php');

$rows = SelectQuery('card_images')->Order('img_id','DESC')->Run();
if (!is_array($rows)) $rows = [];

$can = ['publicidad','comunicacion','marca'];
$by = [
    'publicidad' => [],
    'comunicacion' => [],
    'marca' => [],
    '_default' => []
];

$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']),'/');
$publicBase = $scriptDir . '/../admin/cards_images/';
$publicBase = preg_replace('#/+#','/',$publicBase);

foreach ($rows as $r) {
    $fname = trim((string)($r['img_url'] ?? ''));
    $typeRaw = strtolower(trim((string)($r['img_card_type'] ?? '')));
    if ($fname === '') continue;

    if ($typeRaw === 'publi') $type = 'publicidad';
    elseif ($typeRaw === 'comu') $type = 'comunicacion';
    elseif (in_array($typeRaw, $can, true)) $type = $typeRaw;
    else $type = '';

    $url = $publicBase . $fname;

    if ($type && isset($by[$type])) $by[$type][] = $url;
    $by['_default'][] = $url;
}

foreach ($by as $k => $arr) {
    if (count($arr) > 1) shuffle($by[$k]);
}

$out = [
    'publicidad' => array_values($by['publicidad']),
    'comunicacion' => array_values($by['comunicacion']),
    'marca' => array_values($by['marca']),
    '_default' => array_values($by['_default'])
];

echo 'window.CARDS_IMAGES = ' . json_encode($out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ';';
