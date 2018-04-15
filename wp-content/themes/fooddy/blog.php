<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$fooddy_content = '';
$fooddy_blog_archive_mask = '%%CONTENT%%';
$fooddy_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $fooddy_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($fooddy_content = apply_filters('the_content', get_the_content())) != '') {
		if (($fooddy_pos = strpos($fooddy_content, $fooddy_blog_archive_mask)) !== false) {
			$fooddy_content = preg_replace('/(\<p\>\s*)?'.$fooddy_blog_archive_mask.'(\s*\<\/p\>)/i', $fooddy_blog_archive_subst, $fooddy_content);
		} else
			$fooddy_content .= $fooddy_blog_archive_subst;
		$fooddy_content = explode($fooddy_blog_archive_mask, $fooddy_content);
	}
}

// Prepare args for a new query
$fooddy_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$fooddy_args = fooddy_query_add_posts_and_cats($fooddy_args, '', fooddy_get_theme_option('post_type'), fooddy_get_theme_option('parent_cat'));
$fooddy_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($fooddy_page_number > 1) {
	$fooddy_args['paged'] = $fooddy_page_number;
	$fooddy_args['ignore_sticky_posts'] = true;
}
$fooddy_ppp = fooddy_get_theme_option('posts_per_page');
if ((int) $fooddy_ppp != 0)
	$fooddy_args['posts_per_page'] = (int) $fooddy_ppp;
// Make a new query
query_posts( $fooddy_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($fooddy_content) && count($fooddy_content) == 2) {
	set_query_var('blog_archive_start', $fooddy_content[0]);
	set_query_var('blog_archive_end', $fooddy_content[1]);
}

get_template_part('index');
?>