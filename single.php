<?php
/**
 * Single Post
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

//Body class
function kasutan_single_body_class( $classes ) {
	if(!has_post_thumbnail()) {
		$classes[] = 'no-thumbnail';
	}
	return $classes;
}
add_filter( 'body_class', 'kasutan_single_body_class' );

// Image bannière 
add_action( 'tha_entry_top', 'kasutan_actus_banniere', 5 );


// Breadcrumbs 
add_action( 'tha_entry_top', 'kasutan_fil_ariane', 8 );



//Titre déplacé dans le contenu
remove_action( 'tha_entry_top', 'ea_entry_title' );


//Titre inséré avant le contenu pour mise en page grille
add_action('tha_entry_content_before', 'kasutan_single_entry_content_before');
function kasutan_single_entry_content_before() {
	if(get_post_type() !== 'post') {
		return;
	}
	
	echo '<div class="col">'; //wrapper pour la 1ère colonne

	//titre 
	printf('<h1 class="single-title">%s</h1>',get_the_title());

	//date 
	printf('<p class="single-date">%s</p>', get_the_date('d F Y'));

}

add_action('tha_entry_content_after','kasutan_single_entry_content_after');
function kasutan_single_entry_content_after(){
	//fermer wrapper de la la 1ère colonne
	echo '</div> <!--end .col-->';

	//Ajouter l'image 
	if(function_exists('kasutan_affiche_thumbnail_dans_contenu')) {
		kasutan_affiche_thumbnail_dans_contenu();
	}

	//Et glisser un lien vers toutes les actualités
	$actus=get_option( 'page_for_posts' ) ;
	printf('<div class="retour"><a href="%s">Retour aux actualités</a></div>',get_the_permalink($actus));
}


// Build the page
require get_template_directory() . '/index.php';
