<?php
function Course_Posttype_init() {
	register_post_type( 'courses', array(
			'labels'                => array(
			'name'                  => __( 'Courses', 'morekoren' ),
			'singular_name'         => __( 'Courses', 'morekoren' ),
			'all_items'             => __( 'All Courses', 'morekoren' ),
			'archives'              => __( 'Courses Archives', 'morekoren' ),
			'attributes'            => __( 'Courses Attributes', 'morekoren' ),
			'insert_into_item'      => __( 'Insert into Courses', 'morekoren' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Courses', 'morekoren' ),
			'filter_items_list'     => __( 'Filter Courses list', 'morekoren' ),
			'items_list_navigation' => __( 'Courses list navigation', 'morekoren' ),
			'items_list'            => __( 'Courses list', 'morekoren' ),
			'new_item'              => __( 'New Courses', 'morekoren' ),
			'add_new'               => __( 'Add New Courses', 'morekoren' ),
			'add_new_item'          => __( 'Add New Courses', 'morekoren' ),
			'edit_item'             => __( 'Edit Courses', 'morekoren' ),
			'view_item'             => __( 'View Courses', 'morekoren' ),
			'view_items'            => __( 'View Courses', 'morekoren' ),
			'search_items'          => __( 'Search Courses', 'morekoren' ),
			'not_found'             => __( 'No Courses found', 'morekoren' ),
			'not_found_in_trash'    => __( 'No Courses found in trash', 'morekoren' ),
			'parent_item_colon'     => __( 'Parent Courses Events:', 'morekoren' ),
			'menu_name'             => __( 'Courses', 'morekoren' ),
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
add_action( 'init', 'Course_Posttype_init' );