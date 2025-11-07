<?php
$ORGANIGRAMA = TRUE;
include "_general.php";

header('Content-Type: application/json; charset=utf-8');

$result = array();
$result["success"] = 0;
$result["ok"] = false;

$active = isset($_GET["active"]) ? (int)$_GET["active"] : 0;
$limit = isset($_GET["limit"]) ? max(1, min(10000, (int)$_GET["limit"])) : 1000;

$registers = SelectQuery("pages")
    ->Condition("page_active =", "i", $active)
    ->Order("page_index", "ASC")
    ->Limit($limit)
    ->Run();

if (!is_array($registers)) $registers = array();

foreach ($registers as &$r) {
    $r["page_url"] = isset($r["page_url"]) ? $r["page_url"] : "";
    $r["page_video"] = isset($r["page_video"]) ? $r["page_video"] : "";
    $r["page_video_poster"] = isset($r["page_video_poster"]) ? $r["page_video_poster"] : "";
    $r["page_logo_overlay"] = isset($r["page_logo_overlay"]) ? $r["page_logo_overlay"] : "";
}
unset($r);

$result["success"] = 1;
$result["ok"] = true;
$result["registers"] = array_values($registers);
$result["registers_by_id"] = $registers;
$result["data"] = $result["registers"];

die(json_encode($result, JSON_UNESCAPED_UNICODE));
