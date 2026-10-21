<?php
/**
 * Polyfills for Bitrix 16.0.9 on PHP 8.0–8.2.
 * Loaded from php_interface/init.php and (locally) via auto_prepend_file.
 */

if (!function_exists('get_magic_quotes_gpc')) {
	function get_magic_quotes_gpc()
	{
		return false;
	}
}

if (!function_exists('get_magic_quotes_runtime')) {
	function get_magic_quotes_runtime()
	{
		return false;
	}
}

if (!function_exists('set_magic_quotes_runtime')) {
	function set_magic_quotes_runtime($new_setting)
	{
		return false;
	}
}

if (!function_exists('each')) {
	function each(&$array)
	{
		$key = key($array);
		if ($key === null) {
			return false;
		}
		$value = current($array);
		next($array);
		return array(
			1 => $value,
			'value' => $value,
			0 => $key,
			'key' => $key,
		);
	}
}

if (!function_exists('create_function')) {
	function create_function($args, $code)
	{
		static $i = 0;
		$i++;
		$name = 'bx_create_function_'.$i.'_'.md5($args.$code);
		if (!function_exists($name)) {
			eval('function '.$name.'('.$args.') { '.$code.' }');
		}
		return $name;
	}
}
