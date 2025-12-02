<?php 
$label="Votre recherche...";
$submit="Rechercher";
$placeholder="Votre recherche";
$action="/";

if(KPLL && pll_current_language()=='en') {
	$label="Your search...";
	$submit="Search";
	$placeholder="Your search";
	$action='/en/';
}

printf('<form role="search" method="get" class="search-form" action="%s" >
			<label>
				<span class="screen-reader-text">%s</span>
				<input class="search-field" 
				placeholder="%s" value="" name="s" type="search"></label>
			<input class="search-submit" value="%s" type="submit">
		</form>',
		$action,
		$label,
		$placeholder,
		$submit
);