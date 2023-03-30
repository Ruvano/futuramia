<?php
add_action('init', 'register_custom_post_type_program');
function register_custom_post_type_program(){
	register_post_type('program', [
		'labels' => [
			'name'               => 'Программа праздника',
			'singular_name'      => 'Программа праздника',
			'menu_name'          => 'Программы'
        ],
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => ['title','editor','thumbnail']
        ]
    );
}