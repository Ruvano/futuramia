<?php
/**
 * Registered options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Настройки сайта',
        'menu_title' => 'Настройки сайта',
        'menu_slug' => 'global-options',
        'capability' => 'edit_posts',
        'redirect' => false
    ]);
}


// Телефон на сайте
add_filter('acf/format_value/name=contact_phone', 'convert_phone_to_link', 20, 3);
function convert_phone_to_link($value, $post_id, $field): array
{
    $phone = $value;
    $tel_link = '+' . preg_replace('/[^0-9]/', '', $value);// очистить всё кроме цифр
    $result = [$phone, $tel_link];
    return $result;
}