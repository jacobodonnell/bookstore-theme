<?php
/**
 * Custom taxonomy
 *
 * @package bookstore_theme
 */

/**
 * Registers the `language` taxonomy,
 * for use with 'book'.
 */
function register_taxonomy_language(): void {
	register_taxonomy(
		'language',
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
				'name'                       => __( 'Languages', 'bookstore-theme' ),
				'singular_name'              => _x( 'Language', 'taxonomy general name', 'bookstore-theme' ),
				'search_items'               => __( 'Search Languages', 'bookstore-theme' ),
				'popular_items'              => __( 'Popular Languages', 'bookstore-theme' ),
				'all_items'                  => __( 'All Languages', 'bookstore-theme' ),
				'parent_item'                => __( 'Parent Language', 'bookstore-theme' ),
				'parent_item_colon'          => __( 'Parent Language:', 'bookstore-theme' ),
				'edit_item'                  => __( 'Edit Language', 'bookstore-theme' ),
				'update_item'                => __( 'Update Language', 'bookstore-theme' ),
				'view_item'                  => __( 'View Language', 'bookstore-theme' ),
				'add_new_item'               => __( 'Add New Language', 'bookstore-theme' ),
				'new_item_name'              => __( 'New Language', 'bookstore-theme' ),
				'separate_items_with_commas' => __( 'Separate Languages with commas', 'bookstore-theme' ),
				'add_or_remove_items'        => __( 'Add or remove Languages', 'bookstore-theme' ),
				'choose_from_most_used'      => __( 'Choose from the most used Languages', 'bookstore-theme' ),
				'not_found'                  => __( 'No Languages found.', 'bookstore-theme' ),
				'no_terms'                   => __( 'No Languages', 'bookstore-theme' ),
				'menu_name'                  => __( 'Languages', 'bookstore-theme' ),
				'items_list_navigation'      => __( 'Languages list navigation', 'bookstore-theme' ),
				'items_list'                 => __( 'Languages list', 'bookstore-theme' ),
				'most_used'                  => _x( 'Most Used', 'language', 'bookstore-theme' ),
				'back_to_items'              => __( '&larr; Back to Languages', 'bookstore-theme' ),
			],
			'show_in_rest'          => true,
			'rest_base'             => 'language',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		]
	);
}

add_action( 'init', 'register_taxonomy_language' );

/**
 * Sets the post updated messages for the `language` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `language` taxonomy.
 */
function set_language_taxonomy_updated_messages( array $messages ): array {

	$messages['language'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Language added.', 'bookstore-theme' ),
		2 => __( 'Language deleted.', 'bookstore-theme' ),
		3 => __( 'Language updated.', 'bookstore-theme' ),
		4 => __( 'Language not added.', 'bookstore-theme' ),
		5 => __( 'Language not updated.', 'bookstore-theme' ),
		6 => __( 'Languages deleted.', 'bookstore-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'set_language_taxonomy_updated_messages' );
