<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );


	// Related posts.
	fooddy_show_related_posts(array('orderby' => 'rand',
									'posts_per_page' => max(2, min(4, fooddy_get_theme_option('related_posts')))
									),
								fooddy_get_theme_option('related_style')
								);

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>