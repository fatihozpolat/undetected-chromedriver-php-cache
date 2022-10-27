<?php

function getXmlFile($file): string
{
    if (!file_exists($file)) {
        $xmlRes = file_get_contents('https://chromedriver.storage.googleapis.com/');
        file_put_contents($file, $xmlRes);
        return $xmlRes;
    } else {
        if (time() - filemtime($file) > 60 * 60 * 24) {
            $xmlRes = file_get_contents('https://chromedriver.storage.googleapis.com/');
            file_put_contents($file, $xmlRes);
            return $xmlRes;
        } else {
            return file_get_contents($file);
        }
    }
}

function getLatestReleaseFile($file): string
{
    if (!file_exists($file)) {
        $fileRes = file_get_contents('https://chromedriver.storage.googleapis.com/' . $file);
        file_put_contents($file, $fileRes);
        return $fileRes;
    } else {
        if (time() - filemtime($file) > 60 * 60) {
            $fileRes = file_get_contents('https://chromedriver.storage.googleapis.com/' . $file);
            file_put_contents($file, $fileRes);
            return $fileRes;
        } else {
            return file_get_contents($file);
        }
    }
}