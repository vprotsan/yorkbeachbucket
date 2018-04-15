<?php
/**
 * ThemeREX Shortcodes
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Include files with shortcodes
if (!function_exists('trx_addons_sc_load')) {
	add_action( 'after_setup_theme', 'trx_addons_sc_load', 6 );
	add_action( 'trx_addons_action_save_options', 'trx_addons_sc_load', 6 );
	function trx_addons_sc_load() {
		static $loaded = false;
		if ($loaded) return;
		$loaded = true;
		$trx_addons_shortcodes = apply_filters('trx_addons_sc_list', array(
			'action' => 1,
			'anchor' => 1,
			'blogger' => 1,
			'button' => 1,
			'content' => 1,
			'countdown' => 1,
			'form' => 1,
			'googlemap' => 1,
			'icons' => 1,
			'popup' => 1,
			'price' => 1,
			'promo' => 1,
			'skills' => 1,
			'socials' => 1,
			'table' => 1,
			'title' => 1
			)
		);
		if (is_array($trx_addons_shortcodes) && count($trx_addons_shortcodes) > 0) {
			foreach ($trx_addons_shortcodes as $s=>$need) {
				if ( $need && ($fdir = trx_addons_get_file_dir("shortcodes/{$s}/{$s}.php")) != '') { include_once $fdir; }
			}
		}
	}
}


	
// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_sc_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_sc_load_scripts_front');
	function trx_addons_sc_load_scripts_front() {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_style( 'trx_addons-sc', trx_addons_get_file_url('shortcodes/shortcodes.css'), array(), null );
			wp_enqueue_script( 'trx_addons-sc', trx_addons_get_file_url('shortcodes/shortcodes.js'), array('jquery'), null, true );
		}
	}
}

	
// Merge shortcode's specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_merge_styles' ) ) {
	add_action("trx_addons_filter_merge_styles", 'trx_addons_sc_merge_styles');
	function trx_addons_sc_merge_styles($list) {
		$list[] = 'shortcodes/shortcodes.css';
		return $list;
	}
}

	
// Merge shortcode's specific scripts into single file
if ( !function_exists( 'trx_addons_sc_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_merge_scripts');
	function trx_addons_sc_merge_scripts($list) {
		$list[] = 'shortcodes/shortcodes.js';
		return $list;
	}
}


// Shortcodes parts
//---------------------------------------

// Prepare Id, custom CSS and other parameters in the shortcode's atts
if (!function_exists('trx_addons_sc_prepare_atts')) {
	function trx_addons_sc_prepare_atts($sc, $atts, $defa) {
		// Merge atts with default values
		$atts = trx_addons_html_decode(shortcode_atts(apply_filters('trx_addons_sc_atts', $defa, $sc), $atts));
		// Unsafe item description
		if (!empty($atts['description']))
			$atts['description'] = trim( vc_value_from_safe( $atts['description'] ) );
		// Generate id (if empty)
        if (empty($atts['id']))
        	$atts['id'] = str_replace('trx_', '', $sc) . '_' . str_replace('.', '', mt_rand());
		// Add custom CSS class
		if (!empty($atts['css'])) {
			$atts['class'] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
											(!empty($atts['class']) ? $atts['class'] . ' ' : '') . vc_shortcode_custom_css_class( $atts['css'], ' ' ),
											$sc,
											$atts);
			$atts['css'] = '';
		}
 		return apply_filters('trx_addons_filter_sc_prepare_atts', $atts, $sc);
	}
}

// Enqueue iconed fonts
if (!function_exists('trx_addons_load_icons')) {
	function trx_addons_load_icons($list='') {
		if (!empty($list) && function_exists('vc_icon_element_fonts_enqueue')) {
			$list = explode(',', $list);
			foreach ($list as $icon_type)
				vc_icon_element_fonts_enqueue($icon_type);
		}
	}
}

// Display title, subtitle and description for some shortcodes
if (!function_exists('trx_addons_sc_show_titles')) {
	function trx_addons_sc_show_titles($sc, $args, $size='') {
		if (($fdir = trx_addons_get_file_dir('templates/tpl.sc_titles.php')) != '') {
			set_query_var('trx_addons_args_sc_show_titles', compact('sc', 'args', 'size') );
			include $fdir;
		}
	}
}

// Display link button or image for some shortcodes
if (!function_exists('trx_addons_sc_show_links')) {
	function trx_addons_sc_show_links($sc, $args) {
		if (($fdir = trx_addons_get_file_dir('templates/tpl.sc_links.php')) != '') {
			set_query_var('trx_addons_args_sc_show_links', compact('sc', 'args') );
			include $fdir;
		}
	}
}

// Show post meta block: post date, author, categories, counters, etc.
if ( !function_exists('trx_addons_sc_show_post_meta') ) {
	function trx_addons_sc_show_post_meta($sc, $args=array()) {
		$args = array_merge(array(
			'categories' => false,
			'tags' => false,
			'date' => false,
			'edit' => false,
			'seo' => false,
			'share' => false,
			'counters' => '',
			'echo' => true
			), $args);
		
		if (($meta = apply_filters('trx_addons_filter_post_meta', '', array_merge($args, array('echo'=>false)))) != '') {
			if (!empty($args['echo'])) trx_addons_show_layout($meta);
			else return $meta;
		} else if (($fdir = trx_addons_get_file_dir('templates/tpl.sc_post_meta.php')) != '') {
			set_query_var('trx_addons_args_sc_show_post_meta', compact('sc', 'args') );
			if (empty($args['echo'])) ob_start();
			include $fdir;
			if (empty($args['echo'])) {
				$meta = ob_get_contents();
				ob_end_clean();
				return $meta;
			}
		}
	}
}

// Display begin of the slider layout for some shortcodes
if (!function_exists('trx_addons_sc_show_slider_wrap_start')) {
	function trx_addons_sc_show_slider_wrap_start($sc, $args) {
		if (($fdir = trx_addons_get_file_dir('templates/tpl.sc_slider_start.php')) != '') {
			set_query_var('trx_addons_args_sc_show_slider_wrap', compact('sc', 'args') );
			include $fdir;
		}
	}
}

// Display end of the slider layout for some shortcodes
if (!function_exists('trx_addons_sc_show_slider_wrap_end')) {
	function trx_addons_sc_show_slider_wrap_end($sc, $args) {
		if (($fdir = trx_addons_get_file_dir('templates/tpl.sc_slider_end.php')) != '') {
			set_query_var('trx_addons_args_sc_show_slider_wrap', compact('sc', 'args') );
			include $fdir;
		}
	}
}


// Shortcode's common params
//---------------------------------------------------------

// Return ID, Class, CSS params for the VC
if ( !function_exists( 'trx_addons_vc_add_id_param' ) ) {
	function trx_addons_vc_add_id_param($group=false) {
		$params = array(
					// Common VC parameters
					array(
						"param_name" => "id",
						"heading" => esc_html__("Element ID", 'trx_addons'),
						"description" => wp_kses_data( __("ID for current element", 'trx_addons') ),
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						"param_name" => "class",
						"heading" => esc_html__("Element CSS class", 'trx_addons'),
						"description" => wp_kses_data( __("CSS class for current element", 'trx_addons') ),
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						'param_name' => 'css',
						'heading' => __( 'CSS box', 'trx_addons' ),
						'group' => __( 'Design Options', 'trx_addons' ),
						'type' => 'css_editor'
					)
				);

		// Add param 'group' if not empty
		if ($group===false)
			$group = esc_html__('ID &amp; Class', 'trx_addons');
		
		if (!empty($group)) {
			$params[0]['group'] = $group;
			$params[1]['group'] = $group;
		}

		return $params;
	}
}

// Return slider params for the VC
if ( !function_exists( 'trx_addons_vc_add_slider_param' ) ) {
	function trx_addons_vc_add_slider_param($group=false) {
		$params = array(
					array(
						"param_name" => "slider",
						"heading" => esc_html__("Slider", 'trx_addons'),
						"description" => wp_kses_data( __("Show items as slider", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6 vc_new_row',
						"admin_label" => true,
						"std" => "0",
						"value" => array(esc_html__("Slider", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "slides_space",
						"heading" => esc_html__("Space", 'trx_addons'),
						"description" => wp_kses_data( __("Space between slides", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						'dependency' => array(
							'element' => 'slider',
							'value' => '1'
						),
						"std" => "",
						"type" => "textfield"
					),
					array(
						"param_name" => "slider_controls",
						"heading" => esc_html__("Slider controls", 'trx_addons'),
						"description" => wp_kses_data( __("Show arrows in the slider", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6 vc_new_row',
						'dependency' => array(
							'element' => 'slider',
							'value' => '1'
						),
						"std" => "none",
						"value" => array(
							esc_html__('None', 'trx_addons') => 'none',
							esc_html__('Side', 'trx_addons') => 'side',
							esc_html__('Top', 'trx_addons') => 'top',
							esc_html__('Bottom', 'trx_addons') => 'bottom'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "slider_pagination",
						"heading" => esc_html__("Slider pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Show bullets in the slider", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						'dependency' => array(
							'element' => 'slider',
							'value' => '1'
						),
						"std" => "none",
						"value" => array(
							esc_html__('None', 'trx_addons') => 'none',
							esc_html__('Bottom', 'trx_addons') => 'bottom',
							esc_html__('Left', 'trx_addons') => 'left',
							esc_html__('Right', 'trx_addons') => 'right'
						),
						"type" => "dropdown"
					)
				);

		// Add param 'group' if not empty
		if ($group===false)
			$group = esc_html__('Slider', 'trx_addons');
		if (!empty($group))
			foreach ($params as $k=>$v)
				$params[$k]['group'] = $group;

		return $params;
	}
}

// Return title params for the VC
if ( !function_exists( 'trx_addons_vc_add_title_param' ) ) {
	function trx_addons_vc_add_title_param($group=false, $button=true) {
		$params = array(
					array(
						"param_name" => "title_style",
						"heading" => esc_html__("Title style", 'trx_addons'),
						"description" => wp_kses_data( __("Select style of the title and subtitle", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-4',
						"std" => "default",
				        'save_always' => true,
						"value" => apply_filters('trx_addons_sc_type', array(
							esc_html__('Default', 'trx_addons') => 'default',
							esc_html__('Shadow', 'trx_addons') => 'shadow'
						), 'trx_sc_title' ),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title_tag",
						"heading" => esc_html__("Title tag", 'trx_addons'),
						"description" => wp_kses_data( __("Select tag (level) of the title", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"admin_label" => true,
						"std" => "none",
						"value" => array(
							esc_html__('Default', 'trx_addons') => 'none',
							esc_html__('Heading 1', 'trx_addons') => 'h1',
							esc_html__('Heading 2', 'trx_addons') => 'h2',
							esc_html__('Heading 3', 'trx_addons') => 'h3',
							esc_html__('Heading 4', 'trx_addons') => 'h4',
							esc_html__('Heading 5', 'trx_addons') => 'h5',
							esc_html__('Heading 6', 'trx_addons') => 'h6'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title_align",
						"heading" => esc_html__("Title alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the title, subtitle and description", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"std" => "default",
						"value" => array(
							esc_html__('Default', 'trx_addons') => 'default',
							esc_html__('Left', 'trx_addons') => 'left',
							esc_html__('Center', 'trx_addons') => 'center',
							esc_html__('Right', 'trx_addons') => 'right'
						),
						"type" => "dropdown"
					),
					array(
						"param_name" => "title",
						"heading" => esc_html__("Title", 'trx_addons'),
						"description" => wp_kses_data( __("Title of the block. Enclose any words in {{ and }} to accent them", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-6',
						"type" => "textfield"
					),
					array(
						"param_name" => "subtitle",
						"heading" => esc_html__("Subtitle", 'trx_addons'),
						"description" => wp_kses_data( __("Subtitle of the block", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						"type" => "textfield"
					),
					array(
						"param_name" => "description",
						"heading" => esc_html__("Description", 'trx_addons'),
						"description" => wp_kses_data( __("Description of the block", 'trx_addons') ),
						"type" => "textarea_safe"
					),
				);
		
		// Add button's params
		if ($button)
			$params = array_merge($params, array(
					array(
						"param_name" => "link",
						"heading" => esc_html__("Button URL", 'trx_addons'),
						"description" => wp_kses_data( __("Link URL for the button at the bottom of the block", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"type" => "textfield"
					),
					array(
						"param_name" => "link_text",
						"heading" => esc_html__("Button's text", 'trx_addons'),
						"description" => wp_kses_data( __("Caption for the button at the bottom of the block", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"type" => "textfield"
					),
					array(
						"param_name" => "link_image",
						"heading" => esc_html__("Button's image", 'trx_addons'),
						"description" => wp_kses_data( __("Select the promo image from the library for this button", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"type" => "attach_image"
					)
				)
			);

		// Add param 'group' if not empty
		if ($group===false)
			$group = esc_html__('Titles', 'trx_addons');
		if (!empty($group))
			foreach ($params as $k=>$v)
				$params[$k]['group'] = $group;

		return $params;
	}
}

// Return query params for the VC
if ( !function_exists( 'trx_addons_vc_add_query_param' ) ) {
	function trx_addons_vc_add_query_param($group=false) {
		$params = array(
					array(
						"param_name" => "ids",
						"heading" => esc_html__("IDs to show", 'trx_addons'),
						"description" => wp_kses_data( __("Comma separated IDs list to show. If not empty - parameters 'cat', 'offset' and 'count' are ignored!", 'trx_addons') ),
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						"param_name" => "count",
						"heading" => esc_html__("Count", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of items to display", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array(
							'element' => 'ids',
							'is_empty' => true
						),
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						"param_name" => "columns",
						"heading" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of columns. If empty - auto detect by items number", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						"param_name" => "offset",
						"heading" => esc_html__("Offset", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of items to skip before showed items", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array(
							'element' => 'ids',
							'is_empty' => true
						),
						"admin_label" => true,
						"type" => "textfield"
					),
					array(
						"param_name" => "orderby",
						"heading" => esc_html__("Order by", 'trx_addons'),
						"description" => wp_kses_data( __("Select how to sort the posts", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						"admin_label" => true,
				        'save_always' => true,
						"value" => array(
							esc_html__('None', 'trx_addons') => 'none',
							esc_html__('Post ID', 'trx_addons') => 'ID',
							esc_html__('Date', 'trx_addons') => 'post_date',
							esc_html__('Title', 'trx_addons') => 'title',
							esc_html__('Random', 'trx_addons') => 'rand'
						),
						"std" => "none",
						"type" => "dropdown"
					),
					array(
						"param_name" => "order",
						"heading" => esc_html__("Order", 'trx_addons'),
						"description" => wp_kses_data( __("Select sort order", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						"value" => array(
							esc_html__('Descending', 'trx_addons') => 'desc',
							esc_html__('Ascending', 'trx_addons') => 'asc'
						),
						"std" => "asc",
						"type" => "dropdown"
					)
				);

		// Add param 'group' if not empty
		if ($group===false)
			$group = esc_html__('Query', 'trx_addons');
		if (!empty($group))
			foreach ($params as $k=>$v)
				$params[$k]['group'] = $group;

		return $params;
	}
}

// Return hide_on_mobile param for the VC
if ( !function_exists( 'trx_addons_vc_add_hide_param' ) ) {
	function trx_addons_vc_add_hide_param($group=false) {
		$params = array(
					array(
						"param_name" => "hide_on_tablet",
						"heading" => esc_html__("Hide on the tablet", 'trx_addons'),
						"description" => wp_kses_data( __("Hide this item on the tablets", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"value" => array(esc_html__("Hide on tablets", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "hide_on_mobile",
						"heading" => esc_html__("Hide on mobile", 'trx_addons'),
						"description" => wp_kses_data( __("Hide this item on the mobile devices", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"value" => array(esc_html__("Hide on the mobile", 'trx_addons') => "1"),
						"type" => "checkbox"
					)
				);

		// Add param 'group' if not empty
		if (!empty($group))
			foreach ($params as $k=>$v)
				$params[$k]['group'] = $group;

		return $params;
	}
}

// Return icon params for the VC
if ( !function_exists( 'trx_addons_vc_add_icon_param' ) ) {
	function trx_addons_vc_add_icon_param($group=false) {
		$params = array(
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon library', 'trx_addons' ),
						'edit_field_class' => 'vc_col-sm-4 vc_new_row',
						'value' => array(
							__( 'Font Awesome', 'trx_addons' ) => 'fontawesome',
/*
							__( 'Open Iconic', 'trx_addons' ) => 'openiconic',
							__( 'Typicons', 'trx_addons' ) => 'typicons',
							__( 'Entypo', 'trx_addons' ) => 'entypo',
							__( 'Linecons', 'trx_addons' ) => 'linecons'
*/
						),
						'std' => 'fontswesome',
						'param_name' => 'icon_type',
						'description' => __( 'Select icon library.', 'trx_addons' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'trx_addons' ),
						'description' => esc_html__( 'Select icon from library.', 'trx_addons' ),
						'edit_field_class' => 'vc_col-sm-8',
						'param_name' => 'icon_fontawesome',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,						// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,						// default 100, how many icons per/page to display
							'type' => 'fontawesome'

						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
					),
/*
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'trx_addons' ),
						'description' => esc_html__( 'Select icon from library.', 'trx_addons' ),
						'param_name' => 'icon_openiconic',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,						// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,						// default 100, how many icons per/page to display
							'type' => 'openiconic'
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'openiconic',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'trx_addons' ),
						'description' => esc_html__( 'Select icon from library.', 'trx_addons' ),
						'param_name' => 'icon_typicons',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,						// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,						// default 100, how many icons per/page to display
							'type' => 'typicons',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'trx_addons' ),
						'description' => esc_html__( 'Select icon from library.', 'trx_addons' ),
						'param_name' => 'icon_entypo',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,						// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,						// default 100, how many icons per/page to display
							'type' => 'entypo',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'trx_addons' ),
						'description' => esc_html__( 'Select icon from library.', 'trx_addons' ),
						'param_name' => 'icon_linecons',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,						// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,						// default 100, how many icons per/page to display
							'type' => 'linecons',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
					)
*/					
				);

		// Add param 'group' if not empty
		if ($group===false)
			$group = esc_html__('Icons', 'trx_addons');
		if (!empty($group))
			foreach ($params as $k=>$v)
				$params[$k]['group'] = $group;

		return $params;
	}
}
?>