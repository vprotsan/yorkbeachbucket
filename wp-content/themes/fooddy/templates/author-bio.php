<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage FOODDY
 * @since FOODDY 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$fooddy_mult = fooddy_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 122*$fooddy_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description"><?php
        echo esc_html__('About author', 'fooddy'). ' ';
        ?>
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('%s', 'fooddy'), '<span class="fn">'.get_the_author().'</span>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wpautop(get_the_author_meta( 'description' )); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
