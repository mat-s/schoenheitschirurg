<?php
/**
* Flexible Layout: Preispakete
*/
$section_label    = get_sub_field( 'section_label' );
$section_title    = get_sub_field( 'section_title' );
$section_subtitle = get_sub_field( 'section_subtitle' );
$cards            = get_sub_field( 'cards' );
$footer_note      = get_sub_field( 'footer_note' );
?>
<section class="fp-pricing-bg">
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

    <?php if ( $cards ) : ?>
      <div class="fp-pricing-grid">
        <?php foreach ( $cards as $card ) :
          $is_featured  = ! empty( $card['is_featured'] );
          $btn_style    = $card['button_style'] ?? 'outline';
          $btn_class    = 'gold' === $btn_style ? 'fp-pricing-btn-gold' : 'fp-pricing-btn-outline';
          $border_color = ! empty( $card['border_color'] ) ? $card['border_color'] : '';
          $card_style   = $border_color ? ' style="border-color:' . esc_attr( $border_color ) . ';border-width:2px;"' : '';
        ?>
          <div class="fp-pricing-card<?php echo $is_featured ? ' is-featured' : ''; ?>"<?php echo $card_style; ?>>
            <?php if ( $is_featured && ! empty( $card['ribbon_text'] ) ) : ?>
              <div class="fp-pricing-ribbon"><?php echo esc_html( $card['ribbon_text'] ); ?></div>
            <?php endif; ?>

            <?php if ( ! empty( $card['title'] ) ) : ?>
              <h3><?php echo esc_html( $card['title'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $card['subtitle'] ) ) : ?>
              <p class="fp-subtitle"><?php echo esc_html( $card['subtitle'] ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $card['price_amount'] ) ) : ?>
              <div class="fp-price-amount"><?php echo esc_html( $card['price_amount'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $card['price_period'] ) ) : ?>
              <div class="fp-price-period"><?php echo esc_html( $card['price_period'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $card['price_info'] ) ) : ?>
              <div class="fp-price-info"><?php echo esc_html( $card['price_info'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $card['price_original'] ) ) : ?>
              <div class="fp-price-original"><?php echo esc_html( $card['price_original'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $card['price_saving'] ) ) : ?>
              <div class="fp-price-saving"><?php echo esc_html( $card['price_saving'] ); ?></div>
            <?php endif; ?>

            <?php
            $has_features          = ! empty( $card['features'] );
            $has_features_excluded = ! empty( $card['features_excluded'] );
            if ( $has_features || $has_features_excluded ) : ?>
              <div class="fp-pricing-divider"></div>
            <?php endif; ?>

            <?php if ( $has_features ) : ?>
              <ul class="fp-pricing-features">
                <?php foreach ( $card['features'] as $feat ) : ?>
                  <li><?php echo esc_html( $feat['feature'] ); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if ( $has_features_excluded ) : ?>
              <ul class="fp-pricing-features fp-pricing-features--excluded">
                <?php foreach ( $card['features_excluded'] as $feat ) : ?>
                  <li><?php echo esc_html( $feat['feature'] ); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if ( ! empty( $card['button_text'] ) ) : ?>
              <a href="<?php echo esc_url( $card['button_url'] ?? '#' ); ?>"
               class="fp-pricing-btn <?php echo esc_attr( $btn_class ); ?>">
                <?php echo esc_html( $card['button_text'] ); ?>
              </a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ( $footer_note ) : ?>
      <p class="fp-pricing-footer-note"><?php echo esc_html( $footer_note ); ?></p>
    <?php endif; ?>
  </div>
</section>
