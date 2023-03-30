<?php
add_action('init', 'register_custom_post_type_activity');
function register_custom_post_type_activity(){
	register_post_type('activity', [
		'labels' => [
			'name'               => 'Активность',
			'singular_name'      => 'Активность',
			'menu_name'          => 'Активности'
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