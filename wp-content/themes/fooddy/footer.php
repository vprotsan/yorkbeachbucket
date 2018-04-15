<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

						// Widgets area inside page content
						fooddy_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					fooddy_create_widgets_area('widgets_below_page');

					$fooddy_body_style = fooddy_get_theme_option('body_style');
					if ($fooddy_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$fooddy_footer_style = fooddy_get_theme_option("footer_style");
			if (strpos($fooddy_footer_style, 'footer-custom-')===0) $fooddy_footer_style = 'footer-custom';
			get_template_part( "templates/{$fooddy_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (fooddy_is_on(fooddy_get_theme_option('debug_mode')) && fooddy_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(fooddy_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>