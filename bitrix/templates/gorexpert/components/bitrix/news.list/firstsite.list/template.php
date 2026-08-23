<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p class="ph1">Последние <?=$arResult["IBLOCK_NAME"]?></p>
<table class="info-list-sidebar">
<?foreach($arResult["ITEMS"] as $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<tr class="news-item">
        <td>
		<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" class="img-l" style="width: 60px;"/>
		<?endif?>
        </td>
		<td>
			<p class="article-date"><? echo substr($arItem["TIMESTAMP_X"], 0, 11)?></p>
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</td>
	</tr>
<?endforeach;?>
</table>
<p><a href="<?=str_replace("//", "/", str_replace("#SITE_DIR#", SITE_DIR, $arResult["LIST_PAGE_URL"]))?>">Все <?=$arResult["IBLOCK_NAME"]?></a></p>