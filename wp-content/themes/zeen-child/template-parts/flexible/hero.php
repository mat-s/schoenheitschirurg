<?php
/**
* Flexible Layout: Hero
*/
$badge_text      = get_sub_field( 'badge_text' );
$headline        = get_sub_field( 'headline' );
$subtext         = get_sub_field( 'subtext' );
$btn_primary_text = get_sub_field( 'btn_primary_text' );
$btn_primary_url  = get_sub_field( 'btn_primary_url' );
$btn_secondary_text = get_sub_field( 'btn_secondary_text' );
$btn_secondary_url  = get_sub_field( 'btn_secondary_url' );
?>
<section class="fp-hero">
  <div class="fp-hero-content">
    <?php if ( $badge_text ) : ?>
      <div class="fp-hero-badge"><?php echo esc_html( $badge_text ); ?></div>
    <?php endif; ?>

    <?php if ( $headline ) : ?>
      <h2><?php echo esc_html( $headline ); ?></h2>
    <?php endif; ?>

    <?php if ( $subtext ) : ?>
      <p><?php echo esc_html( $subtext ); ?></p>
    <?php endif; ?>

    <?php if ( $btn_primary_text || $btn_secondary_text ) : ?>
      <div class="fp-hero-buttons">
        <?php if ( $btn_primary_text && $btn_primary_url ) : ?>
          <a href="<?php echo esc_url( $btn_primary_url ); ?>" class="fp-hero-btn fp-hero-btn--primary">
            <?php echo esc_html( $btn_primary_text ); ?>
          </a>
        <?php endif; ?>
        <?php if ( $btn_secondary_text && $btn_secondary_url ) : ?>
          <a href="<?php echo esc_url( $btn_secondary_url ); ?>" class="fp-hero-btn fp-hero-btn--secondary">
            <?php echo esc_html( $btn_secondary_text ); ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
