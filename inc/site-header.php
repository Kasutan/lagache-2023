<?php
add_action('tha_header_top','kasutan_header_top');
function kasutan_header_top() {
	if(!function_exists('get_field')) {
		return;
	}
	$lien=get_field('lagache_acces_client','option');
	if(empty($lien)) {
		return;
	}
	printf('<a href="%s" class="acces-client" target="%s" rel="noopener noreferrer">%s</a>',
		esc_url($lien['url']),
		esc_attr($lien['target']),
		wp_kses_post( $lien['title'] )
	);

}