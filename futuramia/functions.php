<?php
// add_action('init', 'test_init');
// function test_init() {
//     ini_set('display_errors', 1); 
//     ini_set('display_startup_errors', 1);
//     error_reporting(E_ALL);
// }

/**
 * Theme setting setup
 */
if ( ! function_exists( 'futuramia_setup' ) ) :
	function futuramia_setup(): void
    {

        /** Enable title */
		add_theme_support( 'title-tag' );

		/** Enable support for Post Thumbnails on posts and pages. */
        add_theme_support( 'post-thumbnails' );

        /** Register post thumbnails */
        add_image_size('logo', 300, 9999);
        add_image_size('program-thumbnail', 500, 400, true);
        add_image_size('promotion-icon-thumbnail', 800, 200, true);
        add_image_size('activity-icon', 100, 100, true);
        add_image_size('full-width', 1500, 9999);
        add_image_size('full-width-mobile', 800, 9999);
        add_image_size('full-screen', 2000, 9999);

		/** Register menu */
		register_nav_menus([
            'header' => __( 'Меню в шапке', 'futuramia' ),
            'footer' => __( 'Меню в футере', 'futuramia' ),
            'social' => __( 'Меню социальных ссылок', 'futuramia' ),
        ]);

        /** HTML5 Support */
		add_theme_support(
			'html5',
			[
				'search-form',
				'gallery',
				'caption',
            ]
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'futuramia_setup' );


/**
 * Remove post thumbnails
 */
function delete_intermediate_image_sizes( $sizes ): array {
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
    ]);
}
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );


/**
 * Register styles and scripts
 */
