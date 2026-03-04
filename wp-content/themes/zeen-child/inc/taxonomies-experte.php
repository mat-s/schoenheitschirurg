<?php

/**
 * Custom Taxonomies for Experte Post Type
 *
 * @package Zeen_Child
 */

// Prevent direct access
if (! defined('ABSPATH')) {
  exit;
}

/**
 * Register Custom Taxonomy: Stadt (City)
 */
if (! function_exists('dsc_register_stadt_taxonomy')) {
  function dsc_register_stadt_taxonomy()
  {

    // Labels for Stadt taxonomy
    $labels = [
      'name'                       => __('Städte', 'zeen-child'),
      'singular_name'              => __('Stadt', 'zeen-child'),
      'menu_name'                  => __('Städte', 'zeen-child'),
      'all_items'                  => __('Alle Städte', 'zeen-child'),
      'parent_item'                => __('Übergeordnete Stadt', 'zeen-child'),
      'parent_item_colon'          => __('Übergeordnete Stadt:', 'zeen-child'),
      'new_item_name'              => __('Neue Stadt', 'zeen-child'),
      'add_new_item'               => __('Stadt hinzufügen', 'zeen-child'),
      'edit_item'                  => __('Stadt bearbeiten', 'zeen-child'),
      'update_item'                => __('Stadt aktualisieren', 'zeen-child'),
      'view_item'                  => __('Stadt anzeigen', 'zeen-child'),
      'separate_items_with_commas' => __('Städte mit Kommas trennen', 'zeen-child'),
      'add_or_remove_items'        => __('Städte hinzufügen oder entfernen', 'zeen-child'),
      'choose_from_most_used'      => __('Aus den meistgenutzten Städten wählen', 'zeen-child'),
      'popular_items'              => __('Beliebte Städte', 'zeen-child'),
      'search_items'               => __('Städte suchen', 'zeen-child'),
      'not_found'                  => __('Nicht gefunden', 'zeen-child'),
      'no_terms'                   => __('Keine Städte', 'zeen-child'),
      'items_list'                 => __('Städte Liste', 'zeen-child'),
      'items_list_navigation'      => __('Städte Listen Navigation', 'zeen-child'),
    ];

    // Arguments for Stadt taxonomy
    $args = [
      'labels'                => $labels,
      'hierarchical'          => true,
      'public'                => true,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'show_in_nav_menus'     => true,
      'show_tagcloud'         => true,
      'show_in_rest'          => true,
      'rewrite'               => [
        'slug' => 'experten/stadt',
        'with_front' => false,
      ],
    ];

    // Register the taxonomy
    register_taxonomy('stadt', ['experte'], $args);
  }
}

/**
 * Register Custom Taxonomy: Eingriff (Procedure)
 */
if (! function_exists('dsc_register_eingriff_taxonomy')) {
  function dsc_register_eingriff_taxonomy()
  {

    // Labels for Eingriff taxonomy
    $labels = [
      'name'                       => __('Eingriffe', 'zeen-child'),
      'singular_name'              => __('Eingriff', 'zeen-child'),
      'menu_name'                  => __('Eingriffe', 'zeen-child'),
      'all_items'                  => __('Alle Eingriffe', 'zeen-child'),
      'parent_item'                => __('Übergeordneter Eingriff', 'zeen-child'),
      'parent_item_colon'          => __('Übergeordneter Eingriff:', 'zeen-child'),
      'new_item_name'              => __('Neuer Eingriff', 'zeen-child'),
      'add_new_item'               => __('Eingriff hinzufügen', 'zeen-child'),
      'edit_item'                  => __('Eingriff bearbeiten', 'zeen-child'),
      'update_item'                => __('Eingriff aktualisieren', 'zeen-child'),
      'view_item'                  => __('Eingriff anzeigen', 'zeen-child'),
      'separate_items_with_commas' => __('Eingriffe mit Kommas trennen', 'zeen-child'),
      'add_or_remove_items'        => __('Eingriffe hinzufügen oder entfernen', 'zeen-child'),
      'choose_from_most_used'      => __('Aus den meistgenutzten Eingriffen wählen', 'zeen-child'),
      'popular_items'              => __('Beliebte Eingriffe', 'zeen-child'),
      'search_items'               => __('Eingriffe suchen', 'zeen-child'),
      'not_found'                  => __('Nicht gefunden', 'zeen-child'),
      'no_terms'                   => __('Keine Eingriffe', 'zeen-child'),
      'items_list'                 => __('Eingriffe Liste', 'zeen-child'),
      'items_list_navigation'      => __('Eingriffe Listen Navigation', 'zeen-child'),
    ];

    // Arguments for Eingriff taxonomy
    $args = [
      'labels'                => $labels,
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'show_in_nav_menus'     => true,
      'show_tagcloud'         => true,
      'show_in_rest'          => true,
      'rewrite'               => [
        'slug'       => 'experten/eingriff',
        'with_front' => false,
      ],
    ];

    // Register the taxonomy
    register_taxonomy('eingriff', ['experte'], $args);
  }
}

