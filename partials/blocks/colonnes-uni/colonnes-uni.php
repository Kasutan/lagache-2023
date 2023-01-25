<?php 
/**
* Template pour le bloc colonnes-uni
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre=wp_kses_post( get_field('titre') );
$texte=wp_kses_post( get_field('texte') );
$lien=get_field('lien') ;
$image_id=esc_attr( get_field('image') );
$couleur=esc_attr( get_field('couleur') );
$cote_image=esc_attr( get_field('cote_image') );

printf('<section class="acf colonnes-uni %s %s %s">', $className,$couleur,$cote_image);
	
	printf('<div class="col-texte has-%s-background-color">',$couleur);
		if($titre) printf('<h2 class="titre-section h1 has-blanc-color">%s</h2>',$titre);
		if($texte) printf('<div class="texte has-blanc-color">%s</div>',$texte);

		if(!empty($lien)) {
			$target_atts='';
			if(!empty($lien['target']) && esc_attr($lien['target'])==='_blank') {
				$target_atts='target="_blank" rel="noopener noreferrer"';
			}

			printf('<a href="%s" class="bouton blanc has-%s-color" %s>%s</a>',
				esc_url($lien['url']),
				$couleur,
				$target_atts,
				wp_kses_post( $lien['title'] )
			);
		}
	echo '</div>';
	echo '<div class="col-image">';
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'large');
		echo '</div>';
		
	echo '</div>';


echo '</section>';
	