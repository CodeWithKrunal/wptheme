<?php
function online_Course_Posttype_init() {
	register_post_type( 'online-courses', array(
			'labels'                => array(
			'name'                  => __( 'Online Courses', 'morekoren' ),
			'singular_name'         => __( 'Online Courses', 'morekoren' ),
			'all_items'             => __( 'All Online Courses', 'morekoren' ),
			'archives'              => __( 'Online Courses Archives', 'morekoren' ),
			'attributes'            => __( 'Online Courses Attributes', 'morekoren' ),
			'insert_into_item'      => __( 'Insert into Online Courses', 'morekoren' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Online Courses', 'morekoren' ),
			'filter_items_list'     => __( 'Filter Online Courses list', 'morekoren' ),
			'items_list_navigation' => __( 'Online Courses list navigation', 'morekoren' ),
			'items_list'            => __( 'Online Courses list', 'morekoren' ),
			'new_item'              => __( 'New Online Courses', 'morekoren' ),
			'add_new'               => __( 'Add New Online Courses', 'morekoren' ),
			'add_new_item'          => __( 'Add New Online Courses', 'morekoren' ),
			'edit_item'             => __( 'Edit Online Courses', 'morekoren' ),
			'view_item'             => __( 'View Online Courses', 'morekoren' ),
			'view_items'            => __( 'View Online Courses', 'morekoren' ),
			'search_items'          => __( 'Search Online Courses', 'morekoren' ),
			'not_found'             => __( 'No Online Courses found', 'morekoren' ),
			'not_found_in_trash'    => __( 'No Online Courses found in trash', 'morekoren' ),
			'parent_item_colon'     => __( 'Parent Online Courses Events:', 'morekoren' ),
			'menu_name'             => __( 'Online Courses', 'morekoren' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => 5,
		'exclude_from_search'   => true,
		'menu_icon'             => "dashicons-groups",
		'show_in_rest'          => false,
	) );

}
add_action( 'init', 'online_Course_Posttype_init' );