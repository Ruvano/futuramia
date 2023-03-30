<?php
add_action('init', 'register_custom_post_type_attraction');
function register_custom_post_type_attraction(){
	register_post_type('attraction', [
		'labels' => [
			'name'               => 'Аттракцион',
			'singular_name'      => 'Аттракцион',
			'menu_name'          => 'Аттракционы'
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