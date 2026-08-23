<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;
if(CModule::IncludeModule("v1rt.mediagallery"))
{
    $collections = \V1rt\Media\CMediaGallery::bc($arResult["VARIABLES"]["GALLERY_ID"]);
    if(count($collections))
    {
        foreach($collections as $collection)
        {
            if($collection["ID"] && $collection["ID"] != $arParams["FOLDERS"])
            {
                $path = str_replace("#GALLERY_ID#", $collection["ID"], $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"]);
                $APPLICATION->AddChainItem($collection["NAME"], $path);
            }
        }
    }
}

$APPLICATION->IncludeComponent(
	"v1rt.mediagallery:mediagallery.collections.list",
	"",
	Array(
		"GALLERY_ID"  => $arResult["VARIABLES"]["GALLERY_ID"],
		"DETAIL_URL"  => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"CACHE_TYPE"  => $arParams["CACHE_TYPE"],
		"CACHE_TIME"  => $arParams["CACHE_TIME"],
	),
    $component
);

$APPLICATION->IncludeComponent(
    "v1rt.mediagallery:mediagallery.collections", 
    "", 
    array(
        "FOLDERS"           => array($arResult["VARIABLES"]["GALLERY_ID"]),
       	"VARIABLE"          => "",
       	"COUNT_IMAGE"       => "",
       	"RANDOM"            => "N",
        "COUNT_IMG_ROW"     => $arParams["COUNT_IMG_ROW"],
       	"TITLE"             => $arParams["TITLE"],
       	"CACHE_TYPE"        => $arParams["CACHE_TYPE"],
		"CACHE_TIME"        => $arParams["CACHE_TIME"],
       	"PAGE_NAV_MODE"     => $arParams["PAGE_NAV_MODE"],
       	"ELEMENT_PAGE"      => $arParams["ELEMENT_PAGE"],
       	"PAGER_SHOW_ALL"    => $arParams["PAGER_SHOW_ALL"],
       	"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
       	"PAGER_TITLE"       => $arParams["PAGER_TITLE"],
       	"PAGER_TEMPLATE"    => $arParams["PAGER_TEMPLATE"],
       	"RESIZE_MODE"       => $arParams["RESIZE_MODE"],
       	"RESIZE_MODE_W"     => $arParams["RESIZE_MODE_W"],
       	"RESIZE_MODE_H"     => $arParams["RESIZE_MODE_H"],
       	"PAGE_LINK"         => "",
       	"PAGE_LINK_TEXT"    => "",
       	"LOAD_JS"           => $arParams["LOAD_JS"]
   	),
   	$component
);
?>