if ( ! function_exists('futuramia_enqueue_scripts')) :
    function futuramia_enqueue_scripts() : void {
        if (is_admin()) return;

        /** Register fonts */
        wp_enqueue_style('roboto-slab', 'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap&subset=cyrillic', false, false, 'all');
        wp_enqueue_style('rotonda', get_template_directory_uri() . '/assets/fonts/rotonda.css', false, false, 'all');

        /** Register styles */
        wp_enqueue_style('bootstrap-reboot', get_template_directory_uri() . '/assets/css/vendor/bootstrap-reboot.min.css', false, false, 'all');
        wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . '/assets/css/vendor/bootstrap-grid.min.css', false, false, 'all');
        wp_enqueue_style('jquery-ui--slider', get_template_directory_uri() . '/assets/css/vendor/jquery-ui--slider.min.css', false, false, 'all');
        wp_enqueue_style('selectize', get_template_directory_uri() . '/assets/css/vendor/selectize.default.css', false, false, 'all');
        wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/css/vendor/owl.carousel.min.css', false, false, 'all');
        wp_enqueue_style('owl.theme.default', get_template_directory_uri() . '/assets/css/vendor/owl.theme.default.css', false, false, 'all');
        wp_enqueue_style('hamburgers', get_template_directory_uri() . '/assets/css/vendor/hamburgers.min.css', false, false, 'all');
		wp_enqueue_style('datepicker', get_template_directory_uri() . '/assets/css/vendor/datepicker.min.css', false, false, 'all');
        wp_enqueue_style('table', get_template_directory_uri() . '/assets/css/vendor/table.css',false, time(), 'all');
        wp_enqueue_style('micromodal', get_template_directory_uri() . '/assets/css/vendor/micromodal.css',false, time(), 'all');
        wp_enqueue_style('fancybox', get_template_directory_uri() . '/assets/css/vendor/jquery.fancybox.min.css',false, time(), 'all');
        wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom.css', false, time(), 'all');

        wp_enqueue_style('additives', get_template_directory_uri() . '/assets/css/additives.css', false, time(), 'all'); // стиль для "добавки"
        

        /** Register vendor scripts & jquery */
        wp_deregister_script('jquery');
		// wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.3.1.min.js', false, null, true);
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, null, false);
        wp_enqueue_script('jquery');

        wp_enqueue_script('jquery-ui--slider', get_template_directory_uri() . '/assets/js/vendor/jquery-ui--slider.min.js', false, null, true);
        wp_enqueue_script('selectize', get_template_directory_uri() . '/assets/js/vendor/selectize.min.js', false, null, true);
        wp_enqueue_script('smooth-scroll', get_template_directory_uri() . '/assets/js/vendor/smooth-scroll.polyfills.min.js', false, null, true);
        wp_enqueue_script('matchHeight', get_template_directory_uri() . '/assets/js/vendor/jquery.matchHeight.min.js', false, null, true);
        wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/assets/js/vendor/owl.carousel.min.js', false, null, true);
        wp_enqueue_script('datepicker', get_template_directory_uri() . '/assets/js/vendor/datepicker.min.js', false, null, true);
        wp_enqueue_script('jquery.mask', get_template_directory_uri() . '/assets/js/vendor/jquery.mask.min.js', false, null, true);
        wp_enqueue_script('typed', get_template_directory_uri() . '/assets/js/vendor/typed.min.js', false, null, true);
        wp_enqueue_script('micromodal', get_template_directory_uri() . '/assets/js/vendor/micromodal.min.js', false, null, true);
        wp_enqueue_script('jquery.fancybox', get_template_directory_uri() . '/assets/js/vendor/jquery.fancybox.min.js', false, null, true);
        wp_enqueue_script('readmore', get_template_directory_uri() . '/assets/js/vendor/readmore.js', false, null, true);
        //wp_enqueue_script('yandex-maps', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=4e537bff-e17b-4dc1-ad7d-fc13c99b76d6', false, null, true);
        wp_enqueue_script('vimeo-player', 'https://player.vimeo.com/api/player.js', false, null, true);

        // Кнопка обратного звонка 1/3
        wp_enqueue_script('fontawesome-js', get_template_directory_uri() . '/assets/js/kit.fontawesome.com.js', false, null, true);

        /** Ajax and register custom.js */
        global $wp_query;
        wp_register_script('custom', get_template_directory_uri() . '/assets/js/custom.js?ver='.time(), ['jquery']);
        wp_localize_script('custom', 'ajax', [
            'url' => site_url() . '/wp-admin/admin-ajax.php',
            'posts' => json_encode($wp_query->query_vars),
            'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages
        ]);
        wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', false, null, true);
        
        //wp_enqueue_script('test', get_template_directory_uri() . '/assets/js/test.js?ver='.time(), false, null, true);
    }

endif;
add_action('wp_enqueue_scripts', 'futuramia_enqueue_scripts');

/**
 * Добавим скриптам defer
 */
if (!function_exists('defer_parsing_of_js')) :
function defer_parsing_of_js($url)
{
    return (
        strpos($url, '.js')
        && !is_admin()
        && !strpos($url, 'akismet-frontend.js')
        && !strpos($url, 'fontawesome.com.js')
        && !strpos($url, 'jquery.js')
    ) ? str_replace(' src', ' defer=\'defer\' src', $url) : $url;

} add_filter('script_loader_tag', 'defer_parsing_of_js', 10);
endif;

/**
 * Remove Revisions
 */
function futuramia_revisions_to_keep($revisions): int
{
    return 3;
}
add_filter('wp_revisions_to_keep', 'futuramia_revisions_to_keep');

/**
 * Init global site options
 */
if (function_exists('get_fields'))
add_action('init', 'init_global_options_acf');
function init_global_options_acf(): void
{
    global $globalOptions;
    $globalOptions = get_fields( 'option' );
}

/**
 * Custom menu
 */
