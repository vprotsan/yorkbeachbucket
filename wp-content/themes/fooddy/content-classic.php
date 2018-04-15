<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

$fooddy_blog_style = explode('_', fooddy_get_theme_option('blog_style'));
$fooddy_columns = empty($fooddy_blog_style[1]) ? 2 : max(2, $fooddy_blog_style[1]);
$fooddy_expanded = !fooddy_sidebar_present() && fooddy_is_on(fooddy_get_theme_option('expand_content'));
$fooddy_post_format = get_post_format();
$fooddy_post_format = empty($fooddy_post_format) ? 'standard' : str_replace('post-format-', '', $fooddy_post_format);
$fooddy_animation = fooddy_get_theme_option('blog_animation');

?><div class="<?php echo $fooddy_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($fooddy_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($fooddy_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($fooddy_columns)
					. ' post_layout_'.esc_attr($fooddy_blog_style[0]) 
					. ' post_layout_'.esc_attr($fooddy_blog_style[0]).'_'.esc_attr($fooddy_columns)
					); ?>
	<?php echo (!fooddy_is_off($fooddy_animation) ? ' data-animation="'.esc_attr(fooddy_get_animation_classes($fooddy_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	fooddy_show_post_featured( array( 'thumb_size' => fooddy_get_thumb_size($fooddy_blog_style[0] == 'classic'
													? (strpos(fooddy_get_theme_option('body_style'), 'full')!==false 
															? ( $fooddy_columns > 2 ? 'big' : 'huge' )
															: (	$fooddy_columns > 2
																? ($fooddy_expanded ? 'med' : 'small')
																: ($fooddy_expanded ? 'big' : 'med')
																)
														)
													: (strpos(fooddy_get_theme_option('body_style'), 'full')!==false 
															? ( $fooddy_columns > 2 ? 'masonry-big' : 'full' )
															: (	$fooddy_columns <= 2 && $fooddy_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
            do_action('fooddy_action_before_post_meta');

            // Post meta
            fooddy_show_post_meta(array(
                    'categories' => false,
                    'date' => true,
                    'author' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'counters' => ''	//comments,likes,views - comma separated in any combination
                )
            );

			do_action('fooddy_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );


			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$fooddy_show_learn_more = false; //!in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote'))) {
			fooddy_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $fooddy_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'fooddy'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>