<?php
namespace Prime\Cleaner;

class URLParser
{
    public static function getExtension(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH);

        return pathinfo($path, PATHINFO_EXTENSION);
    }

    public static function getRelativePath(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH);

        return self::resizeCacheNormalize(ltrim($path, '/'));
    }

    public static function getFileName(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH);

        return basename($path);
    }

    public static function resizeCacheNormalize(string $url): string
    {
        if (preg_match('/\/resize_cache\//i', $url)) {
            $resizeCacheKey = 1;
            $folderKey = 4;

            $arURL = explode('/', $url);

            if ($arURL[$resizeCacheKey] == 'resize_cache') {
                unset($arURL[$resizeCacheKey]);
            }

            if (isset($arURL[$folderKey])) {
                unset($arURL[$folderKey]);
            }

            return implode('/', $arURL);
        }

        return $url;
    }
}