<?php
use Bitrix\Main\Loader;
use Prime\Cleaner;

const MODULE_ID = 'prime.cleaner';
const DATA_DIR_NAME = 'PRIME_DATA_DIR';
const SESSION_MESSAGE_KEY = 'PRIME_CLEANER_MESSAGE';

Loader::registerAutoloadClasses(MODULE_ID, [
    Cleaner\General::class => '/lib/general.php',
    Cleaner\ImageFinder::class => '/lib/ImageFinder.php',
    Cleaner\Helper::class => '/lib/Helper.php',
    Cleaner\CSVParser::class => '/lib/CSVParser.php',
    Cleaner\URLParser::class => '/lib/URLParser.php',
    Cleaner\PathParser::class => '/lib/PathParser.php',
    Cleaner\Cleaner::class => '/lib/Cleaner.php',
]);
