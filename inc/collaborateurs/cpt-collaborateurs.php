<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************************************
	Custom Post Type : collaborateurs
/***************************************************************/
function kasutan_collaborateurs_post_type() {

	$labels = array(
		'name'                  => _x( 'Collaborateurs', 'Post Type General Name', 'lagache' ),
		'singular_name'         => _x( 'Collaborateur', 'Post Type Singular Name', 'lagache' ),
		'menu_name'             => __( 'Collaborateurs', 'lagache' ),
		'name_admin_bar'        => __( 'Collaborateurs', 'lagache' ),
		'archives'              => __( 'Archives des collaborateurs', 'lagache' ),
		'attributes'            => __( 'Item Attributes', 'lagache' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lagache' ),
		'all_items'             => __( 'Tous les collaborateurs', 'lagache' ),
		'add_new_item'          => __( 'Ajouter un collaborateur', 'lagache' ),
		'add_new'               => __( 'Ajouter', 'lagache' ),
		'new_item'              => __( 'Nouveau collaborateur', 'lagache' ),
		'edit_item'             => __( 'Modifier ce collaborateur', 'lagache' ),
		'update_item'           => __( 'Mettre à jour ce collaborateur', 'lagache' ),
		'view_item'             => __( 'Voir ce collaborateur', 'lagache' ),
		'view_items'            => __( 'Voir les collaborateurs', 'lagache' ),
		'search_items'          => __( 'Rechercher un collaborateur', 'lagache' ),
		'not_found'             => __( 'Aucun collaborateur', 'lagache' ),
		'not_found_in_trash'    => __( 'Aucun collaborateur dans la corbeille', 'lagache' ),
	);
	$args = array(
		'label'                 => __( 'Collaborateurs', 'lagache' ),
		'description'           => __( 'Collaborateurs', 'lagache' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions', 'custom-fields','thumbnail' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-id',
		'taxonomies'            => array( 'lagache_services'),
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'lgh_collaborateurs', $args );

}
add_action( 'init', 'kasutan_collaborateurs_post_type', 0 );