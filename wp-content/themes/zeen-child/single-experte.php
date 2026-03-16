<?php

/**
 * Single Experte template.
 *
 * @package Zeen_Child
 */

$post_id = get_the_ID();

$titel_name = get_field('titel_name', $post_id);
$facharzttitel = get_field('facharzttitel', $post_id);
$praxis_name = get_field('praxis_name', $post_id);
$adresse = get_field('adresse', $post_id);
$profilbild_id = get_field('profilbild', $post_id);
$berufserfahrung_seit = get_field('berufserfahrung_seit', $post_id);
$claim_status = get_field('claim_status', $post_id);
$is_premium = ($claim_status === 'premium');

$berufserfahrung_label = '';
if (!empty($berufserfahrung_seit)) {
  $start_year = (int) preg_replace('/\D+/', '', (string) $berufserfahrung_seit);
  $current_year = (int) current_time('Y');

  if ($start_year >= 1900 && $start_year <= $current_year) {
    $years_active = max(1, $current_year - $start_year);
    $years_text = ($years_active === 1) ? '1 Jahr' : ($years_active . ' Jahren');
    $berufserfahrung_label = 'seit über ' . $years_text . ' tätig';
  } else {
    $berufserfahrung_label = 'Seit ' . (string) $berufserfahrung_seit;
  }
}

$website = $is_premium ? get_field('website', $post_id) : '';
$telefon = $is_premium ? get_field('telefon', $post_id) : '';
$kurzbiografie = $is_premium ? get_field('kurzbiografie', $post_id) : '';
$schwerpunkte = $is_premium ? get_field('schwerpunkte', $post_id) : array();
$mitgliedschaften = $is_premium ? get_field('mitgliedschaften', $post_id) : array();
$galerie = $is_premium ? get_field('galerie', $post_id) : array();
$faq = $is_premium ? get_field('faq', $post_id) : array();
$video_beratung = $is_premium ? get_field('video_beratung', $post_id) : false;
$google_maps_embed = $is_premium ? get_field('google_maps_embed', $post_id) : '';

$stadt_terms = get_the_terms($post_id, 'stadt');
$eingriff_terms = get_the_terms($post_id, 'eingriff');
$anbieter_terms = get_the_terms($post_id, 'anbieter-typ');

$stadt_term = (is_array($stadt_terms) && !empty($stadt_terms)) ? $stadt_terms[0] : null;

/**
 * Sanitize phone number for tel links.
 *
 * @param string $phone Raw phone.
 * @return string
 */
function expert_sanitize_phone($phone)
{
  $phone = trim((string) $phone);
  $phone = preg_replace('/[^\d\+]/', '', $phone);
  $phone = preg_replace('/(?!^)\+/', '', $phone);
  return $phone;
}

/**
 * Get placeholder image URL if file exists.
 *
 * @param string $filename
 * @return string
 */
function expert_get_placeholder_url($filename)
{
  $path = trailingslashit(get_stylesheet_directory()) . 'img/' . $filename;
  if (file_exists($path)) {
    return trailingslashit(get_stylesheet_directory_uri()) . 'img/' . $filename;
  }
  return '';
}

/**
 * Render inline SVG placeholder.
 *
 * @param string $label
 */
function expert_render_svg_placeholder($label)
{
  $label = esc_html($label);
  echo '<svg class="expert-placeholder" viewBox="0 0 200 240" role="img" aria-label="' . $label . '" xmlns="http://www.w3.org/2000/svg">';
  echo '<rect width="200" height="240" rx="10" fill="#E2E8F0" />';
  echo '<circle cx="100" cy="80" r="36" fill="#CBD5E0" />';
  echo '<rect x="35" y="130" width="130" height="70" rx="12" fill="#CBD5E0" />';
  echo '</svg>';
}

/**
 * Build JSON-LD for premium experts.
 *
 * @return array
 */
