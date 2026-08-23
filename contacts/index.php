<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Оценочная компания Городская Экспертиза. Экспертиза и подготовка отчета по оценке стоимости имущества.");
$APPLICATION->SetPageProperty("title", "Контакты компании Городская Экспертиза");
$APPLICATION->SetTitle("Контакты");
?><div class="vcard">
	<h2><span class="fn org">ООО "Городская экспертиза"</span></h2>
	<div class="adr">
 <strong>Адрес:</strong> <span class="locality">г. Санкт-Петербург</span>,&nbsp;Торфяная дорога 7, лит. А, оф. 607, БЦ "Гулливер 1".
	</div>
 <strong>Телефон:</strong> <span class="tel"><a href="tel:+78126009313">+7 (812) 600-93-13</a></span> (многоканальный), <span class="tel"><a href="tel:+78126422460">+7 (812) 642-24-60</a></span>. <br>
 <strong>E-mail:</strong> <a href="mailto:info@gorexpert.ru">info@gorexpert.ru</a>
</div>
<h2>Схема проезда</h2>
<div style="margin-bottom: 20px; height: 450px;">
	<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3c49b41b3792408b9112def0fd6ef50f9bdc576cdc66afacf70d3a921048b690&amp;source=constructor" width="100%" height="450" frameborder="0" style="display:block;"></iframe>
</div>
 <a name="feedback"></a>
<h2>Форма обратной связи</h2>
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"feedback",
	Array(
		"EMAIL_TO" => "info@gorexpert.ru",
		"EVENT_MESSAGE_ID" => array(0=>"7",),
		"OK_TEXT" => "Спасибо, Ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"EMAIL",2=>"MESSAGE",),
		"USE_CAPTCHA" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>