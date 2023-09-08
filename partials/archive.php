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

	ea_post_summary_image('medium_large');

	echo '<div class="post-summary__content">';
		ea_entry_category('archive');

		if(function_exists('kasutan_cat_pour_filtre')) {
			kasutan_cat_pour_filtre();
		}
		
		ea_post_summary_title();

		printf('<p class="entry-date">%s</p>', get_the_date('d F Y'));

		$extrait=wpautop(get_the_excerpt());
		printf('<div class="extrait">%s</div>',$extrait);

		printf('<a href="%s" class="bouton suite" title="Lire cet article"><span class="screen-reader-text">Lire %s</span>
			<svg xmlns="http://www.w3.org/2000/svg" width="11" height="19" viewBox="0 0 10.969 18.81"><path d="M87.666,41.75l7.407-7.407a.593.593,0,0,0,0-.867l-.942-.942a.592.592,0,0,0-.867,0l-8.783,8.783a.593.593,0,0,0,0,.867l8.783,8.783a.592.592,0,0,0,.867,0l.942-.942a.593.593,0,0,0,0-.867Z" transform="translate(95.262 51.155) rotate(180)" fill="#ffffff"/></svg>
		</a>',esc_url( get_permalink( ) ),get_the_title( ));
		
	echo '</div>';

printf('</%s>',$tag);

