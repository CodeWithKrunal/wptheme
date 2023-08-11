<?php
function Jobs_Posttype_init() {
	register_post_type( 'morekoren_jobs', array(
			'labels'                => array(
			'name'                  => __( 'Jobs', 'morekoren' ),
			'singular_name'         => __( 'Jobs', 'morekoren' ),
			'all_items'             => __( 'All Jobs', 'morekoren' ),
			'archives'              => __( 'Jobs Archives', 'morekoren' ),
			'attributes'            => __( 'Jobs Attributes', 'morekoren' ),
			'insert_into_item'      => __( 'Insert into Jobs', 'morekoren' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Jobs', 'morekoren' ),
			'filter_items_list'     => __( 'Filter Jobs list', 'morekoren' ),
			'items_list_navigation' => __( 'Jobs list navigation', 'morekoren' ),
			'items_list'            => __( 'Jobs list', 'morekoren' ),
			'new_item'              => __( 'New Jobs', 'morekoren' ),
			'add_new'               => __( 'Add New Jobs', 'morekoren' ),
			'add_new_item'          => __( 'Add New Jobs', 'morekoren' ),
			'edit_item'             => __( 'Edit Jobs', 'morekoren' ),
			'view_item'             => __( 'View Jobs', 'morekoren' ),
			'view_items'            => __( 'View Jobs', 'morekoren' ),
			'search_items'          => __( 'Search Jobs', 'morekoren' ),
			'not_found'             => __( 'No Jobs found', 'morekoren' ),
			'not_found_in_trash'    => __( 'No Jobs found in trash', 'morekoren' ),
			'parent_item_colon'     => __( 'Parent Jobs Events:', 'morekoren' ),
			'menu_name'             => __( 'Jobs', 'morekoren' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => 5,
		'exclude_from_search'   => true,
		'menu_icon'             => "dashicons-groups",
		'show_in_rest'          => false,
	) );

}
add_action( 'init', 'Jobs_Posttype_init' );