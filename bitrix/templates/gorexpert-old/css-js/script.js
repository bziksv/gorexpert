$(document).ready(function(){
    $(".showmap").fancybox({
        'width'  : 615,
        'height' : 490,
		autoSize : false
	});
    
    $(".img-open").each(function(){
        if($(this).attr("title") != undefined && $(this).attr("title") != "")
            $(this).wrap('<a href="' + $(this).attr("src") + '" title="' + $(this).attr("title") + '" class="medialibrary-f"></a>');
        else
            $(this).wrap('<a href="' + $(this).attr("src") + '" class="medialibrary-f"></a>');
    });
    $(".medialibrary-f").fancybox({
        helpers : {
    		title : {
    			type : 'inside'
    		}
    	}
    });
    
    $("a.link-open").on("click", function(event){
        event.preventDefault();
        event.stopPropagation();
        window.open(this.href, '_blank');
    });
});