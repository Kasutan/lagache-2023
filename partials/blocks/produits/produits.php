<?php 
/**
* Template pour le bloc produits
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
	$titre=wp_kses_post( get_field('nom') );
	$image_id=esc_attr( get_field('image_principale') );
	$couleur=esc_attr( get_field('couleur') );
	$rand=rand(0,1000);

	$autres_photos=false;
	if(have_rows('produits')) {
		$autres_photos=true;
	}


	printf('<section class="produits %s">',$className);
		echo '<div class="image-principale">';
			echo '<div class="image">';
				echo wp_get_attachment_image( $image_id, 'large');
			echo '</div>';

			printf('<h2 class="titre" style="background-color:%s">%s</h2>',$couleur,$titre);

			if($autres_photos) {
				printf('<button class="bouton toggle" aria-expanded="false" aria-controls="volet-%s"><span class="screen-reader-text">Basculer l\'affichage d\'autres photos de produit</span>
				</button>',$rand);
			}
			
		echo '</div>';
		if($autres_photos) : 

			printf('<ul id="volet-%s" class="autres-photos js-show" aria-expanded="false">',$rand);
			while ( have_rows('produits') ) : the_row();
				$photo=esc_attr( get_sub_field('image') );
				$nom=esc_attr( get_sub_field('nom') );
				
				printf('<li class="produit">');
					printf('<div class="photo">%s</div>',wp_get_attachment_image( $photo, 'medium_large'));
					printf('<h3 class="nom">%s</h3>',$nom);
				echo '</li>';

			endwhile;
			echo '</ul>';

		echo '</section>';
	endif;

endif;