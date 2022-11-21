<?php
ini_set('max_execution_time', 0);

if (!file_exists('files')) {
    mkdir('files');
}

require_once "functions.php";

if (!isset($_GET['file'])) {
    header('Content-Type: application/xml');
    echo getXmlFile();
    die();
}

$file = $_GET['file'];
file_put_contents('log.txt', '[' . date('Y-m-d H:i:s') . '] ' . $file . PHP_EOL, FILE_APPEND);

if ($file === 'favicon.ico') return false;

if (strpos(mb_strtolower($file), 'latest') !== false) {
    echo getLatestReleaseFile($file);
    die();
}

echo getZip($file);