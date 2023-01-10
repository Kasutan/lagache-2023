<?php 
/**
* Template pour le bloc Carrousel de logos des membres
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
	$label=wp_kses_post( get_field('label') );
	$cible=esc_url( get_field('cible') );

	$posts=get_posts(array(
		'post_type'=>'sdds_membres',
		'numberposts'=>-1,
		'orderby'=>'rand'
	));

	if($posts) : 
		printf('<section class="carrousel %s">',$className);
		if($titre) printf('<h2 class="titre-section">%s</h2>',$titre);
		echo '<div class="owl-carousel">';
			foreach ($posts as $post_id) :
				if(has_post_thumbnail( $post_id )) {
					printf('<div class="slide logo">%s</div>',
						get_the_post_thumbnail($post_id));
				}
			endforeach;
		echo '</div>';
		if($label && $cible) {
			printf('<div class="flex-center"><a href="%s" class="bouton">%s</a></div>',$cible, $label);
		}
		echo '</section>';
	endif;

endif;