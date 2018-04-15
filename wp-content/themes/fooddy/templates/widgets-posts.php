<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_post_id    = get_the_ID();
$fooddy_post_date  = fooddy_get_date();
$fooddy_post_title = get_the_title();
$fooddy_post_link  = get_permalink();
$fooddy_post_author_id   = get_the_author_meta('ID');
$fooddy_post_author_name = get_the_author_meta('display_name');
$fooddy_post_author_url  = get_author_posts_url($fooddy_post_author_id, '');

$fooddy_args = get_query_var('fooddy_args_widgets_posts');
$fooddy_show_date = isset($fooddy_args['show_date']) ? (int) $fooddy_args['show_date'] : 1;
$fooddy_show_image = isset($fooddy_args['show_image']) ? (int) $fooddy_args['show_image'] : 1;
$fooddy_show_author = isset($fooddy_args['show_author']) ? (int) $fooddy_args['show_author'] : 1;
$fooddy_show_counters = isset($fooddy_args['show_counters']) ? (int) $fooddy_args['show_counters'] : 1;
$fooddy_show_categories = isset($fooddy_args['show_categories']) ? (int) $fooddy_args['show_categories'] : 1;

$fooddy_output = fooddy_storage_get('fooddy_output_widgets_posts');

$fooddy_post_counters_output = '';
if ( $fooddy_show_counters ) {
	$fooddy_post_counters_output = '<span class="post_info_item post_info_counters">'
								. fooddy_get_post_counters('comments')
							. '</span>';
}


$fooddy_output .= '<article class="post_item with_thumb">';

if ($fooddy_show_image) {
	$fooddy_post_thumb = get_the_post_thumbnail($fooddy_post_id, fooddy_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($fooddy_post_thumb) $fooddy_output .= '<div class="post_thumb">' . ($fooddy_post_link ? '<a href="' . esc_url($fooddy_post_link) . '">' : '') . ($fooddy_post_thumb) . ($fooddy_post_link ? '</a>' : '') . '</div>';
}

$fooddy_output .= '<div class="post_content">'
			. ($fooddy_show_categories 
					? '<div class="post_categories">'
						. fooddy_get_post_categories()
						. $fooddy_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($fooddy_post_link ? '<a href="' . esc_url($fooddy_post_link) . '">' : '') . ($fooddy_post_title) . ($fooddy_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('fooddy_filter_get_post_info', 
								'<div class="post_info">'
									. ($fooddy_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($fooddy_post_link ? '<a href="' . esc_url($fooddy_post_link) . '" class="post_info_date">' : '') 
											. esc_html($fooddy_post_date) 
											. ($fooddy_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($fooddy_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'fooddy') . ' ' 
											. ($fooddy_post_link ? '<a href="' . esc_url($fooddy_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($fooddy_post_author_name) 
											. ($fooddy_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$fooddy_show_categories && $fooddy_post_counters_output
										? $fooddy_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
fooddy_storage_set('fooddy_output_widgets_posts', $fooddy_output);
?>