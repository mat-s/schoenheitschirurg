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
require_once get_stylesheet_directory() . '/inc/settings-experte.php';

/**
 * ACF Flexible Content – Seitenmodule
 * Lädt die Feldgruppen-Definition (Code-based, kein DB-Import nötig).
 */
add_action( 'acf/init', function () {
    require_once get_stylesheet_directory() . '/inc/acf-flexible-content.php';
    require_once get_stylesheet_directory() . '/inc/acf-fields-experte-neu.php';
} );

/**
 * CSS für Flexible Page Templates nur laden wenn nötig.
 */
add_action( 'wp_enqueue_scripts', function () {
    if ( is_page_template( 'page-profil-erweitern.php' ) ) {
        wp_enqueue_style(
            'fp-flexible-page',
            get_stylesheet_directory_uri() . '/assets/css/page-flexible.css',
            [ 'zeen-child-style' ],
            '1.0.0'
        );
    }
} );
