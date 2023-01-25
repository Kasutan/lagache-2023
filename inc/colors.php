<?php
/**
 * Register Custom color palette for Gutenberg editor
 *
 * Should be the colors from css/colors.css.
 *
 * @package kasutan
 */

$colors_sass=array('blanc'=>'#fff', 
'vert' =>'#3A7C32', 
'rouge' =>'#C03419',
'orange' =>'#DF9240', 
'gris' =>'rgba(0,0,0,0.6)',
'texte' =>'rgba(0,0,0,0.9)',
'bordure' =>'rgba(0,0,0,0.4)',
'noir' =>'#000000');

$colors_editor=array();

foreach($colors_sass as $nom=>$couleur) {
	$colors_editor[]=array('name'=>$nom,'slug'=>$nom,'color'=>$couleur);
}

add_theme_support( 'editor-color-palette',$colors_editor);