<?php
/**
 * 404 / No Results partial
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


echo '<section class="no-results not-found">';

	echo '<h1 class="entry-title">' . esc_html__( 'Contenu introuvable', 'ea-starter' ) . '</h1>';
	echo '<div class="entry-content">';

	if ( is_search() ) {

		echo '<p>' . esc_html__( 'Désolé, aucun résultat n\'a été trouvé. Voulez-vous essayer avec des mots-clés différents&nbsp;?', 'ea-starter' ) . '</p>';
		get_search_form();

	} else {

		echo '<p>' . esc_html__( 'Ce contenu n\'existe pas. Voulez-vous essayer une recherche&nbsp;?', 'ea-starter' ) . '</p>';
		get_search_form();
	}

	echo '</div>';
echo '</section>';
