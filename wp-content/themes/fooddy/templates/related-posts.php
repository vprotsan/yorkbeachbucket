<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_link = get_permalink();
$fooddy_post_format = get_post_format();
$fooddy_post_format = empty($fooddy_post_format) ? 'standard' : str_replace('post-format-', '', $fooddy_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($fooddy_post_format) ); ?>><?php
	fooddy_show_post_featured(array(
		'thumb_size' => fooddy_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . fooddy_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($fooddy_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($fooddy_link) . '">' . fooddy_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>