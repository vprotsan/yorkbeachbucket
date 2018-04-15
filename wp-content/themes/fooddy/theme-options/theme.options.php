<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('fooddy_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'fooddy_options_theme_setup1', 1 );
	function fooddy_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		fooddy_storage_set('settings', array(
			
			'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																		// For style 'Classic' - get half from this value
			'message_maxlength'			=> 1000							// Max length of the message from contact form
			
		));
		
		
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		fooddy_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Roboto Slab',
				'family' => 'serif',
				'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
				),
            array(
                'name'	 => 'Damion',
                'family' => 'cursive',
                'styles' => '400'		// Parameter 'style' used only for the Google fonts
            )
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		fooddy_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		fooddy_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'fooddy'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'fooddy'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.575em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.6em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '4.643em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.077em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.61em',
				'margin-bottom'		=> '1.05em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '3.571rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1111em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.18em',
				'margin-bottom'		=> '1.35em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '3.214em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.225em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.91em',
				'margin-bottom'		=> '0.88em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '2.5em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3043em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.78em',
				'margin-bottom'		=> '0.5em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '2.143em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.35em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.18em',
				'margin-bottom'		=> '0.4em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.643em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.32em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.25em',
				'margin-bottom'		=> '0.65em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'fooddy'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.143rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'fooddy'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.143rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'fooddy'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'fooddy'),
				'description'		=> esc_html__('Font settings of the main menu items', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'fooddy'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'fooddy'),
                'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		fooddy_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'fooddy'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',   //
					'bd_color'				=> '#f8f8f8',   //
		
					// Text and links colors
					'text'					=> '#9a9a9a',   //
					'text_light'			=> '#b7b7b7',
					'text_dark'				=> '#414549',   //
					'text_link'				=> '#ffbd2f',   //
					'text_hover'			=> '#ecb132',   //
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f2f2f2',   //
					'alter_bg_hover'		=> '#ebebeb',   //
					'alter_bd_color'		=> '#f2f2f2',   //
					'alter_bd_hover'		=> '#d2d2d2',   //
					'alter_text'			=> '#e0e0e0',   //
					'alter_light'			=> '#cecece',   //
					'alter_dark'			=> '#465058',   //
					'alter_link'			=> '#f76f2a',   //
					'alter_hover'			=> '#3bb991',   //
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bg_hover'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bd_color'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bd_hover'		=> '#ededed',   //
					'input_text'			=> '#858789',   //
					'input_light'			=> '#fafafa',   //
					'input_dark'			=> '#414449',   //
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',   //
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
		
					// Additional accented colors (if used in the current theme)
					// For example:
					//'accent2'				=> '#faef81'
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'fooddy'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#0e0d12',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#b7b7b7',   //
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#ffbd2f',   //
					'text_hover'			=> '#ffaa5f',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#1e1d22',
					'alter_bg_hover'		=> '#28272e',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#ffaa5f',
					'alter_hover'			=> '#fe7259',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bg_hover'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_hover'		=> '#353535',
					'input_text'			=> '#858789',   //
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#414549',   //
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
				
					// Additional accented colors (if used in the current theme)
					// For example:
					//'accent2'				=> '#ff6469'
		
				)
			)
		
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('fooddy_options_create')) {

	function fooddy_options_create() {

		fooddy_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'fooddy'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'fooddy') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'fooddy') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'fooddy') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'fooddy'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'fooddy'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'fooddy') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'fooddy'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => fooddy_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'fooddy'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'fooddy'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'fooddy'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'fooddy') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'fooddy'),
					'left'	=> esc_html__('Left',	'fooddy'),
					'right'	=> esc_html__('Right',	'fooddy')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'fooddy'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'fooddy') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'fooddy'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'fooddy') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'fooddy'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'fooddy') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'fooddy'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'fooddy') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'fooddy'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'fooddy') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'fooddy'),
				"desc" => wp_kses_data( __('Options for the content area.', 'fooddy') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'fooddy') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'fooddy'),
				"desc" => wp_kses_data( __('Select width of the body content', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'fooddy'),
					'wide'		=> esc_html__('Wide',		'fooddy'),
					'fullwide'	=> esc_html__('Fullwide',	'fooddy'),
					'fullscreen'=> esc_html__('Fullscreen',	'fooddy')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'fooddy'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'fooddy')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'fooddy'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'fooddy')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'fooddy'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'fooddy') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'fooddy'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'fooddy') ),
				"std" => 0,
				"type" => "text"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'fooddy') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'fooddy') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'fooddy'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'fooddy') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets above the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets below the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'fooddy')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'fooddy'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'fooddy') )
							. '<br>'
							. wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'fooddy') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'fooddy'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'fooddy')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'fooddy')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'fooddy')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'fooddy'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'fooddy')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => fooddy_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'fooddy'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'fooddy') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'fooddy')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'fooddy'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'fooddy') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'fooddy') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'fooddy'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'fooddy') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'fooddy'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'fooddy') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'fooddy'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'fooddy') ),
				"std" => esc_html__('Fooddy &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'fooddy'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'fooddy'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'fooddy') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'fooddy'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'fooddy') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'fooddy'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'fooddy') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'fooddy'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'fooddy') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'fooddy'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'fooddy') ),
				"std" => 'header_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'fooddy') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'fooddy') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'fooddy') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'fooddy') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'fooddy') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'fooddy'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'fooddy') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'fooddy'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'fooddy') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'fooddy'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'fooddy'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'fooddy') ),
				"std" => 2,
				"options" => fooddy_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'fooddy'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'fooddy'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'fooddy'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'fooddy'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'fooddy'),
					'links'	=> esc_html__("Older/Newest", 'fooddy'),
					'more'	=> esc_html__("Load more", 'fooddy'),
					'infinite' => esc_html__("Infinite scroll", 'fooddy')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'fooddy'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'fooddy'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'fooddy') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'fooddy'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'fooddy') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'fooddy'),
					'fullpost'	=> esc_html__('Full post',	'fooddy')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'fooddy'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'fooddy') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'fooddy'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'fooddy') ),
				"std" => 2,
				"options" => fooddy_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'fooddy'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'fooddy') ),
				"std" => 2,
				"options" => fooddy_get_list_styles(1,2),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'fooddy'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'fooddy')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'fooddy'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'fooddy'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'fooddy'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'fooddy') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'fooddy'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'fooddy') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'fooddy'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'fooddy') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'fooddy'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'fooddy') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'fooddy') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'fooddy'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'fooddy'),
					"advanced" => esc_html__("Advanced", 'fooddy')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'fooddy'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'fooddy') ),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'fooddy'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'fooddy'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'fooddy'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'fooddy'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'fooddy'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'fooddy'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'fooddy') ),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'fooddy'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'fooddy') ),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'fooddy'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'fooddy'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'fooddy'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'fooddy'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'fooddy'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'fooddy'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'fooddy'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'fooddy'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'fooddy'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the active field', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'fooddy'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'fooddy'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'fooddy') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$fooddy_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'fooddy'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'fooddy') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'fooddy')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'fooddy'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'fooddy') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'fooddy')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'fooddy'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'fooddy'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'fooddy') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'fooddy') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'fooddy'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'fooddy') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'fooddy') ),
				"refresh" => false,
				"std" => '$fooddy_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=fooddy_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'fooddy'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'fooddy'),
				"desc" => '',
				"refresh" => false,
				"std" => '$fooddy_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'fooddy'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'fooddy') )
							: '',
				"refresh" => false,
				"std" => '$fooddy_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'fooddy'),
					'serif' => esc_html__('serif', 'fooddy'),
					'sans-serif' => esc_html__('sans-serif', 'fooddy'),
					'monospace' => esc_html__('monospace', 'fooddy'),
					'cursive' => esc_html__('cursive', 'fooddy'),
					'fantasy' => esc_html__('fantasy', 'fooddy')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'fooddy'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'fooddy') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'fooddy') )
							: '',
				"refresh" => false,
				"std" => '$fooddy_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = fooddy_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'fooddy'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'fooddy'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'fooddy'),
						'100' => esc_html__('100 (Light)', 'fooddy'), 
						'200' => esc_html__('200 (Light)', 'fooddy'), 
						'300' => esc_html__('300 (Thin)',  'fooddy'),
						'400' => esc_html__('400 (Normal)', 'fooddy'),
						'500' => esc_html__('500 (Semibold)', 'fooddy'),
						'600' => esc_html__('600 (Semibold)', 'fooddy'),
						'700' => esc_html__('700 (Bold)', 'fooddy'),
						'800' => esc_html__('800 (Black)', 'fooddy'),
						'900' => esc_html__('900 (Black)', 'fooddy')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'fooddy'),
						'normal' => esc_html__('Normal', 'fooddy'), 
						'italic' => esc_html__('Italic', 'fooddy')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'fooddy'),
						'none' => esc_html__('None', 'fooddy'), 
						'underline' => esc_html__('Underline', 'fooddy'),
						'overline' => esc_html__('Overline', 'fooddy'),
						'line-through' => esc_html__('Line-through', 'fooddy')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'fooddy'),
						'none' => esc_html__('None', 'fooddy'), 
						'uppercase' => esc_html__('Uppercase', 'fooddy'),
						'lowercase' => esc_html__('Lowercase', 'fooddy'),
						'capitalize' => esc_html__('Capitalize', 'fooddy')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$fooddy_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		fooddy_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			fooddy_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'fooddy'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'fooddy') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'fooddy')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('fooddy_options_get_list_choises')) {
	add_filter('fooddy_filter_options_get_list_choises', 'fooddy_options_get_list_choises', 10, 2);
	function fooddy_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = fooddy_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = fooddy_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = fooddy_get_list_schemes(true);
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = fooddy_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = fooddy_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = fooddy_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = fooddy_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = fooddy_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = fooddy_array_merge(array(0 => esc_html__('- Select category -', 'fooddy')), fooddy_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = fooddy_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = fooddy_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = fooddy_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('fooddy_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'fooddy_options_theme_setup2', 2 );
	function fooddy_options_theme_setup2() {
		fooddy_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('fooddy_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'fooddy_options_theme_setup5', 5 );
	function fooddy_options_theme_setup5() {
		fooddy_storage_set('options_reloaded', false);
		fooddy_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('fooddy_load_custom_options')) {
		add_action( 'wp_loaded', 'fooddy_load_custom_options' );
		function fooddy_load_custom_options() {
			if (!fooddy_storage_get('options_reloaded')) {
				fooddy_storage_set('options_reloaded', true);
				fooddy_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('fooddy_load_theme_options') ) {
	function fooddy_load_theme_options() {
		$options = fooddy_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$fooddy_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				fooddy_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			fooddy_customizer_save_css();
		} else {
			do_action('fooddy_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('fooddy_override_theme_options') ) {
	add_action( 'wp', 'fooddy_override_theme_options', 1 );
	function fooddy_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			fooddy_storage_set('blog_archive', true);
			fooddy_storage_set('blog_template', get_the_ID());
		}
		fooddy_storage_set('blog_mode', fooddy_detect_blog_mode());
		if (is_singular()) {
			fooddy_storage_set('options_meta', get_post_meta(get_the_ID(), 'fooddy_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('fooddy_get_theme_option')) {
	function fooddy_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!fooddy_storage_isset('post_options_meta', $post_id))
				fooddy_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'fooddy_options', true));
			if (fooddy_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = fooddy_storage_get_array('post_options_meta', $post_id, $name);
				if (!fooddy_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && fooddy_storage_isset('options')) {
			if ( !fooddy_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'fooddy'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = fooddy_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (fooddy_storage_isset('options_meta', $name) && !fooddy_is_inherit(fooddy_storage_get_array('options_meta', $name))) {
					$rez = fooddy_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && fooddy_storage_isset('options', $name . '_' . $blog_mode, 'val') && !fooddy_is_inherit(fooddy_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = fooddy_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (fooddy_storage_isset('options', $name, 'val')) {
					$rez = fooddy_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('fooddy_check_theme_option')) {
	function fooddy_check_theme_option($name) {
		return fooddy_storage_isset('options', $name);
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('fooddy_get_theme_dependencies') ) {
	function fooddy_get_theme_dependencies() {
		$options = fooddy_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('fooddy_get_theme_setting')) {
	function fooddy_get_theme_setting($name) {
		return fooddy_storage_isset('settings', $name) ? fooddy_storage_get_array('settings', $name) : false;
	}
}

// Set theme setting
if ( !function_exists( 'fooddy_set_theme_setting' ) ) {
	function fooddy_set_theme_setting($option_name, $value) {
		if (fooddy_storage_isset('settings', $option_name))
			fooddy_storage_set_array('settings', $option_name, $value);
	}
}
?>