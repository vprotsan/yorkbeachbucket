<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('fooddy_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'fooddy_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'fooddy_trx_addons_theme_specific_setup1', 8 );
	function fooddy_trx_addons_theme_specific_setup1() {
		if (fooddy_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'fooddy_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'fooddy_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'fooddy_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'fooddy_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'fooddy_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'fooddy_trx_addons_cv_enable');
	function fooddy_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return false;
	}
}

// CPT
if ( !function_exists( 'fooddy_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'fooddy_trx_addons_cpt_list');
	function fooddy_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
        unset($list['portfolio']);
        unset($list['resume']);
        unset($list['courses']);
        unset($list['certificates']);
        unset($list['sport']);
        unset($list['dishes']);
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'fooddy_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'fooddy_trx_addons_sc_list');
	function fooddy_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Widgets
if ( !function_exists( 'fooddy_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'fooddy_trx_addons_widgets_list');
	function fooddy_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('fooddy_trx_addons_theme_specific_setup3')) {
	add_action( 'after_setup_theme', 'fooddy_trx_addons_theme_specific_setup3', 3 );
	function fooddy_trx_addons_theme_specific_setup3() {
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (fooddy_exists_courses()) {
		
			fooddy_storage_merge_array('options', '', array(
				'courses' => array(
					"title" => esc_html__('Courses', 'fooddy'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'fooddy') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'fooddy'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'fooddy') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_courses' => array(
					"title" => esc_html__('Header style', 'fooddy'),
					"desc" => wp_kses_data( __('Select style to display the site header on the courses pages', 'fooddy') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_courses' => array(
					"title" => esc_html__('Header position', 'fooddy'),
					"desc" => wp_kses_data( __('Select position to display the site header on the courses pages', 'fooddy') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'fooddy'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'fooddy') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_courses' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'fooddy'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'fooddy') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'fooddy'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'fooddy') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'fooddy') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'fooddy'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fooddy') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => fooddy_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
					"title" => esc_html__('Footer fullwide', 'fooddy'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'fooddy') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
		
		// Section 'Sport' - settings to show 'Sport' blog archive and single posts
		if (fooddy_exists_sport()) {
			fooddy_storage_merge_array('options', '', array(
				'sport' => array(
					"title" => esc_html__('Sport', 'fooddy'),
					"desc" => wp_kses_data( __('Select parameters to display the sport pages', 'fooddy') ),
					"type" => "section"
					),
				'expand_content_sport' => array(
					"title" => esc_html__('Expand content', 'fooddy'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'fooddy') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_sport' => array(
					"title" => esc_html__('Header style', 'fooddy'),
					"desc" => wp_kses_data( __('Select style to display the site header on the sport pages', 'fooddy') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_sport' => array(
					"title" => esc_html__('Header position', 'fooddy'),
					"desc" => wp_kses_data( __('Select position to display the site header on the sport pages', 'fooddy') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_sport' => array(
					"title" => esc_html__('Header widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the sport pages', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_sport' => array(
					"title" => esc_html__('Sidebar widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select sidebar to show on the sport pages', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_sport' => array(
					"title" => esc_html__('Sidebar position', 'fooddy'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the sport pages', 'fooddy') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_sport' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'fooddy'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'fooddy') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_sport' => array(
					"title" => esc_html__('Widgets above the page', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_sport' => array(
					"title" => esc_html__('Widgets above the content', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_sport' => array(
					"title" => esc_html__('Widgets below the content', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_sport' => array(
					"title" => esc_html__('Widgets below the page', 'fooddy'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'fooddy') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_sport' => array(
					"title" => esc_html__('Footer Color Scheme', 'fooddy'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'fooddy') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_sport' => array(
					"title" => esc_html__('Footer widgets', 'fooddy'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'fooddy') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_sport' => array(
					"title" => esc_html__('Footer columns', 'fooddy'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fooddy') ),
					"dependency" => array(
						'footer_widgets_sport' => array('^hide')
					),
					"std" => 0,
					"options" => fooddy_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_sport' => array(
					"title" => esc_html__('Footer fullwide', 'fooddy'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'fooddy') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'fooddy_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'fooddy_trx_addons_menu_cache');
	function fooddy_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		return $list;
	}
}

// Add vars into localize array
if (!function_exists('fooddy_trx_addons_localize_script')) {
	add_filter( 'fooddy_filter_localize_script','fooddy_trx_addons_localize_script' );
	function fooddy_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = fooddy_get_scheme_color('alter_link');
		return $arr;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('fooddy_trx_addons_theme_specific_default_layouts')) {
	add_filter( 'trx_addons_filter_default_layouts',	'fooddy_trx_addons_theme_specific_default_layouts');
	function fooddy_trx_addons_theme_specific_default_layouts($default_layouts=array()) {
		require_once FOODDY_THEME_DIR . 'theme-specific/trx_addons.layouts.php';
		return isset($layouts) && is_array($layouts) && count($layouts) > 0
						? array_merge($default_layouts, $layouts)
						: $default_layouts;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'fooddy_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'fooddy_filter_allow_override_header_image', 'fooddy_trx_addons_allow_override_header_image' );
	function fooddy_trx_addons_allow_override_header_image($allow) {
		return fooddy_is_team_page() || fooddy_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'fooddy_trx_addons_sidebar_present' ) ) {
	add_filter( 'fooddy_filter_sidebar_present', 'fooddy_trx_addons_sidebar_present' );
	function fooddy_trx_addons_sidebar_present($present) {
		return !is_single() && (fooddy_is_team_page() || fooddy_is_portfolio_page()) ? false : $present;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'fooddy_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'fooddy_trx_addons_editor_init', 11);
	function fooddy_trx_addons_editor_init($opt) {
		if (fooddy_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (false && !empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {
						if ( $v['title'] == esc_html__('List styles', 'fooddy') ) {
							$style_formats[$k]['items'][] = array(
										'title' => esc_html__('Arrow', 'fooddy'),
										'selector' => 'ul',
										'classes' => 'trx_addons_list trx_addons_list_arrow'
									);
						}
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Theme-specific thumb sizes
//------------------------------------------------------------------------

// Replace thumb sizes to the theme-specific
if ( !function_exists( 'fooddy_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'fooddy_trx_addons_add_thumb_sizes');
	function fooddy_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Return theme-specific thumb size instead removed plugin's thumb size
if ( !function_exists( 'fooddy_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'fooddy_trx_addons_get_thumb_size');
	function fooddy_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
                'trx_addons-thumb-team',
                'trx_addons-thumb-team-@retina',
                'trx_addons-thumb-teams',
                'trx_addons-thumb-teams-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'fooddy-thumb-huge',
							'fooddy-thumb-huge-@retina',
							'fooddy-thumb-big',
							'fooddy-thumb-big-@retina',
							'fooddy-thumb-med',
							'fooddy-thumb-med-@retina',
                                'fooddy-thumb-team',
                                'fooddy-thumb-team-@retina',
                                'fooddy-thumb-teams',
                                'fooddy-thumb-teams-@retina',
							'fooddy-thumb-tiny',
							'fooddy-thumb-tiny-@retina',
							'fooddy-thumb-masonry-big',
							'fooddy-thumb-masonry-big-@retina',
							'fooddy-thumb-masonry',
							'fooddy-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'fooddy_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'fooddy_trx_addons_thumb_size', 10, 2);
	function fooddy_trx_addons_thumb_size($thumb_size='', $type='') {
		if ($type == 'team-default')
			$thumb_size = fooddy_get_thumb_size('med');
		return $thumb_size;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Return tag for the item's title
if ( !function_exists( 'fooddy_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'fooddy_trx_addons_sc_item_title_tag');
	function fooddy_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'fooddy_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'fooddy_trx_addons_sc_item_button_args');
	function fooddy_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'fooddy_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'fooddy_trx_addons_sc_type', 10, 2);
	function fooddy_trx_addons_sc_type($list, $sc) {
		if (in_array($sc, array('trx_sc_button')))
			$list[esc_html__('Inverse', 'fooddy')] = 'inverse';

        if (in_array($sc, array('trx_sc_team'))) {
            $list[ esc_html__('Full', 'fooddy') ] = 'full';
        }
		return $list;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'fooddy_trx_addons_sc_style' ) ) {
    add_filter( 'trx_addons_sc_style', 'fooddy_trx_addons_sc_style', 10, 2);
    function fooddy_trx_addons_sc_style($list, $sc) {
        if (in_array($sc, array('trx_sc_layouts_search'))) {
            $list[ esc_html__('Search address', 'fooddy') ] = 'address';
        }
        return $list;
    }
}

// Add new styles to the Google map
if ( !function_exists( 'fooddy_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'fooddy_trx_addons_sc_googlemap_styles');
	function fooddy_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'fooddy')] = 'dark';
        $list[esc_html__('Grey', 'fooddy')] = 'grey';
		return $list;
	}
}
