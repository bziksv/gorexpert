<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = array("TYPE_ID" => "FEEDBACK_CALL_FORM", "ACTIVE" => "Y");
if($site !== false)
    $arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
        "USE_CAPTCHA" => Array(
			"NAME" => GetMessage("USE_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
        "EMAIL_TO" => Array(
			"NAME" => GetMessage("EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
        "EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("EVENT_MESSAGE_ID"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"Y", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		)
	),
);
?>