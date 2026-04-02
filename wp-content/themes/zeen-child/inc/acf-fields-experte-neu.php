<?php
/**
 * ACF-Felddefinitionen: Neue Felder für Experten-Profile.
 *
 * Registriert strasse, plz, ort (Adresse aufgeteilt) und
 * email_kontakt (nur intern, kein Frontend-Output) via lokalem
 * Feldgruppen-Code, damit kein manueller DB-Import nötig ist.
 *
 * @package Zeen_Child
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

acf_add_local_field_group( array(
    'key'      => 'group_experte_adresse_kontakt',
    'title'    => 'Adresse & Kontakt (intern)',
    'fields'   => array(
        array(
            'key'          => 'field_experte_strasse',
            'label'        => 'Straße',
            'name'         => 'strasse',
            'type'         => 'text',
            'instructions' => 'Straße und Hausnummer (z. B. Musterstraße 12)',
            'required'     => 0,
        ),
        array(
            'key'          => 'field_experte_plz',
            'label'        => 'PLZ',
            'name'         => 'plz',
            'type'         => 'text',
            'instructions' => 'Postleitzahl (z. B. 80331)',
            'required'     => 0,
        ),
        array(
            'key'          => 'field_experte_ort',
            'label'        => 'Ort',
            'name'         => 'ort',
            'type'         => 'text',
            'instructions' => 'Stadt/Ort (z. B. München)',
            'required'     => 0,
        ),
        array(
            'key'          => 'field_experte_email_kontakt',
            'label'        => 'E-Mail (intern)',
            'name'         => 'email_kontakt',
            'type'         => 'email',
            'instructions' => 'Interne Kontakt-E-Mail – wird nicht auf der Website angezeigt.',
            'required'     => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'experte',
            ),
        ),
    ),
    'position'      => 'normal',
    'style'         => 'default',
    'label_placement' => 'top',
    'active'        => true,
) );
