<?php
/**
 * Site footer rendering and template-part replacement.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Replace footer template part with PHP-rendered markup.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Block data.
 */
function ccg_footer_replace_template_part( $block_content, $block ) {
	if ( ( $block['blockName'] ?? '' ) !== 'core/template-part' ) {
		return $block_content;
	}
	if ( ( $block['attrs']['slug'] ?? '' ) !== 'footer' ) {
		return $block_content;
	}

	ob_start();
	ccg_render_site_footer();
	return ob_get_clean();
}
add_filter( 'render_block', 'ccg_footer_replace_template_part', 10, 2 );

/**
 * Output CMS three-column site footer.
 */
function ccg_render_site_footer() {
	$hhs_logo = ccg_wp_theme_asset_url( 'assets/images/footer/hhs-lockup.svg' );
	$cms_logo = ccg_wp_theme_asset_url( 'assets/images/footer/cms-lockup.svg' );
	?>
	<footer id="site-footer" class="fusion-site-footer" aria-label="<?php esc_attr_e( 'Site footer', 'ccg-wp-theme' ); ?>">
		<div class="fusion-site-footer__inner">
			<div class="fusion-site-footer__brand">
				<div class="fusion-site-footer__brand-logos">
					<img
						class="fusion-site-footer__brand-logo fusion-site-footer__brand-logo--hhs"
						src="<?php echo esc_url( $hhs_logo ); ?>"
						alt="<?php esc_attr_e( 'U.S. Department of Health and Human Services', 'ccg-wp-theme' ); ?>"
						width="72"
						height="72"
						decoding="async"
					/>
					<img
						class="fusion-site-footer__brand-logo fusion-site-footer__brand-logo--cms"
						src="<?php echo esc_url( $cms_logo ); ?>"
						alt="<?php esc_attr_e( 'Centers for Medicare & Medicaid Services', 'ccg-wp-theme' ); ?>"
						width="200"
						height="72"
						decoding="async"
					/>
				</div>
				<p class="fusion-site-footer__brand-body">
					<?php esc_html_e( 'A federal government website managed by the Centers for Medicare & Medicaid Services', 'ccg-wp-theme' ); ?><br />
					<span class="fusion-site-footer__brand-address"><?php esc_html_e( '7500 Security Boulevard, Baltimore, MD 21244', 'ccg-wp-theme' ); ?></span>
				</p>
			</div>

			<nav class="fusion-site-footer__nav" aria-labelledby="fusion-site-footer-heading-cms">
				<h3 id="fusion-site-footer-heading-cms" class="fusion-site-footer__heading"><?php esc_html_e( 'CMS & HHS Websites', 'ccg-wp-theme' ); ?></h3>
				<ul class="fusion-site-footer__list">
					<li><a class="fusion-site-footer__link" href="https://www.cms.gov/"><?php esc_html_e( 'CMS.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.medicare.gov/"><?php esc_html_e( 'Medicare.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.mymedicare.gov/"><?php esc_html_e( 'MyMedicare.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.medicaid.gov/"><?php esc_html_e( 'Medicaid.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.healthcare.gov/"><?php esc_html_e( 'Healthcare.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.hhs.gov/"><?php esc_html_e( 'HHS.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://data.cms.gov/"><?php esc_html_e( 'Data.CMS.gov', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://github.com/CMSgov/"><?php esc_html_e( 'CMS Projects on GitHub', 'ccg-wp-theme' ); ?></a></li>
				</ul>
			</nav>

			<nav class="fusion-site-footer__nav" aria-labelledby="fusion-site-footer-heading-resources">
				<h3 id="fusion-site-footer-heading-resources" class="fusion-site-footer__heading"><?php esc_html_e( 'Additional resources', 'ccg-wp-theme' ); ?></h3>
				<ul class="fusion-site-footer__list">
					<li><a class="fusion-site-footer__link" href="<?php echo esc_url( home_url( '/resources/page-layouts/' ) ); ?>"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://design.cms.gov/"><?php esc_html_e( 'CMS Design System', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.cms.gov/center/freedom-of-information-act-center"><?php esc_html_e( 'Freedom of Information Act', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://oig.hhs.gov/"><?php esc_html_e( 'Inspector General', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.cms.gov/about-cms/agency-information/about-policy/no-fear-act"><?php esc_html_e( 'No Fear Act', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.cms.gov/about-cms/agency-information/plain-writing"><?php esc_html_e( 'Plain Writing', 'ccg-wp-theme' ); ?></a></li>
					<li><a class="fusion-site-footer__link" href="https://www.usa.gov/"><?php esc_html_e( 'USA.gov', 'ccg-wp-theme' ); ?></a></li>
				</ul>
			</nav>
		</div>
	</footer>
	<?php
}
