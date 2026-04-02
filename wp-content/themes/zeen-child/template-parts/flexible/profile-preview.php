<?php
/**
* Flexible Layout: Profil-Vorschau
*/
$section_label    = get_sub_field( 'section_label' );
$section_title    = get_sub_field( 'section_title' );
$section_subtitle = get_sub_field( 'section_subtitle' );
$profile_image    = get_sub_field( 'profile_image' );
$footnote         = get_sub_field( 'footnote' );
?>
<section class="fp-pp-bg">
  <div class="fp-section fp-pp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $section_subtitle ) : ?>
      <p class="fp-section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( $profile_image ) : ?>
      <div class="fp-pp-image-wrap">
        <img
          src="<?php echo esc_url( $profile_image['url'] ); ?>"
          alt="<?php echo esc_attr( $profile_image['alt'] ); ?>"
          class="fp-pp-image"
          width="<?php echo esc_attr( $profile_image['width'] ); ?>"
          height="<?php echo esc_attr( $profile_image['height'] ); ?>"
        >
      </div>
    <?php endif; ?>

    <?php if ( $footnote ) : ?>
      <p class="fp-pp-footnote"><?php echo esc_html( $footnote ); ?></p>
    <?php endif; ?>
  </div>
</section>
