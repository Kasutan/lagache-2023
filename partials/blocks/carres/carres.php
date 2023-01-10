<?php 
/**
* Template pour le bloc Carrés
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
	if(have_rows('carres')) : 
		printf('<section class="carres %s">',$className);
		
			$titre_section=wp_kses_post(get_field('titre_section'));
			if($titre_section) printf('<h2 class="screen-reader-text">%s</h2>',$titre_section);

			echo '<div class="liste-carres">';
			while ( have_rows('carres') ) : the_row();
				$picto=esc_attr( get_sub_field('picto') );
				$picto_survol=esc_attr( get_sub_field('picto_survol') );
				$titre=wp_kses_post(get_sub_field('titre'));
				$texte=wp_kses_post(get_sub_field('texte'));
				$cible=esc_url( get_sub_field('cible') );

				
				printf('<a class="carre" href="%s">',$cible);
					printf('<div class="picto"><div class="base">%s</div><div class="survol">%s</div></div>',wp_get_attachment_image( $picto, 'thumbnail'),wp_get_attachment_image( $picto_survol, 'thumbnail'));
					printf('<h3 class="titre">%s</h3>',$titre);
					printf('<div class="texte">%s</div>',$texte);
					echo '<span class="chevrons">>>></span>';
				echo '</a>';

			endwhile;
			echo '</div>';

		echo '</section>';
	endif;

endif;