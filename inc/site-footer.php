<?php


/**
 * Formulaire newsletter + menus + logo Footer
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {

	echo '<a class="backtotop" href="#haut-page"><span class="screen-reader-text">Retour en haut</span>
		<svg xmlns="http://www.w3.org/2000/svg" width="40" height="23.327" viewBox="0 0 40 23.327"><path d="M106.945,51.7l-2-2a1.26,1.26,0,0,0-1.844,0L87.345,65.444,71.593,49.692a1.26,1.26,0,0,0-1.844,0l-2,2a1.26,1.26,0,0,0,0,1.844L86.423,72.218a1.261,1.261,0,0,0,1.843,0L106.945,53.54a1.263,1.263,0,0,0,0-1.844Z" transform="translate(-67.345 -49.291)" fill="#fff"></path></svg>
	</a>';


	echo '<div class="main-footer"><div class="colonnes-footer">';
	

	for($i=1;$i<=3;$i++) {
		if( has_nav_menu( 'footer-'.$i ) ) {
			printf('<div class="col-%s col">',$i);
			wp_nav_menu( array( 'theme_location' => 'footer-'.$i, 'menu_id' => 'footer-'.$i, 'container_class' => 'nav-footer' ) );

			if($i===3 &&  has_nav_menu( 'footer-social')) {
				wp_nav_menu( array( 'theme_location' => 'footer-social', 'menu_id' => 'footer-social', 'container_class' => 'nav-social' ) );
			}
			echo '</div>';
		}
	}

	echo '</div></div>';
}


/**
* Copyright et liens légaux
*
*/
add_action( 'tha_footer_bottom', 'kasutan_copyright' );
function kasutan_copyright() {
	$mentions_legales=false;
	if(function_exists('get_field')) {
		$mentions_legales=esc_attr(get_field('page_mentions_legales','option'));
	}
	echo '<div class="copyright">';
		//printf('<span class="titre">Copyright &copy; 2022 %s %s</span>',get_option('blogname'), date('Y'));
		//echo '<span class="sep">-</span>';
		if( $mentions_legales ) {
			printf('<a href="%s" class="mentions">%s</a>',get_the_permalink( $mentions_legales),get_the_title($mentions_legales));
			echo '<span class="sep">-</span>';
		}
		echo ('<a class="agence" href="https://banquise.com/" rel="noopener noreferrer" target="_blank">Site internet réalisé par 40 degrés sur la banquise</a>');
	echo '</div>';
}