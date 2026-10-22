<?/*if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
}?>


<?if(count($arResult["LINKED"]["ELEMENTS"]))
{
    echo '<p><strong>Другие '.$arResult["LINKED"]["NAME"].':</strong></p><ul>';
    foreach($arResult["LINKED"]["ELEMENTS"] as $element)
        echo '<li><a href="'.$element["DETAIL_PAGE_URL"].'">'.$element["NAME"].'</a></li>';
    echo '</ul>';
}
*/?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arResult["LINKED"]["ELEMENTS"]) && is_array($arResult["LINKED"]["ELEMENTS"]))
{
?>
	<p style="margin-top:20px;"><strong>Другие статьи:</strong></p>

	<div class="row row-flex article_more">
		<?foreach($arResult["LINKED"]["ELEMENTS"] as $element):?>
			<div class="col-12 col-xs-3 col-sm-3 col-lg-3 col-xl-3">
				<div class="article_more__block">
					<a href="<?=$element["DETAIL_PAGE_URL"];?>" class="article_more__img-link">
						<img src="<?=$element["PREVIEW_PICTURE"];?>" alt="<?=$element["NAME"];?>" title="<?=$element["NAME"];?>">
					</a>
					<div class="article_more__preview">
						<a href="<?=$element["DETAIL_PAGE_URL"];?>" class="article_more__name-link"><?=$element["NAME"];?></a>
					</div>
				</div>
			</div>
		<?endforeach;?>
    
    </div>

<?
}
?>
