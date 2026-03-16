<?php
/**
 * Archive template for Experte CPT.
 *
 * @package Zeen_Child
 */

get_header();

$preview = (int) get_theme_mod( 'experte_layout', 24 );

$fw_setting = get_theme_mod( 'experte_fs' );
if ( $preview > 80 ) {
	$fw = ( '' === $fw_setting ) ? true : ( (int) $fw_setting === 1 );
} else {
	$fw = false;
}

$allowed_img_shapes = array( '1', '21', '26', '27', '28', '61', '71', '72', '79' );
$img_shape = '';
if ( in_array( (string) $preview, $allowed_img_shapes, true ) ) {
	$img_shape = (int) get_theme_mod( 'experte_image_shape', 1 );
}

$allowed_flipstack = array( 61, 24, 26, 27, 28, 29, 64, 68, 2, 21, 71, 72, 79 );
$flipstack = '';
if ( in_array( $preview, $allowed_flipstack, true ) ) {
	$flipstack = (int) get_theme_mod( 'experte_flipstack' );
}

$fs            = empty( $fw ) ? 'off' : 'on';
$sidebar_check = zeen_sidebar_checker(
	array(
		'archive' => $preview,
	)
);

$supported_taxonomies = array( 'stadt', 'eingriff', 'anbieter-typ' );
$queried_term = null;

if ( is_tax( $supported_taxonomies ) ) {
	$queried_object = get_queried_object();
	if ( $queried_object instanceof WP_Term && in_array( $queried_object->taxonomy, $supported_taxonomies, true ) ) {
		$queried_term = $queried_object;
	}
}

$archive_title = $queried_term ? single_term_title( '', false ) : post_type_archive_title( '', false );
$archive_desc  = get_the_archive_description();
$archive_link  = get_post_type_archive_link( 'experte' );

if ( ! $archive_link ) {
	$archive_link = home_url( '/' );
}

/**
 * Render archive filter term links.
 *
 * @param array       $terms        Terms to render.
 * @param string      $label        Visible filter label.
 * @param string      $aria_label   Nav aria label.
 * @param WP_Term|null $queried_term Currently queried taxonomy term.
 */
function zeen_child_render_experte_filter_links( $terms, $label, $aria_label, $queried_term = null ) {
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return;
	}

	echo '<div class="experte-archive__filter-group">';
	echo '<p class="experte-archive__filter-label">' . esc_html( $label ) . '</p>';
	echo '<nav class="experte-archive__tag-nav" aria-label="' . esc_attr( $aria_label ) . '">';
	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term );
		if ( is_wp_error( $term_link ) ) {
			continue;
		}

		$active_class = '';
		if (
			$queried_term instanceof WP_Term &&
			$queried_term->taxonomy === $term->taxonomy &&
			(int) $queried_term->term_id === (int) $term->term_id
		) {
			$active_class = ' experte-archive__tag-link--active';
		}

		echo '<a class="experte-archive__tag-link' . esc_attr( $active_class ) . '" href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a>';
	}
	echo '</nav>';
	echo '</div>';
}

/**
 * Get placeholder image URL if file exists.
 *
 * @param string $filename
 * @return string
 */
function zeen_child_experte_placeholder_url( $filename ) {
	$path = trailingslashit( get_stylesheet_directory() ) . 'img/' . $filename;
	if ( file_exists( $path ) ) {
		return trailingslashit( get_stylesheet_directory_uri() ) . 'img/' . $filename;
	}
	return '';
}

/**
 * Render inline avatar placeholder.
 */
function zeen_child_experte_avatar_placeholder() {
	echo '<span class="experte-card__avatar-placeholder" aria-hidden="true">';
	echo '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">';
	echo '<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>';
	echo '</svg>';
	echo '</span>';
}

