<?php
/**
* Flexible Layout: Kontext-Box
* Zweispaltig: Überschrift + Text links, Tier-Karte rechts.
*/
$headline = get_sub_field( 'headline' );
$text     = get_sub_field( 'text' );
$tiers    = get_sub_field( 'tiers' );
?>
<section class="fp-context-bg">
  <div class="fp-section fp-context-section">

    <div class="fp-context-left">
      <?php if ( $headline ) : ?>
        <h2 class="fp-context-headline"><?php echo esc_html( $headline ); ?></h2>
      <?php endif; ?>
      <?php if ( $text ) : ?>
        <div class="fp-context-text"><?php echo wp_kses_post( $text ); ?></div>
      <?php endif; ?>
    </div>

    <?php if ( $tiers ) : ?>
      <div class="fp-context-right">
        <div class="fp-tier-card">
          <?php foreach ( $tiers as $i => $tier ) :
            $dot_color = ! empty( $tier['dot_color'] ) ? $tier['dot_color'] : '#cccccc';
            $is_last   = $i === array_key_last( $tiers );
          ?>
            <div class="fp-tier-row<?php echo $is_last ? ' fp-tier-row--last' : ''; ?>">
              <span class="fp-tier-dot" style="background-color: <?php echo esc_attr( $dot_color ); ?>;"></span>
              <span class="fp-tier-name"><?php echo esc_html( $tier['tier_name'] ); ?></span>
              <span class="fp-tier-desc"><?php echo esc_html( $tier['tier_description'] ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>
