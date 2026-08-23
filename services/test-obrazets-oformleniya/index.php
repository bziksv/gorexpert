<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><p>
	 Толстая линия
</p>
<hr class="seo-divider">
<p>
	 Тонкая линия
</p>
<hr class="seo-divider--thin">
 <!-- Заголовки h2 и h3 -->
<h2 class="seo-h2">Нормальный заголовок h2 взамен того, что был в шаблоне</h2>
<p>
	 Просто текст к заголовку, чтобы посмотреть на него рядом с текстом.
</p>
<h3 class="seo-h3">Нормальный заголовок h3 взамен того, что был в шаблоне</h3>
<p>
	 Просто текст к заголовку, чтобы посмотреть на него рядом с текстом.
</p>
 <br>
 <!-- Список!-->
<ul class="seo-list">
	<li>
	Пункт списка </li>
	<li>
	Пункт списка </li>
	<li class="seo-list--highlight">
	ВЫДЕЛЕННЫЙ пункт списка </li>
</ul>
 <!-- Карточки -->
<div class="seo-cards">
	<div class="seo-card">
		<h3 class="seo-card-title">Заголовок карточки 1</h3>
		<p class="seo-card-text">
			 Текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки
		</p>
	</div>
	<div class="seo-card">
		<h3 class="seo-card-title">Заголовок карточки 2</h3>
		<p class="seo-card-text">
			 Текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки
		</p>
	</div>
	<div class="seo-card">
		<h3 class="seo-card-title">Заголовок карточки 3</h3>
		<p class="seo-card-text">
			 Текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки
		</p>
	</div>
	<div class="seo-card">
		<h3 class="seo-card-title">Заголовок карточки 4</h3>
		<p class="seo-card-text">
			 Текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки текст карточки
		</p>
	</div>
</div>
 <br>
 <!-- ТАБЛИЦА  -->
<div class="seo-table-minimal-container">
	<table class="seo-table-minimal">
	<thead>
	<tr>
		<th>
			 Заголовок 1
		</th>
		<th>
			 Заголовок 2
		</th>
		<th>
			 Заголовок 3
		</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>
			 Строка 1
		</td>
		<td>
			 11
		</td>
		<td>
			 21
		</td>
	</tr>
	<tr>
		<td>
			 Строка 2
		</td>
		<td>
			 12
		</td>
		<td>
			 22
		</td>
	</tr>
	<tr>
		<td>
			 Строка 3
		</td>
		<td>
			 13
		</td>
		<td>
			 23.
		</td>
	</tr>
	<tr>
		<td class="seo-table--accent">
			 Строка 4 -- другого цвета
		</td>
		<td>
			 14
		</td>
		<td>
			 24
		</td>
	</tr>
	</tbody>
	</table>
</div>
 <br>
 <br>
<div class="seo-faq">
	<h2 class="seo-faq-title">Вопросы и ответы</h2>
	<div class="seo-faq-item">
 <input type="checkbox" id="faq-1" class="seo-faq-toggle"> <label for="faq-1" class="seo-faq-question">
		Вопрос 1? <span class="seo-faq-arrow"></span> </label>
		<div class="seo-faq-answer">
			<div class="seo-faq-answer-content">
				 Ответ на вопрос; внутрю этого дива можно вставлять абзацы и списки; ограничение до 500px
			</div>
		</div>
	</div>
	<div class="seo-faq-item">
 <input type="checkbox" id="faq-2" class="seo-faq-toggle"> <label for="faq-2" class="seo-faq-question">
		Вопрос 2? <span class="seo-faq-arrow"></span> </label>
		<div class="seo-faq-answer">
			<div class="seo-faq-answer-content">
				<p>
					 Ответ на вопрос; внутрю этого дива можно вставлять абзацы и списки; ограничение до 500px
				</p>
			</div>
		</div>
	</div>
	<div class="seo-faq-item">
 <input type="checkbox" id="faq-3" class="seo-faq-toggle"> <label for="faq-3" class="seo-faq-question">
		Вопрос 3? <span class="seo-faq-arrow"></span> </label>
		<div class="seo-faq-answer">
			<div class="seo-faq-answer-content">
				<p>
					 Ответ на вопрос; внутрю этого дива можно вставлять абзацы и списки; ограничение до 500px
				</p>
			</div>
		</div>
	</div>
