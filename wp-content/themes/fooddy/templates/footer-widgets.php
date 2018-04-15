<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */

// Footer sidebar
$fooddy_footer_name = fooddy_get_theme_option('footer_widgets');
$fooddy_footer_present = !fooddy_is_off($fooddy_footer_name) && is_active_sidebar($fooddy_footer_name);
if ($fooddy_footer_present) { 
	fooddy_storage_set('current_sidebar', 'footer');
	$fooddy_footer_wide = fooddy_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($fooddy_footer_name) ) {
		dynamic_sidebar($fooddy_footer_name);
	}
	$fooddy_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($fooddy_out)) {
		$fooddy_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $fooddy_out);
		$fooddy_need_columns = true;	//or check: strpos($fooddy_out, 'columns_wrap')===false;
		if ($fooddy_need_columns) {
			$fooddy_columns = max(0, (int) fooddy_get_theme_option('footer_columns'));
			if ($fooddy_columns == 0) $fooddy_columns = min(6, max(1, substr_count($fooddy_out, '<aside ')));
			if ($fooddy_columns > 1)
				$fooddy_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($fooddy_columns).' widget ', $fooddy_out);
			else
				$fooddy_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($fooddy_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$fooddy_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($fooddy_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'fooddy_action_before_sidebar' );
				fooddy_show_layout($fooddy_out);
				do_action( 'fooddy_action_after_sidebar' );
				if ($fooddy_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$fooddy_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>