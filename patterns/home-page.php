<?php
/**
 * Title: Home — full page (all sections)
 * Slug: ccg-wp-theme/home-page
 * Categories: ccg-fusion, ccg-fusion-home
 * Description: Complete FUSION Sphere homepage — insert once on the front page.
 */
?>
<!-- wp:html -->
<div class="ccg-home-page">
<?php
require get_template_directory() . '/inc/home/partials/hero.php';
require get_template_directory() . '/inc/home/partials/quick-access.php';
require get_template_directory() . '/inc/home/partials/pathways.php';
require get_template_directory() . '/inc/home/partials/multi-cloud.php';
require get_template_directory() . '/inc/home/partials/featured-resources.php';
require get_template_directory() . '/inc/home/partials/academy.php';
require get_template_directory() . '/inc/home/partials/ecosystem.php';
require get_template_directory() . '/inc/home/partials/announcements.php';
?>
</div>
<!-- /wp:html -->
