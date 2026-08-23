<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());
$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_CALL_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(strlen($_POST["user_name"]) <= 1)
            $arResult["ERROR_MESSAGE"][] = GetMessage("ER_MES_NAME");
        if(strlen($_POST["user_phone"]) <= 1)
            $arResult["ERROR_MESSAGE"][] = GetMessage("ER_MES_PHONE");

		if($arParams["USE_CAPTCHA"] == "Y")
		{
			include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}
        
		if(empty($arResult["ERROR_MESSAGE"]))
		{
            $event_id = null;
			$arFields = Array(
                "EMAIL_TO" => $arParams["EMAIL_TO"],
				"AUTHOR" => $_POST["user_name"],
				"AUTHOR_PHONE" => $_POST["user_phone"]
			);
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(intval($v) > 0)
						$event_id = CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", intval($v));
			}
			else
				$event_id = CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
            unset($arFields);
            if(is_null($event_id))
            {
    			$_SESSION["U_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
    			$_SESSION["U_PHONE"] = htmlspecialcharsbx($_POST["user_phone"]);
            }
            else
            {
                $_SESSION["U_NAME"] = "";
    			$_SESSION["U_PHONE"] = "";
            }
            unset($_POST["user_name"]);
            unset($_POST["user_phone"]);
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], array("success")));
		}
		
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["user_name"]);
		$arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_POST["user_phone"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = true;
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if(strlen($_SESSION["U_NAME"]) > 0)
        $arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["U_NAME"]);
	if(strlen($_SESSION["U_PHONE"]) > 0)
        $arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_SESSION["U_PHONE"]);
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
?>