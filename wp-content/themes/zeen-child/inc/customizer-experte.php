<?php
/**
 * Experten Customizer settings and filters.
 *
 * @package Zeen_Child
 */

/**
 * Set archive layout for Experte CPT.
 */
add_filter( 'zeen_archive_default_layout', function( $layout ) {
	if ( is_post_type_archive( 'experte' ) ) {
		return (int) get_theme_mod( 'experte_layout', 24 );
	}
	return $layout;
} );

/**
 * Customizer: Add Experten layout sections.
 */
add_action( 'customize_register', function( $wp_customize ) {
	if ( ! class_exists( 'Zeen_Control_Title' ) || ! function_exists( 'zeen_customizer_archive_options' ) ) {
		return;
	}

	$src_uri = get_parent_theme_file_uri( 'assets/admin/img/' );

	$wp_customize->add_section(
		new Zeen_Section_Title(
			$wp_customize,
			'experte_layouts',
			array(
				'title' => esc_html__( 'Experten', 'zeen' ),
			)
		)
	);

	$wp_customize->add_section(
		'section_experte',
		array(
			'title' => esc_html__( 'Experten-Archiv', 'zeen' ),
		)
	);

	$wp_customize->add_section(
		'section_experte_stadt',
		array(
			'title' => esc_html__( 'Städte', 'zeen' ),
		)
	);

	$wp_customize->add_section(
		'section_experte_eingriff',
		array(
			'title' => esc_html__( 'Eingriffe', 'zeen' ),
		)
	);

	$wp_customize->add_section(
		'section_experte_anbieter_typ',
		array(
			'title' => esc_html__( 'Anbieter-Typen', 'zeen' ),
		)
	);

	zeen_customizer_archive_options( $wp_customize, 'section_experte', $src_uri, 'experte' );
	zeen_customizer_archive_options( $wp_customize, 'section_experte_stadt', $src_uri, 'experte_stadt' );
	zeen_customizer_archive_options( $wp_customize, 'section_experte_eingriff', $src_uri, 'experte_eingriff' );
	zeen_customizer_archive_options( $wp_customize, 'section_experte_anbieter_typ', $src_uri, 'experte_anbieter_typ' );
}, 100 );

/**
 * Use Experten taxonomy-specific customizer options on related archives.
 *
 * @param mixed  $value  Current theme mod value.
 * @param string $suffix Setting suffix (layout, image_shape, fs, flipstack, sidebar, sorter_default, pagination).
 * @return mixed
 */
function zeen_child_experte_tax_mod( $value, $suffix ) {
	if ( is_tax( 'stadt' ) ) {
		$prefix = 'experte_stadt';
	} elseif ( is_tax( 'eingriff' ) ) {
		$prefix = 'experte_eingriff';
	} elseif ( is_tax( 'anbieter-typ' ) ) {
		$prefix = 'experte_anbieter_typ';
	} else {
		return $value;
	}

	$override = get_theme_mod( $prefix . '_' . $suffix, '' );
	if ( '' === $override || null === $override ) {
		return $value;
	}
	return $override;
}

add_filter( 'theme_mod_tax_layout', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'layout' );
} );

add_filter( 'theme_mod_tax_image_shape', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'image_shape' );
} );

add_filter( 'theme_mod_tax_fs', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'fs' );
} );

add_filter( 'theme_mod_tax_flipstack', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'flipstack' );
} );

add_filter( 'theme_mod_tax_sidebar', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'sidebar' );
} );

add_filter( 'theme_mod_tax_sorter_default', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'sorter_default' );
} );

add_filter( 'theme_mod_tax_pagination', function( $value ) {
	return zeen_child_experte_tax_mod( $value, 'pagination' );
} );
