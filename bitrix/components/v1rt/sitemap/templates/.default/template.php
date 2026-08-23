<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<ul class="sitemap" style="margin-top: -5px;">
    <?foreach($arResult["SITEMAP"] as $item):?>
        <li><a href="<?=$item["PATH"]?>"><?=$item["NAME"]?></a>
            <?if($item["IBLOCK"]["ID"] != ""):?>
                <ul>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list", 
                        "sitemap", 
                        Array(
                   	        "AJAX_MODE" => "N",
                           	"IBLOCK_TYPE" => $item["IBLOCK"]["TYPE"],
                           	"IBLOCK_ID" => $item["IBLOCK"]["ID"],
                           	"NEWS_COUNT" => 10000,
                           	"SORT_BY1" => "ACTIVE_FROM",
                           	"SORT_ORDER1" => "DESC",
                           	"SORT_BY2" => "SORT",
                           	"SORT_ORDER2" => "ASC",
                           	"CHECK_DATES" => "Y",
                           	"ACTIVE_DATE_FORMAT" => "d.m.Y",
                           	"SET_TITLE" => "N",
                           	"SET_STATUS_404" => "N",
                           	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                           	"ADD_SECTIONS_CHAIN" => "N",
                           	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                           	"INCLUDE_SUBSECTIONS" => "Y",
                           	"CACHE_TYPE" => "A",
                           	"CACHE_TIME" => "36000000",
                           	"CACHE_FILTER" => "N",
                           	"CACHE_GROUPS" => "Y",
                           	"PAGER_TEMPLATE" => ".default",
                           	"DISPLAY_TOP_PAGER" => "N",
                           	"DISPLAY_BOTTOM_PAGER" => "N",
                           	"PAGER_SHOW_ALWAYS" => "N",
                           	"PAGER_DESC_NUMBERING" => "N",
                           	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                           	"PAGER_SHOW_ALL" => "N",
                           	"AJAX_OPTION_JUMP" => "N",
                           	"AJAX_OPTION_STYLE" => "Y",
                           	"AJAX_OPTION_HISTORY" => "N",
                   	    ),
                       	$component
                    );?>
                </ul>
            <?endif;?>
        </li>
        <?if(count($item["CHILDS"])):?>
            <?foreach($item["CHILDS"] as $child):?>
                <li><a href="<?=$child["PATH"]?>"><?=$child["NAME"]?></a></li>
            <?endforeach;?>
        <?endif;?>
    <?endforeach;?>
</ul>