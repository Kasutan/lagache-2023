<?php
/**
 * Template Tags
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/



/**
 * Entry Category
 *
 */
function ea_entry_category($contexte='archive') {
	$post_type=get_post_type();
	$term=false;
	if($post_type==='post') {
		$term = ea_first_term();
	}
	if( !empty( $term ) && ! is_wp_error( $term ) )
		if($contexte==='archive') {
			$picto=kasutan_picto_categorie($term->term_id,'blanc');
			if($picto) {
				printf('<div class="picto-cat">%s</div>',wp_get_attachment_image( $picto,'thumbnail'));
			}
			//pour le filtre
			printf('<span class="categorie screen-reader-text">%s</span>',$term->slug);
		} else {
			//contexte single
			
				$name=$term->name;
			
			echo '<p class="entry-category h1 entry-title">' . $name . '</p>';
		}
		
}


/**
* Picto associé à une catégorie
*
*/
function kasutan_picto_categorie($term_id,$couleur="blanc") {
	if(!function_exists('get_field')) {
		return false;
	}
	if($couleur=='blanc') {
		$champ='lagache_picto';
	} else {
		$champ='lagache_picto_'.$couleur;
	}
	return esc_attr(get_field($champ,'category_'.$term_id));

}

/**
 * Post Summary Title
 *
 */
function ea_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

/**
 * Post Summary Image
 *
 */
function ea_post_summary_image( $size = 'thumbnail' ) {
	/*On cherche une image à afficher*/ 
	$image_id=get_theme_mod( 'custom_logo' ); //défaut : le logo du site
	$classe='contain';
	if(has_post_thumbnail()) {
		$image_id=get_post_thumbnail_id();
		$classe='';
	} else if(function_exists('get_field')) {
		$banniere=get_field('lagache_page_banniere');
		if($banniere) {
			$image_id=$banniere;
			$classe='';
		} else {
			$logo_footer=get_field('lagache_logo_footer','option');
			if($logo_footer) {
				$image_id=$logo_footer;
				$classe='contain has-bleu-background-color';
			}
		}
	}

	printf('<a class="post-summary__image %s" href="%s" tabindex="-1" aria-hidden="true" >%s</a>',
		$classe,
		get_permalink(),
		wp_get_attachment_image( $image_id, $size )
	);
}

/**
 * Entry Author
 *
 */
function ea_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></p>';
}

/**
* Affiche le fil d'ariane.
*/
function kasutan_fil_ariane() {

	//On n'affiche pas le fil d'ariane sur la page d'accueil
	if(is_front_page()) {
		return;
	}

	$post_type=get_post_type();

	echo '<p class="fil-ariane">';

	
	//Pour tous les contenus : afficher en premier le lien vers l'accueil du site
	//Non pas pour ce site
	/*$accueil=get_option('page_on_front');
	printf('<a href="%s">%s</a> > ',
		get_the_permalink( $accueil),
		strip_tags(get_the_title($accueil))
	);*/
	


	//Afficher la page des actualités pour les articles (single ou archive de catégorie ou archive des articles ou archive de tag)
	if ( (is_single() && 'post' === $post_type) || is_category() || is_tag() ) :
		//l'ID de la page est stockée dans les options du site
		$actus=get_option('page_for_posts'); 
		if($actus) :
			printf('<a href="%s">%s</a><span class="sep">></span>',
				get_the_permalink( $actus),
				strip_tags(get_the_title($actus))
			);
		endif;
		
		//Ajouter la catégorie d'article pour les posts single
		
		if(is_single()) {
			$term=ea_first_term();
			if(!empty($term)) {
				printf('<a href="%s?filtre_cat=%s">%s</a><span class="sep">></span>',
				get_the_permalink( $actus),
					$term->slug,
					$term->name
				);
			}
		}
	endif;


	//Afficher "Groupes de travail" pour les single de ce type de contenu
	if ( (is_single() && 'lagache_groupes' === $post_type) ) :
		$url='/#groupes'; //ancre vers la section groupes de travail sur la page d'accueil
		//TODO penser à ajouter cet ID dans le bloc ACF
		//TODO url modifiable en BO ?
		printf('<a href="%s">Groupes de travail</a><span class="sep">></span>',
			$url
		);
		
	endif;


	//Afficher le titre de la page courante
	if(is_page()) : 
		//Afficher le titre de la page parente s'il y en a une
		$current=get_post(get_the_ID());
		$parent=$current->post_parent; 
		if($parent) :
			printf('<span class="parent">%s</span><span class="sep">></span><span class="current">%s</span>',
				strip_tags(get_the_title($parent)),
				strip_tags(get_the_title())
			);
		else :
			printf('<span class="current">%s</span>',
				strip_tags(get_the_title())
			);
		endif;
	elseif(is_single()):
		printf('<span class="current">%s</span>',
			strip_tags(get_the_title())
		);
	elseif (is_category()) :  //archives catégories d'articles
		//echo '<span class="current">'.strip_tags(single_cat_title( '', false )).'</span>';
	elseif (is_tag()) :  //archives tags d'articles
		//echo '<span class="current">'.strip_tags(single_tag_title( '', false )).'</span>';
	elseif (is_home()) :
		echo '<span class="current">Actualités</span>';
	elseif (is_search()) :
		echo '<span class="current">Recherche : '.get_search_query().'</span>';
	elseif (is_404()) :
		echo '<span class="current">Page introuvable</span>';

	endif;

	//Fermer la balise du fil d'ariane
	echo '</p>';

}




