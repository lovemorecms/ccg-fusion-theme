<?php
/**
 * Program Overview — closing CTA band.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="po-cta ccg-about-cta" aria-labelledby="po-cta-heading">
	<div class="po-cta__inner">
		<h2 id="po-cta-heading" class="po-cta__heading">
			<?php esc_html_e( 'Building together', 'ccg-wp-theme' ); ?>
		</h2>
		<p class="po-cta__lede">
			<?php esc_html_e( "Together, we're making government technology work better for the people it serves. Partner with CMS to deliver secure, scalable solutions that improve healthcare for millions of Americans.", 'ccg-wp-theme' ); ?>
		</p>
		<a class="ds-c-button ds-c-button--solid ccg-btn-accent po-cta__btn" href="#services">
			<?php esc_html_e( 'Learn More About Our Services', 'ccg-wp-theme' ); ?>
		</a>
	</div>
</section>
