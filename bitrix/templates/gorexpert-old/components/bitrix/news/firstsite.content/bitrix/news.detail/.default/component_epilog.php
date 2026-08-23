<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$APPLICATION->AddChainItem($arResult["NAME"]);

if($arResult["GAL_ID"] && is_numeric($arResult["GAL_ID"]))
{
    $APPLICATION->IncludeComponent(
        "v1rt.mediagallery:mediagallery.collections", 
        "", 
        array(
            "FOLDERS" => array($arResult["GAL_ID"]),
           	"VARIABLE" => "",
    		"COUNT_IMAGE" => "",
    		"RANDOM" => "N",
    		"PAGE_LINK" => "",
    		"PAGE_LINK_TEXT" => "",
    		"TITLE" => "N",
    		"LOAD_JS" => "2",
    		"RESIZE_MODE" => "F",
    		"RESIZE_MODE_W" => "150",
    		"RESIZE_MODE_H" => "150",
    		"PAGE_NAV_MODE" => "N",
    		"ELEMENT_PAGE" => "12",
    		"PAGER_SHOW_ALL" => "Y",
    		"PAGER_SHOW_ALWAYS" => "N",
    		"PAGER_TITLE" => "",
    		"PAGER_TEMPLATE" => "modern",
    		"WATERMARK_MODE" => "Y",
    		"WATERMARK_POSITION" => "0",
    		"CACHE_TYPE" => "A",
    		"CACHE_TIME" => "3600"
       	),
       	$component
    );
}

if(count($arResult["LINKED"]["ELEMENTS"]))
{
    echo '<p><strong>Другие '.$arResult["LINKED"]["NAME"].':</strong></p><ul>';
    foreach($arResult["LINKED"]["ELEMENTS"] as $element)
        echo '<li><a href="'.$element["DETAIL_PAGE_URL"].'">'.$element["NAME"].'</a></li>';
    echo '</ul>';
}
?>