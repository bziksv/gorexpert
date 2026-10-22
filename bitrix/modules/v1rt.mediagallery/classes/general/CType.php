<?
namespace V1rt\Media;
IncludeModuleLangFile(__FILE__);

class CType
{
    public static function GetUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE'         => 'N',
            'USER_TYPE'             => 'v1rt_mediagallery',
            'DESCRIPTION'           => GetMessage("NAME_PROPERTY"),
            'GetPropertyFieldHtml'  => array('\V1rt\Media\CType', 'GetPropertyFieldHtml'),
            'ConvertToDB'           => array('\V1rt\Media\CType', 'ConvertToDB'),
            'ConvertFromDB'         => array('\V1rt\Media\CType', 'ConvertFromDB')
        );
    }
        
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        \CModule::IncludeModule("v1rt.mediagallery");
        $gals = \V1rt\Media\CMediaGallery::collections();
        $results = '<option value="0">[0] '.GetMessage("CHANGE_MEDIA_LIST").'</option>';
        foreach($gals as $id=>$gal)
        {
            $tmp = "";
            if($id == $value['VALUE'])
                $tmp = ' selected="selected"';
            $results .= '<option value="'.$id.'"'.$tmp.'>['.$id.'] '.$gal.'</option>';
        }
        $return = '<select name="'.$strHTMLControlName['VALUE'].'" id="'.$strHTMLControlName['VALUE'].'">';
        $return .= $results;
        $return .= '</select>';
        return  $return;
    }
        
    public static function ConvertToDB($arProperty, $value)
    {
        $return = array();
        if(is_numeric($value['VALUE']))
            $return['VALUE'] = intval($value['VALUE']);
        else
            $return['VALUE'] = 0;
        return $return;
    }
        
    public static function ConvertFromDB($arProperty, $value)
    {
        $return = array();
        if(is_numeric($value['VALUE']))
            $return['VALUE'] = intval($value['VALUE']);
        else
            $return['VALUE'] = 0;
        return $return;
    }        
}
?>