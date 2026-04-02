<?php
/**
* Flexible Layout: CTA – nur Buttons (kein Formular)
*/
$section_label     = get_sub_field( 'section_label' );
$section_title     = get_sub_field( 'section_title' );
$subtitle          = get_sub_field( 'subtitle' );
$btn_primary_text  = get_sub_field( 'btn_primary_text' );
$btn_primary_url   = get_sub_field( 'btn_primary_url' );
$btn_secondary_text = get_sub_field( 'btn_secondary_text' );
$btn_secondary_url = get_sub_field( 'btn_secondary_url' );
$note              = get_sub_field( 'note' );
?>
<section class="fp-ctab-bg">
  <div class="fp-section fp-ctab-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label fp-section-label--light"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title fp-section-title--light"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $subtitle ) : ?>
      <p class="fp-section-subtitle fp-section-subtitle--light"><?php echo esc_html( $subtitle ); ?></p>
    <?php endif; ?>

    <div class="fp-ctab-buttons">
      <?php if ( $btn_primary_text && $btn_primary_url ) : ?>
        <a href="<?php echo esc_url( $btn_primary_url ); ?>" class="fp-btn fp-btn--gold">
          <?php echo esc_html( $btn_primary_text ); ?>
        </a>
      <?php endif; ?>
      <?php if ( $btn_secondary_text && $btn_secondary_url ) : ?>
        <a href="<?php echo esc_url( $btn_secondary_url ); ?>" class="fp-btn fp-btn--outline-light">
          <?php echo esc_html( $btn_secondary_text ); ?>
        </a>
      <?php endif; ?>
    </div>

    <?php if ( $note ) : ?>
      <p class="fp-ctab-note"><?php echo esc_html( $note ); ?></p>
    <?php endif; ?>
  </div>
</section>
