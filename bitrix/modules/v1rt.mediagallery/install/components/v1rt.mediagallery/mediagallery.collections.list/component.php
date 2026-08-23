<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("v1rt.mediagallery")) return;

$match = array();
preg_match("/#(.*)#/", $arParams["DETAIL_URL"], $match);

if($arParams["EXCEPTIONS"][0] == 0)
{
    unset($arParams["EXCEPTIONS"]);
    $arParams["EXCEPTIONS"] = array();
}
if(isset($_REQUEST[$arParams["MEDIA_VARIABLE"]])) 
    $_REQUEST[$arParams["MEDIA_VARIABLE"]] = current(explode("?", $_REQUEST[$arParams["MEDIA_VARIABLE"]]));

if($this->StartResultCache(false, array($arParams["EXCEPTIONS"], $arParams["DETAIL_URL"], $match, $arParams["GALLERY_ID"], $_REQUEST[$arParams["MEDIA_VARIABLE"]])))
{
    if((isset($_REQUEST[$arParams["MEDIA_VARIABLE"]]) && is_numeric($_REQUEST[$arParams["MEDIA_VARIABLE"]]) && $_REQUEST[$arParams["MEDIA_VARIABLE"]] > 0) || (is_numeric($arParams["GALLERY_ID"]) && $arParams["GALLERY_ID"] > 0))
    {
        $id = ($_REQUEST[$arParams["MEDIA_VARIABLE"]] != "") ? $_REQUEST[$arParams["MEDIA_VARIABLE"]] : $arParams["GALLERY_ID"];
        $gals = \V1rt\Media\CMediaGallery::listCollections($id);
    }
    else
    {
        $gals = \V1rt\Media\CMediaGallery::listCollections();
    }
    
    if(count($gals) > 0)
    {
        foreach($gals as $gal)
        {
            if(array_search($gal["ID"], $arParams["EXCEPTIONS"]) === false)
            {
                $count = \V1rt\Media\CMediaGallery::countImages($gal["ID"]);
                $gallerys[$gal["PARENT_ID"]][] = array(
                    "DETAIL_PAGE_URL"   => str_replace("#$match[1]#", $gal["ID"], $arParams["DETAIL_URL"]),
                    "ID"                => $gal["ID"],
                    "NAME"              => $gal["NAME"],
                    "DESCRIPTION"       => $gal["DESCRIPTION"],
                    "PARENT_ID"         => $gal["PARENT_ID"],
                    "COUNT"             => $count
                );
            }
        }
    }
    
    $arResult["GALLERYS"] = $gallerys;
    $arResult["PARENT"] = ($_REQUEST[$arParams["MEDIA_VARIABLE"]] != "") ? $_REQUEST[$arParams["MEDIA_VARIABLE"]] : $arParams["GALLERY_ID"];
    $this->IncludeComponentTemplate();
}
?>