<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

// Header sidebar
$fooddy_header_name = fooddy_get_theme_option('header_widgets');
$fooddy_header_present = !fooddy_is_off($fooddy_header_name) && is_active_sidebar($fooddy_header_name);
if ($fooddy_header_present) { 
	fooddy_storage_set('current_sidebar', 'header');
	$fooddy_header_wide = fooddy_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($fooddy_header_name) ) {
		dynamic_sidebar($fooddy_header_name);
	}
	$fooddy_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($fooddy_widgets_output)) {
		$fooddy_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $fooddy_widgets_output);
		$fooddy_need_columns = strpos($fooddy_widgets_output, 'columns_wrap')===false;
		if ($fooddy_need_columns) {
			$fooddy_columns = max(0, (int) fooddy_get_theme_option('header_columns'));
			if ($fooddy_columns == 0) $fooddy_columns = min(6, max(1, substr_count($fooddy_widgets_output, '<aside ')));
			if ($fooddy_columns > 1)
				$fooddy_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($fooddy_columns).' widget ', $fooddy_widgets_output);
			else
				$fooddy_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($fooddy_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$fooddy_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($fooddy_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'fooddy_action_before_sidebar' );
				fooddy_show_layout($fooddy_widgets_output);
				do_action( 'fooddy_action_after_sidebar' );
				if ($fooddy_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$fooddy_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>