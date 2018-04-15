<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$fooddy_post_format = get_post_format();
$fooddy_post_format = empty($fooddy_post_format) ? 'standard' : str_replace('post-format-', '', $fooddy_post_format);
$fooddy_animation = fooddy_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($fooddy_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($fooddy_post_format) ); ?>
	<?php echo (!fooddy_is_off($fooddy_animation) ? ' data-animation="'.esc_attr(fooddy_get_animation_classes($fooddy_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	fooddy_show_post_featured(array(
		'thumb_size' => fooddy_get_thumb_size($fooddy_columns==1 ? 'big' : ($fooddy_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			fooddy_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>