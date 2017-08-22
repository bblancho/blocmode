<div class="woo-custom-share clearfix">

<span> <?php echo esc_html__('Partagez sur : ','ri-ione-child') ; ?> </span><br/><br/>
  <ul class="social-icons">
    <li class="social facebook">
      <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="fa fa-facebook" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;" title="<?php echo esc_html__('Share to facebook','ri-ione')?>" class=""> <?php echo esc_html__('Facebook','ri-ione-child') ; ?>
        <i></i> 
      </a>
    </li>

    <li class="social twitter">
      <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" class="fa fa-twitter" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" title="<?php  echo esc_html__('Share to twitter','ri-ione')?>"> <?php echo esc_html__('Twitter','ri-ione-child') ; ?>
        <i></i>
      </a>
    </li>
    
    <li class="social pinterest">
      <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>" title="<?php  echo esc_html__('Share to pinterest','ri-ione')?>" class='fa fa-pinterest' > <?php echo esc_html__('Pinterest','ri-ione-child') ; ?>
        <i>  </i>
      </a>
    </li>
  </ul>

</div>