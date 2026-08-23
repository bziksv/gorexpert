<?$APPLICATION->IncludeComponent(
	"v1rt:order", 
	"order-form", 
	array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Спасибо, Ваше сообщение принято.",
		"EXT_FIELDS" => array(
			0 => "Телефон"
		),
		"EMAIL_TO" => "info@gorexpert.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "MESSAGE",
		),
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
