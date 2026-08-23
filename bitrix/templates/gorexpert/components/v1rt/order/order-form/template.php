<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?><?
global $V1RT_ORDER_FORM_HEADER;

if(!strlen($V1RT_ORDER_FORM_HEADER))
{
	$V1RT_ORDER_FORM_HEADER = "Заказать оценку объекта";
}
?>

<div class="order-form" id="order-form">
<p class="h2"><?=$V1RT_ORDER_FORM_HEADER;?></p>
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="#order-form" method="POST">
<?=bitrix_sessid_post()?>
<div class="form-block-wrap">
<div class="form-block">
	<label>Ваше имя:</label>
	<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
</div>
<?foreach($arParams["NEW_EXT_FIELDS"] as $i => $ext_field):?>		
	<div class="form-block">
		<label><?=$ext_field?>:</label>
		<input type="text" name="custom[<?$i?>]" value="<?=$arResult["custom_$i"]?>">
	</div>
<?endforeach;?>
</div>
<div>
	<label>Что и где нужно оценить:</label>
	<textarea name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
</div>
	
	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<label><?=GetMessage("MFT_CAPTCHA")?></label>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<label><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></label>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
<p>Все поля обязательны для заполнения.</p>

	<p><input type="checkbox" class="agree-check"> Нажимая на эту кнопку, я даю свое <a href="/company/legal/soglasie-na-obrabotku-pd/">согласие на обработку персональных данных</a> и соглашаюсь с условиями <a href="/company/legal/politika-personalnyh-dannyh/">политики обработки персональных данных</a></p>

	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="agree-button">
</form>
</div>