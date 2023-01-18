<?php 
/**
* Template pour le bloc newsletter
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
$image_id=wp_kses_post( get_field('image') );
$image_id_mobile=wp_kses_post( get_field('image_mobile') );
$shortcode=wp_kses_post(get_field('texte')) ;

printf('<section class="acf newsletter %s">', $className);
	echo '<div class="image desktop">';
	echo wp_get_attachment_image( $image_id, 'banniere');
	echo '</div>';
	echo '<div class="image mobile">';
	echo wp_get_attachment_image( $image_id_mobile, 'large');
	echo '</div>';
	printf('<h2 class="titre-section h1 has-blanc-color">%s</h2>',$titre);
	echo '<div class="form-wrap">';
		echo do_shortcode($shortcode);
	echo '</div>';

echo '</section>';
	