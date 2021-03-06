<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.06
 */

$fooddy_header_css = $fooddy_header_image = '';
$fooddy_header_video = fooddy_get_header_video();
if (true || empty($fooddy_header_video)) {
	$fooddy_header_image = get_header_image();
	if (fooddy_is_on(fooddy_get_theme_option('header_image_override')) && apply_filters('fooddy_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($fooddy_cat_img = fooddy_get_category_image()) != '')
				$fooddy_header_image = $fooddy_cat_img;
		} else if (is_singular() || fooddy_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$fooddy_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($fooddy_header_image)) $fooddy_header_image = $fooddy_header_image[0];
			} else
				$fooddy_header_image = '';
		}
	}
}

$fooddy_header_id = str_replace('header-custom-', '', fooddy_get_theme_option("header_style"));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($fooddy_header_id);
						echo !empty($fooddy_header_image) || !empty($fooddy_header_video) ? ' with_bg_image' : ' without_bg_image';
						if ($fooddy_header_video!='') echo ' with_bg_video';
						if ($fooddy_header_image!='') echo ' '.esc_attr(fooddy_add_inline_css_class('background-image: url('.esc_url($fooddy_header_image).');'));
						if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
						if (fooddy_is_on(fooddy_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(fooddy_is_inherit(fooddy_get_theme_option('header_scheme')) 
														? fooddy_get_theme_option('color_scheme') 
														: fooddy_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($fooddy_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('fooddy_action_show_layout', $fooddy_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );


		
?></header>