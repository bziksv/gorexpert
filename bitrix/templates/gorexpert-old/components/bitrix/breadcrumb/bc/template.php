<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return "";
$strReturn = '<ul class="bc">';
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
    if($index == 0) $strReturn .= '<li><a href="/">Главная</a></li>';
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index < (count($arResult)-1))
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<li><span>'.$title.'</span></li>';
}
$strReturn .= '</ul>';
return $strReturn;
?>