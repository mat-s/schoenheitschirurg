<?php
/**
* Flexible Layout: Vergleichstabelle
* Unterstützt 2 oder 3 Datenspalten. Spalte 3 erscheint nur wenn
* „Spalte 3 – Bezeichnung" im Backend ausgefüllt ist.
*/
$section_label = get_sub_field( 'section_label' );
$section_title = get_sub_field( 'section_title' );
$col_basis     = get_sub_field( 'col_basis' )     ?: 'Kostenlos';
$col_premium   = get_sub_field( 'col_premium' )   ?: 'Premium';
$col_authority = get_sub_field( 'col_authority' );   // leer = nur 2 Spalten
$has_col3      = ! empty( $col_authority );
$rows          = get_sub_field( 'rows' );
$footnote      = get_sub_field( 'footnote' );

/**
* Hilfsfunktion: rendert eine Tabellenzelle anhand von type + text.
*/
function fp_ct_cell( string $type, string $text ): void {
  if ( 'check' === $type ) {
    echo '<span class="fp-check">&#10003;</span>';
  } elseif ( 'cross' === $type ) {
    echo '<span class="fp-cross">&mdash;</span>';
  } else {
    echo esc_html( $text );
  }
}
?>
<section>
  <div class="fp-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>

    <?php if ( $rows ) : ?>
      <table class="fp-comparison-table<?php echo $has_col3 ? ' fp-comparison-table--3col' : ''; ?>">
        <thead>
          <tr>
            <th>Funktion</th>
            <th><?php echo esc_html( $col_basis ); ?></th>
            <th class="fp-col-highlight"><?php echo esc_html( $col_premium ); ?></th>
            <?php if ( $has_col3 ) : ?>
              <th><?php echo esc_html( $col_authority ); ?></th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $rows as $row ) :
            $basis_type     = $row['basis_type']     ?? 'cross';
            $premium_type   = $row['premium_type']   ?? 'check';
            $authority_type = $row['authority_type'] ?? 'check';
          ?>
            <tr>
              <td><?php echo wp_kses_post( $row['feature'] ); ?></td>
              <td><?php fp_ct_cell( $basis_type,     $row['basis_text']     ?? '' ); ?></td>
              <td class="fp-col-highlight"><?php fp_ct_cell( $premium_type, $row['premium_text']   ?? '' ); ?></td>
              <?php if ( $has_col3 ) : ?>
                <td><?php fp_ct_cell( $authority_type, $row['authority_text'] ?? '' ); ?></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php if ( $footnote ) : ?>
      <p class="fp-comparison-footnote"><?php echo esc_html( $footnote ); ?></p>
    <?php endif; ?>
  </div>
</section>
