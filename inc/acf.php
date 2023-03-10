<?php
/**
 * ACF Customizations
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

class BE_ACF_Customizations {

	public function __construct() {

		// Only allow fields to be edited on development
		if ( ! defined( 'WP_LOCAL_DEV' ) || ! WP_LOCAL_DEV ) {
			//add_filter( 'acf/settings/show_admin', '__return_false' );
		}

		// Save and sync fields.
		add_filter( 'acf/settings/save_json', array( $this, 'get_local_json_path' ) );
		add_filter( 'acf/settings/load_json', array( $this, 'add_local_json_path' ) );
		add_action( 'admin_init', array( $this, 'sync_fields_with_json' ) );

		// Register options page
		add_action( 'init', array( $this, 'register_options_page' ) );

		// Register Blocks
		add_filter( 'block_categories_all', array($this,'kasutan_block_categories'), 10, 2 );
		add_action('acf/init', array( $this, 'register_blocks' ) );

	}

	/**
	 * Define where the local JSON is saved.
	 *
	 * @return string
	 */
	public function get_local_json_path() {
		return get_template_directory() . '/acf-json';
	}

	/**
	 * Add our path for the local JSON.
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public function add_local_json_path( $paths ) {
		$paths[] = get_template_directory() . '/acf-json';

		return $paths;
	}

	/**
	 * Automatically sync any JSON field configuration.
	 */
	public function sync_fields_with_json() {
		if ( defined( 'DOING_AJAX' ) || defined( 'DOING_CRON' ) )
			return;

		if ( ! function_exists( 'acf_get_field_groups' ) )
			return;

		$version = get_option( 'ea_acf_json_version' );

		if ( defined( 'KASUTAN_STARTER_VERSION' ) && version_compare( KASUTAN_STARTER_VERSION, $version ) ) {
			update_option( 'ea_acf_json_version', KASUTAN_STARTER_VERSION );
			$groups = acf_get_field_groups();

			if ( empty( $groups ) )
				return;

			$sync = array();
			foreach ( $groups as $group ) {
				$local    = acf_maybe_get( $group, 'local', false );
				$modified = acf_maybe_get( $group, 'modified', 0 );
				$private  = acf_maybe_get( $group, 'private', false );

				if ( $local !== 'json' || $private ) {
					// ignore DB / PHP / private field groups
					continue;
				}

				if ( ! $group['ID'] ) {
					$sync[ $group['key'] ] = $group;
				} elseif ( $modified && $modified > get_post_modified_time( 'U', true, $group['ID'], true ) ) {
					$sync[ $group['key'] ] = $group;
				}
			}

			if ( empty( $sync ) )
				return;

			foreach ( $sync as $key => $v ) {
				if ( acf_have_local_fields( $key ) ) {
					$sync[ $key ]['fields'] = acf_get_local_fields( $key );
				}
				acf_import_field_group( $sync[ $key ] );
			}
		}
	}

	/**
	 * Register Options Page
	 *
	 */
	function register_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(array(
				'page_title' 	=> 'R??glages du site Lagache',
				'menu_title'	=> 'R??glages du site Lagache',
				'menu_slug' 	=> 'site-settings',
				'capability'	=> 'edit_posts',
				'position' 		=> '2.5',
				'icon_url' 		=> 'dashicons-carrot',
				'redirect'		=> false,
				'update_button' => 'Mettre ?? jour',
				'updated_message' => 'R??glages du site mis ?? jour',
				'capability' => 'manage_options',

			));
		}
	}

	/**
	* Enregistre une cat??gorie de blocs li??e au th??me
	*
	*/
	function kasutan_block_categories( $categories, $post ) {
		return array_merge(
			array(
				array(
					'slug' => 'lagache',
					'title' => 'Lagache',
					'icon'  => 'carrot',
				),
			),
			$categories
		);
	}

	function helper_register_block_type($slug,$titre,$description,$icon='carrot',$js=false,$keywords=[], $multiple=true ){
		$keywords_from_slug=explode('-',$slug);
		$keywords=array_merge($keywords,$keywords_from_slug, array('Lagache'));
		$args=[
			'name'            => $slug,
			'title'           => $titre,
			'description'     => $description,
			'render_template' => 'partials/blocks/'.$slug.'/'.$slug.'.php',
			'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/'.$slug.'/'.$slug.'.css',
			'category'        => 'lagache',
			'icon'            => $icon, 
			'mode'			=> "edit",
			'supports' => array( 
				'mode' => false,
				'align'=>false,
				'multiple'=>$multiple,
				'anchor' => true,
			),
			'keywords'        => $keywords
		];
		if($js) {
			$args['enqueue_script']=get_stylesheet_directory_uri() . '/js/min/'.$slug.'/'.$slug.'.js';
		}
		acf_register_block_type( $args);
	}
	

	/**
	 * Register Blocks
	 * @link https://www.billerickson.net/building-gutenberg-block-acf/#register-block
	 *
	 * Categories: common, formatting, layout, widgets, embed
	 * Dashicons: https://developer.wordpress.org/resource/dashicons/
	 * ACF Settings: https://www.advancedcustomfields.com/resources/acf_register_block/
	 */
	function register_blocks() {

		if( ! function_exists('acf_register_block_type') )
			return;


		/*********Bloc banniere ***************/
		$this->helper_register_block_type( 
			'banniere',
			'Bloc image banni??re',
			'Section avec une image de fond et un texte sur fond color?? semi-opaque la page d\'accueil.',
			'carrot', 
			false,
			array( 'banniere', 'accueil')
		);

		/*********Bloc colonnes-decor ***************/
		$this->helper_register_block_type( 
			'colonnes-decor',
			'Bloc 2 colonnes avec d??cor',
			'Section avec titre, texte, bouton dans une colonne, photo et bloc de texte dans une deuxi??me colonne, et d??cor en arri??re-plan.',
			'carrot', 
			false,
			array( 'colonne', 'decor', 'accueil')
		);

		/*********Bloc colonnes-uni ***************/
		$this->helper_register_block_type( 
			'colonnes-uni',
			'Bloc 2 colonnes sur fond color?? uni',
			'Section avec titre, texte, bouton dans une colonne sur fond color?? uni, et photo dans une deuxi??me colonne.',
			'carrot', 
			false,
			array( 'colonne', 'uni', 'accueil')
		);

		/*********Bloc intro-produits ***************/
		$this->helper_register_block_type( 
			'intro-produits',
			'Bloc introduction produits avec 3 images',
			'Section avec titre, texte, bouton dans une colonne, et 3 photos rondes dans une deuxi??me colonne, sur fond uni color?? avec d??cor.',
			'carrot', 
			false,
			array( 'produits', 'intro', 'accueil')
		);

		/*********Bloc blog ***************/
		$this->helper_register_block_type( 
			'blog',
			'Bloc blog',
			'Section avec titre principal et les trois derniers articles publi??s sur le blog. Carrousel sur petits ??crans.',
			'carrot', 
			true, //JS pour carrousel mobile
			array('blog', 'article', 'accueil')
		);

		/*********Bloc newsletter ***************/
		$this->helper_register_block_type( 
			'newsletter',
			'Bloc inscription newsletter',
			'Section avec titre, formulaire et image de fond pour la page d\'accueil.',
			'carrot', 
			false,
			array('newsletter', 'formulaire', 'accueil')
		);

		/*********Bloc carrousel de logos ***************/
		$this->helper_register_block_type( 
			'carrousel',
			'Bloc carrousel de logos des marques',
			'Section avec titre et carrousel de logos des marques',
			'carrot', 
			true, //besoin de JS pour le carrousel
			array('logo', 'marque','carrousel')
		);
		

		/*********Bloc collaborateurs ***************/
		$this->helper_register_block_type( 
			'collaborateurs',
			'Bloc collaborateurs',
			'Section avec titre et grille de collaborateurs. Les coordonn??es de chaque personne sont ?? renseigner dans le menu Collaborateurs',
			'carrot', 
			false,
			array('equipe','collaborateur')
		);

		/*********Bloc produits ***************/
		$this->helper_register_block_type( 
			'produits',
			'Bloc groupe de prouits',
			'Section avec nom et image principale pour un groupe de prouits, et volet escamotable pour afficher plus de photos.',
			'carrot', 
			true, //volets escamotables
			array('produit')
		);
	}
}
new BE_ACF_Customizations();
