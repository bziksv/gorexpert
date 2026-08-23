<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["DISPLAY_PROPERTIES"]["GAL_ID"]["VALUE"] > 0)
    $arResult["GAL_ID"] = $arResult["DISPLAY_PROPERTIES"]["GAL_ID"]["VALUE"];
unset($arResult["DISPLAY_PROPERTIES"]["GAL_ID"]);

if(is_numeric($arResult["ID"]) && $arResult["ID"] && CModule::IncludeModule("iblock"))
{
    $res = CIBlock::GetByID($arResult["IBLOCK_ID"]);
    if($ar_res = $res->GetNext())
        $arResult["LINKED"]["NAME"] = ToLower($ar_res["NAME"]);
    unset($res);
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL","PREVIEW_PICTURE");
    $arFilter = array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ACTIVE" => "Y", "<ID" => $arResult["ID"]);
    $res = CIBlockElement::GetList(array("id" => "desc"), $arFilter, false, array("nPageSize" => 4), $arSelect);
    while($ob = $res->GetNextElement())
        $arResult["LINKED"]["ELEMENTS"][] = $ob->GetFields();
}

foreach($arResult["LINKED"]["ELEMENTS"] as &$element)
{
	$arFile = CFile::GetFileArray($element["PREVIEW_PICTURE"]);
	
    if($arFile)
      $element["PREVIEW_PICTURE"] = $arFile["SRC"];
}

$component = $this->__component;
$component->$arResult = $arResult;
$component->SetResultCacheKeys(array("LINKED", "GAL_ID")); 
?>