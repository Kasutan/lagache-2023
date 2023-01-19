<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function kasutan_collaborateur_affiche_carte($post_id) {
	$nom=get_the_title($post_id);
	$fonction=$tel=$mobile=$email=false;

	if(function_exists('get_field')) {
		$fonction=wp_kses_post(get_field('fonction',$post_id));
		$tel=wp_kses_post(get_field('tel',$post_id));
		$mobile=wp_kses_post(get_field('mobile',$post_id));
		$email=wp_kses_post(get_field('email',$post_id));
	}
	echo '<li class="personne">';
		printf('<div class="image">%s</div>',get_the_post_thumbnail( $post_id, 'thumbnail'));
		echo '<div class="texte">';
			printf('<h3 class="nom has-vert-color">%s</h3>',$nom);
			if($fonction) printf('<p class="fonction">%s</p>',$fonction);
			if($tel) printf('<a class="tel" href="tel:%s">Tél.&nbsp;: %s</a>',$tel,$tel);
			if($mobile) printf('<a class="mobile" href="tel:%s">Mobile.&nbsp;: %s</a>',$mobile,$mobile);
			if($email) printf('<a class="email" href="mailto:%s">Mail&nbsp;: %s</a>',antispambot($email),antispambot($email));
			
		echo '</div>';
	echo '</li>';
}