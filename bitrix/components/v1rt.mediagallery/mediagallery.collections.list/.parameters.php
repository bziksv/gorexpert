<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if(!CModule::IncludeModule("v1rt.mediagallery")) return;

$arFoldersExceptions[0] = GetMessage("NULL_VALUE_LIST");
$collections = \V1rt\Media\CMediaGallery::collections();
foreach($collections as $id=>$collection)
    $arFolders[$id] = "[".$id."] ".substr($collection, 0, 40);
$arFoldersExceptions = array_merge($arFoldersExceptions, $arFolders);

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
        "GALLERY_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("GALLERY_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arFolders
		),
		"EXCEPTIONS" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("EXCEPTIONS"),
			"TYPE" => "LIST",
			"VALUES" => $arFoldersExceptions,
            "MULTIPLE" => "Y"
		),
        "MEDIA_VARIABLE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("MEDIA_VARIABLE"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "ID"
		),
        "DETAIL_URL" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("DETAIL_URL"),
			"TYPE" => "TEXTBOX",
			"DEFAULT" => "/gallery/detail.php?ID=#ID#",
		),
        'CACHE_TIME' => array('DEFAULT' => 3600),
	),
);
?>