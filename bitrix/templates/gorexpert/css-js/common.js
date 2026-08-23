$(document).ready(function () {

	/*Даю класс боди при уменьшении размера окна*/
	if ($(window).width() < 993){
		$('body').addClass("small");
	};

	/*Выполняю скрипт при смене размера окна*/
	$(window).resize(function () {
		var w = $(window).width();
		if (w > 993) {
			$('body').removeClass('small');
			$(".topmenu ul").css("display","block");
		}
		else
		{
		$('body').addClass('small');
		$(".topmenu ul").css("display","none");
	};
	});
/*
		$(".main_nav_button").click(function() {
			$(".topmenu ul").toggle("slow");
		});
		$(document).mouseup(function (e){
			var div = $(".topmenu ul");
			var div2 = $(".topmenu ul *");
			if (!div.is(e.target)) {
				if (!div2.is(e.target)) {
					$(".small .topmenu ul").hide();
				}
			}
		});
		$(".catalog_button").click(function() {
			$(".sidebar").toggle("slow");
		});
*/
	$('.clients-slider').slick({
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  autoplay: true,
	  dots: false,
	  arrows: false,
	  autoplaySpeed: 2000,
	  responsive: [
		{
		  breakpoint: 580,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 3,
			infinite: true
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
	  ]
	});
    $('.navi .open').on('click',function(){
        $('.tag_menu_all').show();
		$('.tag_menu_all').addClass('is-act-sm-c');
        $('.navi .open').removeClass('is-act');
        $('.navi .closem').addClass('is-act');
        return false;
    });

    $('.navi .closem').on('click',function(){
        $('.tag_menu_all').hide();
		$('.tag_menu_all').addClass('is-act-sm');
$('.tag_menu_all').removeClass('is-act-sm-c');
        $('.navi .open').addClass('is-act');
        $('.navi .closem').removeClass('is-act');
        return false;
    });
});