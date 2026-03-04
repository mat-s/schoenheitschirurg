<?php
/**
 * Zeen Child Theme functions and definitions.
 */
function zeen_child_enqueue_styles() {
wp_enqueue_style( 'zeen-child-style' , get_stylesheet_directory_uri() . '/style.css', array( 'zeen-style' ), ZEEN_VERSION );
}
add_action(  'wp_enqueue_scripts', 'zeen_child_enqueue_styles' );

/**
 * Include Custom Post Types and Taxonomies
 */
require_once get_stylesheet_directory() . '/inc/cpt-experte.php';
require_once get_stylesheet_directory() . '/inc/taxonomies-experte.php';
require_once get_stylesheet_directory() . '/inc/customizer-experte.php';
