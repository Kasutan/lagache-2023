//https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html

(function($) {

	$( document ).ready(function() {
		var owl = $(".carrousel .owl-carousel"); 
		if(owl.length > 0) {
			var items= {
				xsm : 1,
				sm : 2,
				md : 3,
				lg : 5,
			}
			owl.owlCarousel({
				loop:true,
				nav : false,
				dots : true,
				autoplay:true,
				autoplayTimeout:5000,
				autoplaySpeed:2000,
				autoplayHoverPause:true,
				margin:0,
				//slideBy:'page',
				//checkVisible: false,
				onInitialized: accessibleNav,
				responsive : {
					0 : {
						items:items.xsm,
						dotsEach:items.xsm
					},
					500 : {
						items:items.sm,
						dotsEach:items.sm,
					},
					768 : {
						items:items.md,
						dotsEach:items.md,
					},
					960 : {
						items:items.lg,
						dotsEach:items.lg,
					},
				}
			});
		}

		function accessibleNav(e) {
			$('.owl-dot span').addClass('screen-reader-text');
			$('.owl-dot span').html('Afficher le groupe de logos suivant');
		}
	}); //fin document ready
})( jQuery );