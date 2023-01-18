<?php 
/**
* Template pour le bloc intro-produits
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
$images=[];
for($i=1;$i<=3;$i++) {
	$images[$i]=esc_attr( get_field('image'.$i) );
}
$couleur=esc_attr( get_field('couleur') );

printf('<section class="acf intro-produits %s has-%s-background-color">', $className,$couleur);

	echo '<div class="col-texte">';
		if($titre) printf('<h2 class="titre-section h1 has-blanc-color">%s</h2>',$titre);
		if($texte) printf('<div class="texte has-blanc-color">%s</div>',$texte);

		if(!empty($lien)) {
			printf('<a href="%s" class="bouton blanc has-%s-color" target="%s" rel="noopener noreferrer">%s</a>',
				esc_url($lien['url']),
				$couleur,
				esc_attr($lien['target']),
				wp_kses_post( $lien['title'] )
			);
		}
	echo '</div>';
	echo '<div class="col-images"><div class="images">';
		for($i=1;$i<=3;$i++) {
			printf('<div class="image image-%s">%s</div>', $i,wp_get_attachment_image( $images[$i], 'medium'));
		}
	echo '</div></div>';


echo '</section>';
	