<?php 
/**
* Template pour le bloc Encadrés
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

	if(have_rows('encadres')) : 
		printf('<section class="encadres %s">',$className);

			echo '<ul class="liste-encadres">';
			while ( have_rows('encadres') ) : the_row();
				$picto=esc_attr( get_sub_field('picto') );
				$titre=wp_kses_post(get_sub_field('titre'));
				$texte=wp_kses_post(get_sub_field('texte'));
				$lien_label=wp_kses_post(get_sub_field('lien_texte'));
				$lien_cible=esc_url(get_sub_field('lien_cible'));
				
				echo '<li class="encadre">';
					printf('<div class="picto">%s</div>',wp_get_attachment_image( $picto, 'medium'));
					printf('<h2 class="titre">%s</h2>',$titre);
					printf('<div class="texte">%s</div>',$texte);
					if($lien_cible && $lien_label) {
						printf('<p><a href="%s" class="lien" rel="noopener noreferrer" target="_blank">%s</a></p>',$lien_cible,$lien_label);
					}
				echo '</li>';
			endwhile;
			echo '</ul>';

		echo '</section>';
	endif;

endif;