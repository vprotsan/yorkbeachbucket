<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_args = get_query_var('fooddy_logo_args');

// Site logo
$fooddy_logo_image  = fooddy_get_logo_image(isset($fooddy_args['type']) ? $fooddy_args['type'] : '');
$fooddy_logo_text   = fooddy_is_on(fooddy_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$fooddy_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($fooddy_logo_image) || !empty($fooddy_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($fooddy_logo_image)) {
			$fooddy_attr = fooddy_getimagesize($fooddy_logo_image);
			echo '<img src="'.esc_url($fooddy_logo_image).'" alt=""'.(!empty($fooddy_attr[3]) ? sprintf(' %s', $fooddy_attr[3]) : '').'>' ;
		} else {
			fooddy_show_layout(fooddy_prepare_macros($fooddy_logo_text), '<span class="logo_text">', '</span>');
			fooddy_show_layout(fooddy_prepare_macros($fooddy_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>