<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_numeric($arResult["ID"]) && $arResult["ID"] && CModule::IncludeModule("iblock"))
    $arResult["IBLOCK_NAME"] = ToLower($arResult["NAME"]);
$component = $this->__component;
$component->$arResult = $arResult;
?>