<?
$error = true;
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка 404");
?>
<p>К сожалению, запрашиваемой Вами страницы не существует. Вероятно, она была удалена, либо её здесь никогда не было. </p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>