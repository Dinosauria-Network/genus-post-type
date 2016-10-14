<?php
/*
Plugin Name: Genus Post Type
Plugin URI: http://dinosauria.net/
Description: Declares a plugin that will create a custom post type displaying genera.
Version: 1.0
Author: Alexander Bell
Author URI: http://alexanderbell.info/
License: GPLv2
*/


function create_genus() {

	$labels = array(
		'name'                => _x( 'Genera', 'Post Type General Name', 'fossils' ),
		'singular_name'       => _x( 'Genus', 'Post Type Singular Name', 'fossils' ),
		'menu_name'           => __( 'Genera', 'fossils' ),
		'name_admin_bar'      => __( 'Genera', 'fossils' ),
		'parent_item_colon'   => __( 'Parent Item:', 'fossils' ),
		'all_items'           => __( 'All Genera', 'fossils' ),
		'add_new_item'        => __( 'Add New Genus', 'fossils' ),
		'add_new'             => __( 'Add New', 'fossils' ),
		'new_item'            => __( 'New Genus', 'fossils' ),
		'edit_item'           => __( 'Edit Genus', 'fossils' ),
		'update_item'         => __( 'Update Genus', 'fossils' ),
		'view_item'           => __( 'View Genus', 'fossils' ),
		'search_items'        => __( 'Search Genus', 'fossils' ),
		'not_found'           => __( 'Not found', 'fossils' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'fossils' ),
	);
	$args = array(
		'label'               => __( 'Genus', 'fossils' ),
		'description'         => __( 'Declares a plugin that will create a custom post type displaying genera.', 'fossils' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'page-attributes', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-networking',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'genus', $args );

}
add_action( 'init', 'create_genus', 0 );

function create_my_taxonomies() {
    register_taxonomy(
        'genus_annotation',
        'genus',
        array(
            'labels' => array(
                'name' => 'Annotation',
                'add_new_item' => 'Add New Annotation',
                'new_item_name' => "New Name Annotation"
            ),
            'show_ui' => true,
            'show_tagcloud' => true,
            'hierarchical' => false
        )
    );
}

?>
