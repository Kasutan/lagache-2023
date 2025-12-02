<?php

// Enables language and translation management for CPT and custom tax
//Désactiver la traduction des collaborateurs : obligerait à dupliquer leurs coordonnées
add_filter( 'pll_get_post_types', 'kasutan_add_cpt_to_pll', 10, 2 );
function kasutan_add_cpt_to_pll( $post_types, $is_settings ) {
	unset( $post_types['lgh_collaborateurs'] );
	return $post_types;
}

add_filter( 'pll_get_taxonomies', 'kasutan_add_tax_to_pll', 10, 2 );
function kasutan_add_tax_to_pll( $taxonomies, $is_settings ) {
	unset( $taxonomies['lagache_services'] );
	return $taxonomies;
}