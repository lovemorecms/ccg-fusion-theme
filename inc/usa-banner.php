<?php
/**
 * USA Banner — CMS.gov Design System markup + expand/collapse behavior.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue USA banner script.
 */
function ccg_usa_banner_enqueue_assets() {
	wp_enqueue_script(
		'ccg-usa-banner',
		get_template_directory_uri() . '/assets/js/usa-banner.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccg_usa_banner_enqueue_assets' );
add_action( 'enqueue_block_editor_assets', 'ccg_usa_banner_enqueue_assets' );
add_action( 'enqueue_block_assets', 'ccg_usa_banner_enqueue_assets' );

/**
 * Replace usa-banner template part with PHP-rendered CMS DS banner.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Block data.
 */
function ccg_usa_banner_replace_template_part( $block_content, $block ) {
	if ( ( $block['blockName'] ?? '' ) !== 'core/template-part' ) {
		return $block_content;
	}
	if ( ( $block['attrs']['slug'] ?? '' ) !== 'usa-banner' ) {
		return $block_content;
	}

	ob_start();
	ccg_render_usa_banner();
	return ob_get_clean();
}
add_filter( 'render_block', 'ccg_usa_banner_replace_template_part', 10, 2 );

/**
 * Inline US flag icon (CMS DS UsaFlagIcon).
 */
function ccg_usa_banner_flag_icon() {
	?>
	<svg
		class="ds-c-icon ds-c-icon--usa-flag ds-c-usa-banner__header-icon"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 16 11"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<g fill="none" fill-rule="evenodd">
			<path fill="#B22234" d="M0 0h16v1H0zm0 2h16v1H0zm0 2h16v1H0zm0 2h16v1H0zm0 2h16v1H0zm0 2h16v1H0z" />
			<path fill="#3C3B6E" d="M0 0h7v6H0z" />
			<path fill="#FFF" d="M1 1h1v1H1zm2 0h1v1H3zm2 0h1v1H5zm-4 2h1v1H1zm2 0h1v1H3zm2 0h1v1H5zm-4 2h1v1H1zm2 0h1v1H3zm2 0h1v1H5z" />
		</g>
	</svg>
	<?php
}

/**
 * Chevron for "Here's how you know" — same SVG as global nav mega menu triggers.
 */
function ccg_usa_banner_chevron_icon() {
	?>
	<svg
		class="ccg-mega-chevron"
		width="12"
		height="12"
		viewBox="0 0 10 6"
		fill="none"
		aria-hidden="true"
		data-usa-banner-chevron
	>
		<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
	</svg>
	<?php
}

/**
 * Close icon for mobile expanded state (CMS DS CloseIconThin).
 */
function ccg_usa_banner_close_icon() {
	?>
	<svg
		class="ds-c-icon ds-c-usa-banner__button-icon"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 24 24"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<path d="M18.717 6.697 12.232 13.18l6.485 6.486-1.414 1.414-6.485-6.485-6.486 6.485L3.03 19.666l6.486-6.485L3.03 6.697 4.444 5.283l6.486 6.485 6.485-6.485 1.414 1.414z" />
	</svg>
	<?php
}

/**
 * Inline government building icon (CMS DS BuildingCircleIcon).
 */
function ccg_usa_banner_building_icon() {
	?>
	<svg
		class="ds-c-icon ds-c-icon--building-circle ds-c-usa-banner__guidance-icon"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 54 54"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<path fill="#2378C3" fill-rule="evenodd" d="M27 0C12.088 0 0 12.088 0 27s12.088 27 27 27 27-12.088 27-27S41.912 0 27 0zm0 4.5c12.426 0 22.5 10.074 22.5 22.5S39.426 49.5 27 49.5 4.5 39.426 4.5 27 14.574 4.5 27 4.5zM17.5 19v2.2L27 27.5l9.5-6.3V19H17.5zm-2.5 4.5v23h15V31h18v15.5h15V23.5H15z" />
	</svg>
	<?php
}

/**
 * Inline lock circle icon (CMS DS LockCircleIcon).
 */
function ccg_usa_banner_lock_circle_icon() {
	?>
	<svg
		class="ds-c-icon ds-c-icon--lock-circle ds-c-usa-banner__guidance-icon"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 54 54"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<path fill="#4AA564" fill-rule="evenodd" d="M27 0C12.088 0 0 12.088 0 27s12.088 27 27 27 27-12.088 27-27S41.912 0 27 0zm0 4.5c12.426 0 22.5 10.074 22.5 22.5S39.426 49.5 27 49.5 4.5 39.426 4.5 27 14.574 4.5 27 4.5zM21 24V19c0-3.314 2.686-6 6-6s6 2.686 6 6v5h3c2.485 0 4.5 2.015 4.5 4.5v15c0 2.485-2.015 4.5-4.5 4.5h-21c-2.485 0-4.5-2.015-4.5-4.5v-15c0-2.485 2.015-4.5 4.5-4.5h3zm3 0h6V19c0-1.657-1.343-3-3-3s-3 1.343-3 3v5z" />
	</svg>
	<?php
}

/**
 * Inline lock icon (CMS DS LockIcon).
 */
function ccg_usa_banner_lock_icon() {
	?>
	<svg
		class="ds-c-icon ds-c-icon--lock ds-c-usa-banner__inline-lock-icon"
		xmlns="http://www.w3.org/2000/svg"
		viewBox="0 0 52 64"
		role="img"
		aria-hidden="true"
		focusable="false"
	>
		<path fill="#000000" fill-rule="evenodd" d="M26 0c10.493 0 19 8.507 19 19v9h3c4.97 0 9 4.03 9 9v28c0 4.97-4.03 9-9 9H3c-4.97 0-9-4.03-9-9V37c0-4.97 4.03-9 9-9h3V19C6 8.507 14.507 0 26 0zm0 8c-6.075 0-11 4.925-11 11v9h22V19c0-6.075-4.925-11-11-11z" />
	</svg>
	<?php
}

/**
 * Output full CMS.gov Design System USA banner.
 */
function ccg_render_usa_banner() {
	$panel_id    = 'ccg-usa-banner-panel';
	$banner_label = __( 'Official website of the United States government', 'ccg-wp-theme' );
	$banner_text  = __( 'An official website of the United States government', 'ccg-wp-theme' );
	$action_text  = __( "Here's how you know", 'ccg-wp-theme' );
	?>
	<section
		class="ds-c-usa-banner fusion-usa-banner"
		aria-label="<?php echo esc_attr( $banner_label ); ?>"
		data-ccg-usa-banner
	>
		<header class="ds-c-usa-banner__header ds-u-font-size--sm" data-usa-banner-header>
			<?php ccg_usa_banner_flag_icon(); ?>
			<p class="ds-c-usa-banner__header-text"><?php echo esc_html( $banner_text ); ?></p>

			<p class="ds-c-usa-banner__action ds-u-align-items--center ds-u-md-display--none ds-u-display--flex" data-usa-banner-mobile-action>
				<?php echo esc_html( $action_text ); ?>
				<?php ccg_usa_banner_chevron_icon(); ?>
			</p>

			<button
				type="button"
				class="ds-c-usa-banner__button"
				aria-expanded="false"
				aria-controls="<?php echo esc_attr( $panel_id ); ?>"
				data-usa-banner-toggle
			>
				<span class="ds-c-usa-banner__button-text ds-u-md-display--flex ds-u-align-items--center">
					<?php echo esc_html( $action_text ); ?>
					<?php ccg_usa_banner_chevron_icon(); ?>
				</span>
				<span class="ds-c-usa-banner__button-icon-container" hidden data-usa-banner-close-container>
					<?php ccg_usa_banner_close_icon(); ?>
				</span>
			</button>
		</header>

		<div class="ds-c-usa-banner__guidance ds-u-leading--base ds-u-font-size--base">
			<div
				class="ds-c-usa-banner__guidance-container"
				id="<?php echo esc_attr( $panel_id ); ?>"
				hidden
				data-usa-banner-guidance
			>
				<div class="ds-c-usa-banner__guidance-item">
					<?php ccg_usa_banner_building_icon(); ?>
					<p class="ds-c-usa-banner__guidance-text">
						<strong><?php esc_html_e( 'Official websites use .gov', 'ccg-wp-theme' ); ?></strong>
						<br />
						<?php
						echo wp_kses(
							sprintf(
								/* translators: %s: .gov */
								__( 'A %s website belongs to an official government organization in the United States.', 'ccg-wp-theme' ),
								'<strong>.gov</strong>'
							),
							array( 'strong' => array() )
						);
						?>
					</p>
				</div>
				<div class="ds-c-usa-banner__guidance-item">
					<?php ccg_usa_banner_lock_circle_icon(); ?>
					<p class="ds-c-usa-banner__guidance-text">
						<strong><?php esc_html_e( 'Secure .gov websites use HTTPS', 'ccg-wp-theme' ); ?></strong>
						<br />
						<?php esc_html_e( 'A', 'ccg-wp-theme' ); ?>
						<strong><?php esc_html_e( 'lock', 'ccg-wp-theme' ); ?></strong>
						( <?php ccg_usa_banner_lock_icon(); ?> )
						<span><?php esc_html_e( 'or', 'ccg-wp-theme' ); ?></span>
						<strong> https:// </strong>
						<?php esc_html_e( "means you've safely connected to the .gov website. Share sensitive information only on official, secure websites.", 'ccg-wp-theme' ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<?php
}
