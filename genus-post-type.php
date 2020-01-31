<?php
/*
  Plugin Name: Genus Post type
  Plugin URI: https://dinosauria.net/
  Description: Declares a plugin that will create a custom post type displaying genera.
  Version: 1.0
  Author: Alexander Bell
  Author URI: https://alexanderbell.info/
  License: GPLv2
*/

function create_genus() {

  $labels = array(
    'name'                => _x( 'Genera', 'Post Type General Name', 'fossils' ),
    'singular_name'       => _x( 'Genus', 'Post Type Singular Name', 'fossils' ),
    'menu_name'           => __( 'Genera', 'fossils' ),
    'name_admin_bar'      => __( 'Genera', 'fossils' ),
    'parent_item_colon'   => __( 'Parent Genus:', 'fossils' ),
    'all_items'           => __( 'All Genera', 'fossils' ),
    'add_new_item'        => __( 'Add New Genus', 'fossils' ),
    'add_new'             => __( 'Add New', 'fossils' ),
    'new_item'            => __( 'New Genus', 'fossils' ),
    'edit_item'           => __( 'Edit Genus', 'fossils' ),
    'update_item'         => __( 'Update Genus', 'fossils' ),
    'view_item'           => __( 'View Genus', 'fossils' ),
    'search_items'        => __( 'Search Genera', 'fossils' ),
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
        'name'           => 'Annotation',
        'add_new_item'   => 'Add New Annotation',
        'new_item_name'  => 'New Name Annotation'
      ),
      'show_ui' => true,
      'show_tagcloud' => true,
      'hierarchical'  => false
    )
  );
}

/**
 * Generated by the WordPress Meta Box Generator at http://goo.gl/8nwllb
 */
class Genus_Authority_Meta_Box {
	private $screens = array(
		'Genus',
	);
	private $fields = array(
		array(
			'id' => '_author',
			'label' => 'Genus Author',
			'type' => 'text',
		),
		array(
			'id' => '_date',
			'label' => 'Genus Date',
			'type' => 'date',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'genus-authority',
				__( 'Genus Authority', 'fossils' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'side',
				'default'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'genus_authority_data', 'genus_authority_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'genus_authority_' . $field['id'], true );
			switch ( $field['type'] ) {
				default:
					$input = sprintf(
						'<input id="%s" name="%s" type="%s" value="%s">',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= '<p>' . $label . '<br>' . $input . '</p>';
		}
		echo $output;
	}

	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['genus_authority_nonce'] ) )
			return $post_id;

		$nonce = $_POST['genus_authority_nonce'];
		if ( !wp_verify_nonce( $nonce, 'genus_authority_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'genus_authority_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'genus_authority_' . $field['id'], '0' );
			}
		}
	}
}
new Genus_Authority_Meta_Box;

?>
