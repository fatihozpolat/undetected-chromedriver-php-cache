<?php
require_once "funcs.php";

// log all request
file_put_contents('log.txt', print_r($_REQUEST, true), FILE_APPEND);

if (!isset($_GET['file'])) {
    header('Content-Type: application/xml');
    echo getXmlFile('google.xml');
    die();
}

$file = $_GET['file'];

// 106.0.5249.61/chromedriver_win32.zip
$fileName = str_replace(['.', '/'], ['_', '-'], $file);

if (!file_exists($fileName)) {
    $file = file_get_contents('https://chromedriver.storage.googleapis.com/' . $file);
    file_put_contents($fileName, $file);
}

header('Content-Type: application/zip');
echo file_get_contents($fileName);
