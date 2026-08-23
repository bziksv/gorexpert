<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?><?$APPLICATION->IncludeComponent(
	"v1rt:sitemap",
	"",
	Array(
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => ""
	)
);?>

<ul>
	<li><a href="/services/poradok-provedenia-ocenki/">Порядок проведения оценки</a></li>
	<li><a href="/services/informacia-ob-ocenke-kvartiri/">Информация об оценке квартиры</a></li>
	<li><a href="/services/ocenka-pri-bankrotsvte/">Оценка при банкротстве</a></li>
	<li><a href="/services/ocenka-dla-kreditovania/">Оценка для кредитования</a></li>
	<li><a href="/partnery-i-klienty/">Наши партнеры и клиенты</a></li>
	<li><a href="/services/priglashenie-k-partnerstvy/">Приглашение к партнерству</a></li>
	<li><a href="/dokumenty/">Наши документы</a></li>
	<li><a href="/services/ocenka-noyhay/">Оценка ноухау</a></li>
	<li><a href="/services/ocenka-gydvila/">Оценка гудвила</a></li>
	<li><a href="/articles/otsenka-brenda/">Оценка бренда</a></li>
	<li><a href="/services/ocenka-predpriatii/">Оценка предприятий</a></li>
	<li><a href="/services/ocenka-zagorodnoi-nedvijemosti/">Оценка загородной недвижимости</a></li>
	<li><a href="/prices/">Прайс-лист</a></li>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>