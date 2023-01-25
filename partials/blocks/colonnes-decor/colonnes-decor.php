<?php 
/**
* Template pour le bloc colonnes-decor
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
$bloc=wp_kses_post( get_field('bloc') );
$image_id=esc_attr( get_field('image') );
$couleur=esc_attr( get_field('couleur') );
$cote_image=esc_attr( get_field('cote_image') );

printf('<section class="acf colonnes-decor %s %s %s">', $className,$couleur,$cote_image);
	
	echo '<div class="decor">';
		include('decor-xl.php');
	echo '</div>';
	if(function_exists('kasutan_affiche_decor_svg')) {
		//kasutan_affiche_decor_svg('decor-xl');
	}
	
	echo '<div class="col-texte">';
		if($titre) printf('<h2 class="titre-section h1 has-%s-color">%s</h2>',$couleur,$titre);
		if($texte) printf('<div class="texte">%s</div>',$texte);

		if(!empty($lien)) {
			$target_atts='';
			if(!empty($lien['target']) && esc_attr($lien['target'])==='_blank') {
				$target_atts='target="_blank" rel="noopener noreferrer"';
			}
			printf('<a href="%s" class="bouton %s" %s>%s</a>',
				esc_url($lien['url']),
				$couleur,
				$target_atts,
				wp_kses_post( $lien['title'] )
			);
		}
	echo '</div>';
	echo '<div class="col-image">';
		echo '<div class="image">';
			echo wp_get_attachment_image( $image_id, 'medium_large');
		echo '</div>';
		if($bloc) {
			printf('<p class="bloc has-%s-background-color">%s</p>',$couleur,$bloc);
		}
	echo '</div>';


echo '</section>';
	