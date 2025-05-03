<?php

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function attr($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function js($str) {
    return json_encode($str, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
} 