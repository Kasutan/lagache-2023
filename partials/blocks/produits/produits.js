
(function($) {

	$( document ).ready(function() {
		
		var boutons=$('.produits .toggle');
		if(boutons.length > 0 ) {
			$('.autres-photos').hide();
			$('.autres-photos').removeClass('js-show');
			$(boutons).click(function(e) {
				var idCible=$(this).attr('aria-controls');
				var cible=$('#'+idCible);
				if($(this).attr('aria-expanded')==="false") {
					$(cible).attr('aria-expanded','true');
					$(this).attr('aria-expanded','true');
					$(cible).slideDown('slow');
					
				} else {
					$(cible).attr('aria-expanded','false');
					$(this).attr('aria-expanded','false');
					$(cible).slideUp('slow');
				}
			})
		}
		
	}); //fin document ready
})( jQuery );