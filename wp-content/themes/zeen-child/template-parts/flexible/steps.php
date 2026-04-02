<?php
/**
* Flexible Layout: Schritte
*/
$section_label = get_sub_field( 'section_label' );
$section_title = get_sub_field( 'section_title' );
$items         = get_sub_field( 'items' );
?>
<section>
  <div class="fp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>

    <?php if ( $items ) : ?>
      <div class="fp-steps">
        <?php foreach ( $items as $item ) : ?>
          <div class="fp-step">
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
  </div>
</section>
