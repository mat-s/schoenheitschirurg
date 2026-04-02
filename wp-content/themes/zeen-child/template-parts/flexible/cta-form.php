<?php
/**
* Flexible Layout: CTA + Kontaktformular
*
* Verarbeitet das Formular serverseitig (wp_mail) und gibt
* Erfolgs- / Fehlermeldungen aus. Nonce-gesichert.
*/
$section_label   = get_sub_field( 'section_label' );
$section_title   = get_sub_field( 'section_title' );
$subtitle        = get_sub_field( 'subtitle' );
$packages        = get_sub_field( 'packages' );
$recipient_email = get_sub_field( 'recipient_email' );
$form_note       = get_sub_field( 'form_note' );

// Fallback-Empfänger wenn kein Feld gefüllt
if ( ! $recipient_email ) {
  $recipient_email = get_option( 'admin_email' );
}

// ── Formular verarbeiten ────────────────────────────────────────────────────
$form_sent  = false;
$form_error = '';

if (
  isset( $_POST['fp_cta_nonce'] ) &&
  wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fp_cta_nonce'] ) ), 'fp_cta_form' )
) {
  $name    = sanitize_text_field( wp_unslash( $_POST['fp_name']    ?? '' ) );
  $praxis  = sanitize_text_field( wp_unslash( $_POST['fp_praxis']  ?? '' ) );
  $email   = sanitize_email(      wp_unslash( $_POST['fp_email']   ?? '' ) );
  $telefon = sanitize_text_field( wp_unslash( $_POST['fp_telefon'] ?? '' ) );
  $package = sanitize_text_field( wp_unslash( $_POST['fp_package'] ?? '' ) );
  $message = sanitize_textarea_field( wp_unslash( $_POST['fp_message'] ?? '' ) );

  if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
    $form_error = __( 'Bitte füllen Sie Name und eine gültige E-Mail-Adresse aus.', 'zeen-child' );
  } else {
    /* translators: %s: name of the enquirer */
    $subject = sprintf( __( 'Neue Profilanfrage: %s', 'zeen-child' ), $name );
    $body    = __( 'Name / Titel', 'zeen-child' ) . ": {$name}\n"
        . __( 'Praxis / Klinik', 'zeen-child' ) . ": {$praxis}\n"
        . __( 'E-Mail', 'zeen-child' ) . ": {$email}\n"
        . __( 'Telefon', 'zeen-child' ) . ": {$telefon}\n"
        . __( 'Ihr Anliegen', 'zeen-child' ) . ": {$package}\n\n"
        . __( 'Nachricht', 'zeen-child' ) . ":\n{$message}";

    $headers = [
      'Content-Type: text/plain; charset=UTF-8',
      'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $sent = wp_mail( $recipient_email, $subject, $body, $headers );

    if ( $sent ) {
      $form_sent = true;
    } else {
      $form_error = __( 'Die Nachricht konnte leider nicht gesendet werden. Bitte versuchen Sie es später erneut.', 'zeen-child' );
    }
  }
}
?>
<section class="fp-cta-bg" id="formular">
  <div class="fp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $subtitle ) : ?>
      <p class="fp-cta-subtitle"><?php echo esc_html( $subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( $form_sent ) : ?>
      <div class="fp-form-success fp-contact-form">
        <?php esc_html_e( 'Vielen Dank! Wir haben Ihre Anfrage erhalten und melden uns innerhalb von 24 Stunden bei Ihnen.', 'zeen-child' ); ?>
      </div>
    <?php else : ?>

      <?php if ( $form_error ) : ?>
        <div class="fp-form-error fp-contact-form">
          <?php echo esc_html( $form_error ); ?>
        </div>
      <?php endif; ?>

      <form class="fp-contact-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>#formular">
        <?php wp_nonce_field( 'fp_cta_form', 'fp_cta_nonce' ); ?>

        <div class="fp-form-grid">
          <div class="fp-form-row">
            <label for="fp_name"><?php esc_html_e( 'Ihr Name / Titel', 'zeen-child' ); ?></label>
            <input type="text" id="fp_name" name="fp_name"
               placeholder="<?php esc_attr_e( 'z. B. Dr. med. Anna Müller', 'zeen-child' ); ?>"
               value="<?php echo esc_attr( $_POST['fp_name'] ?? '' ); ?>"
               required>
          </div>
          <div class="fp-form-row">
            <label for="fp_praxis"><?php esc_html_e( 'Praxis / Klinik', 'zeen-child' ); ?></label>
            <input type="text" id="fp_praxis" name="fp_praxis"
               placeholder="<?php esc_attr_e( 'z. B. Praxis für Ästhetik Berlin', 'zeen-child' ); ?>"
               value="<?php echo esc_attr( $_POST['fp_praxis'] ?? '' ); ?>">
          </div>
        </div>

        <div class="fp-form-grid">
          <div class="fp-form-row">
            <label for="fp_email"><?php esc_html_e( 'E-Mail', 'zeen-child' ); ?></label>
            <input type="email" id="fp_email" name="fp_email"
               placeholder="<?php esc_attr_e( 'praxis@beispiel.de', 'zeen-child' ); ?>"
               value="<?php echo esc_attr( $_POST['fp_email'] ?? '' ); ?>"
               required>
          </div>
          <div class="fp-form-row">
            <label for="fp_telefon"><?php esc_html_e( 'Telefon (optional)', 'zeen-child' ); ?></label>
            <input type="tel" id="fp_telefon" name="fp_telefon"
               placeholder="<?php esc_attr_e( '+49 ...', 'zeen-child' ); ?>"
               value="<?php echo esc_attr( $_POST['fp_telefon'] ?? '' ); ?>">
          </div>
        </div>

        <?php if ( $packages ) : ?>
          <div class="fp-form-row">
            <label for="fp_package"><?php esc_html_e( 'Ihr Anliegen', 'zeen-child' ); ?></label>
            <select id="fp_package" name="fp_package">
              <option value=""><?php esc_html_e( 'Bitte wählen', 'zeen-child' ); ?></option>
              <?php foreach ( $packages as $pkg ) :
                $val      = esc_attr( $pkg['value'] );
                $label    = esc_html( $pkg['label'] );
                $selected = selected( ( $_POST['fp_package'] ?? '' ), $pkg['value'], false );
              ?>
                <option value="<?php echo $val; ?>" <?php echo $selected; ?>>
                  <?php echo $label; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>

        <div class="fp-form-row">
          <label for="fp_message"><?php esc_html_e( 'Nachricht (optional)', 'zeen-child' ); ?></label>
          <textarea id="fp_message" name="fp_message"
               placeholder="<?php esc_attr_e( 'Haben Sie Fragen oder besondere Wünsche?', 'zeen-child' ); ?>"><?php echo esc_textarea( $_POST['fp_message'] ?? '' ); ?></textarea>
        </div>

        <button type="submit" class="fp-btn-submit"><?php esc_html_e( 'Unverbindlich anfragen', 'zeen-child' ); ?></button>

        <?php if ( $form_note ) : ?>
          <p class="fp-form-note"><?php echo esc_html( $form_note ); ?></p>
        <?php endif; ?>
      </form>

    <?php endif; ?>
  </div>
</section>
