<?php
/**
 * Program Overview — services & stats section (full).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="kc-content">
	<section class="kc-section" id="services">
		<h2 class="kc-section-heading po-section-heading"><?php esc_html_e( 'Services to suit your needs', 'ccg-wp-theme' ); ?></h2>
		<p class="kc-section-subtitle po-section-lede">
			<?php esc_html_e( 'From legacy modernization to cloud migration, CMS offers comprehensive technology services designed to meet the unique demands of healthcare and human services programs.', 'ccg-wp-theme' ); ?>
		</p>
		<?php require get_template_directory() . '/inc/about/partials/stats-list.php'; ?>
	</section>
</div>
