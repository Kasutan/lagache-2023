<?php
if ( ! defined( 'ABSPATH' ) ) exit;

//Affiche nom et fonctions (utile pour Conseil d'Administration et section pilote de single groupe de travail)
function kasutan_pilote_affiche_fonctions($post_id,$nom='') {
	if(empty($nom)) {
		$nom=get_the_title($post_id);
	}
	$fonction=$entreprise=$fonctions_lagache=false;
	if(function_exists('get_field')) {
		$fonction=wp_kses_post(get_field('fonction',$post_id));
		$entreprise=wp_kses_post(get_field('entreprise',$post_id));
		$fonctions_lagache=wp_kses_post(get_field('fonctions_lagache',$post_id));
	}
	echo '<div class="infos">';
		printf('<h3 class="nom">%s</h3>',$nom);
		if($fonction) printf('<p class="fonction">%s</p>',$fonction);
		if($entreprise) printf('<p class="entreprise">%s</p>',$entreprise);
		if($fonctions_lagache) printf('<div class="fonctions-lagache">%s</div>',$fonctions_lagache);
	echo '</div>';
}

//Affiche carte pour CA
function kasutan_pilote_affiche_carte($post_id) {
	$nom=get_the_title($post_id);

	$email=false; 
	if(function_exists('get_field')) {
		$email=esc_attr(get_field('email',$post_id));
	}
	echo '<li class="carte">';
		printf('<div class="image">%s</div>',get_the_post_thumbnail($post_id,'thumbnail',array('alt'=>$nom)));
		kasutan_pilote_affiche_fonctions($post_id,$nom);
		if($email && function_exists('kasutan_picto')) {
			$email=antispambot( $email);
			printf('<a href="mailto:%s" title="Envoyer un message à %s">%s</a>', 
				$email,
				$nom,
				kasutan_picto(array('icon'=>'mail','size'=>28))
			);
		}
	echo '</li>';
}