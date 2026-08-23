<?
namespace V1rt\Media;

class CJSLoad
{
    const LOAD_JS_FANCYBOX_1 = "fancybox-1.3.4";
    const LOAD_JS_FANCYBOX_2 = "fancybox-2.1.5";
    const LOAD_JS_MOUSEWHEEL = "mousewheel-3.0.6";
    
    public static function js($lib = CJSLoad::LOAD_JS_FANCYBOX_1, $pack = true)
    {
        global $APPLICATION;
        $path = "/bitrix/js/v1rt.mediagallery/".$lib."/";
        if(file_exists($_SERVER["DOCUMENT_ROOT"].$path))
        {
            if($pack)
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'jquery.'.$lib.'.pack.js"></script>', true);
            else
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'jquery.'.$lib.'.js"></script>', true);
            
            CJSLoad::additionalJSCode($lib);
        }
    }
    
    protected static function additionalJSCode($lib)
    {
        global $APPLICATION;
        $path = "/bitrix/js/v1rt.mediagallery/".$lib."/";
        switch($lib)
        {
            case CJSLoad::LOAD_JS_FANCYBOX_1:
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'jquery.easing-1.4.pack.js"></script>', true);
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'jquery.mousewheel-3.0.4.pack.js"></script>', true);
                $APPLICATION->AddHeadString('<link rel="stylesheet" href="'.$path.'jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>', true);
            break;
            case CJSLoad::LOAD_JS_FANCYBOX_2:
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'jquery.mousewheel-3.0.6.pack.js"></script>', true);
                $APPLICATION->AddHeadString('<link rel="stylesheet" href="'.$path.'jquery.fancybox-2.1.5.css" type="text/css" media="screen"/>', true);
                $APPLICATION->AddHeadString('<link rel="stylesheet" href="'.$path.'helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen"/>', true);
                $APPLICATION->AddHeadString('<link rel="stylesheet" href="'.$path.'helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen"/>', true);
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>', true);
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'helpers/jquery.fancybox-media.js?v=1.0.6"></script>', true);
                $APPLICATION->AddHeadString('<script type="text/javascript" src="'.$path.'helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>', true);
            break;
        }
    }
}
?>