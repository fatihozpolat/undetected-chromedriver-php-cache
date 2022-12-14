<?php

const ONE_HOUR = 3600;
const ONE_DAY = 86400;

function getXmlFile(): string
{
    return file_get_contents('https://chromedriver.storage.googleapis.com/');
}

function getLatestReleaseFile($file): string
{
    $filePath = __DIR__ . '/files/' . $file;
    if (file_exists($filePath) && time() - filemtime($filePath) < ONE_DAY) {
        return file_get_contents($filePath);
    }

    $content = file_get_contents('https://chromedriver.storage.googleapis.com/' . $file);
    file_put_contents($filePath, $content);
    return $content;
}

function getZip($file): string
{
    $fileName = str_replace(['.', '/'], ['_', '-'], $file);
    return getFile($fileName, $file);
}

function getFile($fileName, $orjFileName = null)
{
    header('Content-Type: application/zip');
    $orjFileName = $orjFileName ?? $fileName;
    $filePath = __DIR__ . '/files/' . $fileName;

    if (file_exists($filePath) && time() - filemtime($filePath) < ONE_DAY) {
        return file_get_contents($filePath);
    }

    $content = file_get_contents('https://chromedriver.storage.googleapis.com/' . $orjFileName);
    file_put_contents($filePath, $content);
    return $content;
}


if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}