<?php
/**
 * Custom taxonomy
 *
 * @package bookstore_theme
 */

/**
 * Registers the `format` taxonomy,
 * for use with 'book'.
 */
function register_taxonomy_format(): void {
	register_taxonomy(
		'format',
		[ 'book' ],
		[
			'hierarchical'          => false,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => true,
			'capabilities'          => [
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			],
			'labels'                => [
				'name'                       => __( 'Format', 'bookstore-theme' ),
				'singular_name'              => _x( 'Format', 'taxonomy general name', 'bookstore-theme' ),
				'search_items'               => __( 'Search Formats', 'bookstore-theme' ),
				'popular_items'              => __( 'Popular Formats', 'bookstore-theme' ),
				'all_items'                  => __( 'All Formats', 'bookstore-theme' ),
				'parent_item'                => __( 'Parent Format', 'bookstore-theme' ),
				'parent_item_colon'          => __( 'Parent Format:', 'bookstore-theme' ),
				'edit_item'                  => __( 'Edit Format', 'bookstore-theme' ),
				'update_item'                => __( 'Update Format', 'bookstore-theme' ),
				'view_item'                  => __( 'View Format', 'bookstore-theme' ),
				'add_new_item'               => __( 'Add New Format', 'bookstore-theme' ),
				'new_item_name'              => __( 'New Format', 'bookstore-theme' ),
				'separate_items_with_commas' => __( 'Separate Formats with commas', 'bookstore-theme' ),
				'add_or_remove_items'        => __( 'Add or remove Formats', 'bookstore-theme' ),
				'choose_from_most_used'      => __( 'Choose from the most used Formats', 'bookstore-theme' ),
				'not_found'                  => __( 'No Formats found.', 'bookstore-theme' ),
				'no_terms'                   => __( 'No Formats', 'bookstore-theme' ),
				'menu_name'                  => __( 'Formats', 'bookstore-theme' ),
				'items_list_navigation'      => __( 'Formats list navigation', 'bookstore-theme' ),
				'items_list'                 => __( 'Formats list', 'bookstore-theme' ),
				'most_used'                  => _x( 'Most Used', 'format', 'bookstore-theme' ),
				'back_to_items'              => __( '&larr; Back to Formats', 'bookstore-theme' ),
			],
			'show_in_rest'          => true,
			'rest_base'             => 'format',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		]
	);
}

add_action( 'init', 'register_taxonomy_format' );

/**
 * Sets the post updated messages for the `format` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `format` taxonomy.
 */
function set_format_taxonomy_updated_messages( array $messages ): array {

	$messages['format'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Format added.', 'bookstore-theme' ),
		2 => __( 'Format deleted.', 'bookstore-theme' ),
		3 => __( 'Format updated.', 'bookstore-theme' ),
		4 => __( 'Format not added.', 'bookstore-theme' ),
		5 => __( 'Format not updated.', 'bookstore-theme' ),
		6 => __( 'Formats deleted.', 'bookstore-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'set_format_taxonomy_updated_messages' );
