<?php
function widget_vk_ajax_handler(){
    get_template_part( 'template-parts/ajax/vk-widget' );
    die;
}
add_action('wp_ajax_widget_vk', 'widget_vk_ajax_handler');
add_action('wp_ajax_nopriv_widget_vk', 'widget_vk_ajax_handler');