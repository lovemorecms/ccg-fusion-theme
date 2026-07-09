<?php
/**
 * Title: Fusion Toolkit product grid
 * Slug: ccg-wp-theme/fusion-toolkit-product-grid
 * Categories: ccg-cards
 * Description: 2×2 card grid for BaseCamp, Helix, Lens, and Match.
 */
$products = ccg_fusion_toolkit_products();
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ft-section ft-section--grid ccg-fusion-toolkit-sections","anchor":"toolkit-grid","layout":{"type":"default"}} -->
<section id="toolkit-grid" class="wp-block-group alignfull ft-section ft-section--grid ccg-fusion-toolkit-sections" aria-labelledby="ft-grid-heading" tabindex="-1">
	<!-- wp:group {"className":"ft-container","layout":{"type":"default"}} -->
	<div class="wp-block-group ft-container">
		<!-- wp:group {"className":"ft-section__intro","layout":{"type":"default"}} -->
		<div class="wp-block-group ft-section__intro">
			<!-- wp:heading {"level":2,"className":"ft-section__title"} -->
			<h2 id="ft-grid-heading" class="wp-block-heading ft-section__title"><?php esc_html_e( 'The complete toolkit', 'ccg-wp-theme' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"ft-section__lede"} -->
			<p class="ft-section__lede"><?php esc_html_e( 'Each product in the Fusion Toolkit is designed to excel independently, yet together they create an unparalleled development experience.', 'ccg-wp-theme' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ft-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group ft-grid">
			<?php foreach ( $products as $product ) : ?>
				<?php ccg_fusion_toolkit_render_card_block( $product ); ?>
			<?php endforeach; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
