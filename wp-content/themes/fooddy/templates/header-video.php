<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0.14
 */
$fooddy_header_video = fooddy_get_header_video();
if (!empty($fooddy_header_video) && !fooddy_is_from_uploads($fooddy_header_video)) {
	global $wp_embed;
	if (is_object($wp_embed))
		$fooddy_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($fooddy_header_video) . '[/embed]' ));
	$fooddy_embed_video = fooddy_make_video_autoplay($fooddy_embed_video);
	?><div id="background_video"><?php fooddy_show_layout($fooddy_embed_video); ?></div><?php
}
?>