/**
* Image banniere pour les pages ordinaires
*
*/
function kasutan_page_banniere($page_id=false,$titre=false,$image_defaut=false,$balise_titre=true) {
	if(!function_exists('get_field')) {
		return;
	}
	if(!$page_id) {
		$page_id=get_the_ID();
	}
	if(!$titre) {
		$titre=wp_kses_post(get_field('lagache_banniere_titre',$page_id));
	}
	if(!$titre) {
		$titre=get_the_title($page_id);
	}
	if(!$image_defaut) {
		$image_id=esc_attr(get_field('lagache_banniere_image',$page_id));
	}
	if(!$image_id || $image_defaut) {
		$image_id=esc_attr(get_field('lagache_bg_image','option'));//image par défaut
	}

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));
			if(!empty($titre)) {
				if($balise_titre) {
					printf('<div class="titre-banniere"><h1>%s</h1></div>',$titre);
				} else {
					printf('<div class="titre-banniere"><span class="h1">%s</span></div>',$titre);
				}
			}
		echo '</div>';
	}
}

/**
* Image banniere pour les actus + utilisée aussi pour la recherche
*
*/
function kasutan_actus_banniere() {
	if(!function_exists('get_field')) {
		return;
	}


	if(is_single()) {
		//On est sur un post single, on vérifie s'il a sa propre image bannière
		$image_id=esc_attr(get_field('lagache_banniere_image'));
		if(!$image_id) {
			//si le post n'a pas d'image bannière on utilise l'image par défaut
			$image_id=esc_attr(get_field('lagache_bg_image','option'));//image par défaut
		}

		//On affiche la bannière normale mais avec le label de sa catégorie principale, au singulier (option ACF dans la taxonomie)
		$singulier='';
		$term=ea_first_term();
		if($term) {
			$term_id=$term->term_id;
			$singulier=wp_kses_post(get_field('lagache_singulier','category_'.$term_id));
		}
		if(!$singulier) {
			$singulier='Actualité'; // Par défaut
		}

		kasutan_page_banniere(get_the_ID(),$singulier,false,false);
		return;
	} 

	


	if(is_search()) {
		
		kasutan_page_banniere(false,'Recherche',true);
		return;
	}

	//On est sur une page d'archive, on affiche la bannière de la page des actualités
	$actus=get_option('page_for_posts'); 

	kasutan_page_banniere($actus);
}

/**
* Image mise en avant
*
*/
function kasutan_affiche_thumbnail_dans_contenu() {
	if(has_post_thumbnail()) {
		echo '<div class="thumbnail">';
			the_post_thumbnail( 'medium_large');
		echo '</div>';
	}
}

/**
* Filtre par catégories pour les archives de blog
*
*/
function kasutan_affiche_filtre_articles() {
	$avec_pictos=function_exists('kasutan_picto_categorie');
	echo '<p>Filtrer les actualités</p>';
	echo '<form class="filtre-archive" id="filtre-liste">';
		$terms=get_terms( array(
			'taxonomy' => 'category'
			) 
		);
		?>
		<input type="radio" id="toutes" name="filtre-categorie" value="toutes" checked>
		<label for="toutes" class="toutes">Toutes les actualités</label>
		<?php
		foreach($terms as $term) : 
			$pictos=$classe='';
			if($avec_pictos) {
				$picto_blanc=kasutan_picto_categorie($term->term_id,'blanc');
				$picto_bleu=kasutan_picto_categorie($term->term_id,'bleu');
				if($picto_blanc && $picto_bleu) {
					$pictos=sprintf('<span class="picto blanc">%s</span><span class="picto bleu">%s</span>',wp_get_attachment_image( $picto_blanc,'thumbnail'),wp_get_attachment_image( $picto_bleu,'thumbnail'));
					$classe="avec-pictos";
				}
			}
			

			printf('<input type="radio" id="%s" name="filtre-categorie" value="%s">',
				$term->slug,
				$term->slug
			);
			printf('<label for="%s" class="%s">%s %s</label>',
				$term->slug,
				$classe,
				$pictos,
				$term->name
			);
		endforeach;
		?>
		
	</form>
<?php
}