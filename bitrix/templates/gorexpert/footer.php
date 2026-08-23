</div>
          </div>

</div>
    </main>
<footer>
    <div class="footer">
        <div>

<!-- === DISCLAIMER FOOTER === -->
<div style="max-width:800px;margin:15px auto;padding:10px; line-height:1.5;text-align:center;border-top:1px solid rgba(255,255,255,0.1);">
    Наш сайт использует <a href="/company/legal/politika-cookie/" style="color:#888;text-decoration:underline;">cookies</a> для обеспечения работоспособности и сбора статистики. С их помощью мы анализируем пользовательскую активность, улучшаем работу сайта и делаем рекламу более релевантной. Оставаясь на сайте, вы даете <a href="/company/legal/soglasie-na-obrabotku-pd/" style="color:#888;text-decoration:underline;">согласие на обработку ваших персональных данных</a> в соответствии с <a href="/company/legal/politika-personalnyh-dannyh/" style="color:#888;text-decoration:underline;">Политикой обработки персональных данных</a>. Вы можете отключить сохранение cookies в настройках браузера в любой момент. На сайте также применяются <a href="/company/legal/pravila-rekomendatelnyh-tehnologiy/" style="color:#888;text-decoration:underline;">рекомендательные технологии</a>.
<hr class="seo-divider--thin">
</div>
<!-- === /DISCLAIMER === -->

            <div class="work_menu_foot"><?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.submenu.php"), array(), array("MODE"=>"html"));?></div>
            <p style="padding-bottom:10px;"><?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.copyright.php"), array(), array("MODE"=>"html"));?></p>
			

			
            <a href="https://v1rt.ru/sait-vizitka/" class="link-open">Разработка сайтов на Битриксе</a> - "Виртуальная недвижимость"
	        <div class="counters">
                <?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/inc.counters.php"), array(), array("MODE"=>"html"));?>

	        </div>
        </div>
    </div>
</footer>
<div id="mmenu">
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
			"MAX_LEVEL" => "2",
			"CHILD_MENU_TYPE" => "dopmenu",
			"USE_EXT" => "N",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N",
			"COMPONENT_TEMPLATE" => "top"
		),
		false
	);?>
</div>
<!--[if lt IE 9]>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/es5-shim.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/html5shiv.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/respond/respond.min.js"></script>
	<![endif]-->
	

	<script src="<?=SITE_TEMPLATE_PATH?>/libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/countdown/jquery.plugin.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/countdown/jquery.countdown.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/countdown/jquery.countdown-ru.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/libs/landing-nav/navigation.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/css-js/slick/slick.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/css-js/common.js"></script>



<!-- Yandex.Metrika counter от Prime -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(74741200, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });



</script>
<noscript><div><img src="https://mc.yandex.ru/watch/74741200" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>