/**
 * Register Custom Taxonomy: Anbieter-Typ (Provider Type)
 */
if (! function_exists('dsc_register_anbieter_typ_taxonomy')) {
  function dsc_register_anbieter_typ_taxonomy()
  {

    // Labels for Anbieter-Typ taxonomy
    $labels = [
      'name'                       => __('Anbieter-Typen', 'zeen-child'),
      'singular_name'              => __('Anbieter-Typ', 'zeen-child'),
      'menu_name'                  => __('Anbieter-Typen', 'zeen-child'),
      'all_items'                  => __('Alle Anbieter-Typen', 'zeen-child'),
      'parent_item'                => __('Übergeordneter Anbieter-Typ', 'zeen-child'),
      'parent_item_colon'          => __('Übergeordneter Anbieter-Typ:', 'zeen-child'),
      'new_item_name'              => __('Neuer Anbieter-Typ', 'zeen-child'),
      'add_new_item'               => __('Anbieter-Typ hinzufügen', 'zeen-child'),
      'edit_item'                  => __('Anbieter-Typ bearbeiten', 'zeen-child'),
      'update_item'                => __('Anbieter-Typ aktualisieren', 'zeen-child'),
      'view_item'                  => __('Anbieter-Typ anzeigen', 'zeen-child'),
      'separate_items_with_commas' => __('Anbieter-Typen mit Kommas trennen', 'zeen-child'),
      'add_or_remove_items'        => __('Anbieter-Typen hinzufügen oder entfernen', 'zeen-child'),
      'choose_from_most_used'      => __('Aus den meistgenutzten Anbieter-Typen wählen', 'zeen-child'),
      'popular_items'              => __('Beliebte Anbieter-Typen', 'zeen-child'),
      'search_items'               => __('Anbieter-Typen suchen', 'zeen-child'),
      'not_found'                  => __('Nicht gefunden', 'zeen-child'),
      'no_terms'                   => __('Keine Anbieter-Typen', 'zeen-child'),
      'items_list'                 => __('Anbieter-Typen Liste', 'zeen-child'),
      'items_list_navigation'      => __('Anbieter-Typen Listen Navigation', 'zeen-child'),
    ];

    // Arguments for Anbieter-Typ taxonomy
    $args = [
      'labels'                => $labels,
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'show_in_nav_menus'     => true,
      'show_tagcloud'         => true,
      'show_in_rest'          => true,
      'rewrite'               => [
        'slug'       => 'experten/anbieter-typ',
        'with_front' => false,
      ],
    ];

    // Register the taxonomy
    register_taxonomy('anbieter-typ', ['experte'], $args);
  }
}

/**
 * Register all taxonomies
 */
if (! function_exists('dsc_register_experte_taxonomies')) {
  function dsc_register_experte_taxonomies()
  {
    dsc_register_stadt_taxonomy();
    dsc_register_eingriff_taxonomy();
    dsc_register_anbieter_typ_taxonomy();
  }
}

// Hook into the 'init' action
add_action('init', 'dsc_register_experte_taxonomies', 0);

/**
 * Flush rewrite rules on theme activation for taxonomies
 */
if (! function_exists('dsc_flush_taxonomy_rewrite_rules')) {
  function dsc_flush_taxonomy_rewrite_rules()
  {
    // Register taxonomies first
    dsc_register_experte_taxonomies();

    // Then flush rewrite rules
    flush_rewrite_rules();
  }
}

// Hook into theme activation
add_action('after_switch_theme', 'dsc_flush_taxonomy_rewrite_rules');


/**
 * Custom rewrite rules for experten taxonomies
 *
 * Reason:
 * We enforce explicit and prioritized rewrite rules to avoid
 * conflicts with the CPT single rule:
 * experten/([^/]+)/?$
 *
 * By using priority "top", these rules are evaluated before
 * the generic CPT rewrite rule.
 *
 * Structure:
 * /experten/stadt/{term}/
 * /experten/eingriff/{term}/
 * /experten/anbieter-typ/{term}/
 */
add_action('init', function () {

  /**
   * Stadt taxonomy archive
   * Example: /experten/stadt/berlin/
   */
  add_rewrite_rule(
    '^experten/stadt/([^/]+)/?$',
    'index.php?stadt=$matches[1]',
    'top'
  );

  /**
   * Eingriff taxonomy archive
   * Example: /experten/eingriff/nasenkorrektur/
   */
  add_rewrite_rule(
    '^experten/eingriff/([^/]+)/?$',
    'index.php?eingriff=$matches[1]',
    'top'
  );

  /**
   * Anbieter-Typ taxonomy archive
   * Example: /experten/anbieter-typ/klinik/
   */
  add_rewrite_rule(
    '^experten/anbieter-typ/([^/]+)/?$',
    'index.php?anbieter-typ=$matches[1]',
    'top'
  );

}, 20);
