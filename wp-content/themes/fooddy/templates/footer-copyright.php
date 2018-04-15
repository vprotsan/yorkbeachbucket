<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.10
 */

// Copyright area
$fooddy_footer_scheme =  fooddy_is_inherit(fooddy_get_theme_option('footer_scheme')) ? fooddy_get_theme_option('color_scheme') : fooddy_get_theme_option('footer_scheme');
$fooddy_copyright_scheme = fooddy_is_inherit(fooddy_get_theme_option('copyright_scheme')) ? $fooddy_footer_scheme : fooddy_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($fooddy_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$fooddy_copyright = fooddy_prepare_macros(fooddy_get_theme_option('copyright'));
				if (!empty($fooddy_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $fooddy_copyright, $fooddy_matches)) {
						$fooddy_copyright = str_replace($fooddy_matches[1], date(str_replace(array('{', '}'), '', $fooddy_matches[1])), $fooddy_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($fooddy_copyright));
				}
			?></div>
		</div>
	</div>
</div>