function expert_build_jsonld()
{
  global $post;

  $post_id_local = $post->ID;
  $titel_name_local = get_field('titel_name', $post_id_local);
  $facharzttitel_local = get_field('facharzttitel', $post_id_local);
  $website_local = get_field('website', $post_id_local);
  $adresse_local = get_field('adresse', $post_id_local);
  $profilbild_id_local = get_field('profilbild', $post_id_local);
  $mitgliedschaften_local = get_field('mitgliedschaften', $post_id_local);

  $stadt_terms_local = get_the_terms($post_id_local, 'stadt');
  $eingriff_terms_local = get_the_terms($post_id_local, 'eingriff');

  $image_url = $profilbild_id_local ? wp_get_attachment_image_url($profilbild_id_local, 'full') : '';
  $stadt_name = (is_array($stadt_terms_local) && !empty($stadt_terms_local)) ? $stadt_terms_local[0]->name : '';

  $knows_about = array();
  if (is_array($eingriff_terms_local)) {
    foreach ($eingriff_terms_local as $term) {
      $knows_about[] = $term->name;
    }
  }

  $data = array(
    '@context' => 'https://schema.org',
    '@type' => 'Physician',
    'name' => $titel_name_local ? $titel_name_local : get_the_title($post_id_local),
    'medicalSpecialty' => $facharzttitel_local,
    'knowsAbout' => $knows_about,
    'memberOf' => is_array($mitgliedschaften_local) ? $mitgliedschaften_local : array(),
    'address' => trim($adresse_local . ($stadt_name ? ', ' . $stadt_name : '')),
    'url' => $website_local,
    'image' => $image_url,
  );

  $data = array_filter($data, static function ($value) {
    if (is_array($value)) {
      return !empty($value);
    }
    return (string) $value !== '';
  });

  return $data;
}

/**
 * Build FAQPage JSON-LD if available.
 *
 * @return array
 */
function expert_build_faq_jsonld()
{
  global $post;

  $post_id_local = $post->ID;
  $faq_local = get_field('faq', $post_id_local);

  if (!is_array($faq_local) || empty($faq_local)) {
    return array();
  }

  $entities = array();
  foreach ($faq_local as $item) {
    $frage = isset($item['frage']) ? wp_strip_all_tags($item['frage']) : '';
    $antwort = isset($item['antwort']) ? wp_strip_all_tags($item['antwort']) : '';
    if ($frage && $antwort) {
      $entities[] = array(
        '@type' => 'Question',
        'name' => $frage,
        'acceptedAnswer' => array(
          '@type' => 'Answer',
          'text' => $antwort,
        ),
      );
    }
  }

  if (empty($entities)) {
    return array();
  }

  return array(
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $entities,
  );
}

