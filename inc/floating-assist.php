<?php
/**
 * Global floating scroll-to-top and CMS Assistant controls.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the global floating assistance dock.
 */
function ccg_render_floating_assist_dock() {
	?>
	<div class="fusion-float-dock" data-fusion-float-dock>
		<button
			type="button"
			class="fusion-float-dock__scroll-top"
			data-fusion-scroll-top
			aria-label="<?php esc_attr_e( 'Scroll to top', 'ccg-wp-theme' ); ?>"
			hidden
		>
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
				<path d="M6 15l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>

		<div class="fusion-float-dock__assist">
			<div
				id="fusion-chat-panel"
				class="fusion-chat-panel"
				data-fusion-chat-panel
				role="dialog"
				aria-modal="false"
				aria-label="<?php esc_attr_e( 'CMS Assistant', 'ccg-wp-theme' ); ?>"
				hidden
			>
				<header class="fusion-chat-panel__header">
					<div class="fusion-chat-panel__header-text">
						<h2 class="fusion-chat-panel__title"><?php esc_html_e( 'CMS Assistant', 'ccg-wp-theme' ); ?></h2>
						<p class="fusion-chat-panel__subtitle"><?php esc_html_e( 'Ask me about CMS Hybrid Cloud.', 'ccg-wp-theme' ); ?></p>
					</div>
					<div class="fusion-chat-panel__header-actions">
						<button type="button" class="fusion-chat-panel__icon-btn" data-fusion-chat-restart aria-label="<?php esc_attr_e( 'Restart chat', 'ccg-wp-theme' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
								<path d="M4 12a8 8 0 0113.657-5.657M20 12a8 8 0 01-13.657 5.657M4 12H1m19 0h-3M4 12l2-2m15 2-2-2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<button type="button" class="fusion-chat-panel__icon-btn" data-fusion-chat-close aria-label="<?php esc_attr_e( 'Close CMS Assistant', 'ccg-wp-theme' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
								<path d="M18 6 6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
							</svg>
						</button>
					</div>
				</header>

				<div class="fusion-chat-panel__body" data-fusion-chat-messages role="log" aria-live="polite" aria-relevant="additions">
					<div class="fusion-chat-panel__bubble fusion-chat-panel__bubble--assistant">
						<?php esc_html_e( "Hi! I'm here to help you with questions about CMS Hybrid Cloud. What would you like to know?", 'ccg-wp-theme' ); ?>
					</div>
				</div>

				<form class="fusion-chat-panel__footer" data-fusion-chat-form>
					<label for="fusion-chat-input" class="fusion-chat-panel__input-label"><?php esc_html_e( 'Message', 'ccg-wp-theme' ); ?></label>
					<div class="fusion-chat-panel__input-row">
						<input
							id="fusion-chat-input"
							type="text"
							class="fusion-chat-panel__input"
							data-fusion-chat-input
							placeholder="<?php esc_attr_e( 'Type your message…', 'ccg-wp-theme' ); ?>"
							autocomplete="off"
						/>
						<button type="submit" class="fusion-chat-panel__send" aria-label="<?php esc_attr_e( 'Send message', 'ccg-wp-theme' ); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
								<path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
				</form>
			</div>

			<button
				type="button"
				class="fusion-chat-fab"
				data-fusion-chat-toggle
				aria-expanded="false"
				aria-controls="fusion-chat-panel"
				aria-label="<?php esc_attr_e( 'Open CMS Assistant', 'ccg-wp-theme' ); ?>"
			>
				<span class="fusion-chat-fab__icon">
					<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
						<path d="M12 3C7.03 3 3 6.58 3 11c0 2.39 1.08 4.53 2.78 6.02L4 21l4.26-1.11C9.53 20.7 10.74 21 12 21c4.97 0 9-3.58 9-8s-4.03-8-9-8z" fill="currentColor"/>
					</svg>
				</span>
			</button>
		</div>
	</div>
	<?php
}
add_action( 'wp_footer', 'ccg_render_floating_assist_dock', 5 );
