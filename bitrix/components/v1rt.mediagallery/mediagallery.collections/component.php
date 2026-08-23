<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Настройки
 */
if(!CModule::IncludeModule("v1rt.mediagallery")) ShowError(GetMessage("NOT_INSTALL_MODULE"));
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arResult["MIN_H"] = $arParams["RESIZE_MODE_H"];
$arResult["MIN_W"] = $arParams["RESIZE_MODE_W"];

if($arParams["COUNT_IMAGE"] == 0)
    $arParams["COUNT_IMAGE"] = "";
if($arParams["VARIABLE"] != "" && is_numeric($_REQUEST[$arParams["VARIABLE"]]))
    $arParams["FOLDERS"][] = $_REQUEST[$arParams["VARIABLE"]];

$arParams["RANDOM"] = ($arParams["RANDOM"] == "Y" ? true : false);
$upload = COption::GetOptionString("main", "upload_dir", "upload");

$arResult["GAL_ID"] = md5(print_r($arParams["FOLDERS"], true));

/**
 * Загрузка JS
 */
if($arParams["LOAD_JS"] > 0)
{
    switch($arParams["LOAD_JS"])
    {
        case 1: \V1rt\Media\CJSLoad::js(\V1rt\Media\CJSLoad::LOAD_JS_FANCYBOX_1); break;
        case 2: \V1rt\Media\CJSLoad::js(\V1rt\Media\CJSLoad::LOAD_JS_FANCYBOX_2); break;
    }
}

/**
 * Работа компонента
 */
