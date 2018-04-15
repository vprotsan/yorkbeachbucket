<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($fooddy_columns).' post_format_'.esc_attr($fooddy_post_format) ); ?>
	<?php echo (!fooddy_is_off($fooddy_animation) ? ' data-animation="'.esc_attr(fooddy_get_animation_classes($fooddy_animation)).'"' : ''); ?>
	>

	<?php
	$fooddy_image_hover = fooddy_get_theme_option('image_hover');
	// Featured image
	fooddy_show_post_featured(array(
		'thumb_size' => fooddy_get_thumb_size(strpos(fooddy_get_theme_option('body_style'), 'full')!==false || $fooddy_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $fooddy_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $fooddy_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>