<?php


/**
 * Formulaire newsletter + menus + logo Footer
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {
	echo '<div class="main-footer"><div class="colonnes-footer">';
	$lagache_footer_titre_contact=$lagache_footer_titre_telephone=$lagache_telephone=$lagache_telephone_lien=$lagache_adresse=false;
	if(function_exists('get_field')) {
		$lagache_footer_titre_contact=wp_kses_post(get_field('lagache_footer_titre_contact','option'));
		$lagache_footer_titre_telephone=wp_kses_post(get_field('lagache_footer_titre_telephone','option'));
		$lagache_telephone=esc_attr(get_field('lagache_telephone','option'));
		$lagache_telephone_lien=wp_kses_post(get_field('lagache_telephone_lien','option'));
		$lagache_adresse=wp_kses_post(get_field('lagache_adresse','option'));
	}

	for($i=1;$i<=2;$i++) {
		if( has_nav_menu( 'footer-'.$i ) ) {
			printf('<div class="col-%s col">',$i);
			wp_nav_menu( array( 'theme_location' => 'footer-'.$i, 'menu_id' => 'footer-'.$i, 'container_class' => 'nav-footer' ) );

			if($i===1 &&  has_nav_menu( 'footer-social')) {
				wp_nav_menu( array( 'theme_location' => 'footer-social', 'menu_id' => 'footer-social', 'container_class' => 'nav-social' ) );
			}
			echo '</div>';
		}
	}

	if($lagache_adresse || $lagache_telephone) {
		printf('<div class="col-%s col">',3);
			if($lagache_footer_titre_contact) {
				printf('<p class="titre-contact">%s</p>',$lagache_footer_titre_contact);
			}
			if($lagache_adresse) {
				printf('<p class="titre-site"><span class="picto">%s</span>%s</p>',kasutan_picto(array('icon'=>'map-marker',15)),get_option('blogname'));
				printf('<div class="adresse">%s</div>',$lagache_adresse);
			}
			if($lagache_footer_titre_telephone) {
				printf('<p class="titre-tel">%s</p>',$lagache_footer_titre_telephone);
			}
			if($lagache_telephone) {
				if(!$lagache_telephone_lien) {
					$lagache_telephone_lien=$lagache_telephone;
				}
				printf('<div class="telephone"><span class="picto">%s</span><a href="tel:%s">%s</a></div>',kasutan_picto(array('icon'=>'telephone',12)),$lagache_telephone_lien,$lagache_telephone);
			}
		echo '</div>';
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
		printf('<span class="titre">Copyright &copy; 2022 %s %s</span>',get_option('blogname'), date('Y'));
		echo '<span class="sep">-</span>';
		if( $mentions_legales ) {
			printf('<a href="%s" class="mentions">%s</a>',get_the_permalink( $mentions_legales),get_the_title($mentions_legales));
			echo '<span class="sep">-</span>';
		}
		echo ('<a class="agence" href="https://banquise.com/" rel="noopener noreferrer" target="_blank">Site réalisé par 40 degrés sur la banquise</a>');
	echo '</div>';
}