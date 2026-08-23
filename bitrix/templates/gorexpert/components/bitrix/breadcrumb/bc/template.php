<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(empty($arResult)) return "";
$strReturn = '<ul class="bc">
  <div class="bx-breadcrumb-item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">';
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{

	if($index == 0) $strReturn .= '<li><a href="/" itemprop="url"><span itemprop="title">Главная</span></a></li>';
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index < (count($arResult)-1))
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url"><span itemprop="title">'.$title.'</span></a></li>';
	else {
		$strReturn .= '<li><span itemprop="title">'.$title.'</span></li>';
	}

}
$strReturn .= '</div>
</ul>';
return $strReturn;
?>