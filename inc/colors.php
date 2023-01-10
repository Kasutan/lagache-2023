<?php
/**
 * Register Custom color palette for Gutenberg editor
 *
 * Should be the colors from css/colors.css.
 *
 * @package kasutan
 */

add_theme_support( 'editor-color-palette', array(
	array(
		'name'  =>'Bleu',
		'slug'  => 'bleu',
		'color'	=> '#2F80ED',
	),
	array(
		'name'  =>'Orange',
		'slug'  => 'orange',
		'color'	=> '#FC950F',
	),
	array(
		'name'  =>'Fond orange pastel',
		'slug'  => 'fond',
		'color'	=> '#FFF6EB',
	),
	array(
		'name'  =>'Gris foncé',
		'slug'  => 'gris',
		'color'	=> '#282828',
	),
	array(
		'name'  =>'Gris (texte)',
		'slug'  => 'gris-texte',
		'color'	=> '#333333',
	),
	array(
		'name'  =>'Blanc',
		'slug'  => 'blanc',
		'color'	=> '#ffffff',
	),
	array(
		'name'  =>'Noir',
		'slug'  => 'noir',
		'color'	=> '#101631',
	),
));