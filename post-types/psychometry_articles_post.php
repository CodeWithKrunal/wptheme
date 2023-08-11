<?php
function psycho_Articles_Posttype_init() {
	register_post_type( 'psychometry-articles', array(
			'labels'                => array(
			'name'                  => __( 'Psychometry Articles', 'morekoren' ),
			'singular_name'         => __( 'Psychometry Articles', 'morekoren' ),
			'all_items'             => __( 'All Psychometry Articles', 'morekoren' ),
			'archives'              => __( 'Psychometry Articles Archives', 'morekoren' ),
			'attributes'            => __( 'Psychometry Articles Attributes', 'morekoren' ),
			'insert_into_item'      => __( 'Insert into Psychometry Articles', 'morekoren' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Psychometry Articles', 'morekoren' ),
			'filter_items_list'     => __( 'Filter Psychometry Articles list', 'morekoren' ),
			'items_list_navigation' => __( 'Psychometry Articles list navigation', 'morekoren' ),
			'items_list'            => __( 'Psychometry Articles list', 'morekoren' ),
			'new_item'              => __( 'New Psychometry Articles', 'morekoren' ),
			'add_new'               => __( 'Add New Psychometry Articles', 'morekoren' ),
			'add_new_item'          => __( 'Add New Psychometry Articles', 'morekoren' ),
			'edit_item'             => __( 'Edit Psychometry Articles', 'morekoren' ),
			'view_item'             => __( 'View Psychometry Articles', 'morekoren' ),
			'view_items'            => __( 'View Psychometry Articles', 'morekoren' ),
			'search_items'          => __( 'Search Psychometry Articles', 'morekoren' ),
			'not_found'             => __( 'No Psychometry Articles found', 'morekoren' ),
			'not_found_in_trash'    => __( 'No Psychometry Articles found in trash', 'morekoren' ),
			'parent_item_colon'     => __( 'Parent Psychometry Articles Events:', 'morekoren' ),
			'menu_name'             => __( 'Psychometry Articles', 'morekoren' ),
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
add_action( 'init', 'psycho_Articles_Posttype_init' );