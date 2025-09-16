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