</div>
 <br>
 <br>
 <!-- --> <!-- Блок текста с серым фоном -->
<div class="seo-highlight-box">
	<p>
		 Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями.
	</p>
	<p>
		 Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями. Это текст, который будет выделен серой подложкой со скругленными краями.
	</p>
</div>
 <br>
 <!-- Блок текста с ярким фоном -->
<div class="seo-highlight-box seo-highlight-box--important">
	<p>
 <strong>Более важный текст!</strong> Этот текст будет выделен чуть более ярко. Более ярко. БОЛЕЕ ЯРКО!
	</p>
</div>
 <br>
 <br>
 <!-- Примеры отчетов -- можно брать только часть списка -->
<div class="seo-pdf-list">
 <a href="/upload/otchet-ob-ocenke-kvartiy-dlya-banka.pdf" target="_blank" class="seo-pdf-card">
	<div class="seo-pdf-icon">
	</div>
	<div class="seo-pdf-title">
		 Пример отчета по оценке квартиры для банка
	</div>
 </a> <a href="/upload/otchet-ob-ocenke-zagorodnoy-nedvizhimosti.pdf" target="_blank" class="seo-pdf-card">
	<div class="seo-pdf-icon">
	</div>
	<div class="seo-pdf-title">
		 Пример отчета по оценке загородной недвижимости
	</div>
 </a> <a href="/upload/otchet-ob-ocenke-zdaniya.pdf" target="_blank" class="seo-pdf-card">
	<div class="seo-pdf-icon">
	</div>
	<div class="seo-pdf-title">
		 Пример отчета по оценке здания
	</div>
 </a> <a href="/upload/otchet-ob-ocenke-avto.pdf" target="_blank" class="seo-pdf-card">
	<div class="seo-pdf-icon">
	</div>
	<div class="seo-pdf-title">
		 Пример отчета по оценке авто
	</div>
 </a> <a href="/upload/otchet-ob-ocenke-zemelnogo-uchastka-dlya-banka.pdf" target="_blank" class="seo-pdf-card">
	<div class="seo-pdf-icon">
	</div>
	<div class="seo-pdf-title">
		 Пример отчета об оценке земельного участка для банка
	</div>
 </a>
</div>
 <br>

<div class="seo-report">
 <input type="checkbox" id="report-1" class="seo-report-toggle"> <label for="report-1" class="seo-report-header"> <strong>📄
 Пример отчета
</strong> <span class="seo-report-arrow"></span> </label>
	<div class="seo-report-content">
		<div class="seo-report-inner">
		
			<h3>
			h3 будет иметь уникальный вид
			</h3>
			
			<p>
				параграф уникальный
			</p>
			
			<h4>
			h4 будет иметь уникальный вид
			</h4>
			
			<p>
				Таблица тоже будет выглядеть уникально, если ее добавить
			</p>
			
			<div class="seo-report-signature">
				 В такой див можно добавить текст "а-ля подпись к отчету"
			</div>
			
		</div>
	</div>
</div>
<br>

 <br>
 <br>
<p>
	 Далее -- стандартные классы шаблона +плитка, которую мы когда-то давно сделали
</p>
 <br>
 <!-- Блок Интересное -- самое яркое выделение текста -->
<div class="interesting">
 <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
	<div class="interesting__text">
		 Блок Интересное для выделения текста
	</div>
</div>
 <!--  --> <?$APPLICATION->IncludeFile("/include_areas/inc.price-nedvizhimost.php", array(), array("MODE"=>"html"));?>
<p>
 <a href="/prices/">Все остальные прайсы -- можно взять здесь</a>
</p>
 <!-- Плитка тегов со ссылками на разделы, состоит из двух дивов -- один с самой плиткой, второй -- с функцией свернуть-развернуть -->
<div class="podrazdel tag_menu_all">
 <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a> <a href="ОТНОСИТЕЛЬНАЯ ССЫЛКА" class="podrazdel__link">
	Текст плитки </a>
</div>
<div class="navi">
 <span class="open is-act">Показать все</span><span class="closem">Свернуть</span>
</div>
 <br>
 <!-- Форма Оставить заявку, в заголовок можно вписать свой текст --> <?$V1RT_ORDER_FORM_HEADER = "Заказать оценку с выездом эксперта";?> <?$APPLICATION->IncludeFile("/include_areas/inc.order-form.php", array(), array("MODE"=>"html"));?>
<ul>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>