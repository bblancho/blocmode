<?php
/**
 *
 * id: gold-5
 * base: m-5
 * title: Gold
 *
 */

$main_plugin = CcPopUp::get_instance();
?>

<?php

$always_center_pop_up = get_post_meta( $this->lp_post_id, '_chch_pop_up_always_center_pop_up', true );

$always_center_pop_up_class = '';

if ( $always_center_pop_up == 'on' ) {
	$always_center_pop_up_class = 'modal-centered';
}
?>


<div class="cc-pu-bg m-5 gold-5"></div>
<article class="pop-up-cc m-5 gold-5 <?php echo $always_center_pop_up_class; ?> <?php echo $this-> get_template_option('size','size');?>">
	<div class="modal-inner">
<?php
  $main_plugin->get_close_button($this->lp_post_id);
?>
		<?php $content = $template_options['contents']; ?>
		<div class="cc-pu-header-section">
			 <?php echo wpautop($content['header']);?>
		</div>

		<div class="cc-pu-subheader-section">
		 <?php echo wpautop($content['subheader']);?>
		</div>

		<div class="cc-pu-content-section">
			<?php echo wpautop($content['content']);?>
		</div>


		<?php
		$main_plugin->get_newsletter_form($template_options, $this->lp_post_id, $this);
		?>
		<footer class="cc-pu-privacy-info">
			<?php if(!empty($content['privacy_link']) || is_admin()):?>
				<a href="<?php echo $content['privacy_link'];?>"><?php echo $this-> get_template_option('contents','privacy_link_label');?></a>
			<?php endif;?>
			<div class="cc-pu-privacy-section">
				<?php echo wpautop($content['privacy_message']);?>
			</div>
		</footer>
	</div>
</article>
