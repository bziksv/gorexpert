<?php
namespace Bitrix\Main\Diag;

interface IExceptionHandlerOutput
{
	function renderExceptionMessage(\Throwable $exception, $debug = false);
}
