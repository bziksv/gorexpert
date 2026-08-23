<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$arParams["COUNT_IMG_ROW"] = ($arParams["COUNT_IMG_ROW"] == "" ? 3 : $arParams["COUNT_IMG_ROW"]);?>
<?$i = 1;?>
<div class="photo-line">
    <?foreach($arResult["IMAGES"] as $img):?>
        <div>
            <a href="<?=$img["URL"]["FILE"]?>" rel="<?=$arResult["GAL_ID"]?>" class="photo-line-item<?if($i == $arParams["COUNT_IMG_ROW"]):?> last<?endif;?>" style="display:block;width:<?=$arResult["MIN_W"]?>px;height:<?=$arResult["MIN_H"]?>px;overflow:hidden;" title="<?=$img["DESCRIPTION"]?>">
                <img src="<?=$img["URL"]["IMAGE"]?>"<?=$img["SIZE"]?> alt="<?=$img["DESCRIPTION"]?>"/>
            </a>
        </div>
        <?if($i == $arParams["COUNT_IMG_ROW"]){ $i = 1; }else{ $i++; }?>
    <?endforeach;?>
</div>
<div style="clear: both;"></div>
<?if($arParams["PAGE_NAV_MODE"] == "Y"):?><?=$arResult["NAV_STRING"]?><?endif;?>