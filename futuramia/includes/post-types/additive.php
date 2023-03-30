<?php
add_action('init', 'register_custom_post_type_additive');
function register_custom_post_type_additive(){
	register_post_type('additive', [
		'labels' => [
			'name'               => 'Добавка',
			'singular_name'      => 'Добавка',
			'menu_name'          => 'Добавки'
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