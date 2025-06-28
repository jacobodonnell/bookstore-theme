<?php
/**
 * Custom taxonomy
 *
 * @package bookstore_theme
 */

/**
 * Registers the `publisher` taxonomy,
 * for use with 'book'.
 */
function register_taxonomy_publisher(): void {
	register_taxonomy(
		'publisher',
		array( 'book' ),
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
				'name'                       => __( 'Publishers', 'bookstore-theme' ),
				'singular_name'              => _x( 'Publisher', 'taxonomy general name', 'bookstore-theme' ),
				'search_items'               => __( 'Search Publishers', 'bookstore-theme' ),
				'popular_items'              => __( 'Popular Publishers', 'bookstore-theme' ),
				'all_items'                  => __( 'All Publishers', 'bookstore-theme' ),
				'parent_item'                => __( 'Parent Publisher', 'bookstore-theme' ),
				'parent_item_colon'          => __( 'Parent Publisher:', 'bookstore-theme' ),
				'edit_item'                  => __( 'Edit Publisher', 'bookstore-theme' ),
				'update_item'                => __( 'Update Publisher', 'bookstore-theme' ),
				'view_item'                  => __( 'View Publisher', 'bookstore-theme' ),
				'add_new_item'               => __( 'Add New Publisher', 'bookstore-theme' ),
				'new_item_name'              => __( 'New Publisher', 'bookstore-theme' ),
				'separate_items_with_commas' => __( 'Separate Publishers with commas', 'bookstore-theme' ),
				'add_or_remove_items'        => __( 'Add or remove Publishers', 'bookstore-theme' ),
				'choose_from_most_used'      => __( 'Choose from the most used Publishers', 'bookstore-theme' ),
				'not_found'                  => __( 'No Publishers found.', 'bookstore-theme' ),
				'no_terms'                   => __( 'No Publishers', 'bookstore-theme' ),
				'menu_name'                  => __( 'Publishers', 'bookstore-theme' ),
				'items_list_navigation'      => __( 'Publishers list navigation', 'bookstore-theme' ),
				'items_list'                 => __( 'Publishers list', 'bookstore-theme' ),
				'most_used'                  => _x( 'Most Used', 'publisher', 'bookstore-theme' ),
				'back_to_items'              => __( '&larr; Back to Publishers', 'bookstore-theme' ),
			],
			'show_in_rest'          => true,
			'rest_base'             => 'publisher',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		]
	);
}

add_action( 'init', 'register_taxonomy_publisher' );

/**
 * Sets the post updated messages for the `publisher` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `publisher` taxonomy.
 */
function set_publisher_taxonomy_updated_messages( array $messages ): array {

	$messages['publisher'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Publisher added.', 'bookstore-theme' ),
		2 => __( 'Publisher deleted.', 'bookstore-theme' ),
		3 => __( 'Publisher updated.', 'bookstore-theme' ),
		4 => __( 'Publisher not added.', 'bookstore-theme' ),
		5 => __( 'Publisher not updated.', 'bookstore-theme' ),
		6 => __( 'Publishers deleted.', 'bookstore-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'set_publisher_taxonomy_updated_messages' );
