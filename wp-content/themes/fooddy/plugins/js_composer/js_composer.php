<?php
/* Visual Composer support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('fooddy_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'fooddy_vc_theme_setup9', 9 );
	function fooddy_vc_theme_setup9() {
		if (fooddy_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'fooddy_vc_frontend_scripts', 1100 );
			add_filter( 'fooddy_filter_merge_styles',						'fooddy_vc_merge_styles' );
			add_filter( 'fooddy_filter_get_css',							'fooddy_vc_get_css', 10, 4 );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'fooddy_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'fooddy'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'fooddy') ),
				"group" => esc_html__('Colors', 'fooddy'),
				"admin_label" => true,
				"value" => array_flip(fooddy_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_section", $scheme);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'fooddy'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'fooddy') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'fooddy') => 'tiny',
					esc_html__('Small', 'fooddy') => 'small',
					esc_html__('Medium', 'fooddy') => 'medium',
					esc_html__('Large', 'fooddy') => 'large',
					esc_html__('Huge', 'fooddy') => 'huge',
                    esc_html__('Super Huge', 'fooddy') => 'superhuge',
					esc_html__('From the value above', 'fooddy') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'fooddy'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'fooddy') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'fooddy') => "1",
					esc_html__("Hide on notebook", 'fooddy') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'fooddy'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'fooddy') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'fooddy') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'fooddy'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'fooddy') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'fooddy') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'fooddy_filter_tgmpa_required_plugins',		'fooddy_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'fooddy_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'fooddy_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('fooddy_filter_tgmpa_required_plugins',	'fooddy_vc_tgmpa_required_plugins');
	function fooddy_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', fooddy_storage_get('required_plugins'))) {
			$path = fooddy_get_file_dir('plugins/js_composer/js_composer.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer', 'fooddy'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if Visual Composer installed and activated
if ( !function_exists( 'fooddy_exists_visual_composer' ) ) {
	function fooddy_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if Visual Composer in frontend editor mode
if ( !function_exists( 'fooddy_vc_is_frontend' ) ) {
	function fooddy_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
		//return function_exists('vc_is_frontend_editor') && vc_is_frontend_editor();
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'fooddy_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'fooddy_vc_frontend_scripts', 1100 );
	function fooddy_vc_frontend_scripts() {
		if (fooddy_exists_visual_composer()) {
			if (fooddy_is_on(fooddy_get_theme_option('debug_mode')) && fooddy_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'fooddy-js_composer',  fooddy_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'fooddy_vc_merge_styles' ) ) {
	//Handler of the add_filter('fooddy_filter_merge_styles', 'fooddy_vc_merge_styles');
	function fooddy_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'fooddy_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'fooddy_vc_iconpicker_type_fontawesome' );
	function fooddy_vc_iconpicker_type_fontawesome($icons) {
		$list = fooddy_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'fooddy') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'fooddy_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'fooddy_vc_add_params_classes', 10, 3 );
	function fooddy_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !fooddy_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !fooddy_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add VC specific styles into color scheme
//------------------------------------------------------------------------

// Add styles into CSS
if ( !function_exists( 'fooddy_vc_get_css' ) ) {
	//Handler of the add_filter( 'fooddy_filter_get_css', 'fooddy_vc_get_css', 10, 4 );
	function fooddy_vc_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text {
	{$fonts['p_font-family']}
}
body .mejs-container *,
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	{$fonts['info_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.vc_section,
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	color: {$colors['text']};
}
.scheme_self.vc_section[data-vc-full-width="true"],
.scheme_self.wpb_row[data-vc-full-width="true"],
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
}
.scheme_self.vc_row.vc_parallax[class*="scheme_"] .vc_parallax-inner:before {
	background-color: {$colors['bg_color_08']};
}
.sc_countdown .sc_countdown_label {
    color: {$colors['text_dark']};
}
/* Accordion */
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['text_dark']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion.vc_tta-shape-round .vc_tta-panel:hover .vc_tta-panel-title > a,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover {
	color: {$colors['inverse_text']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a:hover .vc_tta-controls-icon {
	color: {$colors['text_link']};
	background-color: {$colors['bg_color']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:before,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a .vc_tta-controls-icon:after {
	border-color: {$colors['text_link']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion.vc_tta-shape-round .vc_tta-panel {
    background-color: {$colors['alter_bg_color']};
}
.wpb-js-composer .vc_tta.vc_tta-accordion.vc_tta-shape-round .vc_tta-panel:hover,
.wpb-js-composer .vc_tta.vc_tta-accordion.vc_tta-shape-round .vc_tta-panel.vc_active {
    background-color: {$colors['text_link']};
    color: {$colors['inverse_text']};
}

/* Tabs */
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['text_dark']};
	background-color: {$colors['alter_bg_color']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['alter_bg_color']};
}

/* Progress bar */
.scheme_dark .vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
    background-color: {$colors['bg_color']};
}
.scheme_dark .vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['inverse_text']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar {
	background-color: {$colors['alter_bg_color']};
}
.vc_progress_bar.vc_progress_bar_narrow.vc_progress-bar-color-bar_red .vc_single_bar .vc_bar {
	background-color: {$colors['alter_link']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units {
	color: {$colors['alter_link']};
}
.vc_tta-tabs.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a,
 .vc_tta-tabs.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel:hover .vc_tta-panel-title > a{
    background-color: {$colors['text_link']};
}

.vc_message_box.vc_message_box_closeable:after {
    background-color: {$colors['bg_color_02']};
    color: {$colors['inverse_text']};
}

.vc_color-grey.vc_message_box {
    background-color: {$colors['alter_bg_color']};
    color: {$colors['text_dark']};
}
.vc_color-grey.vc_message_box.vc_message_box_closeable:after{
    background-color: {$colors['text_dark_01']};
}

.vc_color-warning.vc_message_box {
    background-color: {$colors['alter_link']};
    color: {$colors['inverse_text']};
}
.vc_color-warning.vc_message_box.vc_message_box_closeable:after,
.vc_color-warning.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}

.vc_color-info.vc_message_box {
    background-color: {$colors['text_link']};
    color: {$colors['inverse_text']};
}

.vc_color-success.vc_message_box {
    background-color: {$colors['alter_hover']};
    color: {$colors['inverse_text']};
}
.vc_color-info.vc_message_box .vc_message_box-icon,
.vc_color-success.vc_message_box.vc_message_box_closeable:after,
.vc_color-success.vc_message_box .vc_message_box-icon {
    color: {$colors['inverse_text']};
}
CSS;
		}
		
		return $css;
	}
}
?>