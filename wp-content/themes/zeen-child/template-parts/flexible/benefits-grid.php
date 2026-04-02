<?php
/**
* Flexible Layout: Vorteile-Grid
*/
$section_label    = get_sub_field( 'section_label' );
$section_title    = get_sub_field( 'section_title' );
$section_subtitle = get_sub_field( 'section_subtitle' );
$items            = get_sub_field( 'items' );
$footnote_label   = get_sub_field( 'footnote_label' );
$footnote_text    = get_sub_field( 'footnote_text' );
?>
<section class="fp-benefits-bg">
  <div class="fp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $section_subtitle ) : ?>
      <p class="fp-section-subtitle"><?php echo esc_html( $section_subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( $items ) : ?>
      <div class="fp-benefits-grid">
        <?php foreach ( $items as $item ) : ?>
          <div class="fp-benefit-card">
            <?php if ( ! empty( $item['title'] ) ) : ?>
              <h3><?php echo esc_html( $item['title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $item['text'] ) ) : ?>
              <p><?php echo esc_html( $item['text'] ); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ( $footnote_text ) : ?>
      <div class="fp-benefits-footnote">
        <?php if ( $footnote_label ) : ?>
          <strong><?php echo esc_html( $footnote_label ); ?></strong>
        <?php endif; ?>
        <?php echo esc_html( $footnote_text ); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
