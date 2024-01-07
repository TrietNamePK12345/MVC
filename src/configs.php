<?php
namespace App\src;
define('_DIR_ROOT', __DIR__);

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$dir_root = str_replace('\\', '/', _DIR_ROOT);
$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$folder = str_replace(strtolower($documentRoot), '', strtolower($dir_root));
$web_root .= $folder;

define('_WEB_ROOT', $web_root);