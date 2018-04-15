<?php
/* Visual Composer Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('fooddy_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'fooddy_vc_extensions_theme_setup9', 9 );
	function fooddy_vc_extensions_theme_setup9() {
		if (fooddy_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'fooddy_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'fooddy_filter_merge_styles',						'fooddy_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'fooddy_filter_tgmpa_required_plugins',		'fooddy_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'fooddy_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('fooddy_filter_tgmpa_required_plugins',	'fooddy_vc_extensions_tgmpa_required_plugins');
	function fooddy_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', fooddy_storage_get('required_plugins'))) {
			$path = fooddy_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			$list[] = array(
					'name' 		=> esc_html__('Visual Composer Extensions Bundle', 'fooddy'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'fooddy_exists_vc_extensions' ) ) {
	function fooddy_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'fooddy_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'fooddy_vc_extensions_frontend_scripts', 1100 );
	function fooddy_vc_extensions_frontend_scripts() {
		if (fooddy_is_on(fooddy_get_theme_option('debug_mode')) && fooddy_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'fooddy-vc-extensions-bundle',  fooddy_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'fooddy_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('fooddy_filter_merge_styles', 'fooddy_vc_extensions_merge_styles');
	function fooddy_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>