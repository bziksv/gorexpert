<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фотогалерея");
?><?$APPLICATION->IncludeComponent(
	"v1rt.mediagallery:mediagallery",
	"",
	Array(
		"COUNT_IMG_ROW" => "4",
		"FOLDERS" => "3",
		"SEF_MODE" => "Y",
		"TITLE" => "Y",
		"RESIZE_MODE" => "F",
		"RESIZE_MODE_W" => "150",
		"RESIZE_MODE_H" => "150",
		"PAGE_NAV_MODE" => "N",
		"ELEMENT_PAGE" => "5",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TITLE" => "Фотографии",
		"PAGER_TEMPLATE" => "modern",
		"LOAD_JS" => "2",
		"WATERMARK_MODE" => "N",
		"WATERMARK_POSITION" => "0",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SEF_FOLDER" => "/gallerys/",
		"SEF_URL_TEMPLATES" => Array(
			"list" => "/",
			"detail" => "#GALLERY_ID#/"
		),
		"VARIABLE_ALIASES" => Array(
			"list" => Array(),
			"detail" => Array(),
		)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>