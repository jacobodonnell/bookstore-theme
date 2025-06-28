<?php
/**
 * Custom taxonomy
 *
 * @package bookstore_theme
 */

/**
 * Registers the `author` taxonomy,
 * for use with 'book'.
 */
function register_taxonomy_author(): void {
	register_taxonomy(
		'author',
		[ 'book' ],
		[
			'hierarchical'          => false,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_admin_column'     => false,
			'query_var'             => true,
			'rewrite'               => true,
			'capabilities'          => [
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			],
			'labels'                => [
				'name'                       => __( 'Authors', 'bookstore-theme' ),
				'singular_name'              => _x( 'Author', 'taxonomy general name', 'bookstore-theme' ),
				'search_items'               => __( 'Search Authors', 'bookstore-theme' ),
				'popular_items'              => __( 'Popular Authors', 'bookstore-theme' ),
				'all_items'                  => __( 'All Authors', 'bookstore-theme' ),
				'parent_item'                => __( 'Parent Author', 'bookstore-theme' ),
				'parent_item_colon'          => __( 'Parent Author:', 'bookstore-theme' ),
				'edit_item'                  => __( 'Edit Author', 'bookstore-theme' ),
				'update_item'                => __( 'Update Author', 'bookstore-theme' ),
				'view_item'                  => __( 'View Author', 'bookstore-theme' ),
				'add_new_item'               => __( 'Add New Author', 'bookstore-theme' ),
				'new_item_name'              => __( 'New Author', 'bookstore-theme' ),
				'separate_items_with_commas' => __( 'Separate Authors with commas', 'bookstore-theme' ),
				'add_or_remove_items'        => __( 'Add or remove Authors', 'bookstore-theme' ),
				'choose_from_most_used'      => __( 'Choose from the most used Authors', 'bookstore-theme' ),
				'not_found'                  => __( 'No Authors found.', 'bookstore-theme' ),
				'no_terms'                   => __( 'No Authors', 'bookstore-theme' ),
				'menu_name'                  => __( 'Authors', 'bookstore-theme' ),
				'items_list_navigation'      => __( 'Authors list navigation', 'bookstore-theme' ),
				'items_list'                 => __( 'Authors list', 'bookstore-theme' ),
				'most_used'                  => _x( 'Most Used', 'author', 'bookstore-theme' ),
				'back_to_items'              => __( '&larr; Back to Authors', 'bookstore-theme' ),
			],
			'show_in_rest'          => true,
			'rest_base'             => 'author',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		]
	);
}

add_action( 'init', 'register_taxonomy_author' );

/**
 * Sets the post updated messages for the `author` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `author` taxonomy.
 */
function set_author_taxonomy_updated_messages( $messages ): array {

	$messages['author'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Author added.', 'bookstore-theme' ),
		2 => __( 'Author deleted.', 'bookstore-theme' ),
		3 => __( 'Author updated.', 'bookstore-theme' ),
		4 => __( 'Author not added.', 'bookstore-theme' ),
		5 => __( 'Author not updated.', 'bookstore-theme' ),
		6 => __( 'Authors deleted.', 'bookstore-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'set_author_taxonomy_updated_messages' );
