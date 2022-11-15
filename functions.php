<?php

const ONE_HOUR = 3600;

function getXmlFile($file): string
{
    $filePath = __DIR__ . '/files/' . $file;

    if (!file_exists($filePath)) {
        $xmlRes = file_get_contents('https://chromedriver.storage.googleapis.com/');
        file_put_contents($filePath, $xmlRes);
        return $xmlRes;
    }

    if (time() - filemtime($filePath) > ONE_HOUR) {
        $res = file_get_contents('https://chromedriver.storage.googleapis.com/');
        file_put_contents($filePath, $res);
        return $res;
    }

    return file_get_contents($filePath);
}

function getLatestReleaseFile($file): string
{
    return getFile($file);
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

    if (time() - filemtime($filePath) > ONE_HOUR) {
        $res = file_get_contents('https://chromedriver.storage.googleapis.com/' . $orjFileName);
        file_put_contents($filePath, $res);
    }

    if (str_contains($fileName, 'zip'))
        header('Content-Type: application/zip');
    return file_get_contents($filePath);
}