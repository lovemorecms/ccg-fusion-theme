<?php
/**
 * Program Overview — critical work section (full).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="kc-content">
	<section class="kc-section" id="critical-work">
		<h2 class="kc-section-heading po-section-heading"><?php esc_html_e( 'We know your work is critical.', 'ccg-wp-theme' ); ?></h2>
		<p class="kc-section-subtitle po-section-lede">
			<?php esc_html_e( 'CMS delivers secure and effective technology services and solutions to support the critical missions of CMS and our federal and state partners in administering Medicare, Medicaid, the Children\'s Health Insurance Program, and the Health Insurance Marketplace.', 'ccg-wp-theme' ); ?>
		</p>
		<?php require get_template_directory() . '/inc/about/partials/platform-cards.php'; ?>
	</section>
</div>
