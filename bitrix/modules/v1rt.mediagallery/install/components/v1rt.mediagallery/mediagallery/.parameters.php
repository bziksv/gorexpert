<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("v1rt.mediagallery")) return;

$collections = \V1rt\Media\CMediaGallery::collections();
foreach($collections as $id=>$collection)
    $arFolders[$id] = "[".$id."] ".substr($collection, 0, 40);

$arResizeMode = array(
    "N" => GetMessage("RESIZE_MODE_NO"),
    "F" => GetMessage("RESIZE_MODE_FLY"),
    "P" => GetMessage("RESIZE_MODE_PREVIEW")
);

$arWatermarkPosition = array(
    "center" => GetMessage("WATERMARK_POS_0"),
    "left-top" => GetMessage("WATERMARK_POS_1"),
    "right-top" => GetMessage("WATERMARK_POS_2"),
    "right-bottom" => GetMessage("WATERMARK_POS_3"),
    "left-bottom" => GetMessage("WATERMARK_POS_4"),
);

$arJS = array(
    0 => GetMessage("LOAD_JS_NO"),
    1 => GetMessage("LOAD_JS_FC_1"),
    2 => GetMessage("LOAD_JS_FC_2")
);

$arComponentParameters = array(
	"GROUPS" => array(
        "DETAIL_PAGE_SETTINGS" => array(
            "NAME" => GetMessage("DETAIL_PAGE_SETTINGS"),
        ),
        "RESIZE_SETTINGS" => array(
            "NAME" => GetMessage("RESIZE_SETTINGS")
        ),
        "NAVIGATION" => array(
			"NAME" => GetMessage("NAVIGATION")
		),
        "TPL_SETTINGS" => array(
            "NAME" => GetMessage("TPL_SETTINGS")
        ),
        "WATERMARK" => array(
            "NAME" => GetMessage("WATERMARK_SETTINGS")
        ),
	),
	"PARAMETERS" => array(

		"FOLDERS" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("FOLDERS"),
			"TYPE" => "LIST",
			"VALUES" => $arFolders
		),

		"VARIABLE_ALIASES" => array(
			"GALLERY_ID" => array(
				"NAME" => GetMessage("MEDIA_VARIABLE"),
				"DEFAULT" => "GALLERY_ID",
			),
		),
        
		"SEF_MODE" => array(
			"list" => array(
				"NAME" => GetMessage("LIST_PAGE"),
				"DEFAULT" => "/",
				"VARIABLES" => array()
			),
			"detail" => array(
				"NAME" => GetMessage("DETAIL_PAGE"),
				"DEFAULT" => "#GALLERY_ID#/",
				"VARIABLES" => array("GALLERY_ID")
			),
		),
        
        "TITLE" => array(
			"PARENT" => "DETAIL_PAGE_SETTINGS",
			"NAME" => GetMessage("TITLE"),
			"TYPE" => "CHECKBOX",
		),
        
        "RESIZE_MODE" => array(
            "PARENT" => "RESIZE_SETTINGS",
			"NAME" => GetMessage("RESIZE_MODE"),
			"TYPE" => "LIST",
            "VALUES" => $arResizeMode,
		),
        "RESIZE_MODE_W" => array(
            "PARENT" => "RESIZE_SETTINGS",
			"NAME" => GetMessage("RESIZE_MODE_W"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "150",
		), 
        "RESIZE_MODE_H" => array(
            "PARENT" => "RESIZE_SETTINGS",
			"NAME" => GetMessage("RESIZE_MODE_H"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "150",
		),
        
        "PAGE_NAV_MODE" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("PAGE_NAV_MODE"),
			"TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
		),
        "ELEMENT_PAGE" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("ELEMENT_PAGE"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "5",
		),
        "PAGER_SHOW_ALL" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("PAGER_SHOW_ALL"),
			"TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
		),
        "PAGER_SHOW_ALWAYS" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("PAGER_SHOW_ALWAYS"),
			"TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
		),
        "PAGER_TITLE" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("PAGER_TITLE"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "Фотографии",
		),
        "PAGER_TEMPLATE" => array(
            "PARENT" => "NAVIGATION",
			"NAME" => GetMessage("PAGER_TEMPLATE"),
			"TYPE" => "TEXTBOX",
            "DEFAULT" => "modern",
		),
        
        "LOAD_JS" => array(
			"PARENT" => "TPL_SETTINGS",
			"NAME" => GetMessage("LOAD_JS"),
			"TYPE" => "LIST",
            "VALUES" => $arJS,
		),
        
        "WATERMARK_MODE" => array(
            "PARENT" => "WATERMARK",
			"NAME" => GetMessage("WATERMARK_MODE"),
			"TYPE" => "CHECKBOX",
            "DEFAULT" => "",
		),
        "WATERMARK_POSITION" => array(
            "PARENT" => "WATERMARK",
			"NAME" => GetMessage("WATERMARK_POSITION"),
			"TYPE" => "LIST",
            "VALUES" => $arWatermarkPosition,
            "DEFAULT" => 0,
		),
        
        'CACHE_TIME' => array('DEFAULT' => 3600),

	),
);
?>