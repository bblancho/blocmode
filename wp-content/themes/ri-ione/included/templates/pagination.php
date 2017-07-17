<?php
/**
 * Pagination template
 * @package WordPress
 * @subpackage ri-ione
 * @since ri-ione 1.0
 */
?>
<div class="wrap-pagination">
    <?php if(get_previous_posts_link()){?>
    <div class="rit-pagination-left pull-left primary-font default-pagination"><?php
        previous_posts_link(__('<i class="fa fa-angle-double-left" aria-hidden="true"></i> NEWER POST ', 'ri-ione'));
        ?>
    </div>
    <?php } if(get_next_posts_link()){?>
    <div class="rit-pagination-right pull-right primary-font default-pagination">
        <?php
        next_posts_link(__('OLDER POST <i class="fa fa-angle-double-right" aria-hidden="true"></i>', 'ri-ione'));
        ?>
    </div>
    <?php }?>
</div>