<?php
/**
 * The style "default" of the Team
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_team');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_team_item">
	<?php
	// Featured image
	set_query_var('trx_addons_args_featured', apply_filters('trx_addons_filter_args_featured', array(
		'class' => 'sc_team_item_thumb',
		'hover' => 'zoomin',
		'thumb_size' => apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('team'))
		), 'team-default'));
	if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }
	?>
	<div class="sc_team_item_info">
		<div class="sc_team_item_header">
			<h6 class="sc_team_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h6>
		</div>
		<div class="sc_team_item_content"><?php the_excerpt(); ?></div>
		<?php
		if (!empty($meta['socials'])) {
			?><div class="sc_team_item_socials"><?php echo trim(trx_addons_get_socials_links_custom($meta['socials'])); ?></div><?php
		}
		?>
		<div class="sc_team_item_button"><a href="<?php echo esc_url($link); ?>" class="sc_button sc_button_simple"><?php esc_html_e('Learn more', 'fooddy'); ?></a></div>
	</div>
</div>
<?php
if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>