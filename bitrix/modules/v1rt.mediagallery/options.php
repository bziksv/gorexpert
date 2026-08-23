<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$module_id = "v1rt.mediagallery";
global $USER;
if($USER->IsAdmin())
{
    global $MESS;
    include(GetLangFileName($GLOBALS["DOCUMENT_ROOT"]."/bitrix/modules/main/lang/", "/options.php"));
    include(GetLangFileName($GLOBALS["DOCUMENT_ROOT"]."/bitrix/modules/".$module_id."/lang/", "/options.php"));
    
    $aTabs = array(
    	array("DIV" => "edit1", "TAB" => GetMessage("V1RT_MEDIAGALLERY_TAB_1"), "TITLE" => GetMessage("V1RT_MEDIAGALLERY_TAB_1_DESC"))
    );
    
    $tabControl = new CAdminTabControl("tabControl", $aTabs);
    if($REQUEST_METHOD == "POST" && strlen($Update.$Apply.$RestoreDefaults) > 0 && check_bitrix_sessid())
    {
        if($_FILES["v1rt_mediagallery_watermark"]["type"] == "image/png")
        {
            move_uploaded_file($_FILES["v1rt_mediagallery_watermark"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/v1rt.mediagallery/watermark.png");
        }
        LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&".$tabControl->ActiveTabParam());
    }
    
    $pathWatermark = $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/v1rt.mediagallery/";
    $access = is_writable($pathWatermark);
    
    $tabControl->Begin();?>
    
    <form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($module_id)?>&lang=<?=LANGUAGE_ID?>" enctype="multipart/form-data" name="post_form" id="post_form">
        <?bitrix_sessid_post();?>
        <?$tabControl->BeginNextTab();?>
            <tr>
        		<td valign="top" width="50%" style="padding-top: 14px;"><label for="v1rt_mediagallery_watermark"><?=GetMessage("V1RT_MEDIAGALLERY_WATERMARK")?>:</label></td>
        		<td valign="top" width="50%">
                    <?if($access):?>
                        <input type="file" name="v1rt_mediagallery_watermark" id="v1rt_mediagallery_watermark"/>
                    <?else:?>
                        <?=GetMessage("V1RT_MEDIAGALLERY_IS_WRITABLE", array("%PATH%" => $pathWatermark));?>
                    <?endif;?>
                    <?if(file_exists($pathWatermark."watermark.png")):?>
                        <p><?=CFile::ShowImage("/bitrix/images/v1rt.mediagallery/watermark.png", 200, 200, "border=0", "", true);?></p>
                    <?endif;?>
                </td>
            </tr>  
        <?$tabControl->Buttons();?>
        	<input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>"/>
        	<?=bitrix_sessid_post();?>
        <?$tabControl->End();?>
    </form>
    
<?
}
?>