function customGetMenuArray($location): array
{
    $menu = [];
    $menuLocations = get_nav_menu_locations();
    $array_menus = wp_get_nav_menu_items($menuLocations[$location]);
    if (!empty($array_menus)) :
        foreach ($array_menus as $array_menu) :
            if (empty($array_menu->menu_item_parent)) :
                $curent_id = $array_menu->ID;
                $menu[$curent_id] = [
                    'id'        => $curent_id,
                    'title'     => $array_menu->title,
                    'href'      => $array_menu->url,
                    'children'  => []
                ];
            endif;
            if (isset($curent_id) && $curent_id == $array_menu->menu_item_parent) :
                $submenu_id = $array_menu->ID;
                $menu[$curent_id]['children'][$array_menu->ID] = [
                    'id'        => $submenu_id,
                    'title'     => $array_menu->title,
                    'href'      => $array_menu->url,
                    'children'  => []
                ];
            endif;
        endforeach;
    endif;

    return $menu;
}

/**
 * Instagram
 */
//function getLastPostsFromInstagram($clientName, $count): bool|array
//{
//    $url = "https://www.instagram.com/" . $clientName;
//    $html = file_get_contents($url);
//    $array = explode('window._sharedData = ', $html);
//    $array = explode(';</script>',$array[1]);
//
//    /** Object */
//    $obj = json_decode($array[0], true);
//    if (empty($obj)) {
//        return false;
//    }
//    /** User */
//    $user = !empty($obj['entry_data']['ProfilePage'][0]['graphql']['user']) ? $obj['entry_data']['ProfilePage'][0]['graphql']['user'] : [];
//    if (empty($user)) {
//        return false;
//    }
//    /** Nodes */
//    $nodes = !empty($user["edge_owner_to_timeline_media"]["edges"]) ? $user["edge_owner_to_timeline_media"]["edges"] : [] ;
//    if (empty($nodes)) {
//        return false;
//    }
//    /** Generate result array */
//    $filteredNodes = [];
//    foreach($nodes as $item) :
//        $node = $item["node"];
//        $filteredNodes[] = [
//            "__typename" => $node["__typename"],
//            "id" => $node["id"],
//            "code" => $node["shortcode"],
//            "display_url" => $node["display_url"],
//            "thumbnail_src" => $node["thumbnail_resources"][3]["src"],
//            "is_video" => $node["is_video"]
//        ];
//    endforeach;
//    /** Return array images */
//    $count = ($count > 10) ? 10 : $count;
//    $output = array_slice($filteredNodes, 0, $count, true);
//    return $output;
//}

/**
 * Register Custom Post Types
 */
require_once __DIR__ . '/includes/post-types/program.php';
require_once __DIR__ . '/includes/post-types/attraction.php';
// require_once __DIR__ . '/includes/post-types/activity.php';
require_once __DIR__ . '/includes/post-types/review.php';
require_once __DIR__ . '/includes/post-types/park.php';
require_once __DIR__ . '/includes/post-types/page-options-acf.php';
require_once __DIR__ . '/includes/post-types/additive.php';
/** Hooks */
require_once __DIR__ . '/includes/hooks/clean-head.php';
require_once __DIR__ . '/includes/hooks/clean-admin.php';
require_once __DIR__ . '/includes/hooks/fix-toolbar.php';
require_once __DIR__ . '/includes/hooks/element-ajax.php';

/** Calculator API */
// add_action('init', 'init_calculator_api');
// function init_calculator_api() {
//     require_once __DIR__ . '/includes/api/calculator.php';
// }



/** Relation SELECT PARKS */
// function acf_load_park_relation_field_choices( $field ) {
//     // reset choices
//     $field['choices'] = array();

//     $parks = get_field('parks', 'option' );
//     if( !empty($parks) ) :
//         foreach($parks as $key => $item) :
//             $label = $item['name'];
//             $value = $item['id'];
//             if (isset($label) && $label != '' && isset($value) && $value != '') {
//                 $field['choices'][ $value ] = $label;
//             }
//         endforeach;
//     endif;

//     return $field;
// }
// add_filter('acf/load_field/name=park_relation', 'acf_load_park_relation_field_choices');