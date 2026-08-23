<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<div class="mfeedback" style="margin-bottom: 15px;">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=GetMessage("V1RT_MF_OK_MESSAGE")?></div><?
}
?>

<form action="<?=$APPLICATION->GetCurPage()?>#feedback" method="POST">
<?=bitrix_sessid_post()?>
<table class="feedback">
    <tr>
        <td>
            <?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?> <span>*</span><?endif?><br />
            <input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?> <span>*</span><?endif?><br />
            <input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>"/>
        </td>
    </tr>
    <tr>
        <td>
            <?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span>*</span><?endif?><br />
            <textarea name="MESSAGE" rows="5" cols="40"><?=($arResult["MESSAGE"] == "" ? $arParams["SERVICE_MESSAGE"] : $arResult["MESSAGE"])?></textarea>
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
            <input type="submit" style="margin-left: 0px;" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>"/>
        </td>
    </tr>
</table>
</form>
</div>