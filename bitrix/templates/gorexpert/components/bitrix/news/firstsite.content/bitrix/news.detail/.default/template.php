<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-detail">
<p class="article-date"><? echo substr($arResult["TIMESTAMP_X"], 0, 11)?></p>
	<?if(is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="img-r img-open" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?echo $arResult["DETAIL_TEXT"];?>
	<div style="clear:both"></div>
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
<div style="clear:both"></div>
<?
/*
if(is_numeric($arResult["ID"]) && $arResult["ID"] && CModule::IncludeModule("iblock"))
{
    $i = 0;
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ACTIVE" => "Y", "<ID" => $arResult["ID"]);
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 4), $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        if($i == 0)
        {
            $res_ = CIBlock::GetByID($arResult["IBLOCK_ID"]);
            if($ar_res = $res_->GetNext())
                echo '<p><strong>Другие '.ToLower($ar_res["NAME"]).':</strong></p><ul>';
        }
        echo '<li><a href="'.$arFields["DETAIL_PAGE_URL"].'">'.$arFields["NAME"].'</a></li>';
        $i++;
    }
    if($i > 0)
        echo '</ul>';
}
*/
?>