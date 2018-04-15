<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */

$fooddy_footer_scheme =  fooddy_is_inherit(fooddy_get_theme_option('footer_scheme')) ? fooddy_get_theme_option('color_scheme') : fooddy_get_theme_option('footer_scheme');
$fooddy_footer_id = str_replace('footer-custom-', '', fooddy_get_theme_option("footer_style"));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($fooddy_footer_id); ?> scheme_<?php echo esc_attr($fooddy_footer_scheme); ?>">
	<?php
    // Custom footer's layout
    do_action('fooddy_action_show_layout', $fooddy_footer_id);
	?>
</footer><!-- /.footer_wrap -->
