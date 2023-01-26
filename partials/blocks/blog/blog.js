//https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html

(function($) {

	$( document ).ready(function() {
		var width=$(window).width();
		var owl=$('.acf.blog .loop');
		//Carrousel en mobile et tablette uniquement
		if(width < 960 ) {
			$(owl).addClass('owl-carousel');
			owl.owlCarousel({
				loop:true,
				nav : true,
				navText:['<span><span class="screen-reader-text"> Article précédent</span></span>','<span><span class="screen-reader-text">Article suivant <span></span>'],
				dots : false,
				autoplay:true,
				autoplayTimeout:4000,
				autoplaySpeed:2000,
				autoplayHoverPause:true,
				items:1,
				onInitialized : removeAttr,
			});
		}

		function removeAttr(event) {
			//Role incorrect d'après Axe
			$('.owl-nav button').removeAttr('role');

		}
		
	}); //fin document ready
})( jQuery );