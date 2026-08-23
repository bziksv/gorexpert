<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<a name="call"></a>
<p class="ph1">Заказать обратный звонок</p>
<div class="mfeedback" style="margin-bottom: 10px;">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if($arResult["OK_MESSAGE"] == true)
{
	?><div class="mf-ok-text"><?=GetMessage("V1RT_OK_MESSAGE")?></div><?
}
?>

<form action="<?=$APPLICATION->GetCurPage()?>#call" method="POST">
<?=bitrix_sessid_post()?>
<table class="feedback">
    <tr>
        <td>
            <?=GetMessage("V1RT_NAME")?> <span>*</span><br />
            <input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?=GetMessage("V1RT_PHONE")?> <span>*</span><br />
            <input type="text" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>"/>
        </td>
    </tr>
    <?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <tr>
            <td>
                <?=GetMessage("MFT_CAPTCHA")?><br />
                <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>"/>
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"/>
            </td>
        </tr>
        <tr>
            <td>
                <?=GetMessage("MFT_CAPTCHA_CODE")?> <span>*</span><br />
                <input type="text" name="captcha_word" size="30" maxlength="50" value=""/>
            </td>
        </tr>
    <?endif;?>
    <tr>
        <td>
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>"/>
            <input type="submit" style="margin-left: 0px;" name="submit" value="<?=GetMessage("V1RT_SUBMIT")?>"/>
        </td>
    </tr>
</table>
</form>
</div>