if(count($arParams["FOLDERS"]) > 0)
{
    //Установка заголовка
    if($arParams["TITLE"] == "Y")
    {
        $title = \V1rt\Media\CMediaGallery::getNameCollection($arParams["FOLDERS"][0]);
        if(strlen($title))
        {
            $APPLICATION->SetTitle($title);
            $arResult["NAME"] = $title;
        }
    }
    //Вытаскиваем ID картинок этой папки
    $res = \V1rt\Media\CMediaGallery::getImagesCollection($arParams["FOLDERS"], $arParams["COUNT_IMAGE"], $arParams["RANDOM"]);
    //Постраничная навигация
    if($arParams["PAGE_NAV_MODE"] == "Y")
    {
        //Постраничная навигация
        $arParams["PAGER_SHOW_ALWAYS"] = ($arParams["PAGER_SHOW_ALWAYS"] == "N" ? false : true);
        $arParams["PAGER_SHOW_ALL"] = ($arParams["PAGER_SHOW_ALL"] == "N" ? false : true);        
        
        $arNavParams = array(
  		    "nPageSize" => $arParams["ELEMENT_PAGE"],
      		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
      		"bShowAll" => $arParams["PAGER_SHOW_ALL"],
       	);
        
       	$arNavigation = $res->GetNavParams($arNavParams);
        $res->NavStart($arParams["ELEMENT_PAGE"]);
        $res->bShowAll = $arNavParams["bShowAll"];
        $arResult["NAV_STRING"] = $res->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
        $arResult["NAV_RESULT"] = $res;
    }
    //Кеширование и основная работа компонента
    if($this->StartResultCache(false, $arNavigation))
    {
        $iteration = 1;
        while($img = $res->Fetch())
        {
            $arResult["IMAGES"][$iteration] = CFile::GetByID($img["SOURCE_ID"])->Fetch();
            $arResult["IMAGES"][$iteration]["DESCRIPTION"] = $img["DESCRIPTION"];
            //URL картинки
            $arResult["IMAGES"][$iteration]["URL"]["FILE"] = "/".$upload."/".$arResult["IMAGES"][$iteration]["SUBDIR"]."/".$arResult["IMAGES"][$iteration]["FILE_NAME"];
            $arResult["IMAGES"][$iteration]["URL"]["IMAGE"] = $arResult["IMAGES"][$iteration]["URL"]["FILE"];
            //Режим уменьшения изображений
            if($arParams["RESIZE_MODE"] != "N")
            {
                if($arParams["RESIZE_MODE_W"] != "" && $arParams["RESIZE_MODE_H"] != "")
                {
                    if($arParams["RESIZE_MODE"] == "F")
                    {
                        $size = getimagesize($_SERVER["DOCUMENT_ROOT"]."/".$upload."/".$arResult["IMAGES"][$iteration]["SUBDIR"]."/".$arResult["IMAGES"][$iteration]["FILE_NAME"]);        
                        if($size[0]/$arParams["RESIZE_MODE_W"] >= $size[1]/$arParams["RESIZE_MODE_H"])
                            $arResult["IMAGES"][$iteration]["SIZE"] = ' height="'.$arParams["RESIZE_MODE_H"].'"';
                        else
                            $arResult["IMAGES"][$iteration]["SIZE"] = ' width="'.$arParams["RESIZE_MODE_W"].'"';
                    }
                    elseif($arParams["RESIZE_MODE"] == "P")
                    {
                        $file = CFile::ResizeImageGet($arResult["IMAGES"][$iteration], array('width' => $arParams["RESIZE_MODE_W"], 'height' => $arParams["RESIZE_MODE_H"]), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                        if($arResult["MIN_H"] > $file["height"])
                            $arResult["MIN_H"] = $file["height"];
                        if($arResult["MIN_W"] > $file["width"])
                            $arResult["MIN_W"] = $file["width"];
                        $arResult["IMAGES"][$iteration]["URL"]["IMAGE"] = $file["src"];
                    }
                }
            }
            //Ватермарк
            if($arParams["WATERMARK_MODE"] == "Y")
            {
                set_time_limit(0);
                $path = $_SERVER["DOCUMENT_ROOT"]."/".$upload."/".$arResult["IMAGES"][$iteration]["SUBDIR"]."/".$arResult["IMAGES"][$iteration]["FILE_NAME"];
                $type = end(explode("/", $arResult["IMAGES"][$iteration]["CONTENT_TYPE"]));
                
                if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/".$arResult["IMAGES"][$iteration]["FILE_NAME"]))
                {
                    if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/images/v1rt.mediagallery/watermark.png"))
                    {
                        $watermark = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"]."/bitrix/images/v1rt.mediagallery/watermark.png");
                        $wm = new \V1rt\Media\CWatermark();
                            
                        if($type == "jpeg") $image = imagecreatefromjpeg($path);
                        elseif($type == "png") $image = imagecreatefrompng($path);
                        elseif($type == "gif") $image = imagecreatefromgif($path);
                        
                        $image = $wm->create_watermark($image, $watermark, 100, $arParams["WATERMARK_POSITION"]);
                        
                        if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/")) @mkdir($_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/");
                        if(!file_exists($_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/")) @mkdir($_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/");
                        
                        if($type == "jpeg") imagejpeg($image, $_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/".$arResult["IMAGES"][$iteration]["FILE_NAME"]);
                        elseif($type == "png") imagepng($image, $_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/".$arResult["IMAGES"][$iteration]["FILE_NAME"]);
                        elseif($type == "gif") imagegif($image, $_SERVER["DOCUMENT_ROOT"]."/".$upload."/v1rt.mediagallery/".md5($path)."/".$arResult["IMAGES"][$iteration]["FILE_NAME"]);
                                
                        imagedestroy($image);
                        imagedestroy($watermark);
                    }
                }
                
                $arResult["IMAGES"][$iteration]["URL"]["FILE"] = "/".$upload."/v1rt.mediagallery/".md5($path)."/".$arResult["IMAGES"][$iteration]["FILE_NAME"];
                $arResult["IMAGES"][$iteration]["URL"]["IMAGE"] = $arResult["IMAGES"][$iteration]["URL"]["FILE"];
            }
            $iteration++;
        }
        $this->IncludeComponentTemplate();
    }
}
?>