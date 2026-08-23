<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Заказать онлайн оценку у профессиональных экспертов-оценщиков компании Городская Экспертиза. Проведение экспертизы и подготовка отчета по оценке стоимости имущества для нотариуса, банка и иных нужд.");
$APPLICATION->SetPageProperty("title", "Онлайн-заявка на оценку имущества");
$APPLICATION->SetTitle("Онлайн-заявка");
?><?$APPLICATION->IncludeComponent(
	"bitrix:order", 
	".default", 
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, Ваше сообщение принято.",
		"EXT_FIELDS" => array(
			0 => "Объект оценки",
			1 => "Цель оценки",
			2 => "Телефон",
			3 => "Удобное время для связи",
			4 => "",
		),
		"EMAIL_TO" => "info@gorexpert.ru, gorexpert@mail.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NONE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>