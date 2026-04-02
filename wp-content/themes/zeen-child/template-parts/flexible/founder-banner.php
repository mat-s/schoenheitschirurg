<?php
/**
* Flexible Layout: Gründungspartner-Banner
*/
$badge_label    = get_sub_field( 'badge_label' );
$slots_text     = get_sub_field( 'slots_text' );
$headline       = get_sub_field( 'headline' );
$description    = get_sub_field( 'description' );
$price_amount   = get_sub_field( 'price_amount' );
$price_period   = get_sub_field( 'price_period' );
$price_total    = get_sub_field( 'price_total' );
$price_original = get_sub_field( 'price_original' );
$price_saving   = get_sub_field( 'price_saving' );
$button_text    = get_sub_field( 'button_text' );
$button_url     = get_sub_field( 'button_url' );
?>
<div class="fp-founder-wrap">
  <div class="fp-founder-banner">

    <div class="fp-founder-content">
      <div class="fp-founder-badge-row">
        <?php if ( $badge_label ) : ?>
          <span class="fp-founder-badge-label"><?php echo esc_html( $badge_label ); ?></span>
        <?php endif; ?>
        <?php if ( $slots_text ) : ?>
          <span class="fp-founder-slots"><?php echo esc_html( $slots_text ); ?></span>
        <?php endif; ?>
      </div>

      <?php if ( $headline ) : ?>
        <h3><?php echo esc_html( $headline ); ?></h3>
      <?php endif; ?>

      <?php if ( $description ) : ?>
        <div class="fp-founder-desc"><?php echo wp_kses_post( $description ); ?></div>
      <?php endif; ?>
    </div>

    <div class="fp-founder-price">
      <?php if ( $price_amount ) : ?>
        <div class="fp-founder-price-amount"><?php echo esc_html( $price_amount ); ?></div>
      <?php endif; ?>
      <?php if ( $price_period ) : ?>
        <div class="fp-founder-price-period"><?php echo esc_html( $price_period ); ?></div>
      <?php endif; ?>
      <?php if ( $price_total ) : ?>
        <div class="fp-founder-price-total"><?php echo esc_html( $price_total ); ?></div>
      <?php endif; ?>
      <?php if ( $price_original ) : ?>
        <div class="fp-founder-price-original"><?php echo esc_html( $price_original ); ?></div>
      <?php endif; ?>
      <?php if ( $price_saving ) : ?>
        <div class="fp-founder-price-saving"><?php echo esc_html( $price_saving ); ?></div>
      <?php endif; ?>
      <?php if ( $button_text && $button_url ) : ?>
        <br>
        <a href="<?php echo esc_url( $button_url ); ?>" class="fp-founder-btn">
          <?php echo esc_html( $button_text ); ?>
        </a>
      <?php endif; ?>
    </div>

  </div>
</div>
