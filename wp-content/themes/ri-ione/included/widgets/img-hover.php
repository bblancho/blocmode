<?php
/**
 * Plugin Name: Image hover sidebar
 */

add_action('widgets_init', 'rit_imghover');

function rit_imghover()
{
    register_widget('rit_imghover_widget');
}

// add admin scripts

if(function_exists('rit_js_enqueue')) {
    function rit_js_enqueue()
    {
        wp_enqueue_media();
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        // moved the js to an external file, you may want to change the path
        // wp_enqueue_script('imghover_js',get_stylesheet_directory_uri(). '/included/widgets/js/widget.js', null, null, true);

    }
    add_action('admin_enqueue_scripts', 'js_enqueue');
}
class rit_imghover_widget extends WP_Widget
{

    /**
     * Widget setup.
     */
    public function __construct()
    {
        /* Widget settings. */
        $widget_ops = array('classname' => 'imghover_widget', 'description' => esc_html__('Easy add image for sidebar.', 'ri-ione'));

        /* Widget control settings. */
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'imghover_widget');

        /* Create the widget. */
        parent::__construct('imghover_widget', esc_html__('RIT: Image Sidebar', 'ri-ione'), $widget_ops, $control_ops);
    }

    /**
     * How to display the widget on the screen.
     */
    function widget($args, $instance)
    {
        extract($args);

        /* Our variables from the widget settings. */
        $title = apply_filters('widget_title', $instance['title']);
        $image = $instance['image'];
        $caption = $instance['caption'] != '' ? '<p>' . esc_html($instance['caption']) . '</p>' : '';
        $link = $instance['link'];
        $text_link = $instance['text_link'] != '' ? '<span>' . esc_html($instance['text_link']) . '</span>' : '';
        $target = $instance['target'] == 'yes' ? 'target="_blank"' : '';
        $img_align = $instance['img_align'];
        $class = $instance['class'];
        echo ent2ncr($args['before_widget']);
        if ($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>
        <div class="rit-image-hover <?php echo esc_attr($class); ?>"
             style="text-align:<?php echo esc_attr($img_align) ?>">
            <?php if ($image != '') {
                ?>
                <a href="<?php echo esc_url($link); ?>"
                    <?php echo esc_attr($target); echo esc_attr($instance['caption'] != '' ? 'title="' . esc_html($instance['caption']) . '"' : ''); ?>>
                    <img src="<?php echo esc_url($image)?>" alt="<?php echo esc_html($instance['caption'])?>"/>
                    <?php echo esc_html($text_link); ?>
                </a>
                <?php echo esc_html($caption); ?>
                <?php } ?>

        </div>
        <?php

        /* After widget (defined by themes). */
        echo ent2ncr($args['after_widget']);
    }

    /**
     * Update the widget settings.
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['caption'] = strip_tags($new_instance['caption']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['text_link'] = strip_tags($new_instance['text_link']);
        $instance['target'] = strip_tags($new_instance['target']);
        $instance['img_align'] = strip_tags($new_instance['img_align']);
        $instance['class'] = strip_tags($new_instance['class']);
        return $instance;
    }
    function form($instance)
    {

        /* Set up some default widget settings. */
        $defaults = array('title' => esc_html__('', 'ri-ione'),
            'image' => '',
            'caption' => '',
            'link' => '#',
            'text_link' => '',
            'target' => 'no',
            'img_align' => 'center',
            'class' => ''
        );
        $instance = wp_parse_args((array)$instance, $defaults);
        ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'ri-ione'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
        </p>

        <p id="<?php echo esc_attr($this->get_field_id('image').'-wrapp'); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image:', 'ri-ione'); ?></label>
            <img id="<?php echo esc_attr($this->get_field_id('image').'-img'); ?>" src="<?php echo esc_url($instance['image'])?>"
                 style="max-width:100%"
                 class="custom_media_image <?php echo($instance['image']==''?  esc_attr('hidden'):''); ?>"/>
            <input type="text" class="widefat custom_media_url hidden" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
            <br>
            <input type="button" class="button button-primary custom_media_button" id="<?php echo esc_attr($this->get_field_id('image').'-button'); ?>" value="<?php esc_attr_e('Select Image','ri-ione')?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('caption')); ?>"><?php esc_html_e('Caption:', 'ri-ione'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('caption')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('caption')); ?>" value="<?php echo esc_attr($instance['caption']); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link:', 'ri-ione'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link')); ?>" value="<?php echo esc_attr($instance['link']); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('text_link')); ?>"><?php esc_html_e('Text Link:', 'ri-ione'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('text_link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('text_link')); ?>"
                   value="<?php echo esc_attr($instance['text_link']); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php esc_html_e('Open in new tabs:', 'ri-ione'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('target')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('target')); ?>" class="widefat"
                    style="width:100%;">
                <option
                    value='yes' <?php if ('yes' == $instance['target']) echo 'selected="selected"'; ?>><?php esc_html_e('Yes', 'ri-ione'); ?>
                </option>
                <option
                    value='no' <?php if ('no' == $instance['target']) echo 'selected="selected"'; ?>><?php esc_html_e('No', 'ri-ione'); ?>
            </select>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('img_align')); ?>"><?php esc_html_e('Image align:', 'ri-ione'); ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('img_align')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('img_align')); ?>" class="widefat"
                    style="width:100%;">
                <option
                    value='center' <?php if ('center' == $instance['img_align']) echo 'selected="selected"'; ?>><?php esc_html_e('Center', 'ri-ione'); ?>
                </option>
                <option
                    value='left' <?php if ('left' == $instance['img_align']) echo 'selected="selected"'; ?>><?php esc_html_e('Left', 'ri-ione'); ?>
                <option
                    value='right' <?php if ('right' == $instance['img_align']) echo 'selected="selected"'; ?>><?php esc_html_e('Right', 'ri-ione'); ?>
            </select>
        </p>
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('class')); ?>"><?php esc_html_e('Class:', 'ri-ione'); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('class')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('class')); ?>"
                   value="<?php echo esc_attr($instance['class']); ?>"/>
        </p>
        <?php
    }
}

?>