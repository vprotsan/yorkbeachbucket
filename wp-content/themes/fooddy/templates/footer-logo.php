<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */

// Logo
if (fooddy_is_on(fooddy_get_theme_option('logo_in_footer'))) {
	$fooddy_logo_image = '';
	if (fooddy_get_retina_multiplier(2) > 1)
		$fooddy_logo_image = fooddy_get_theme_option( 'logo_footer_retina' );
	if (empty($fooddy_logo_image)) 
		$fooddy_logo_image = fooddy_get_theme_option( 'logo_footer' );
	$fooddy_logo_text   = get_bloginfo( 'name' );
	if (!empty($fooddy_logo_image) || !empty($fooddy_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($fooddy_logo_image)) {
					$fooddy_attr = fooddy_getimagesize($fooddy_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($fooddy_logo_image).'" class="logo_footer_image" alt=""'.(!empty($fooddy_attr[3]) ? sprintf(' %s', $fooddy_attr[3]) : '').'></a>' ;
				} else if (!empty($fooddy_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($fooddy_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>