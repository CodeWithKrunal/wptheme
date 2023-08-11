<?php
function Office_Posttype_init() {
	register_post_type( 'office', array(
			'labels'                => array(
			'name'                  => __( 'Offices', 'morekoren' ),
			'singular_name'         => __( 'Offices', 'morekoren' ),
			'all_items'             => __( 'All Offices', 'morekoren' ),
			'archives'              => __( 'Offices Archives', 'morekoren' ),
			'attributes'            => __( 'Offices Attributes', 'morekoren' ),
			'insert_into_item'      => __( 'Insert into Offices', 'morekoren' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Offices', 'morekoren' ),
			'filter_items_list'     => __( 'Filter Offices list', 'morekoren' ),
			'items_list_navigation' => __( 'Offices list navigation', 'morekoren' ),
			'items_list'            => __( 'Offices list', 'morekoren' ),
			'new_item'              => __( 'New Offices', 'morekoren' ),
			'add_new'               => __( 'Add New Offices', 'morekoren' ),
			'add_new_item'          => __( 'Add New Offices', 'morekoren' ),
			'edit_item'             => __( 'Edit Offices', 'morekoren' ),
			'view_item'             => __( 'View Offices', 'morekoren' ),
			'view_items'            => __( 'View Offices', 'morekoren' ),
			'search_items'          => __( 'Search Offices', 'morekoren' ),
			'not_found'             => __( 'No Offices found', 'morekoren' ),
			'not_found_in_trash'    => __( 'No Offices found in trash', 'morekoren' ),
			'parent_item_colon'     => __( 'Parent Offices Events:', 'morekoren' ),
			'menu_name'             => __( 'Offices', 'morekoren' ),
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
add_action( 'init', 'Office_Posttype_init' );