<?php
/**
 * Einstellungen für den Experten-Bereich.
 *
 * Fügt unter dem CPT "experte" einen Menüpunkt "Einstellungen" hinzu.
 *
 * Optionen:
 *   experte_claim_page_id  – ID einer WordPress-Seite (primär)
 *   experte_claim_url      – manuelle URL (überschreibt die Seite, falls gesetzt)
 *
 * Hilfsfunktion: zeen_child_get_claim_url() gibt die aufgelöste URL zurück.
 *
 * @package Zeen_Child
 */

/**
 * Gibt die URL für "Profil erweitern" zurück.
 * Vorrang: manuelle URL > ausgewählte Seite > Fallback.
 *
 * @param string $fallback URL, falls nichts konfiguriert ist.
 */
function zeen_child_get_claim_url( string $fallback = '#' ): string {
    $manual_url = get_option( 'experte_claim_url', '' );
    if ( $manual_url ) {
        return $manual_url;
    }

    $page_id = (int) get_option( 'experte_claim_page_id', 0 );
    if ( $page_id ) {
        $permalink = get_permalink( $page_id );
        if ( $permalink ) {
            return $permalink;
        }
    }

    return $fallback;
}

// ---------------------------------------------------------------------------
// Admin-Menü
// ---------------------------------------------------------------------------

add_action( 'admin_menu', 'zeen_child_experte_settings_menu' );
function zeen_child_experte_settings_menu(): void {
    add_submenu_page(
        'edit.php?post_type=experte',
        'Experten-Einstellungen',
        'Einstellungen',
        'manage_options',
        'experte-settings',
        'zeen_child_experte_settings_page'
    );
}

// ---------------------------------------------------------------------------
// Optionen registrieren
// ---------------------------------------------------------------------------

add_action( 'admin_init', 'zeen_child_experte_settings_register' );
function zeen_child_experte_settings_register(): void {
    register_setting( 'experte_settings_group', 'experte_claim_page_id', [
        'type'              => 'integer',
        'sanitize_callback' => 'absint',
        'default'           => 0,
    ] );

    register_setting( 'experte_settings_group', 'experte_claim_url', [
        'type'              => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'default'           => '',
    ] );

    add_settings_section( 'experte_settings_claim', '', '__return_null', 'experte-settings' );

    add_settings_field(
        'experte_claim_page_id',
        'Seite auswählen',
        'zeen_child_field_claim_page',
        'experte-settings',
        'experte_settings_claim'
    );

    add_settings_field(
        'experte_claim_url',
        'Oder manuelle URL',
        'zeen_child_field_claim_url',
        'experte-settings',
        'experte_settings_claim'
    );
}

function zeen_child_field_claim_page(): void {
    $selected = (int) get_option( 'experte_claim_page_id', 0 );
    echo '<select name="experte_claim_page_id" id="experte_claim_page_id">';
    echo '<option value="0">— Keine Seite ausgewählt —</option>';
    foreach ( get_pages() as $page ) {
        printf(
            '<option value="%d"%s>%s</option>',
            $page->ID,
            selected( $selected, $page->ID, false ),
            esc_html( $page->post_title )
        );
    }
    echo '</select>';
    echo '<p class="description">Wähle eine bestehende WordPress-Seite aus.</p>';
}

function zeen_child_field_claim_url(): void {
    $value = get_option( 'experte_claim_url', '' );
    echo '<input
        type="url"
        id="experte_claim_url"
        name="experte_claim_url"
        value="' . esc_attr( $value ) . '"
        class="regular-text"
        placeholder="https://example.com/profil-erweitern"
    >';
    echo '<p class="description">Optional. Eine eingetragene URL hat Vorrang vor der ausgewählten Seite.</p>';
}

// ---------------------------------------------------------------------------
// Settings-Seite
// ---------------------------------------------------------------------------

function zeen_child_experte_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1>Experten-Einstellungen</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'experte_settings_group' );
            do_settings_sections( 'experte-settings' );
            submit_button( 'Einstellungen speichern' );
            ?>
        </form>
    </div>
    <?php
}
