<?php
/**
 * Custom taxonomy
 *
 * @package bookstore_theme
 */

/**
 * Registers the `genre` taxonomy,
 * for use with 'book'.
 */
function register_taxonomy_genre(): void {
	register_taxonomy(
		'genre',
		[ 'book' ],
		[
			'hierarchical'          => true,
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
				'name'                       => __( 'Genres', 'bookstore-theme' ),
				'singular_name'              => _x( 'Genre', 'taxonomy general name', 'bookstore-theme' ),
				'search_items'               => __( 'Search Genres', 'bookstore-theme' ),
				'popular_items'              => __( 'Popular Genres', 'bookstore-theme' ),
				'all_items'                  => __( 'All Genres', 'bookstore-theme' ),
				'parent_item'                => __( 'Parent Genre', 'bookstore-theme' ),
				'parent_item_colon'          => __( 'Parent Genre:', 'bookstore-theme' ),
				'edit_item'                  => __( 'Edit Genre', 'bookstore-theme' ),
				'update_item'                => __( 'Update Genre', 'bookstore-theme' ),
				'view_item'                  => __( 'View Genre', 'bookstore-theme' ),
				'add_new_item'               => __( 'Add New Genre', 'bookstore-theme' ),
				'new_item_name'              => __( 'New Genre', 'bookstore-theme' ),
				'separate_items_with_commas' => __( 'Separate Genres with commas', 'bookstore-theme' ),
				'add_or_remove_items'        => __( 'Add or remove Genres', 'bookstore-theme' ),
				'choose_from_most_used'      => __( 'Choose from the most used Genres', 'bookstore-theme' ),
				'not_found'                  => __( 'No Genres found.', 'bookstore-theme' ),
				'no_terms'                   => __( 'No Genres', 'bookstore-theme' ),
				'menu_name'                  => __( 'Genres', 'bookstore-theme' ),
				'items_list_navigation'      => __( 'Genres list navigation', 'bookstore-theme' ),
				'items_list'                 => __( 'Genres list', 'bookstore-theme' ),
				'most_used'                  => _x( 'Most Used', 'genre', 'bookstore-theme' ),
				'back_to_items'              => __( '&larr; Back to Genres', 'bookstore-theme' ),
			],
			'show_in_rest'          => true,
			'rest_base'             => 'genre',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		]
	);
}

add_action( 'init', 'register_taxonomy_genre' );

/**
 * Sets the post updated messages for the `genre` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `genre` taxonomy.
 */
function set_genre_taxonomy_updated_messages( array $messages ): array {

	$messages['genre'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Genre added.', 'bookstore-theme' ),
		2 => __( 'Genre deleted.', 'bookstore-theme' ),
		3 => __( 'Genre updated.', 'bookstore-theme' ),
		4 => __( 'Genre not added.', 'bookstore-theme' ),
		5 => __( 'Genre not updated.', 'bookstore-theme' ),
		6 => __( 'Genres deleted.', 'bookstore-theme' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'set_genre_taxonomy_updated_messages' );
