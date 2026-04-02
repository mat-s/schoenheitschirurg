<?php
/**
* Flexible Layout: Feature-Grid (dunkel)
*/
$section_label    = get_sub_field( 'section_label' );
$section_title    = get_sub_field( 'section_title' );
$section_subtitle = get_sub_field( 'section_subtitle' );
$items            = get_sub_field( 'items' );
?>
<section class="fp-fgrid-bg">
  <div class="fp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label fp-section-label--light"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title fp-section-title--light"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $section_subtitle ) : ?>
      <p class="fp-section-subtitle fp-section-subtitle--light"><?php echo esc_html( $section_subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( $items ) : ?>
      <div class="fp-fgrid">
        <?php foreach ( $items as $item ) : ?>
          <div class="fp-fgrid-card">
            <?php if ( ! empty( $item['icon'] ) ) : ?>
              <div class="fp-fgrid-icon"><?php echo esc_html( $item['icon'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $item['title'] ) ) : ?>
              <h3 class="fp-fgrid-title"><?php echo esc_html( $item['title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $item['text'] ) ) : ?>
              <p class="fp-fgrid-text"><?php echo esc_html( $item['text'] ); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
