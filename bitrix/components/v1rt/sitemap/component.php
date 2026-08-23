<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if($this->StartResultCache() && CModule::IncludeModule("iblock"))
{
    if(file_exists($_SERVER["DOCUMENT_ROOT"].SITE_DIR.".top.menu.php"))
    {
        $arIBlock = array();
        global $aMenuLinks;
        include($_SERVER["DOCUMENT_ROOT"].SITE_DIR.".top.menu.php");
        $topMenu = $aMenuLinks;
        unset($aMenuLinks);
        
        $res = CIBlock::GetList(array(), array("SITE_ID" => SITE_ID, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"), true);
        while($ar_res = $res->Fetch())
        {
            $arIBlock[] = array(
                "ID" => $ar_res["ID"],
                "TYPE" => $ar_res["TYPE"],
                "NAME" => $ar_res["NAME"],
                "COUNT" => $ar_res["ELEMENT_CNT"],
                "SECTION" => str_replace("//", "/", str_replace("#SITE_DIR#", SITE_DIR, $ar_res["LIST_PAGE_URL"]))
            );
        }
        
        foreach($topMenu as $i=>$menu)
        {
            $arResult["SITEMAP"][$i] = array(
                "NAME" => $menu[0],
                "PATH" => $menu[1]
            );
            
            if(file_exists($_SERVER["DOCUMENT_ROOT"].$menu[1].".left.menu.php"))
            {
                global $aMenuLinks;
                include($_SERVER["DOCUMENT_ROOT"].SITE_DIR.".left.menu.php");
                $leftMenu = $aMenuLinks;
                
                if(count($leftMenu))
                {
                    foreach($leftMenu as $j=>$l)
                    {
                        $arResult["SITEMAP"][$i]["CHILDS"][$j] = array(
                            "NAME" => $l[0],
                            "PATH" => $l[1]
                        );
                        foreach($arIBlock as $id=>$ib)
                        {
                            if($ib["SECTION"] == $menu[1])
                            {
                                $arResult["SITEMAP"][$i]["CHILDS"][$j]["IBLOCK"] = $arIBlock[$id];
                                break;
                            }
                        }
                    }
                }
            }
            
            foreach($arIBlock as $id=>$ib)
            {
                if($ib["SECTION"] == $menu[1])
                {
                    $arResult["SITEMAP"][$i]["IBLOCK"] = $arIBlock[$id];
                    break;
                }
            }
        }
    }
    $this->IncludeComponentTemplate();
}
?>