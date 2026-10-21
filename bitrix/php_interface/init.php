<?php
/**
 * Runtime bootstrap for Bitrix 16 on PHP 8.x
 */
$poly = $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/php82-polyfills.php';
if (is_file($poly))
{
	require_once $poly;
}
