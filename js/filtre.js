(function($) {

	$( document ).ready(function() {
		/*--------------------------------------------------------------
		# Filtrer archives par catégorie
		--------------------------------------------------------------*/
		var optionsListe = {
			valueNames: ['categorie'],
			page: 3, 
			pagination: true
		};
	
		var listePosts = new List('archive-filtrable', optionsListe);

		var resultats=$('.list, .pagination');


		$('.filtre-archive').change(function(){
			$(resultats).animate(
				{opacity:0},
				400,
				'linear',
				function(){
					//callback de l'animation
					var selected_value = $("input[name='filtre-categorie']:checked").val();

					if(selected_value=='toutes') {
						listePosts.filter();
						localStorage.removeItem('filtreBlog');
						updateURL('')
					} else {
						listePosts.filter(function(item) {
							return (item.values().categorie.indexOf(selected_value)>=0);
						});
						
						localStorage.setItem('filtreBlog',selected_value);
						updateURL(selected_value);
						
					}
					//la nouvelle liste est prête, nouvelle animation pour réafficher
					$(resultats).animate(
						{opacity:1}, 1000, 'linear'	
					);
				} //fin fonction callback
			); //fin animate
		
		});

		// Au chargement d'une page archive, on vérifie d'abord s'il y a un paramètre cat dans l'url
		const queryString = window.location.search;
		console.log(queryString);
		const urlParams = new URLSearchParams(queryString);
		if(urlParams.has('filtre_cat')) {
			//s'il y a un paramètre cat dans l'url, on coche l'input du filtre correspondant
			$(".filtre-archive input").each(function (index, element) {
				if($(element).val() === urlParams.get('filtre_cat')) {
					$(element).prop("checked", true);
					//on force la mise en oeuvre du filtre
					$('.filtre-archive').trigger('change');
				}
			});
		} else {
			// S'il n'y a pas de paramètre dans l'url, on vérifie s'il y a un filtre stocké pour les articles (c'est le cas si le filtre a été activé par le visiteur précédemment)
			var filtreBlog = localStorage.getItem('filtreBlog');
			if(filtreBlog) {
				//si oui, on coche l'input du filtre correspondant
				$(".filtre-archive input").each(function (index, element) {
					if($(element).val() === filtreBlog) {
						$(element).prop("checked", true);
						//on force la mise en oeuvre du filtre
						$('.filtre-archive').trigger('change');
					}
				});
			}
		}

		//Au clic sur un élément de pagination, smooth scroll en haut de la liste
		bindScroll(); // lier les écouteurs au premier affichage

		//lier les écouteurs à chaque fois que la liste est mise à jour + attendre un peu pour que les liens de navigation soient reconstruits
		listePosts.on('updated',function(e) {
			setTimeout(bindScroll,1000);
		})

		function bindScroll() {
			$('.pagination li').click(function(e) {
				$("html, body").animate({
					scrollTop: $('#filtre-liste').offset().top - 150
					}, 500);
			});
		}

		//Mettre à jour l'url de la page
		function updateURL(value) {
			var url = new URL(window.location.href); //objet url à partir de l'url de la fenêtre actuelle
			if(value) {
				urlParams.set('filtre_cat',encodeURI(value));
			} else {
				urlParams.delete('filtre_cat');
			}
			url.search = urlParams.toString(); //on ajoute ces paramètres à notre objet url tout neuf
			var new_url = url.toString(); // on convertit l'ensemble en chaine
			history.pushState({pageID: 'Lagache'}, 'Lagache', new_url); //on stocke dans l'historique
		}
		

	}); //fin document ready
})( jQuery );

