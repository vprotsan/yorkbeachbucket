<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

// Page (category, tag, archive, author) title

if ( fooddy_need_page_title() ) {
	fooddy_sc_layouts_showed('title', true);
	fooddy_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								fooddy_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$fooddy_blog_title = fooddy_get_blog_title();
							$fooddy_blog_title_text = $fooddy_blog_title_class = $fooddy_blog_title_link = $fooddy_blog_title_link_text = '';
							if (is_array($fooddy_blog_title)) {
								$fooddy_blog_title_text = $fooddy_blog_title['text'];
								$fooddy_blog_title_class = !empty($fooddy_blog_title['class']) ? ' '.$fooddy_blog_title['class'] : '';
								$fooddy_blog_title_link = !empty($fooddy_blog_title['link']) ? $fooddy_blog_title['link'] : '';
								$fooddy_blog_title_link_text = !empty($fooddy_blog_title['link_text']) ? $fooddy_blog_title['link_text'] : '';
							} else
								$fooddy_blog_title_text = $fooddy_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($fooddy_blog_title_class); ?>"><?php
								$fooddy_top_icon = fooddy_get_category_icon();
								if (!empty($fooddy_top_icon)) {
									$fooddy_attr = fooddy_getimagesize($fooddy_top_icon);
									?><img src="<?php echo esc_url($fooddy_top_icon); ?>" alt="" <?php if (!empty($fooddy_attr[3])) fooddy_show_layout($fooddy_attr[3]);?>><?php
								}
								echo wp_kses_data($fooddy_blog_title_text);
							?></h1>
							<?php
							if (!empty($fooddy_blog_title_link) && !empty($fooddy_blog_title_link_text)) {
								?><a href="<?php echo esc_url($fooddy_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($fooddy_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'fooddy_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>