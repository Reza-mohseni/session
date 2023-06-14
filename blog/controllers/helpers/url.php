<?php
$isHttps = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1 || $_SERVER['SERVER_PORT'] === 443);
$ishttps = $isHttps ? 'https://' : 'http://';

define('BASE_URL',$ishttps . $_SERVER['SERVER_NAME'] . "/programmer/session/blog");

function redirect($url)
{
    header('Location: '. trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
}
function asset($file)
{
    return trim(BASE_URL, '/ ') . '/' .'views/assets/' . trim($file, '/ ');
}

function url($url)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
}