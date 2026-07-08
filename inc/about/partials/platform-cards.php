<?php
/**
 * Program Overview — platform image cards grid.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cards = array(
	array(
		'image' => 'secure-platforms.jpg',
		'title' => __( 'Secure platforms', 'ccg-wp-theme' ),
		'desc'  => __( 'Our infrastructure is built with security at its core, meeting the highest standards for government and healthcare.', 'ccg-wp-theme' ),
	),
	array(
		'image' => 'scalable-platforms.jpg',
		'title' => __( 'Scalable platforms', 'ccg-wp-theme' ),
		'desc'  => __( 'Grow with confidence knowing our systems can handle peak demands and expand as your needs evolve.', 'ccg-wp-theme' ),
	),
	array(
		'image' => 'stress-tested-platforms.jpg',
		'title' => __( 'Stress-tested platforms', 'ccg-wp-theme' ),
		'desc'  => __( 'Rigorously tested and proven to deliver reliable performance under the most demanding conditions.', 'ccg-wp-theme' ),
	),
);
?>
<div class="po-platform-grid">
	<?php foreach ( $cards as $card ) : ?>
		<article class="po-platform-card">
			<div class="po-platform-card__media">
				<img src="<?php echo esc_url( ccg_about_program_image_url( $card['image'] ) ); ?>" alt="" loading="lazy" decoding="async" />
			</div>
			<div class="po-platform-card__body">
				<h3 class="po-platform-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
				<p class="po-platform-card__desc"><?php echo esc_html( $card['desc'] ); ?></p>
			</div>
		</article>
	<?php endforeach; ?>
</div>
