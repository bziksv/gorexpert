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

/**
 * Force white page background in admin so Cursor/Electron screenshots
 * don't render transparent fatal/empty responses as solid black.
 */
if (
	PHP_SAPI !== 'cli'
	&& !defined('BX_GX_FORCE_WHITE_BG')
	&& isset($_SERVER['REQUEST_URI'])
	&& strpos($_SERVER['REQUEST_URI'], '/bitrix/admin/') !== false
) {
	define('BX_GX_FORCE_WHITE_BG', true);
	ob_start(static function ($buf) {
		if ($buf === false || $buf === null) {
			$buf = '';
		}
		$trim = ltrim($buf);
		if ($trim !== '' && (stripos($trim, '<pre>') === 0 || stripos($trim, '<pre ') === 0)) {
			return '<style>html,body,pre{background:#ffffff!important;color:#111111!important;margin:0;padding:16px;white-space:pre-wrap}</style>'.$buf;
		}
		if ($buf !== '' && stripos($buf, 'data-gx-force-bg') === false && stripos($buf, '<head') !== false) {
			$replaced = preg_replace(
				'/<head(\s[^>]*)?>/i',
				'<head$1><style data-gx-force-bg>html,body{background:#ffffff!important}</style>',
				$buf,
				1
			);
			if (is_string($replaced)) {
				$buf = $replaced;
			}
		}
		return $buf;
	});
}
