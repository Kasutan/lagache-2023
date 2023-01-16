<?php 
/**
* Template pour le bloc banniere
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$texte=wp_kses_post( get_field('texte') );
$image_id=esc_attr( get_field('image') );

printf('<section class="acf banniere %s">', $className);
	echo '<div class="image">';
		echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));
	echo '</div>';

	printf('<div class="texte"><div class="decor"></div><p>%s</p></div>',$texte);

echo '</section>';
	