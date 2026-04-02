<?php
/**
* Template Name: Profil erweitern (Flexible Modules)
*
* Rendert alle ACF Flexible Content Layouts in der im Backend
* gewählten Reihenfolge. Neue Layouts können in
* inc/acf-flexible-content.php ergänzt und hier als case eingebunden werden.
*/

get_header();

// ACF muss aktiv sein – ohne ACF kein Flexible Content.
if ( ! function_exists( 'have_rows' ) ) {
  echo '<div style="padding:48px 24px;text-align:center;color:#c00;">Advanced Custom Fields Pro ist nicht aktiviert.</div>';
  get_footer();
  return;
}
?>
<?php if ( have_rows( 'flexible_content' ) ) : ?>

  <?php while ( have_rows( 'flexible_content' ) ) : the_row(); ?>

    <?php $layout = get_row_layout(); ?>

    <?php if ( 'hero' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/hero' ); ?>

    <?php elseif ( 'founder_banner' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/founder-banner' ); ?>

    <?php elseif ( 'pricing_section' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/pricing-section' ); ?>

    <?php elseif ( 'context_box' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/context-box' ); ?>

    <?php elseif ( 'comparison_table' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/comparison-table' ); ?>

    <?php elseif ( 'benefits_grid' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/benefits-grid' ); ?>

    <?php elseif ( 'steps' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/steps' ); ?>

    <?php elseif ( 'cta_form' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/cta-form' ); ?>

    <?php elseif ( 'feature_grid' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/feature-grid' ); ?>

    <?php elseif ( 'profile_preview' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/profile-preview' ); ?>

    <?php elseif ( 'faq' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/faq' ); ?>

    <?php elseif ( 'cta_buttons' === $layout ) : ?>
      <?php get_template_part( 'template-parts/flexible/cta-buttons' ); ?>

    <?php endif; ?>

  <?php endwhile; ?>

<?php else : ?>
  <div style="padding: 48px 24px; text-align: center; color: #888;">
    Noch keine Module konfiguriert. Bitte im Backend unter „Seitenmodule" Module hinzufügen.
  </div>
<?php endif; ?>

<?php get_footer(); ?>
