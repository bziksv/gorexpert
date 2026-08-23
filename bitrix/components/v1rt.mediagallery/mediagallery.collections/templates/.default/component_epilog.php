<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?if($arParams["LOAD_JS"] == 1):?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("a[rel=<?=$arResult["GAL_ID"]?>]").fancybox({
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'titlePosition' 	: 'over',
                'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
                }
            });
        });
    </script>
<?elseif($arParams["LOAD_JS"] == 2):?>
    <script type="text/javascript">
        $(document).ready(function(){
        	$("a[rel=<?=$arResult["GAL_ID"]?>]").fancybox({
        		prevEffect	: 'none',
        		nextEffect	: 'none',
        		helpers	: {
        			title	: {
        				type: 'inside'
        			},
        			thumbs	: {
        				width	: 50,
        				height	: 50
        			}
        		}
        	});
        });
    </script>
<?endif;?>