<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
            <title><?$APPLICATION->ShowTitle()?></title>
            <link href="<?=SITE_TEMPLATE_PATH?>/css-js/reset.css" rel="stylesheet" type="text/css" />
            
            <script src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery-1.9.1.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery-1.10.1.min.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery.mousewheel-3.0.6.pack.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/jquery.fancybox.pack.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/helpers/jquery.fancybox-media.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/script.js"></script>
            <link href="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css" />
            
            <?$APPLICATION->ShowHead()?>
        </head>
    <body>
        <?$APPLICATION->ShowPanel();?>
		<table class="h-table">
            <tr>
                <td>
					<div  class="header">
					<a href="/" class="logo"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.jpg" /></a>
					<div class="header-ew">
						<p class="ltext2 ltext2-m"><span>11 лет</span> БЕЗУПРЕЧНОЙ РАБОТЫ</p>
					</div>
                    <div id="work_menu">
                        <?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.address.php"), array(), array("MODE" => "html"));?>
                        <div class="work_menu_link">
                            <?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.submenu.php"), array(), array("MODE" => "html"));?>
                        </div>
                    </div>
					</div>
                    <div style="clear:both;"></div>
                    <div class="header-image"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="topmenu">
                        <div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
                            	"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                            	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                            	"MAX_LEVEL" => "1",	// Уровень вложенности меню
                            	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                            	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                            	"DELAY" => "N",	// Откладывать выполнение шаблона меню
                            	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            	),
                            	false
                            );?>
                        </div>
                    </div>
                </td>
            </tr>
		</table>
		<table class="main-table">
            <tr>
                <td class="center-wrapper">
                    <table width="100%">
                        <tr>
                            <td class="sidebar">
                                <?$APPLICATION->IncludeComponent("bitrix:menu", "left", Array(
                                	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
                                	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
                                	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                	"MAX_LEVEL" => "1",	// Уровень вложенности меню
                                	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                                	"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                	"DELAY" => "N",	// Откладывать выполнение шаблона меню
                                	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                	),
                                	false
                                );?>
								<ul>
									<li><a href="/services/poradok-provedenia-ocenki/">Порядок проведения оценки</a></li>
									<li><a href="/services/informacia-ob-ocenke-kvartiri/">Информация об оценке квартиры</a></li>
									<li><a href="/services/ocenka-pri-bankrotsvte/">Оценка при банкротстве</a></li>
									<li><a href="/services/ocenka-dla-kreditovania/">Оценка для кредитования</a></li>
									<li><a href="/services/nashi-partneri-i-klienti/">Наши партнеры и клиенты</a></li>
									<li><a href="/services/priglashenie-k-partnerstvy/">Приглашение к партнерству</a></li>
									<li><a href="/services/nashi-documneti/">Наши документы</a></li>
									<li><a href="/services/ocenka-noyhay/">Оценка ноухау</a></li>
									<li><a href="/services/ocenka-gydvila/">Оценка гудвила</a></li>
									<li><a href="/services/ocenka-brenda/">Оценка бренда</a></li>
									<li><a href="/services/ocenka-predpriatii/">Оценка предприятий</a></li>
									<li><a href="/services/ocenka-zagorodnoi-nedvijemosti/">Оценка загородной недвижимости</a></li>
									<li><a href="/prices/">Прайс-лист</a></li>
								</ul>
                                <?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.banners.php"), array(), array("MODE" => "html"));?>
								<table width="255" border="0" cellspacing="1" cellpadding="0" class="table-left">
								 <tbody><tr>
											   <td width="100%" bgcolor="#FFFFFF"><div align="justify">
												   <p align="center"><b><a href="http://www.finanalis.ru">Финансовый
													 анализ +<br>
													 Оценка бизнеса</a></b> <br>
													 - программа компклексного финансового и <a href="http://www.faprof.ru" target="_blank">экономического
													 анализа</a> организации</p>
												   </div></td>
								 </tr>
								</tbody></table>
								<?$APPLICATION->IncludeComponent("bitrix:news.list", "firstsite.list", Array(
                                	"AJAX_MODE" => "N",	// Включить режим AJAX
                                	"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
                                	"IBLOCK_ID" => "2",	// Код информационного блока
                                	"NEWS_COUNT" => "2",	// Количество новостей на странице
                                	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                                	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                                	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                                	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                                	"FILTER_NAME" => "",	// Фильтр
                                	"FIELD_CODE" => "",	// Поля
                                	"PROPERTY_CODE" => "",	// Свойства
                                	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                                	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                                	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                                	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                                	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
                                	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
                                	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                                	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                                	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                                	"PARENT_SECTION" => "",	// ID раздела
                                	"PARENT_SECTION_CODE" => "",	// Код раздела
                                	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                                	"CACHE_TYPE" => "A",	// Тип кеширования
                                	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                                	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
                                	"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                                	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                                	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                                	"PAGER_TITLE" => "",	// Название категорий
                                	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                                	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                                	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                                	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                                	),
                                	false
                                );?>
                            </td> 
                            <td class="content">
                                <h1><?$APPLICATION->ShowTitle(false)?></h1>
                                <?if($APPLICATION->GetCurDir() != "/"):
                                    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bc", Array(
                                    	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                                    	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                    	"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                                    	),
                                    	false
                                    );
                                endif;?>