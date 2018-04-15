<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */


// Socials
if ( fooddy_is_on(fooddy_get_theme_option('socials_in_footer')) && ($fooddy_output = fooddy_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php fooddy_show_layout($fooddy_output); ?>
		</div>
	</div>
	<?php
}
?>