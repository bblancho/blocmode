<?php
wp_enqueue_script('countdown');
$rit_time='';
if($atts['date']!=''){
    $rit_time= date("m-d-Y", strtotime($atts['date'])).'-' . $atts['hour']. '-' . $atts['sec']. '-' . $atts['min'];
}
?>
<div class="rit-countdown <?php echo esc_attr($atts['el_class']) ?>">
    <div class="countdown-block" data-countdown="countdown" data-date="<?php echo esc_attr($rit_time)?>">
    </div>
    <?php
    $rit_link = vc_build_link($atts['link']);
    if($rit_link['url']!=''){
    ?><a href="<?php echo esc_url($rit_link['url']) ?>" class="btn btn-around" title="<?php echo esc_attr($rit_link['title']) ?>" target="<?php echo esc_attr($rit_link['target']) ?>" rel="<?php echo esc_attr($rit_link['rel']) ?>">
        <?php echo esc_html($rit_link['title']) ?></a>
    <?php }
    ?>
</div>
