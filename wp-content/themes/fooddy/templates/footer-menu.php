<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */

// Footer menu
$fooddy_menu_footer = fooddy_get_nav_menu('menu_footer');
if (!empty($fooddy_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php fooddy_show_layout($fooddy_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>