<?php 
/**
* Template pour le bloc collaborateurs
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';

$collaborateurs=get_field('collaborateurs');

if(!empty($collaborateurs) && function_exists('kasutan_collaborateur_affiche_carte')) : 
	printf('<section class="acf collaborateurs %s">', $className);
		$titre=wp_kses_post( get_field('titre') );
		if($titre) printf('<h2 class="titre-section">%s</h2>',$titre);
		
		echo '<ul class="liste-collaborateurs">';
		foreach($collaborateurs as $post_id) : 
			kasutan_collaborateur_affiche_carte($post_id);
		endforeach;
		echo '</ul>';


	echo '</section>';

endif;
	