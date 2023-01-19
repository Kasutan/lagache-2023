<?php 
/**
* Template pour le bloc Carrousel de logos des marques
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/

if(function_exists('get_field')) : 

	if(array_key_exists('className',$block)) {
		$className=esc_attr($block["className"]);
	} else $className='';

	$titre=wp_kses_post( get_field('titre') );
	$galerie=get_field('galerie');

	if(!empty($galerie)) : 
		printf('<section class="carrousel %s">',$className);
			
		if($titre) printf('<h2 class="titre-section h1">%s</h2>',$titre);

			echo '<div class="owl-carousel">';
				foreach($galerie as $image_id) :
					echo '<div class="logo">';
					echo wp_get_attachment_image( $image_id, 'medium');
					echo '</div>';
				endforeach;
			echo '</div>';
	
		echo '</section>';
	endif;

endif;