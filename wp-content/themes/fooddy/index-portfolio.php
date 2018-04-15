<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

fooddy_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', fooddy_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', fooddy_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', fooddy_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'fooddy-gallery-script', fooddy_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$fooddy_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$fooddy_sticky_out = is_array($fooddy_stickies) && count($fooddy_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$fooddy_cat = fooddy_get_theme_option('parent_cat');
	$fooddy_post_type = fooddy_get_theme_option('post_type');
	$fooddy_taxonomy = fooddy_get_post_type_taxonomy($fooddy_post_type);
	$fooddy_show_filters = fooddy_get_theme_option('show_filters');
	$fooddy_tabs = array();
	if (!fooddy_is_off($fooddy_show_filters)) {
		$fooddy_args = array(
			'type'			=> $fooddy_post_type,
			'child_of'		=> $fooddy_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $fooddy_taxonomy,
			'pad_counts'	=> false
		);
		$fooddy_portfolio_list = get_terms($fooddy_args);
		if (is_array($fooddy_portfolio_list) && count($fooddy_portfolio_list) > 0) {
			$fooddy_tabs[$fooddy_cat] = esc_html__('All', 'fooddy');
			foreach ($fooddy_portfolio_list as $fooddy_term) {
				if (isset($fooddy_term->term_id)) $fooddy_tabs[$fooddy_term->term_id] = $fooddy_term->name;
			}
		}
	}
	if (count($fooddy_tabs) > 0) {
		$fooddy_portfolio_filters_ajax = true;
		$fooddy_portfolio_filters_active = $fooddy_cat;
		$fooddy_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters fooddy_tabs fooddy_tabs_ajax">
			<ul class="portfolio_titles fooddy_tabs_titles">
				<?php
				foreach ($fooddy_tabs as $fooddy_id=>$fooddy_title) {
					?><li><a href="<?php echo esc_url(fooddy_get_hash_link(sprintf('#%s_%s_content', $fooddy_portfolio_filters_id, $fooddy_id))); ?>" data-tab="<?php echo esc_attr($fooddy_id); ?>"><?php echo esc_html($fooddy_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$fooddy_ppp = fooddy_get_theme_option('posts_per_page');
			if (fooddy_is_inherit($fooddy_ppp)) $fooddy_ppp = '';
			foreach ($fooddy_tabs as $fooddy_id=>$fooddy_title) {
				$fooddy_portfolio_need_content = $fooddy_id==$fooddy_portfolio_filters_active || !$fooddy_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $fooddy_portfolio_filters_id, $fooddy_id)); ?>"
					class="portfolio_content fooddy_tabs_content"
					data-blog-template="<?php echo esc_attr(fooddy_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(fooddy_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($fooddy_ppp); ?>"
					data-post-type="<?php echo esc_attr($fooddy_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($fooddy_taxonomy); ?>"
					data-cat="<?php echo esc_attr($fooddy_id); ?>"
					data-parent-cat="<?php echo esc_attr($fooddy_cat); ?>"
					data-need-content="<?php echo (false===$fooddy_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($fooddy_portfolio_need_content) 
						fooddy_show_portfolio_posts(array(
							'cat' => $fooddy_id,
							'parent_cat' => $fooddy_cat,
							'taxonomy' => $fooddy_taxonomy,
							'post_type' => $fooddy_post_type,
							'page' => 1,
							'sticky' => $fooddy_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		fooddy_show_portfolio_posts(array(
			'cat' => $fooddy_cat,
			'parent_cat' => $fooddy_cat,
			'taxonomy' => $fooddy_taxonomy,
			'post_type' => $fooddy_post_type,
			'page' => 1,
			'sticky' => $fooddy_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>