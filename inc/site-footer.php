<?php


/**
 * Formulaire newsletter + menus + logo Footer
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {
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