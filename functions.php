<?php

const ONE_HOUR = 3600;

function getXmlFile(): string
{
    return file_get_contents('https://chromedriver.storage.googleapis.com/');
}

function getLatestReleaseFile($file): string
{
    return file_get_contents('https://chromedriver.storage.googleapis.com/' . $file);
}

function getZip($file): string
{
    $fileName = str_replace(['.', '/'], ['_', '-'], $file);
    return getFile($fileName, $file);
}

function getFile($fileName, $orjFileName = null)
{
    $orjFileName = $orjFileName ?? $fileName;
    $filePath = __DIR__ . '/files/' . $fileName;

    if (!file_exists($filePath)) {
        $res = file_get_contents('https://chromedriver.storage.googleapis.com/' . $orjFileName);
        file_put_contents($filePath, $res);
    }

    if (filemtime($filePath) > ONE_HOUR) {
        $res = file_get_contents('https://chromedriver.storage.googleapis.com/' . $orjFileName);
        file_put_contents($filePath, $res);
    }

    if (str_contains($fileName, 'zip'))
        header('Content-Type: application/zip');
    return file_get_contents($filePath);
}


if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}