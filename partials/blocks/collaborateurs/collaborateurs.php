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

if(!empty($collaborateurs) && function_exists('kasutan_pilote_affiche_carte')) : 
	printf('<section class="acf collaborateurs %s">', $className);

		$titre_section='Membres du conseil d\'administration';
		if($titre_section) printf('<h2 class="screen-reader-text">%s</h2>',$titre_section);

		echo '<ul class="liste-collaborateurs">';
		foreach($collaborateurs as $post_id) : 
			kasutan_pilote_affiche_carte($post_id);
		endforeach;
		echo '</ul>';


	echo '</section>';

endif;
	