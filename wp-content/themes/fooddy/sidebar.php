<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_sidebar_position = fooddy_get_theme_option('sidebar_position');
if (fooddy_sidebar_present()) {
	ob_start();
	$fooddy_sidebar_name = fooddy_get_theme_option('sidebar_widgets');
	fooddy_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($fooddy_sidebar_name) ) {
		dynamic_sidebar($fooddy_sidebar_name);
	}
	$fooddy_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($fooddy_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($fooddy_sidebar_position); ?> widget_area<?php if (!fooddy_is_inherit(fooddy_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(fooddy_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'fooddy_action_before_sidebar' );
				fooddy_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $fooddy_out));
				do_action( 'fooddy_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>