<?php
/**
* Flexible Layout: FAQ-Akkordeon
*/
$section_label = get_sub_field( 'section_label' );
$section_title = get_sub_field( 'section_title' );
$items         = get_sub_field( 'items' );
?>
<section class="fp-faq-bg">
  <div class="fp-section fp-faq-section">
    <?php if ( $section_label ) : ?>
      <div class="fp-section-label"><?php echo esc_html( $section_label ); ?></div>
    <?php endif; ?>
    <?php if ( $section_title ) : ?>
      <h2 class="fp-section-title"><?php echo esc_html( $section_title ); ?></h2>
    <?php endif; ?>

    <?php if ( $items ) : ?>
      <div class="fp-faq-list">
        <?php foreach ( $items as $i => $item ) : ?>
          <div class="fp-faq-item" id="fp-faq-<?php echo $i; ?>">
            <button
              class="fp-faq-question"
              aria-expanded="false"
              aria-controls="fp-faq-answer-<?php echo $i; ?>"
            >
              <span><?php echo esc_html( $item['question'] ); ?></span>
              <span class="fp-faq-icon" aria-hidden="true">+</span>
            </button>
            <div
              class="fp-faq-answer"
              id="fp-faq-answer-<?php echo $i; ?>"
              hidden
            >
              <p><?php echo esc_html( $item['answer'] ); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
(function () {
  document.querySelectorAll('.fp-faq-question').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      var answerId = btn.getAttribute('aria-controls');
      var answer   = document.getElementById(answerId);
      var icon     = btn.querySelector('.fp-faq-icon');

      btn.setAttribute('aria-expanded', !expanded);
      if (expanded) {
        answer.setAttribute('hidden', '');
        icon.textContent = '+';
        btn.classList.remove('fp-faq-question--open');
      } else {
        answer.removeAttribute('hidden');
        icon.textContent = '×';
        btn.classList.add('fp-faq-question--open');
      }
    });
  });
})();
</script>
