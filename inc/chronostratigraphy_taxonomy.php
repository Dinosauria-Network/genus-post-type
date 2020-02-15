<?php

// Register Custom Taxonomy
function geological_time() {

	$labels = array(
		'name'                       => _x( 'Strata', 'Taxonomy General Name', 'genus' ),
		'singular_name'              => _x( 'Stratum', 'Taxonomy Singular Name', 'genus' ),
		'menu_name'                  => __( 'Geological Time', 'genus' ),
		'all_items'                  => __( 'All Strata', 'genus' ),
		'parent_item'                => __( 'Parent Stratum', 'genus' ),
		'parent_item_colon'          => __( 'Parent Stratum:', 'genus' ),
		'new_item_name'              => __( 'New Stratum Name', 'genus' ),
		'add_new_item'               => __( 'Add New Stratum', 'genus' ),
		'edit_item'                  => __( 'Edit Stratum', 'genus' ),
		'update_item'                => __( 'Update Stratum', 'genus' ),
		'view_item'                  => __( 'View Stratum', 'genus' ),
		'separate_items_with_commas' => __( 'Separate strata with commas', 'genus' ),
		'add_or_remove_items'        => __( 'Add or remove strata', 'genus' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'genus' ),
		'popular_items'              => __( 'Popular Strata', 'genus' ),
		'search_items'               => __( 'Search Strata', 'genus' ),
		'not_found'                  => __( 'Not Found', 'genus' ),
		'no_terms'                   => __( 'No strata', 'genus' ),
		'items_list'                 => __( 'Strata list', 'genus' ),
		'items_list_navigation'      => __( 'Strata list navigation', 'genus' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'geological_time', array( 'genus' ), $args );

}
add_action( 'init', 'geological_time', 0 );
