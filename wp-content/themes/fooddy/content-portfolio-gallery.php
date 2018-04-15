<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_blog_style = explode('_', fooddy_get_theme_option('blog_style'));
$fooddy_columns = empty($fooddy_blog_style[1]) ? 2 : max(2, $fooddy_blog_style[1]);
$fooddy_post_format = get_post_format();
$fooddy_post_format = empty($fooddy_post_format) ? 'standard' : str_replace('post-format-', '', $fooddy_post_format);
$fooddy_animation = fooddy_get_theme_option('blog_animation');
$fooddy_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($fooddy_columns).' post_format_'.esc_attr($fooddy_post_format) ); ?>
	<?php echo (!fooddy_is_off($fooddy_animation) ? ' data-animation="'.esc_attr(fooddy_get_animation_classes($fooddy_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($fooddy_image[1]) && !empty($fooddy_image[2])) echo intval($fooddy_image[1]) .'x' . intval($fooddy_image[2]); ?>"
	data-src="<?php if (!empty($fooddy_image[0])) echo esc_url($fooddy_image[0]); ?>"
	>

	<?php
	$fooddy_image_hover = 'icon';	//fooddy_get_theme_option('image_hover');
	if (in_array($fooddy_image_hover, array('icons', 'zoom'))) $fooddy_image_hover = 'dots';
	// Featured image
	fooddy_show_post_featured(array(
		'hover' => $fooddy_image_hover,
		'thumb_size' => fooddy_get_thumb_size( strpos(fooddy_get_theme_option('body_style'), 'full')!==false || $fooddy_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. fooddy_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'fooddy') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>