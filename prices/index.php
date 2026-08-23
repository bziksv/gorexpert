<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Узнать стоимость разных оценочных услуг в СПб вы можете на нашем сайте. Мы предоставляем наиболее выгодные условия по самым низким ценам. К тому же у нас действуют хорошие скидки.");
$APPLICATION->SetPageProperty("title", "Прайс-лист - Сколько стоит оценка");
$APPLICATION->SetTitle("Цены на независимую оценку имущества");
?><div class="page-prices">
	<p class="h2">
		Недвижимость
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-nedvizhimost.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Земельные участки
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-zemelnye-uchastki.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Восстановительный ремонт помещений (ущерб и др.)
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-vosstanovitelnyj-remont.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Автотранспортные средства
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-avtotransportnye-sredstva.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Железнодорожный транспорт
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-zheleznodorozhnyj-transport.php", array(), array("MODE"=>"html"));?> <?/*
<p class="h2">Морские и речные суда, отнесенные к недвижимости</p>
<?$APPLICATION->IncludeFile("/include_areas/inc.price-morskie-suda.php", array(), array("MODE"=>"html"));?>


<p class="h2">Самолеты, отнесенные к недвижимости</p>
<?$APPLICATION->IncludeFile("/include_areas/inc.price-samolety.php", array(), array("MODE"=>"html"));?>


<p class="h2">Вертолеты, отнесенные к недвижимости</p>
<?$APPLICATION->IncludeFile("/include_areas/inc.price-vertolety.php", array(), array("MODE"=>"html"));?>
*/?>
	<p class="h2">
		Серийное оборудование
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-serijnoe-oborudovanie.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Технологическая линия
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-tehnologicheskaya-liniya.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Бизнес (действующие предприятия или пакеты некотируемых акций предприятий)
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-biznes.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Интеллектуальная собственность
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-intellektualnaya-sobstvennost.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Готовая продукция
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-gotovaya-produkciya.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Месторождения, лицензии на разработку месторождений
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-mestorozhdeniya.php", array(), array("MODE"=>"html"));?>
	<p class="h2">
		Задолженности
	</p>
	 <?$APPLICATION->IncludeFile("/include_areas/inc.price-zadolzhennost.php", array(), array("MODE"=>"html"));?>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>