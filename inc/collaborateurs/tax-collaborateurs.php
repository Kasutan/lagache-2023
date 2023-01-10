<?php
if ( ! defined( 'ABSPATH' ) ) exit;


/***************************************************************
	Custom Taxonomy Service pour les collaborateurs
/***************************************************************/

add_action( 'init', 'kasutan_services_tag', 0 );
function kasutan_services_tag() {
	// Labels part for the GUI
	$labels = array(
		'name' => _x( 'Services', 'taxonomy general name' ),
		'singular_name' => _x( 'Service', 'taxonomy singular name' ),
		'menu_name' => __( 'Services' ),
	); 
	register_taxonomy('lagache_services','lgh_collaborateurs',array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true, 
		'show_admin_column' => true,
		'query_var' => true,
		'public' => false, 
		'show_in_rest' => false
	));
}
