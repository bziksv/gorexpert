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

	$(".agree-check").each(function() {
		var parentForm = $(this).parents('form:first');
		parentForm.find(".agree-button").prop('disabled', !this.checked);
	}).change(function() {
    	var parentForm = $(this).parents('form:first');		
		if(this.checked) {			
			parentForm.find(".agree-button").prop('disabled',false);			
		}
		else
		{
			parentForm.find(".agree-button").prop('disabled',true);
		}
	});
	
	$('.index__slider').slick(
		 {
		 	arrows: false,
		 	dots: true,
		 	autoplay: true,
  			autoplaySpeed: 3000
		 }
	);
	$('.clients-slider2').slick(
		 {
		 	arrows: false,
		 	dots: true,
		 	autoplay: true,
  			autoplaySpeed: 3000,
			slidesToShow: 5,
      		slidesToScroll: 3,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 4,
					slidesToScroll: 2,
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				  }
				}
			]
		}
	);

	$("#mmenu").mmenu({
		navbar: {
 			title: "Меню"
 	},
         // options
     }, {
         // configuration
         offCanvas: {
            pageSelector: "#page-wrap"
         }
	
	});
		var menuAPI = $("#mmenu").data( "mmenu" );
	$(".mmenu__button").click(function(e) {
		
         menuAPI.open();
        // e.preventDefaults();
      });
	  
	  
	
});

