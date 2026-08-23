<?php
namespace Prime\Cleaner;

class PathParser
{
    public static function getRelativePath(string $absolutePath): string
    {
        return ltrim(str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', realpath($absolutePath)), '/\\');
    }

    public static function normalizeUrlPath(string $path): string
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', self::getRelativePath($path));
    }

    public static function getAbsolutePath(string $relativePath): string
    {
        return implode(DIRECTORY_SEPARATOR, [$_SERVER['DOCUMENT_ROOT'], ltrim($relativePath, '/')]);
    }

    public static function getCurDir(): string
    {
        return PathParser::getAbsolutePath(self::getCurDirRel());
    }

    public static function getCurDirRel(): string
    {
        return \COption::getOptionString(
            MODULE_ID,
            DATA_DIR_NAME,
            "/upload/"
        );
    }
}
