<?php
/**
* ACF Flexible Content – Seitenmodule
*
* Registriert eine Flexible-Content-Feldgruppe für alle Seiten,
* die das Page Template "page-profil-erweitern.php" (oder ein anderes
* Template, das du hier ergänzt) verwenden.
*
* Layouts (jedes ist ein wiederverwendbares Modul):
*  - hero                Großer Hero-Bereich oben
*  - founder_banner      Gründungspartner-Highlight (grüner Banner)
*  - pricing_section     Preiskarten-Grid (beliebig viele Karten)
*  - context_box         Zweispaltig: Text links, Tier-Karte rechts
*  - comparison_table    Feature-Vergleichstabelle
*  - benefits_grid       Vorteile-Grid (Icon + Titel + Text)
*  - steps               Nummerierte Schritte
*  - cta_form            CTA-Bereich mit Kontaktformular
*/

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
  return;
}

acf_add_local_field_group( [
  'key'                   => 'group_flexible_page',
  'title'                 => 'Flexible Seitenmodule',
  'fields'                => [
    [
      'key'           => 'field_flexible_content',
      'label'         => 'Seitenmodule',
      'name'          => 'flexible_content',
      'type'          => 'flexible_content',
      'button_label'  => '+ Modul hinzufügen',
      'layouts'       => [

        /* ────────────────────────────────────────────
        * 1. HERO
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_hero',
          'name'       => 'hero',
          'label'      => 'Hero',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_hero_badge',
              'label'         => 'Badge-Text',
              'name'          => 'badge_text',
              'type'          => 'text',
              'default_value' => 'Für Fachärzte & Kliniken',
            ],
            [
              'key'           => 'field_hero_headline',
              'label'         => 'Überschrift',
              'name'          => 'headline',
              'type'          => 'text',
            ],
            [
              'key'           => 'field_hero_subtext',
              'label'         => 'Untertext',
              'name'          => 'subtext',
              'type'          => 'textarea',
              'rows'          => 3,
            ],
            [
              'key'           => 'field_hero_btn_primary_text',
              'label'         => 'Button 1 – Text (gold)',
              'name'          => 'btn_primary_text',
              'type'          => 'text',
              'default_value' => 'Premium-Profil anfragen',
            ],
            [
              'key'           => 'field_hero_btn_primary_url',
              'label'         => 'Button 1 – URL',
              'name'          => 'btn_primary_url',
              'type'          => 'text',
              'default_value' => '#formular',
            ],
            [
              'key'           => 'field_hero_btn_secondary_text',
              'label'         => 'Button 2 – Text (Outline)',
              'name'          => 'btn_secondary_text',
              'type'          => 'text',
              'default_value' => 'Kostenloses Profil prüfen',
            ],
            [
              'key'           => 'field_hero_btn_secondary_url',
              'label'         => 'Button 2 – URL',
              'name'          => 'btn_secondary_url',
              'type'          => 'text',
              'default_value' => '#',
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 2. GRÜNDUNGSPARTNER BANNER
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_founder_banner',
          'name'       => 'founder_banner',
          'label'      => 'Gründungspartner-Banner',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_fb_badge',
              'label'         => 'Badge-Label',
              'name'          => 'badge_label',
              'type'          => 'text',
              'default_value' => 'Gründungspartner',
            ],
            [
              'key'           => 'field_fb_slots',
              'label'         => 'Verfügbare-Plätze-Text',
              'name'          => 'slots_text',
              'type'          => 'text',
              'instructions'  => 'z. B. „Noch 20 von 20 Plätzen verfügbar"',
              'default_value' => 'Noch 20 von 20 Plätzen verfügbar',
            ],
            [
              'key'   => 'field_fb_headline',
              'label' => 'Überschrift',
              'name'  => 'headline',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_fb_desc',
              'label'        => 'Beschreibung',
              'name'         => 'description',
              'type'         => 'wysiwyg',
              'toolbar'      => 'basic',
              'media_upload' => 0,
            ],
            [
              'key'           => 'field_fb_price',
              'label'         => 'Preis',
              'name'          => 'price_amount',
              'type'          => 'text',
              'default_value' => '100 €',
            ],
            [
              'key'           => 'field_fb_period',
              'label'         => 'Zeitraum',
              'name'          => 'price_period',
              'type'          => 'text',
              'default_value' => 'pro Monat zzgl. MwSt.',
            ],
            [
              'key'           => 'field_fb_total',
              'label'         => 'Gesamtpreis',
              'name'          => 'price_total',
              'type'          => 'text',
              'default_value' => '1.200 €/Jahr',
            ],
            [
              'key'           => 'field_fb_original',
              'label'         => 'Originalpreis (durchgestrichen)',
              'name'          => 'price_original',
              'type'          => 'text',
              'default_value' => 'statt 1.500 €/Jahr',
            ],
            [
              'key'           => 'field_fb_saving',
              'label'         => 'Ersparnis-Badge',
              'name'          => 'price_saving',
              'type'          => 'text',
              'default_value' => 'Sie sparen 600 €/Jahr',
            ],
            [
              'key'           => 'field_fb_btn_text',
              'label'         => 'Button-Text',
              'name'          => 'button_text',
              'type'          => 'text',
              'default_value' => 'Platz sichern',
            ],
            [
              'key'           => 'field_fb_btn_url',
              'label'         => 'Button-URL',
              'name'          => 'button_url',
              'type'          => 'text',
              'default_value' => '#formular',
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 3. PREISPAKETE
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_pricing_section',
          'name'       => 'pricing_section',
          'label'      => 'Preispakete',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_ps_label',
              'label'         => 'Section-Label',
              'name'          => 'section_label',
              'type'          => 'text',
              'default_value' => 'Pakete & Preise',
            ],
            [
              'key'   => 'field_ps_title',
              'label' => 'Section-Titel',
              'name'  => 'section_title',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_ps_subtitle',
              'label'        => 'Section-Untertitel (optional)',
              'name'         => 'section_subtitle',
              'type'         => 'textarea',
              'rows'         => 2,
              'instructions' => 'Erscheint unter dem Titel, z. B. „Von der Basispräsenz bis zur umfassenden Expertensichtbarkeit."',
            ],
            [
              'key'          => 'field_ps_cards',
              'label'        => 'Preiskarten',
              'name'         => 'cards',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Karte hinzufügen',
              'sub_fields'   => [
                // ── Zeile 1: Titel · Untertitel ──
                [
                  'key'     => 'field_pc_title',
                  'label'   => 'Titel',
                  'name'    => 'title',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '50' ],
                ],
                [
                  'key'     => 'field_pc_subtitle',
                  'label'   => 'Untertitel',
                  'name'    => 'subtitle',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '50' ],
                ],
                // ── Zeile 2: Preis · Zeitraum · Preis-Infozeile ──
                [
                  'key'     => 'field_pc_price',
                  'label'   => 'Preis',
                  'name'    => 'price_amount',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '25' ],
                ],
                [
                  'key'     => 'field_pc_period',
                  'label'   => 'Zeitraum',
                  'name'    => 'price_period',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '35' ],
                ],
                [
                  'key'          => 'field_pc_price_info',
                  'label'        => 'Preis-Infozeile (optional)',
                  'name'         => 'price_info',
                  'type'         => 'text',
                  'instructions' => 'z. B. „1.800 €/Jahr · monatliche Zahlung möglich"',
                  'wrapper'      => [ 'width' => '40' ],
                ],
                // ── Zeile 3: Originalpreis · Ersparnis-Badge ──
                [
                  'key'     => 'field_pc_original',
                  'label'   => 'Originalpreis (durchgestrichen)',
                  'name'    => 'price_original',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '50' ],
                ],
                [
                  'key'     => 'field_pc_saving',
                  'label'   => 'Ersparnis-Badge',
                  'name'    => 'price_saving',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '50' ],
                ],
                // ── Zeile 4: Featured · Ribbon-Text ──
                [
                  'key'     => 'field_pc_featured',
                  'label'   => 'Featured (goldener Rahmen)',
                  'name'    => 'is_featured',
                  'type'    => 'true_false',
                  'ui'      => 1,
                  'wrapper' => [ 'width' => '25' ],
                ],
                [
                  'key'           => 'field_pc_ribbon',
                  'label'         => 'Ribbon-Text (wenn Featured)',
                  'name'          => 'ribbon_text',
                  'type'          => 'text',
                  'default_value' => 'Empfohlen',
                  'wrapper'       => [ 'width' => '50' ],
                ],
                [
                  'key'          => 'field_pc_border_color',
                  'label'        => 'Rahmenfarbe (optional)',
                  'name'         => 'border_color',
                  'type'         => 'color_picker',
                  'instructions' => 'Leer lassen = kein farbiger Rahmen. Überschreibt den Featured-Rahmen.',
                  'wrapper'      => [ 'width' => '25' ],
                ],
                [
                  'key'          => 'field_pc_features',
                  'label'        => 'Enthaltene Features (✓)',
                  'name'         => 'features',
                  'type'         => 'repeater',
                  'layout'       => 'table',
                  'button_label' => '+ Feature hinzufügen',
                  'sub_fields'   => [
                    [
                      'key'   => 'field_pcf_item',
                      'label' => 'Feature',
                      'name'  => 'feature',
                      'type'  => 'text',
                    ],
                  ],
                ],
                [
                  'key'          => 'field_pc_features_excluded',
                  'label'        => 'Nicht enthaltene Features (—)',
                  'name'         => 'features_excluded',
                  'type'         => 'repeater',
                  'layout'       => 'table',
                  'button_label' => '+ Feature hinzufügen',
                  'sub_fields'   => [
                    [
                      'key'   => 'field_pcfe_item',
                      'label' => 'Feature',
                      'name'  => 'feature',
                      'type'  => 'text',
                    ],
                  ],
                ],
                // ── Zeile 5: Button-Text · Button-URL · Button-Stil ──
                [
                  'key'           => 'field_pc_btn_text',
                  'label'         => 'Button-Text',
                  'name'          => 'button_text',
                  'type'          => 'text',
                  'default_value' => 'Jetzt anfragen',
                  'wrapper'       => [ 'width' => '30' ],
                ],
                [
                  'key'           => 'field_pc_btn_url',
                  'label'         => 'Button-URL',
                  'name'          => 'button_url',
                  'type'          => 'text',
                  'default_value' => '#formular',
                  'wrapper'       => [ 'width' => '50' ],
                ],
                [
                  'key'           => 'field_pc_btn_style',
                  'label'         => 'Button-Stil',
                  'name'          => 'button_style',
                  'type'          => 'select',
                  'choices'       => [
                    'outline' => 'Outline',
                    'gold'    => 'Gold',
                  ],
                  'default_value' => 'outline',
                  'wrapper'       => [ 'width' => '20' ],
                ],
              ],
            ],
            [
              'key'           => 'field_ps_footnote',
              'label'         => 'Fußnote',
              'name'          => 'footer_note',
              'type'          => 'text',
              'default_value' => 'Alle Preise zzgl. 19 % MwSt. · Keine Einrichtungsgebühr · Profil innerhalb von 48 Stunden online',
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 4. KONTEXT-BOX (zweispaltig: Text + Tier-Karte)
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_context_box',
          'name'       => 'context_box',
          'label'      => 'Kontext-Box (Text + Tier-Karte)',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'   => 'field_cb_headline',
              'label' => 'Überschrift (links)',
              'name'  => 'headline',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_cb_text',
              'label'        => 'Text (links)',
              'name'         => 'text',
              'type'         => 'wysiwyg',
              'toolbar'      => 'basic',
              'media_upload' => 0,
              'instructions' => 'Unterstützt Kursivschrift und Links.',
            ],
            [
              'key'          => 'field_cb_tiers',
              'label'        => 'Tier-Einträge (rechte Karte)',
              'name'         => 'tiers',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Tier hinzufügen',
              'sub_fields'   => [
                [
                  'key'          => 'field_cbt_dot_color',
                  'label'        => 'Punkt-Farbe',
                  'name'         => 'dot_color',
                  'type'         => 'color_picker',
                  'instructions' => '#c0c0c0 Grau · #c5a55a Gold · #1a2332 Navy',
                  'wrapper'      => [ 'width' => '20' ],
                ],
                [
                  'key'     => 'field_cbt_name',
                  'label'   => 'Tier-Name',
                  'name'    => 'tier_name',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '30' ],
                ],
                [
                  'key'     => 'field_cbt_desc',
                  'label'   => 'Kurzbeschreibung',
                  'name'    => 'tier_description',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '50' ],
                ],
              ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 5. VERGLEICHSTABELLE
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_comparison_table',
          'name'       => 'comparison_table',
          'label'      => 'Vergleichstabelle',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_ct_label',
              'label'         => 'Section-Label',
              'name'          => 'section_label',
              'type'          => 'text',
              'default_value' => 'Leistungsvergleich',
              'wrapper'       => [ 'width' => '50' ],
            ],
            [
              'key'     => 'field_ct_title',
              'label'   => 'Section-Titel',
              'name'    => 'section_title',
              'type'    => 'text',
              'wrapper' => [ 'width' => '50' ],
            ],
            [
              'key'           => 'field_ct_col1',
              'label'         => 'Spalte 1 – Bezeichnung',
              'name'          => 'col_basis',
              'type'          => 'text',
              'default_value' => 'Basis (kostenlos)',
              'wrapper'       => [ 'width' => '33' ],
            ],
            [
              'key'           => 'field_ct_col2',
              'label'         => 'Spalte 2 – Bezeichnung',
              'name'          => 'col_premium',
              'type'          => 'text',
              'default_value' => 'Premium',
              'wrapper'       => [ 'width' => '33' ],
            ],
            [
              'key'           => 'field_ct_col3',
              'label'         => 'Spalte 3 – Bezeichnung (optional)',
              'name'          => 'col_authority',
              'type'          => 'text',
              'default_value' => 'Authority',
              'instructions'  => 'Leer lassen um nur 2 Spalten anzuzeigen.',
              'wrapper'       => [ 'width' => '34' ],
            ],
            [
              'key'          => 'field_ct_footnote',
              'label'        => 'Fußnote (unter der Tabelle)',
              'name'         => 'footnote',
              'type'         => 'text',
              'instructions' => 'z. B. „* Wir planen eine jährliche Hochglanz-Printausgabe …"',
            ],
            [
              'key'          => 'field_ct_rows',
              'label'        => 'Zeilen',
              'name'         => 'rows',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Zeile hinzufügen',
              'sub_fields'   => [
                [
                  'key'     => 'field_ctr_feature',
                  'label'   => 'Feature / Funktion',
                  'name'    => 'feature',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '34' ],
                ],
                [
                  'key'           => 'field_ctr_basis_type',
                  'label'         => 'Spalte 1',
                  'name'          => 'basis_type',
                  'type'          => 'select',
                  'choices'       => [
                    'check' => '✓ Ja',
                    'cross' => '— Nein',
                    'text'  => 'Text…',
                  ],
                  'default_value' => 'cross',
                  'wrapper'       => [ 'width' => '10' ],
                ],
                [
                  'key'     => 'field_ctr_basis_text',
                  'label'   => 'Spalte 1 – Text',
                  'name'    => 'basis_text',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '12' ],
                ],
                [
                  'key'           => 'field_ctr_premium_type',
                  'label'         => 'Spalte 2',
                  'name'          => 'premium_type',
                  'type'          => 'select',
                  'choices'       => [
                    'check' => '✓ Ja',
                    'cross' => '— Nein',
                    'text'  => 'Text…',
                  ],
                  'default_value' => 'check',
                  'wrapper'       => [ 'width' => '10' ],
                ],
                [
                  'key'     => 'field_ctr_premium_text',
                  'label'   => 'Spalte 2 – Text',
                  'name'    => 'premium_text',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '12' ],
                ],
                [
                  'key'           => 'field_ctr_authority_type',
                  'label'         => 'Spalte 3',
                  'name'          => 'authority_type',
                  'type'          => 'select',
                  'choices'       => [
                    'check' => '✓ Ja',
                    'cross' => '— Nein',
                    'text'  => 'Text…',
                  ],
                  'default_value' => 'check',
                  'wrapper'       => [ 'width' => '10' ],
                ],
                [
                  'key'     => 'field_ctr_authority_text',
                  'label'   => 'Spalte 3 – Text',
                  'name'    => 'authority_text',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '12' ],
                ],
              ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 5. VORTEILE-GRID
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_benefits_grid',
          'name'       => 'benefits_grid',
          'label'      => 'Vorteile-Grid',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_bg_label',
              'label'         => 'Section-Label',
              'name'          => 'section_label',
              'type'          => 'text',
              'default_value' => 'Warum Premium',
            ],
            [
              'key'   => 'field_bg_title',
              'label' => 'Section-Titel',
              'name'  => 'section_title',
              'type'  => 'text',
            ],
            [
              'key'   => 'field_bg_subtitle',
              'label' => 'Section-Untertitel (optional)',
              'name'  => 'section_subtitle',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_bg_items',
              'label'        => 'Vorteile',
              'name'         => 'items',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Vorteil hinzufügen',
              'sub_fields'   => [
                [
                  'key'     => 'field_bgi_title',
                  'label'   => 'Titel',
                  'name'    => 'title',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '35' ],
                ],
                [
                  'key'     => 'field_bgi_text',
                  'label'   => 'Text',
                  'name'    => 'text',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '65' ],
                ],
              ],
            ],
            [
              'key'          => 'field_bg_footnote_label',
              'label'        => 'Hinweis-Label (fett, optional)',
              'name'         => 'footnote_label',
              'type'         => 'text',
              'instructions' => 'z. B. „Transparenz:" – wird fett vorangestellt.',
              'wrapper'      => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_bg_footnote_text',
              'label'   => 'Hinweis-Text (optional)',
              'name'    => 'footnote_text',
              'type'    => 'textarea',
              'rows'    => 2,
              'wrapper' => [ 'width' => '75' ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 6. SCHRITTE
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_steps',
          'name'       => 'steps',
          'label'      => 'Schritte',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_st_label',
              'label'         => 'Section-Label',
              'name'          => 'section_label',
              'type'          => 'text',
              'default_value' => 'In 3 Schritten',
            ],
            [
              'key'   => 'field_st_title',
              'label' => 'Section-Titel',
              'name'  => 'section_title',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_st_items',
              'label'        => 'Schritte',
              'name'         => 'items',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Schritt hinzufügen',
              'sub_fields'   => [
                [
                  'key'   => 'field_sti_title',
                  'label' => 'Titel',
                  'name'  => 'title',
                  'type'  => 'text',
                ],
                [
                  'key'   => 'field_sti_text',
                  'label' => 'Text',
                  'name'  => 'text',
                  'type'  => 'textarea',
                  'rows'  => 3,
                ],
              ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 7. CTA + KONTAKTFORMULAR
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_cta_form',
          'name'       => 'cta_form',
          'label'      => 'CTA + Kontaktformular',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'           => 'field_cf_label',
              'label'         => 'Section-Label',
              'name'          => 'section_label',
              'type'          => 'text',
              'default_value' => 'Jetzt starten',
            ],
            [
              'key'   => 'field_cf_title',
              'label' => 'Section-Titel',
              'name'  => 'section_title',
              'type'  => 'text',
            ],
            [
              'key'           => 'field_cf_subtitle',
              'label'         => 'Untertitel',
              'name'          => 'subtitle',
              'type'          => 'text',
              'default_value' => 'Keine Einrichtungsgebühr · in 48 Stunden online',
            ],
            [
              'key'          => 'field_cf_packages',
              'label'        => 'Anliegen-Optionen (Dropdown)',
              'name'         => 'packages',
              'type'         => 'repeater',
              'layout'       => 'table',
              'button_label' => '+ Option hinzufügen',
              'sub_fields'   => [
                [
                  'key'   => 'field_cfp_value',
                  'label' => 'Wert (value)',
                  'name'  => 'value',
                  'type'  => 'text',
                ],
                [
                  'key'   => 'field_cfp_label',
                  'label' => 'Anzeigetext',
                  'name'  => 'label',
                  'type'  => 'text',
                ],
              ],
            ],
            [
              'key'           => 'field_cf_recipient',
              'label'         => 'Empfänger-E-Mail',
              'name'          => 'recipient_email',
              'type'          => 'email',
              'instructions'  => 'An diese Adresse werden Formulareinsendungen gesendet.',
            ],
            [
              'key'           => 'field_cf_form_note',
              'label'         => 'Formular-Hinweis (unter dem Button)',
              'name'          => 'form_note',
              'type'          => 'text',
              'default_value' => 'Wir melden uns innerhalb von 24 Stunden bei Ihnen. Keine automatische Buchung.',
            ],
          ],
        ],


        /* ────────────────────────────────────────────
        * 8. FEATURE-GRID (dunkel)
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_feature_grid',
          'name'       => 'feature_grid',
          'label'      => 'Feature-Grid (dunkel)',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'     => 'field_fg_label',
              'label'   => 'Section-Label',
              'name'    => 'section_label',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_fg_title',
              'label'   => 'Section-Titel',
              'name'    => 'section_title',
              'type'    => 'text',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'  => 'field_fg_subtitle',
              'label' => 'Untertitel',
              'name'  => 'section_subtitle',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_fg_items',
              'label'        => 'Features',
              'name'         => 'items',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Feature hinzufügen',
              'sub_fields'   => [
                [
                  'key'          => 'field_fgi_icon',
                  'label'        => 'Icon / Emoji',
                  'name'         => 'icon',
                  'type'         => 'text',
                  'instructions' => 'Emoji oder kurzes Symbol, z. B. ✓ oder 🔒',
                  'wrapper'      => [ 'width' => '15' ],
                ],
                [
                  'key'     => 'field_fgi_title',
                  'label'   => 'Titel',
                  'name'    => 'title',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '35' ],
                ],
                [
                  'key'     => 'field_fgi_text',
                  'label'   => 'Text',
                  'name'    => 'text',
                  'type'    => 'textarea',
                  'rows'    => 2,
                  'wrapper' => [ 'width' => '50' ],
                ],
              ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 9. PROFIL-VORSCHAU
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_profile_preview',
          'name'       => 'profile_preview',
          'label'      => 'Profil-Vorschau',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'     => 'field_pp_label',
              'label'   => 'Section-Label',
              'name'    => 'section_label',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_pp_title',
              'label'   => 'Section-Titel',
              'name'    => 'section_title',
              'type'    => 'text',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'  => 'field_pp_subtitle',
              'label' => 'Untertitel',
              'name'  => 'section_subtitle',
              'type'  => 'text',
            ],
            [
              'key'          => 'field_pp_image',
              'label'        => 'Profil-Bild',
              'name'         => 'profile_image',
              'type'         => 'image',
              'return_format' => 'array',
              'preview_size' => 'medium',
              'instructions' => 'Screenshot oder Mockup des Profils.',
            ],
            [
              'key'  => 'field_pp_footnote',
              'label' => 'Fußnote (kursiv, optional)',
              'name'  => 'footnote',
              'type'  => 'text',
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 10. FAQ-AKKORDEON
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_faq',
          'name'       => 'faq',
          'label'      => 'FAQ-Akkordeon',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'     => 'field_faq_label',
              'label'   => 'Section-Label',
              'name'    => 'section_label',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_faq_title',
              'label'   => 'Section-Titel',
              'name'    => 'section_title',
              'type'    => 'text',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'          => 'field_faq_items',
              'label'        => 'Fragen & Antworten',
              'name'         => 'items',
              'type'         => 'repeater',
              'layout'       => 'block',
              'button_label' => '+ Frage hinzufügen',
              'sub_fields'   => [
                [
                  'key'     => 'field_faqi_question',
                  'label'   => 'Frage',
                  'name'    => 'question',
                  'type'    => 'text',
                  'wrapper' => [ 'width' => '40' ],
                ],
                [
                  'key'     => 'field_faqi_answer',
                  'label'   => 'Antwort',
                  'name'    => 'answer',
                  'type'    => 'textarea',
                  'rows'    => 3,
                  'wrapper' => [ 'width' => '60' ],
                ],
              ],
            ],
          ],
        ],

        /* ────────────────────────────────────────────
        * 11. CTA – NUR BUTTONS (kein Formular)
        * ──────────────────────────────────────────── */
        [
          'key'        => 'layout_cta_buttons',
          'name'       => 'cta_buttons',
          'label'      => 'CTA – Buttons',
          'display'    => 'block',
          'sub_fields' => [
            [
              'key'     => 'field_cb_label',
              'label'   => 'Section-Label',
              'name'    => 'section_label',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_cb_title',
              'label'   => 'Überschrift',
              'name'    => 'section_title',
              'type'    => 'text',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'  => 'field_cb_subtitle',
              'label' => 'Untertitel',
              'name'  => 'subtitle',
              'type'  => 'text',
            ],
            [
              'key'     => 'field_cb_btn1_text',
              'label'   => 'Button 1 – Text',
              'name'    => 'btn_primary_text',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_cb_btn1_url',
              'label'   => 'Button 1 – URL',
              'name'    => 'btn_primary_url',
              'type'    => 'url',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'     => 'field_cb_btn2_text',
              'label'   => 'Button 2 – Text',
              'name'    => 'btn_secondary_text',
              'type'    => 'text',
              'wrapper' => [ 'width' => '25' ],
            ],
            [
              'key'     => 'field_cb_btn2_url',
              'label'   => 'Button 2 – URL',
              'name'    => 'btn_secondary_url',
              'type'    => 'url',
              'wrapper' => [ 'width' => '75' ],
            ],
            [
              'key'  => 'field_cb_note',
              'label' => 'Hinweis (klein, unter Buttons)',
              'name'  => 'note',
              'type'  => 'text',
            ],
          ],
        ],

      ], // end layouts
    ],
  ], // end fields
  'location' => [
    [
      [
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'page-profil-erweitern.php',
      ],
    ],
  ],
  'menu_order'          => 0,
  'position'            => 'normal',
  'style'               => 'default',
  'label_placement'     => 'top',
  'instruction_placement' => 'label',
] );
