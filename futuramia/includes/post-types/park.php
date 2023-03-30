<?php
add_action('init', 'register_custom_post_type_park');
function register_custom_post_type_park(){
	register_post_type('park', [
		'labels' => [
			'name'               => 'Парк',
			'singular_name'      => 'Парк',
			'menu_name'          => 'Парки'
        ],
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => ['title']
        ]
    );
}