<?php
/**
 * Display layout control of product page
 * @since: ri-ione 1.0
 * @version: 1.0
 */
?>
<ul class="layout-control-block">
    <?php if(rit_woo_sidebar()!='no-sidebar'){?>
    <li class="control-item sidebar-control">
        <a href="javascript:;" class="<?php echo esc_attr(rit_woo_sidebar_status())?>" title="<?php echo esc_attr__('Show/Hide Sidebar','ri-ione');?>">
            <i class="fa fa-sliders" aria-hidden="true"></i>
        </a>
    </li>
    <?php }?>
    <li class="control-item">
        <a href="javascript:;" title="<?php echo esc_attr__('Switch to Grid Layout','ri-ione');?>" class="layout-control grid-layout <?php echo esc_attr(rit_woo_layout()=='grid'?'active':'')?>">
            <i class="clever-icon-grid"></i>
        </a>
    </li>
    <li class="control-item">
        <a href="javascript:;" title="<?php echo esc_attr__('Switch to List Layout','ri-ione');?>"  class="layout-control list-layout  <?php echo esc_attr(rit_woo_layout()=='list'?'active':'')?>">
            <i class="clever-icon-list"></i>
        </a>
    </li>
</ul>
