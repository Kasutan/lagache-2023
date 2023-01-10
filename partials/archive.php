<?php
/**
 * Archive partial
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

//On récupère une éventuelle info sur le tag html passée en $args de get_template_part
$tag='li';
if(!empty($args) && array_key_exists('tag',$args)) {
	$tag=$args['tag'];
}

printf('<%s class="post-summary">',$tag);

	ea_post_summary_image('medium');

	echo '<div class="post-summary__content">';
		ea_entry_category('archive');
		printf('<p class="entry-date"><img class="picto-date" alt="picto calendrier" src="%s/icons/today.png" width="22" height="22"/>%s</p>',get_stylesheet_directory_uri(  ), get_the_date('d F Y'));
		ea_post_summary_title();
		$extrait=wpautop(get_the_excerpt());
		printf('<div class="extrait">%s</div>',$extrait);

		$content=apply_filters('the_content',get_the_content());
		$p1=strpos($content,'</p>');
		$p2=strpos($content,'</p>',$p1+5);
		if($p2) {
			$content=substr($content,0,$p2+4);
		}
		printf('<div class="debut-content">%s <a href="%s" class="suite-content bouton">Lire la suite<span class="screen-reader-text"> de %s</span></a></div>',$content,esc_url( get_permalink( ) ),
		get_the_title( ));
		
	echo '</div>';

printf('</%s>',$tag);

