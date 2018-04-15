<?php
$args = get_query_var('trx_addons_args_search');
?>
<div class="search_wrap search_style_<?php echo esc_attr($args['style']);
		if (!empty($args['ajax'])) echo ' search_ajax';
		if (!empty($args['class'])) echo ' '.esc_attr($args['class']);
        if ($args['style'] == 'address') {
            $placeholder = esc_html__('Enter Your Address', 'fooddy');
        } else {
            $placeholder = esc_html__('Search', 'fooddy');
        }
	?>">
	<div class="search_form_wrap">
		<form role="search" method="get" class="search_form" action="<?php echo esc_url(home_url('/')); ?>">
			<input type="text" class="search_field" placeholder="<?php echo wp_kses_data($placeholder); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
            <?php  if ($args['style'] == 'address') {?>
			    <button type="submit"><?php esc_html_e('Find a restaurant', 'fooddy'); ?></button>
            <?php } else {?>
                <button type="submit" class="search_submit trx_addons_icon-search"></button>
            <?php }?>
			<?php if ($args['style'] == 'fullscreen') { ?>
				<a class="search_close trx_addons_icon-delete"></a>
			<?php } ?>
		</form>
	</div>
	<?php
	if (!empty($args['ajax'])) {
		?><div class="search_results widget_area"><a href="#" class="search_results_close trx_addons_icon-cancel"></a><div class="search_results_content"></div></div><?php
	}
	?>
</div>