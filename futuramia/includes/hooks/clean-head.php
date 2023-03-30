<?php
/* --------------------------------------------------------------------------
*  Отключаем wp-json
* -------------------------------------------------------------------------- */
// Отключаем сам REST API
// add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
// remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
// remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
// remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
// remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
// remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
// remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Отключаем события REST API
// remove_action( 'init',          'rest_api_init' );
// remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
// remove_action( 'parse_request', 'rest_api_loaded' );

// Отключаем Embeds связанные с REST API
// remove_action( 'rest_api_init',             'wp_oembed_register_route'              );
// remove_filter( 'rest_pre_serve_request',    '_oembed_rest_pre_serve_request', 10, 4 );

// remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
/* --------------------------------------------------------------------------
*  Отключаем wp-json
* -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
 * Отключаем Emoji
 * -------------------------------------------------------------------------- */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

add_filter( 'emoji_svg_url', '__return_false' );
/* --------------------------------------------------------------------------
 * Отключаем Emoji
 * -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
 *  Удаляем опасные методы работы XML-RPC Pingback
 * -------------------------------------------------------------------------- */
add_filter( 'xmlrpc_methods', 'sheensay_block_xmlrpc_attacks' );
function sheensay_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}
 
add_filter( 'wp_headers', 'sheensay_remove_x_pingback_header' );
function sheensay_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}
/* --------------------------------------------------------------------------
*  Удаляем опасные методы работы XML-RPC Pingback
* -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
*  pingback, canonical, meta generator, wlwmanifest, EditURI, shortlink, prev,
*  next, RSS, feed, profile из заголовков head
* -------------------------------------------------------------------------- */
// Удаляем код meta name="generator"
remove_action( 'wp_head', 'wp_generator' );
 
// Удаляем link rel="canonical" // Этот тег лучше выводить с помощью плагина Yoast SEO или All In One SEO Pack
remove_action( 'wp_head', 'rel_canonical' );
 
// Удаляем link rel="shortlink" - короткую ссылку на текущую страницу
remove_action( 'wp_head', 'wp_shortlink_wp_head' ); 
 
// Удаляем link rel="EditURI" type="application/rsd+xml" title="RSD"
// Используется для сервиса Really Simple Discovery 
remove_action( 'wp_head', 'rsd_link' ); 
 
// Удаляем link rel="wlwmanifest" type="application/wlwmanifest+xml"
// Используется Windows Live Writer
remove_action( 'wp_head', 'wlwmanifest_link' );
 
// Удаляем различные ссылки link rel
// на главную страницу
//remove_action( 'wp_head', 'index_rel_link' ); 
// на первую запись
remove_action( 'wp_head', 'start_post_rel_link', 10 );  
// на предыдущую запись
remove_action( 'wp_head', 'parent_post_rel_link', 10 ); 
// на следующую запись
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10 );
 
// Удаляем связь с родительской записью
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); 
 
// Удаляем вывод /feed/
remove_action( 'wp_head', 'feed_links', 2 );
// Удаляем вывод /feed/ для записей, категорий, тегов и подобного
remove_action( 'wp_head', 'feed_links_extra', 3 );
 
// Удаляем ненужный css плагина WP-PageNavi
remove_action( 'wp_head', 'pagenavi_css' );

/* --------------------------------------------------------------------------
*  pingback, canonical, meta generator, wlwmanifest, EditURI, shortlink, prev,
*  next, RSS, feed, profile из заголовков head
* -------------------------------------------------------------------------- */