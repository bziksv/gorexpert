<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/include/legal_page.php");
gorexpert_render_legal_page(
	"legal-recommendation.html",
	"Правила применения рекомендательных технологий",
	"Правила применения рекомендательных технологий — Городская экспертиза"
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