if ($is_premium) {
  $physician_jsonld = expert_build_jsonld();
  $faq_jsonld = expert_build_faq_jsonld();

  add_action('wp_head', static function () use ($physician_jsonld, $faq_jsonld) {
    if (!empty($physician_jsonld)) {
      echo "\n<script type=\"application/ld+json\">" . wp_json_encode($physician_jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
    }
    if (!empty($faq_jsonld)) {
      echo "\n<script type=\"application/ld+json\">" . wp_json_encode($faq_jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</script>\n";
    }
  });
}

get_header();

$avatar_placeholder_url = expert_get_placeholder_url('expert-avatar-placeholder.png');
$badge_placeholder_url = expert_get_placeholder_url('expert-badge-verified.png');

$tel_sanitized = $telefon ? expert_sanitize_phone($telefon) : '';
$tel_href = $tel_sanitized ? 'tel:' . $tel_sanitized : '';
$website_href = $website ? esc_url($website) : '';

$allowed_iframe = array(
  'iframe' => array(
    'src' => true,
    'width' => true,
    'height' => true,
    'style' => true,
    'allowfullscreen' => true,
    'loading' => true,
    'referrerpolicy' => true,
    'title' => true,
    'aria-label' => true,
    'frameborder' => true,
  ),
);
?>

<main id="primary" class="expert">
  <nav class="expert-breadcrumb tipi-row" aria-label="Breadcrumb">
    <a class="expert-breadcrumb__link" href="<?php echo esc_url(home_url('/')); ?>">Startseite</a>
    <span class="expert-breadcrumb__separator">&gt;</span>
    <a class="expert-breadcrumb__link" href="<?php echo esc_url(get_post_type_archive_link('experte')); ?>">Experten</a>
    <?php if ($stadt_term) : ?>
      <span class="expert-breadcrumb__separator">&gt;</span>
      <a class="expert-breadcrumb__link" href="<?php echo esc_url(get_term_link($stadt_term)); ?>"><?php echo esc_html($stadt_term->name); ?></a>
    <?php endif; ?>
    <span class="expert-breadcrumb__separator">&gt;</span>
    <span class="expert-breadcrumb__current"><?php echo esc_html($titel_name ? $titel_name : get_the_title()); ?></span>
  </nav>

  <section class="expert-hero">
    <div class="expert-hero__inner">
      <div class="expert-hero__photo">
        <?php if ($profilbild_id) : ?>
          <?php echo wp_get_attachment_image($profilbild_id, 'large', false, array('class' => 'expert-hero__photo-img', 'alt' => esc_attr($titel_name ? $titel_name : get_the_title()))); ?>
        <?php elseif ($avatar_placeholder_url) : ?>
          <img class="expert-hero__photo-img" src="<?php echo esc_url($avatar_placeholder_url); ?>" alt="<?php echo esc_attr($titel_name ? $titel_name : get_the_title()); ?>" />
        <?php else : ?>
          <?php expert_render_svg_placeholder('Platzhalter'); ?>
        <?php endif; ?>
      </div>

      <div class="expert-hero__info">
        <?php if ($is_premium) : ?>
          <div class="expert-hero__badge">
            <?php if ($badge_placeholder_url) : ?>
              <img class="expert-hero__badge-img" src="<?php echo esc_url($badge_placeholder_url); ?>" alt="" />
            <?php endif; ?>
            <span class="expert-hero__badge-text">Verifizierter Experte</span>
          </div>
        <?php endif; ?>

        <h1 class="expert-hero__name"><?php echo esc_html($titel_name ? $titel_name : get_the_title()); ?></h1>
        <?php if ($facharzttitel) : ?>
          <div class="expert-hero__title"><?php echo esc_html($facharzttitel); ?></div>
        <?php endif; ?>
        <div class="expert-hero__meta">
          <?php if ($praxis_name) : ?>
            <span class="expert-hero__meta-item">
              <svg class="expert-hero__meta-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M4 4h16v16H4zM9 7h6v2H9zm0 4h2v2H9zm4 0h2v2h-2zm-4 4h2v2H9zm4 0h2v2h-2z"/>
              </svg>
              <?php echo esc_html($praxis_name); ?>
            </span>
          <?php endif; ?>
          <?php if ($stadt_term) : ?>
            <span class="expert-hero__meta-item">
              <svg class="expert-hero__meta-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
              </svg>
              <?php echo esc_html($stadt_term->name); ?>
            </span>
          <?php endif; ?>
          <?php if ($berufserfahrung_label) : ?>
            <span class="expert-hero__meta-item">
              <svg class="expert-hero__meta-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12 3l2.7 5.5 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.8 1-6.1-4.4-4.3 6.1-.9z"/>
              </svg>
              <?php echo esc_html($berufserfahrung_label); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="expert-hero__actions">
        <?php if ($is_premium) : ?>
          <?php if ($tel_href) : ?>
            <a class="expert-hero__action expert-hero__action--primary" href="<?php echo esc_url($tel_href); ?>"><?php echo esc_html($telefon); ?></a>
          <?php endif; ?>
          <?php if ($website_href) : ?>
            <a class="expert-hero__action expert-hero__action--secondary" href="<?php echo esc_url($website_href); ?>" target="_blank" rel="noopener">Zur Website</a>
          <?php endif; ?>
        <?php else : ?>
          <a class="expert-hero__action expert-hero__action--primary" href="#">Profil erweitern</a>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="expert-body">
    <div class="expert-main">
      <?php if ($is_premium && $kurzbiografie) : ?>
        <section class="expert-section expert-section--bio">
          <h2 class="expert-section__title">Kurzbiografie</h2>
          <div class="expert-section__content expert-text">
            <?php echo wp_kses_post($kurzbiografie); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($is_premium && is_array($schwerpunkte) && !empty($schwerpunkte)) : ?>
        <section class="expert-section expert-section--schwerpunkte">
          <h2 class="expert-section__title">Schwerpunkte</h2>
          <div class="expert-section__content">
            <?php foreach ($schwerpunkte as $item) : ?>
              <?php
              $titel = isset($item['titel']) ? $item['titel'] : '';
              $beschreibung = isset($item['beschreibung']) ? $item['beschreibung'] : '';
              ?>
              <?php if ($titel || $beschreibung) : ?>
                <div class="expert-focus">
                  <?php if ($titel) : ?>
                    <h3 class="expert-focus__title"><?php echo esc_html($titel); ?></h3>
                  <?php endif; ?>
                  <?php if ($beschreibung) : ?>
                    <p class="expert-focus__text"><?php echo esc_html($beschreibung); ?></p>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ($is_premium && is_array($faq) && !empty($faq)) : ?>
        <section class="expert-section expert-section--faq">
          <h2 class="expert-section__title">Häufige Fragen</h2>
          <div class="expert-section__content">
            <?php foreach ($faq as $item) : ?>
              <?php
              $frage = isset($item['frage']) ? $item['frage'] : '';
              $antwort = isset($item['antwort']) ? $item['antwort'] : '';
              ?>
              <?php if ($frage || $antwort) : ?>
                <div class="expert-faq">
                  <?php if ($frage) : ?>
                    <h3 class="expert-faq__question"><?php echo esc_html($frage); ?></h3>
                  <?php endif; ?>
                  <?php if ($antwort) : ?>
                    <div class="expert-faq__answer"><?php echo wp_kses_post($antwort); ?></div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endif; ?>
    </div>

    <aside class="expert-sidebar">
      <div class="expert-card expert-card--contact">
        <h3 class="expert-card__title">Kontakt</h3>
        <div class="expert-card__content">
          <?php if ($praxis_name) : ?>
            <div class="expert-contact__item expert-contact__item--clinic">
              <div class="expert-contact__clinic-name"><?php echo esc_html($praxis_name); ?></div>
              <?php if ($facharzttitel) : ?>
                <div class="expert-contact__clinic-subtitle"><?php echo esc_html($facharzttitel); ?></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if ($adresse) : ?>
            <div class="expert-contact__item expert-contact__item--address">
              <span class="expert-contact__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zm0-9a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
              </span>
              <span class="expert-contact__text"><?php echo esc_html($adresse); ?></span>
            </div>
          <?php endif; ?>

          <?php if ($is_premium) : ?>
            <?php if ($tel_href) : ?>
              <a class="expert-contact__link expert-contact__link--phone" href="<?php echo esc_url($tel_href); ?>">
                <span class="expert-contact__icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.6 10.8a15.6 15.6 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.2 11.2 11.2 0 0 0 3.5.6 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.9 21 3 13.1 3 3a1 1 0 0 1 1-1h3.6a1 1 0 0 1 1 1 11.2 11.2 0 0 0 .6 3.5 1 1 0 0 1-.2 1l-2.4 2.3z"/>
                  </svg>
                </span>
                <span class="expert-contact__text"><?php echo esc_html($telefon); ?></span>
              </a>
            <?php endif; ?>
            <?php if ($website_href) : ?>
              <a class="expert-contact__website-btn" href="<?php echo esc_url($website_href); ?>" target="_blank" rel="noopener">
                <span class="expert-contact__icon" aria-hidden="true">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.6 13.4a1 1 0 0 0 1.4 1.4l5.4-5.4a3 3 0 0 0-4.2-4.2l-2.2 2.2a1 1 0 1 0 1.4 1.4l2.2-2.2a1 1 0 0 1 1.4 1.4L10.6 13.4zm2.8-2.8a1 1 0 0 0-1.4-1.4l-5.4 5.4a3 3 0 0 0 4.2 4.2l2.2-2.2a1 1 0 0 0-1.4-1.4l-2.2 2.2a1 1 0 0 1-1.4-1.4l5.4-5.4z"/>
                  </svg>
                </span>
                <span>Website besuchen</span>
              </a>
            <?php endif; ?>
          <?php else : ?>
            <a class="expert-contact__cta" href="#">Profil erweitern</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="expert-card expert-card--overview">
        <h3 class="expert-card__title">Auf einen Blick</h3>
        <div class="expert-card__content">
          <?php if ($facharzttitel) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Facharzttitel</span>
              <span class="expert-overview__value"><?php echo esc_html($facharzttitel); ?></span>
            </div>
          <?php endif; ?>
          <?php if ($stadt_term) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Standort</span>
              <span class="expert-overview__value"><?php echo esc_html($stadt_term->name); ?></span>
            </div>
          <?php endif; ?>
          <?php if ($berufserfahrung_seit) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Berufserfahrung</span>
              <span class="expert-overview__value">Seit <?php echo esc_html($berufserfahrung_seit); ?></span>
            </div>
          <?php endif; ?>
          <?php if ($is_premium && is_array($mitgliedschaften) && !empty($mitgliedschaften)) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Mitgliedschaften</span>
              <span class="expert-overview__value"><?php echo esc_html(implode(', ', $mitgliedschaften)); ?></span>
            </div>
          <?php endif; ?>
          <?php if ($is_premium && $video_beratung) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Video-Beratung</span>
              <span class="expert-overview__value">Verfügbar</span>
            </div>
          <?php endif; ?>
          <?php if (is_array($anbieter_terms) && !empty($anbieter_terms)) : ?>
            <div class="expert-overview__row">
              <span class="expert-overview__label">Anbieter-Typ</span>
              <span class="expert-overview__value"><?php echo esc_html($anbieter_terms[0]->name); ?></span>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if ($is_premium && is_array($galerie) && !empty($galerie)) : ?>
        <div class="expert-card expert-card--gallery">
          <h3 class="expert-card__title">Praxis-Impressionen</h3>
          <div class="expert-card__content">
            <div class="expert-gallery">
              <?php foreach ($galerie as $image_id) : ?>
                <?php $image_url = wp_get_attachment_image_url($image_id, 'medium'); ?>
                <?php if ($image_url) : ?>
                  <img class="expert-gallery__image" src="<?php echo esc_url($image_url); ?>" alt="" />
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($is_premium && $google_maps_embed) : ?>
        <div class="expert-card expert-card--map">
          <h3 class="expert-card__title">Standort</h3>
          <div class="expert-card__content">
            <div class="expert-map">
              <?php echo wp_kses($google_maps_embed, $allowed_iframe); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="expert-disclaimer">
        <strong>Hinweis:</strong> Dieses Profil basiert auf öffentlich zugänglichen Informationen und Angaben des Arztes. Die Darstellung auf Der Schönheitschirurg stellt keine Empfehlung oder medizinische Bewertung dar und ersetzt keine ärztliche Beratung.
      </div>
    </aside>
  </section>

  <?php
  $related_posts = array();
  $exclude_ids = array($post_id);

  $sort_related = static function ($a, $b) {
    $a_premium = (get_field('claim_status', $a->ID) === 'premium');
    $b_premium = (get_field('claim_status', $b->ID) === 'premium');
    if ($a_premium !== $b_premium) {
      return $a_premium ? -1 : 1;
    }
    $a_name = get_field('titel_name', $a->ID);
    $b_name = get_field('titel_name', $b->ID);
    $a_name = $a_name ? $a_name : $a->post_title;
    $b_name = $b_name ? $b_name : $b->post_title;
    return strcasecmp($a_name, $b_name);
  };

  if ($stadt_term) {
    $stadt_query = new WP_Query(array(
      'post_type' => 'experte',
      'posts_per_page' => 6,
      'post__not_in' => $exclude_ids,
      'tax_query' => array(
        array(
          'taxonomy' => 'stadt',
          'field' => 'term_id',
          'terms' => array($stadt_term->term_id),
        ),
      ),
      'no_found_rows' => true,
    ));

    if ($stadt_query->have_posts()) {
      $stadt_posts = $stadt_query->posts;
      usort($stadt_posts, $sort_related);
      foreach ($stadt_posts as $post_item) {
        if (count($related_posts) >= 3) {
          break;
        }
        $related_posts[] = $post_item;
        $exclude_ids[] = $post_item->ID;
      }
    }
    wp_reset_postdata();
  }

  if (count($related_posts) < 3 && is_array($eingriff_terms) && !empty($eingriff_terms)) {
    $eingriff_ids = array();
    foreach ($eingriff_terms as $term) {
      $eingriff_ids[] = $term->term_id;
    }

    $eingriff_query = new WP_Query(array(
      'post_type' => 'experte',
      'posts_per_page' => 6,
      'post__not_in' => $exclude_ids,
      'tax_query' => array(
        array(
          'taxonomy' => 'eingriff',
          'field' => 'term_id',
          'terms' => $eingriff_ids,
        ),
      ),
      'no_found_rows' => true,
    ));

    if ($eingriff_query->have_posts()) {
      $eingriff_posts = $eingriff_query->posts;
      usort($eingriff_posts, $sort_related);
      foreach ($eingriff_posts as $post_item) {
        if (count($related_posts) >= 3) {
          break;
        }
        $related_posts[] = $post_item;
        $exclude_ids[] = $post_item->ID;
      }
    }
    wp_reset_postdata();
  }
  ?>

  <?php if (!empty($related_posts)) : ?>
    <section class="expert-related">
      <div class="expert-related__inner">
        <h2 class="expert-related__title">Weitere Experten in der Region</h2>
        <div class="expert-related__grid">
          <?php foreach ($related_posts as $related_post) : ?>
            <?php
            $related_id = $related_post->ID;
            $related_name = get_field('titel_name', $related_id);
            $related_title = get_field('facharzttitel', $related_id);
            $related_city_terms = get_the_terms($related_id, 'stadt');
            $related_city = (is_array($related_city_terms) && !empty($related_city_terms)) ? $related_city_terms[0]->name : '';
            $related_eingriffe = get_the_terms($related_id, 'eingriff');
            ?>
            <a class="expert-related__card" href="<?php echo esc_url(get_permalink($related_id)); ?>">
              <h3 class="expert-related__name"><?php echo esc_html($related_name ? $related_name : get_the_title($related_id)); ?></h3>
              <?php if ($related_title) : ?>
                <div class="expert-related__subtitle"><?php echo esc_html($related_title); ?></div>
              <?php endif; ?>
              <?php if (is_array($related_eingriffe) && !empty($related_eingriffe)) : ?>
                <div class="expert-related__tags">
                  <?php
                  $tag_count = 0;
                  foreach ($related_eingriffe as $term) {
                    if ($tag_count >= 2) {
                      break;
                    }
                    $tag_count++;
                    echo '<span class="expert-related__tag">' . esc_html($term->name) . '</span>';
                  }
                  ?>
                </div>
              <?php endif; ?>
              <?php if ($related_city) : ?>
                <div class="expert-related__city"><?php echo esc_html($related_city); ?></div>
              <?php endif; ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php
get_footer();
