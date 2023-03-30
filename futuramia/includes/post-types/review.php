<?php
add_action('init', 'register_custom_post_type_review');
function register_custom_post_type_review(){
	register_post_type('review', [
		'labels' => [
			'name'               => 'Отзыв',
			'singular_name'      => 'Отзыв',
			'menu_name'          => 'Отзывы'
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