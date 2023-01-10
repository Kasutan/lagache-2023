<?php
/**
 * Single Post
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Image bannière 
add_action( 'tha_entry_top', 'kasutan_actus_banniere', 5 );


// Breadcrumbs 
add_action( 'tha_entry_top', 'kasutan_fil_ariane', 8 );



//Titre et date insérés avant le contenu pour mise en page grille
add_action('tha_entry_content_before', 'kasutan_single_entry_content_before');
function kasutan_single_entry_content_before() {
	if(get_post_type() !== 'post') {
		return;
	}
	echo '<div class="col image">'; //wrapper pour la 1ère colonne
		//image 
		if(function_exists('kasutan_affiche_thumbnail_dans_contenu')) {
			kasutan_affiche_thumbnail_dans_contenu();
		}
		//titre 
		printf('<h1 class="h2 single-title">%s</h1>',get_the_title());
		// Publish date
		echo '<p class="publish-date">'. get_the_date('d F Y') . '</p>';

	echo '</div>';

	echo '<div class="col contenu">'; //wrapper pour la 2e colonne

	

	
}

add_action('tha_entry_content_after','kasutan_single_entry_content_after');
function kasutan_single_entry_content_after(){
	//fermer wrapper
	echo '</div> <!--end .col-->';
}


// Build the page
require get_template_directory() . '/index.php';
