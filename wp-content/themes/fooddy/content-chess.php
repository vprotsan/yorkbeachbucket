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
$fooddy_columns = empty($fooddy_blog_style[1]) ? 1 : max(1, $fooddy_blog_style[1]);
$fooddy_expanded = !fooddy_sidebar_present() && fooddy_is_on(fooddy_get_theme_option('expand_content'));
$fooddy_post_format = get_post_format();
$fooddy_post_format = empty($fooddy_post_format) ? 'standard' : str_replace('post-format-', '', $fooddy_post_format);
$fooddy_animation = fooddy_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($fooddy_columns).' post_format_'.esc_attr($fooddy_post_format) ); ?>
	<?php echo (!fooddy_is_off($fooddy_animation) ? ' data-animation="'.esc_attr(fooddy_get_animation_classes($fooddy_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($fooddy_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	fooddy_show_post_featured( array(
											'class' => $fooddy_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => fooddy_get_thumb_size(
																	strpos(fooddy_get_theme_option('body_style'), 'full')!==false
																		? ( $fooddy_columns > 1 ? 'huge' : 'original' )
																		: (	$fooddy_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('fooddy_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('fooddy_action_before_post_meta'); 

			// Post meta
			$fooddy_post_meta = fooddy_show_post_meta(array(
                    'categories' => false,
                    'date' => true,
                    'author' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'counters' => ''	//comments,likes,views - comma separated in any combination
                )
								);
			fooddy_show_layout($fooddy_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$fooddy_show_learn_more = !in_array($fooddy_post_format, array('link', 'aside', 'status', 'quote'));
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
				fooddy_show_layout($fooddy_post_meta);
			}
			// More button
			if ( $fooddy_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'fooddy'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>