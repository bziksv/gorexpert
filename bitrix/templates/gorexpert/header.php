<!DOCTYPE html>
    <html>
        <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name='wmail-verification' content='8e22adb58ef78f6af6a5e81c66a975c6' />
		<meta name='wmail-verification' content='9414ce6748e78cbbe9f679aca6ab58f5' />
            <title><?$APPLICATION->ShowTitle()?></title>
            <link href="<?=SITE_TEMPLATE_PATH?>/css-js/reset.css" rel="stylesheet" type="text/css" />

            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery.min.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery.mousewheel-3.0.6.pack.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/jquery.fancybox.pack.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/helpers/jquery.fancybox-media.js"></script>
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/jquery.mmenu.js"></script>
			
            <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/css-js/script.js"></script>
            <link href="<?=SITE_TEMPLATE_PATH?>/css-js/fancybox-2.1.5/jquery.fancybox.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css-js/jquery.mmenu.css" >

			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/libs/bootstrap/bootstrap-grid-3.3.1.min.css" >
			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/libs/font-awesome-4.2.0/css/font-awesome.min.css" >
			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/libs/countdown/jquery.countdown.css" >

			
			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css-js/slick/slick.css" >






            <?$APPLICATION->ShowHead()?>
			
			<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/media.css" >

<link rel="icon" href="/favicon.ico" type="image/x-icon">

        </head>
    <body>
        <?$APPLICATION->ShowPanel();?>
		<header>
			<div class="wrapper"> 
				<div class="container">
					<div  class="header">
						<div class="col">
							<a href="/" class="logo"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Городская экспертиза - оценка имущества в СПб" /></a>
						</div>
						
						<div style="color: #81d481;" class="col mnogo-let cormorant">
							20 лет безупречной работы в СПб
						</div>
						
						<div class="col header__address">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/adress.svg" alt="Адрес">
							Торфяная дорога 7, лит А,<br>оф. 607, БЦ "Гулливер 1"
						</div>	
						<div class="col header__email">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/mail.svg" alt="E-mail">
							<a href="mailto:info@gorexpert.ru">info@gorexpert.ru</a>
						</div>	
							
						<div class="col header__tel">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/phone.svg" alt="Телефон">
							<div class="tel">
								<a href="tel:+78126009313">+7 (812) 600-93-13</a><br>
								<a href="tel:+78126422460">+7 (812) 642-24-60</a>
							</div>
						</div>	
							
						
					</div>
		
				</div>
			</div>			
                    <div class="topmenu">
						<button class="mmenu__button main_nav_button hidden-md hidden-lg"><i class="fa fa-bars" aria-hidden="true"></i> Меню</button>
                        <div class="container">
                            <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "top"
	),
	false
);?>
                        </div>
							</div>
		</header>
		<main>
		<?if($APPLICATION->GetCurPage() == "/"):?>
		<div class="index__slider-wrap">
				<div class="index__slider">
					<div>
						<img src="<?=SITE_TEMPLATE_PATH;?>/images/slide-1.jpg" alt="">
						<div class="index__slider-text">
							<p class="hdr">Оценка недвижимости</p>
							<p class="cena"><span class="from">от</span> 5&nbsp;000 ₽</p>
							<a href="/services/ocenka-nedvijemosti/">Подробнее</a>
						</div>
					</div>
					<div>
						<img src="<?=SITE_TEMPLATE_PATH;?>/images/slide-2.jpg" alt="">
						<div class="index__slider-text">
							<p class="hdr">Оценка земельных участков</p>
							<p class="cena"><span class="from">от</span> 6&nbsp;000 ₽</p>
							<a href="/services/ocenka-zemelnih-ychastkov/">Подробнее</a>
						</div>
					</div>
					<div>
						<img src="<?=SITE_TEMPLATE_PATH;?>/images/slide-3.jpg" alt="">
						<div class="index__slider-text">
							<p class="hdr">Оценка автомобилей и оборудования</p>
							<p class="cena"><span class="from">от</span> 5&nbsp;000 ₽</p>
							<a href="/services/ocenka-oborydovania-mashiniavtotransoprtnih-sredstv/">Подробнее</a>
						</div>
					</div>
					<div>
						<img src="<?=SITE_TEMPLATE_PATH;?>/images/slide-4.jpg" alt="">
						<div class="index__slider-text">
							<p class="hdr">Оценка бизнеса</p>
							<p class="cena"><span class="from">от</span> 20&nbsp;000 ₽</p>
							<a href="/services/ocenka-biznesa/">Подробнее</a>
						</div>
					</div>
					<div>
						<img src="<?=SITE_TEMPLATE_PATH;?>/images/slide-5.jpg" alt="">
						<div class="index__slider-text">
							<p class="hdr">Оценка нематериальных активов</p>
							<p class="cena"><span class="from">от</span> 20&nbsp;000 ₽</p>
							<a href="/services/ocenka-nemat-aktivov/">Подробнее</a>
						</div>
					</div>
					
				</div>
		</div>
		<?endif;?>
		<div class="container">
		
		
		
   		<div class="row">
         <div class="sidebar col-md-3">
                                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "submenu",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "left"
	),
	false
);?>
								<ul class="dop-left-menu">
									<li><a href="/otsenochnaya-kompaniya/">Что такое оценочная компания</a></li>
									<li><a href="/services/poradok-provedenia-ocenki/">Порядок проведения оценки</a></li>
									<li><a href="/services/informacia-ob-ocenke-kvartiri/">Информация об оценке квартиры</a></li>
							

									<li><a href="/services/priglashenie-k-partnerstvy/">Приглашение к партнерству</a></li>


								</ul>
                                <?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.banners.php"), array(), array("MODE" => "html"));?>
								<!--<table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-left">
								 <tbody><tr>
											   <td width="100%" bgcolor="#FFFFFF"><div align="justify">
												   <p align="center"><b><a href="http://www.finanalis.ru">Финансовый
													 анализ +<br>
													 Оценка бизнеса</a></b> <br>
													 - программа комплексного финансового и <a href="http://www.faprof.ru" target="_blank">экономического
													 анализа</a> организации</p>
												   </div></td>
								 </tr>
								</tbody></table>-->

								<table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-left">
								 <tbody><tr>
									<td class="icon-wrapper icon-wrapper--kadastr">
										<a href="https://p-kc.ru/" target="_blank"><img src="/upload/kadastr.jpg"></a>
									 </td>
									</tr>
								</tbody></table>

								<table width="100%" border="0" cellspacing="1" cellpadding="0" class="table-left table-otchet">
								 <tbody><tr>
									<td class="icon-wrapper">
										<p class="h2">Примеры отчетов по оценке имущества</p>
										<div><img src="/upload/pdf-icon.png"></div>
										<a href="/primery-otchetov/">Посмотреть</a>
									 </td>
									</tr>
								</tbody></table>

								<div class="sidebar-articles">
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
			 					</div>
                            </div> 
                            <div class="content col-md-9">
                                <?if($APPLICATION->GetCurPage() != "/"):?><h1><?$APPLICATION->ShowTitle(false)?></h1><?endif;?>

                                

<?if($APPLICATION->GetCurDir() != "/"):
                                    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bc", Array(
                                    	"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                                    	"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                    	"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                                    	),
                                    	false
                                    );
                                endif;?>