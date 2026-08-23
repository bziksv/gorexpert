<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if(count($arResult["GALLERYS"]) > 0):?>
<ul>
    <?if(isset($arResult["GALLERYS"][0])):?>
        <?foreach($arResult["GALLERYS"][0] as $gallery):?>
            <li><a href="<?=$gallery["DETAIL_PAGE_URL"]?>"><?=$gallery["NAME"];?></a></li>
        <?endforeach;?>
    <?else:?>
        <?foreach($arResult["GALLERYS"] as $gallery):?>
            <?foreach($gallery as $gal):?>
                <li><a href="<?=$gal["DETAIL_PAGE_URL"]?>"><?=$gal["NAME"];?></a></li>
            <?endforeach;?>
        <?endforeach;?>
    <?endif;?>
</ul>
<?endif;?>