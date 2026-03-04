<?php
/**
 * Custom Post Type: Experte
 *
 * @package Zeen_Child
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Type: Experte
 */
if ( ! function_exists( 'dsc_register_experte_post_type' ) ) {
    function dsc_register_experte_post_type() {
        
        // Labels for the custom post type
        $labels = [
            'name'                  => __( 'Experten', 'zeen-child' ),
            'singular_name'         => __( 'Experte', 'zeen-child' ),
            'menu_name'             => __( 'Experten', 'zeen-child' ),
            'name_admin_bar'        => __( 'Experte', 'zeen-child' ),
            'archives'              => __( 'Experten Archive', 'zeen-child' ),
            'attributes'            => __( 'Experten Eigenschaften', 'zeen-child' ),
            'parent_item_colon'     => __( 'Übergeordneter Experte:', 'zeen-child' ),
            'all_items'             => __( 'Alle Experten', 'zeen-child' ),
            'add_new_item'          => __( 'Neuen Experten hinzufügen', 'zeen-child' ),
            'add_new'               => __( 'Neu hinzufügen', 'zeen-child' ),
            'new_item'              => __( 'Neuer Experte', 'zeen-child' ),
            'edit_item'             => __( 'Experte bearbeiten', 'zeen-child' ),
            'update_item'           => __( 'Experte aktualisieren', 'zeen-child' ),
            'view_item'             => __( 'Experte anzeigen', 'zeen-child' ),
            'view_items'            => __( 'Experten anzeigen', 'zeen-child' ),
            'search_items'          => __( 'Experte suchen', 'zeen-child' ),
            'not_found'             => __( 'Nicht gefunden', 'zeen-child' ),
            'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'zeen-child' ),
            'featured_image'        => __( 'Profilbild', 'zeen-child' ),
            'set_featured_image'    => __( 'Profilbild festlegen', 'zeen-child' ),
            'remove_featured_image' => __( 'Profilbild entfernen', 'zeen-child' ),
            'use_featured_image'    => __( 'Als Profilbild verwenden', 'zeen-child' ),
            'insert_into_item'      => __( 'In Experten einfügen', 'zeen-child' ),
            'uploaded_to_this_item' => __( 'Zu diesem Experten hochgeladen', 'zeen-child' ),
            'items_list'            => __( 'Experten Liste', 'zeen-child' ),
            'items_list_navigation' => __( 'Experten Listen Navigation', 'zeen-child' ),
            'filter_items_list'     => __( 'Experten Liste filtern', 'zeen-child' ),
        ];

        // Arguments for the custom post type
        $args = [
            'label'                => __( 'Experte', 'zeen-child' ),
            'description'          => __( 'Schönheitschirurgen und Experten', 'zeen-child' ),
            'labels'               => $labels,
            'supports'             => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
            'taxonomies'           => [],
            'hierarchical'         => false,
            'public'               => true,
            'show_ui'              => true,
            'show_in_menu'         => true,
            'menu_position'        => 20,
            'menu_icon'            => 'dashicons-businessperson',
            'show_in_admin_bar'    => true,
            'show_in_nav_menus'    => true,
            'can_export'           => true,
            'has_archive'          => true,
            'exclude_from_search'  => false,
            'publicly_queryable'   => true,
            'show_in_rest'         => true,
            'rewrite'              => [
                'slug'       => 'experten',
                'with_front' => false,
            ],
        ];

        // Register the post type
        register_post_type( 'experte', $args );
    }
}

// Hook into the 'init' action
add_action( 'init', 'dsc_register_experte_post_type', 0 );

/**
 * Flush rewrite rules on theme activation
 */
if ( ! function_exists( 'dsc_flush_rewrite_rules_on_activation' ) ) {
    function dsc_flush_rewrite_rules_on_activation() {
        // Register post types first
        dsc_register_experte_post_type();
        
        // Then flush rewrite rules
        flush_rewrite_rules();
    }
}

// Hook into theme activation
add_action( 'after_switch_theme', 'dsc_flush_rewrite_rules_on_activation' );