$avatar_placeholder_url = zeen_child_experte_placeholder_url( 'expert-avatar-placeholder.png' );
?>
<div id="primary" class="content-area expert-archive-page">
	<?php
	$contents_classes = 'contents-wrap standard-archive';
	if ( $sidebar_check ) {
		$sb_type = (int) get_theme_mod( 'experte_sidebar', 1 );
		if ( 2 === $sb_type ) {
			$contents_classes .= ' sidebar-left';
		} else {
			$contents_classes .= ' sidebar-right';
		}
	}
	$contents_classes .= ' clearfix';
	echo '<div id="contents-wrap" class="' . esc_attr( $contents_classes ) . '">';
	?>
		<nav class="expert-breadcrumb tipi-row" aria-label="<?php esc_attr_e( 'Breadcrumb', 'zeen-child' ); ?>">
			<a class="expert-breadcrumb__link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Startseite', 'zeen-child' ); ?></a>
			<span class="expert-breadcrumb__separator">&gt;</span>
			<a class="expert-breadcrumb__link" href="<?php echo esc_url( $archive_link ); ?>"><?php esc_html_e( 'Experten', 'zeen-child' ); ?></a>
			<?php if ( $queried_term ) : ?>
				<span class="expert-breadcrumb__separator">&gt;</span>
				<span class="expert-breadcrumb__current"><?php echo esc_html( $queried_term->name ); ?></span>
			<?php endif; ?>
		</nav>
		<?php
		if ( empty( $sidebar_check ) && ( $archive_title || $archive_desc ) ) {
			echo '<header class="archive-header">';
			if ( $archive_title ) {
				echo '<h1 class="archive-title">' . esc_html( $archive_title ) . '</h1>';
			}
			if ( $archive_desc ) {
				echo '<div class="archive-description">' . wp_kses_post( $archive_desc ) . '</div>';
			}
			echo '</header>';
		}
		?>
		<?php if ( empty( $fw ) ) { ?>
			<div class="tipi-row content-bg clearfix">
				<div class="tipi-cols clearfix sticky--wrap">
		<?php } ?>
		<?php zeen_ad( 'archive' ); ?>
		<?php
		echo '<main class="';
		zeen_classes(
			array(
				'preview'  => $preview,
				'complete' => 'off',
				'fw'       => $fw,
				'classes'  => 'main',
			)
		);
		echo '">';
		?>
			<?php
			if ( ! empty( $sidebar_check ) && ( $archive_title || $archive_desc ) ) {
				echo '<header class="archive-header">';
				if ( $archive_title ) {
					echo '<h1 class="archive-title">' . esc_html( $archive_title ) . '</h1>';
				}
				if ( $archive_desc ) {
					echo '<div class="archive-description">' . wp_kses_post( $archive_desc ) . '</div>';
				}
				echo '</header>';
			}

			$paged = max( 1, (int) get_query_var( 'paged' ) );

				$experte_args = array(
					'post_type'           => 'experte',
					'posts_per_page'      => (int) get_option( 'posts_per_page' ),
					'paged'               => $paged,
					'ignore_sticky_posts' => true,
					'no_found_rows'       => false,
					'experte_order'       => true,
				);

				if ( $queried_term ) {
					$experte_args['tax_query'] = array(
						array(
							'taxonomy' => $queried_term->taxonomy,
							'field'    => 'term_id',
							'terms'    => array( (int) $queried_term->term_id ),
						),
					);
				}

			$experte_posts_join = static function( $join, $query ) {
				if ( ! $query->get( 'experte_order' ) ) {
					return $join;
				}
				global $wpdb;
				return $join . " LEFT JOIN {$wpdb->postmeta} AS pm_experte_claim ON ({$wpdb->posts}.ID = pm_experte_claim.post_id AND pm_experte_claim.meta_key = 'claim_status')";
			};

			$experte_posts_orderby = static function( $orderby, $query ) {
				if ( ! $query->get( 'experte_order' ) ) {
					return $orderby;
				}
				global $wpdb;
				$case = "CASE WHEN pm_experte_claim.meta_value = 'premium' THEN 0 ELSE 1 END";
				return $case . ", {$wpdb->posts}.post_title ASC";
			};

				add_filter( 'posts_join', $experte_posts_join, 10, 2 );
				add_filter( 'posts_orderby', $experte_posts_orderby, 10, 2 );
				$experte_query = new WP_Query( $experte_args );
				remove_filter( 'posts_join', $experte_posts_join, 10 );
				remove_filter( 'posts_orderby', $experte_posts_orderby, 10 );

				$experte_count = (int) $experte_query->found_posts;
				$eingriff_filter_terms = get_terms(
					array(
						'taxonomy'   => 'eingriff',
						'hide_empty' => true,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);
				$stadt_filter_terms = get_terms(
					array(
						'taxonomy'   => 'stadt',
						'hide_empty' => true,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);
				$anbieter_typ_filter_terms = get_terms(
					array(
						'taxonomy'   => 'anbieter-typ',
						'hide_empty' => true,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);

				echo '<div class="experte-archive__meta">';
				printf(
					'<p class="experte-archive__count"><strong>%1$d</strong> %2$s</p>',
					$experte_count,
					esc_html__( 'Experten gefunden', 'zeen-child' )
				);

				echo '<div class="experte-archive__filters">';
				zeen_child_render_experte_filter_links(
					$eingriff_filter_terms,
					__( 'Behandlungsmethoden', 'zeen-child' ),
					__( 'Behandlungsmethoden Filter', 'zeen-child' ),
					$queried_term
				);
				zeen_child_render_experte_filter_links(
					$stadt_filter_terms,
					__( 'Städte', 'zeen-child' ),
					__( 'Städte Filter', 'zeen-child' ),
					$queried_term
				);
				zeen_child_render_experte_filter_links(
					$anbieter_typ_filter_terms,
					__( 'Anbieter-Typen', 'zeen-child' ),
					__( 'Anbieter-Typen Filter', 'zeen-child' ),
					$queried_term
				);
				echo '</div>';
				echo '</div>';

				if ( $experte_query->have_posts() ) :
					echo '<div class="experte-archive">';
				echo '<div class="experte-archive__grid">';
				while ( $experte_query->have_posts() ) :
					$experte_query->the_post();
					$experte_id = get_the_ID();

						$titel_name = function_exists( 'get_field' ) ? get_field( 'titel_name', $experte_id ) : '';
						$facharzttitel = function_exists( 'get_field' ) ? get_field( 'facharzttitel', $experte_id ) : '';
						$profilbild_id = function_exists( 'get_field' ) ? get_field( 'profilbild', $experte_id ) : '';
						$claim_status = function_exists( 'get_field' ) ? get_field( 'claim_status', $experte_id ) : get_post_meta( $experte_id, 'claim_status', true );
						$is_premium = ( $claim_status === 'premium' );
						$display_name = $titel_name ? $titel_name : get_the_title();

						$stadt_terms = get_the_terms( $experte_id, 'stadt' );
						$eingriff_terms = get_the_terms( $experte_id, 'eingriff' );
						$anbieter_typ_terms = get_the_terms( $experte_id, 'anbieter-typ' );
						$city_name = ( is_array( $stadt_terms ) && ! empty( $stadt_terms ) ) ? $stadt_terms[0]->name : '';

						$is_klinik = false;
						if ( is_array( $anbieter_typ_terms ) ) {
							foreach ( $anbieter_typ_terms as $anbieter_typ_term ) {
								if (
									false !== stripos( $anbieter_typ_term->slug, 'klinik' ) ||
									false !== stripos( $anbieter_typ_term->name, 'klinik' )
								) {
									$is_klinik = true;
									break;
								}
							}
						}

						$badge_text = $is_klinik ? __( 'Verifizierte Klinik', 'zeen-child' ) : __( 'Verifizierter Facharzt', 'zeen-child' );
						$claim_cta_url = get_permalink( $experte_id );

						$card_classes = 'experte-card';
						$card_classes .= $is_premium ? ' experte-card--premium' : ' experte-card--basic';
						?>
						<article class="<?php echo esc_attr( $card_classes ); ?>">
							<?php if ( $is_premium ) : ?>
								<div class="experte-card__premium-strip" aria-hidden="true"></div>
							<?php endif; ?>
							<a class="experte-card__link" href="<?php echo esc_url( get_permalink( $experte_id ) ); ?>">
								<div class="experte-card__content">
									<div class="experte-card__top">
										<div class="experte-card__avatar-wrap">
											<?php if ( $is_premium && $profilbild_id ) : ?>
												<?php echo wp_get_attachment_image( $profilbild_id, 'thumbnail', false, array( 'class' => 'experte-card__avatar', 'alt' => esc_attr( $display_name ) ) ); ?>
											<?php elseif ( $is_premium && $avatar_placeholder_url ) : ?>
												<img class="experte-card__avatar" src="<?php echo esc_url( $avatar_placeholder_url ); ?>" alt="<?php echo esc_attr( $display_name ); ?>" />
											<?php else : ?>
												<?php zeen_child_experte_avatar_placeholder(); ?>
											<?php endif; ?>
										</div>

										<div class="experte-card__info">
											<h2 class="experte-card__name"><?php echo esc_html( $display_name ); ?></h2>
											<?php if ( $facharzttitel ) : ?>
												<div class="experte-card__title"><?php echo esc_html( $facharzttitel ); ?></div>
											<?php endif; ?>
											<?php if ( $city_name ) : ?>
												<div class="experte-card__location">
													<svg class="experte-card__location-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
														<path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
													</svg>
													<span class="experte-card__location-text"><?php echo esc_html( $city_name ); ?></span>
												</div>
											<?php endif; ?>
										</div>
									</div>

									<?php if ( $is_premium ) : ?>
										<div class="experte-card__badge"><?php echo esc_html( $badge_text ); ?></div>
									<?php endif; ?>

									<div class="experte-card__tags">
										<?php
										if ( is_array( $eingriff_terms ) && ! empty( $eingriff_terms ) ) {
											$tag_count = 0;
											foreach ( $eingriff_terms as $term ) {
												if ( $tag_count >= 3 ) {
													break;
												}
												$tag_count++;
												$term_link = get_term_link( $term, 'eingriff' );
											echo '<a href="' . esc_url( $term_link ) . '" class="experte-card__tag" onclick="event.stopPropagation()">' . esc_html( $term->name ) . '</a>';
											}
										}
										?>
									</div>
								</div>
							</a>
							<?php if ( ! $is_premium ) : ?>
								<a class="experte-card__claim-cta" href="<?php echo esc_url( $claim_cta_url ); ?>"><?php esc_html_e( 'Profil erweitern', 'zeen-child' ); ?></a>
							<?php endif; ?>
						</article>
						<?php
					endwhile;
					echo '</div>';
					echo '</div>';

					$old_wp_query = $wp_query;
					$wp_query = $experte_query;
					the_posts_pagination();
					$wp_query = $old_wp_query;
				else :
					zeen_main_layout_none();
				endif;
				wp_reset_postdata();
				?>
			</main><!-- .site-main -->
			<?php
			zeen_get_sidebar(
				array(
					'archive'       => $preview,
					'sidebar_check' => $sidebar_check,
				)
			);
			
			if ( empty( $fw ) ) {
				echo '</div>';
				echo '</div>';
			}
			zeen_ad( 'archive_below' );
			?>
			<?php do_action( 'zeen_end_contents_wrap' ); ?>
		</div>
	</div><!-- .content-area -->
		<?php
		get_footer();
