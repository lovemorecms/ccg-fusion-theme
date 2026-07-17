<?php
/**
 * Site search panel (header chrome).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue site search script.
 */
function ccg_site_search_enqueue_assets() {
	wp_enqueue_script(
		'ccg-site-search',
		get_template_directory_uri() . '/assets/js/site-search.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccg_site_search_enqueue_assets' );
add_action( 'enqueue_block_editor_assets', 'ccg_site_search_enqueue_assets' );
add_action( 'enqueue_block_assets', 'ccg_site_search_enqueue_assets' );

/**
 * Search magnifying glass icon (matches React SearchIcon).
 */
function ccg_render_search_icon() {
	?>
	<svg class="ccg-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
		<path
			d="M19 19L13 13M15 8C15 8.91925 14.8189 9.82951 14.4672 10.6788C14.1154 11.5281 13.5998 12.2997 12.9497 12.9497C12.2997 13.5998 11.5281 14.1154 10.6788 14.4672C9.82951 14.8189 8.91925 15 8 15C7.08075 15 6.1705 14.8189 5.32122 14.4672C4.47194 14.1154 3.70026 13.5998 3.05025 12.9497C2.40024 12.2997 1.88463 11.5281 1.53284 10.6788C1.18106 9.82951 1 8.91925 1 8C1 6.14348 1.7375 4.36301 3.05025 3.05025C4.36301 1.7375 6.14348 1 8 1C9.85652 1 11.637 1.7375 12.9497 3.05025C14.2625 4.36301 15 6.14348 15 8Z"
			stroke="currentColor"
			stroke-width="2"
			stroke-linecap="round"
			stroke-linejoin="round"
		/>
	</svg>
	<?php
}

/**
 * Collapsible site search region below the nav bar.
 */
function ccg_render_site_search_panel() {
	?>
	<div
		id="site-search-region"
		class="fusion-site-search"
		hidden
		data-site-search-panel
	>
		<form
			class="fusion-site-search__form"
			role="search"
			method="get"
			action="<?php echo esc_url( home_url( '/' ) ); ?>"
		>
			<label class="sr-only" for="site-search-input"><?php esc_html_e( 'Search site', 'ccg-wp-theme' ); ?></label>
			<input
				id="site-search-input"
				class="fusion-site-search__input"
				type="search"
				name="s"
				placeholder="<?php esc_attr_e( 'Search cloud topics, guidance, and services…', 'ccg-wp-theme' ); ?>"
				autocomplete="off"
				data-site-search-input
			/>
			<div class="fusion-site-search__actions">
				<button type="submit" class="ds-c-button ds-c-button--solid fusion-site-search__submit">
					<?php esc_html_e( 'Search', 'ccg-wp-theme' ); ?>
				</button>
				<button type="button" class="ds-c-button ds-c-button--ghost fusion-site-search__close" data-site-search-close>
					<?php esc_html_e( 'Close', 'ccg-wp-theme' ); ?>
				</button>
			</div>
		</form>
	</div>
	<?php
}
