<?php
/**
 * Custom post type
 *
 * @package bookstore_theme
 */

/**
 * Registers the `book` post type.
 */
function bookstore_theme_init(): void {
	register_post_type(
		'book',
		[
			'labels'                => [
				'name'                  => __( 'Books', 'bookstore-theme' ),
				'singular_name'         => __( 'Book', 'bookstore-theme' ),
				'all_items'             => __( 'All Books', 'bookstore-theme' ),
				'archives'              => __( 'Book Archives', 'bookstore-theme' ),
				'attributes'            => __( 'Book Attributes', 'bookstore-theme' ),
				'insert_into_item'      => __( 'Insert into Book', 'bookstore-theme' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Book', 'bookstore-theme' ),
				'featured_image'        => _x( 'Featured Image', 'book', 'bookstore-theme' ),
				'set_featured_image'    => _x( 'Set featured image', 'book', 'bookstore-theme' ),
				'remove_featured_image' => _x( 'Remove featured image', 'book', 'bookstore-theme' ),
				'use_featured_image'    => _x( 'Use as featured image', 'book', 'bookstore-theme' ),
				'filter_items_list'     => __( 'Filter Books list', 'bookstore-theme' ),
				'items_list_navigation' => __( 'Books list navigation', 'bookstore-theme' ),
				'items_list'            => __( 'Books list', 'bookstore-theme' ),
				'new_item'              => __( 'New Book', 'bookstore-theme' ),
				'add_new'               => __( 'Add New', 'bookstore-theme' ),
				'add_new_item'          => __( 'Add New Book', 'bookstore-theme' ),
				'edit_item'             => __( 'Edit Book', 'bookstore-theme' ),
				'view_item'             => __( 'View Book', 'bookstore-theme' ),
				'view_items'            => __( 'View Books', 'bookstore-theme' ),
				'search_items'          => __( 'Search Books', 'bookstore-theme' ),
				'not_found'             => __( 'No Books found', 'bookstore-theme' ),
				'not_found_in_trash'    => __( 'No Books found in trash', 'bookstore-theme' ),
				'parent_item_colon'     => __( 'Parent Book:', 'bookstore-theme' ),
				'menu_name'             => __( 'Books', 'bookstore-theme' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'thumbnail', 'revisions' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-book',
			'show_in_rest'          => true,
			'rest_base'             => 'book',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);
}

add_action( 'init', 'bookstore_theme_init' );

/**
 * Sets the post updated messages for the `book` post type.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `book` post type.
 */
function bookstore_theme_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['book'] = array(
		0  => '',
		// Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Book updated. <a target="_blank" href="%s">View Book</a>', 'bookstore-theme' ),
			esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'bookstore-theme' ),
		3  => __( 'Custom field deleted.', 'bookstore-theme' ),
		4  => __( 'Book updated.', 'bookstore-theme' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s', 'bookstore-theme' ),
			wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Book published. <a href="%s">View Book</a>', 'bookstore-theme' ), esc_url( $permalink ) ),
		7  => __( 'Book saved.', 'bookstore-theme' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Book submitted. <a target="_blank" href="%s">Preview Book</a>', 'bookstore-theme' ),
			esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Book scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Book</a>',
			'bookstore-theme' ), date_i18n( __( 'M j, Y @ G:i', 'bookstore-theme' ), strtotime( $post->post_date ) ),
			esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Book draft updated. <a target="_blank" href="%s">Preview Book</a>', 'bookstore-theme' ),
			esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

add_filter( 'post_updated_messages', 'bookstore_theme_updated_messages' );

/**
 * Sets the bulk post updated messages for the `book` post type.
 *
 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param int[] $bulk_counts Array of item counts for each message, used to build internationalized strings.
 *
 * @return array Bulk messages for the `book` post type.
 */
function bookstore_theme_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['book'] = array(
		/* translators: %s: Number of Books. */
		'updated'   => _n( '%s Book updated.', '%s Books updated.', $bulk_counts['updated'], 'bookstore-theme' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Book not updated, somebody is editing it.',
			'bookstore-theme' ) :
			/* translators: %s: Number of Books. */
			_n( '%s Book not updated, somebody is editing it.', '%s Books not updated, somebody is editing them.',
				$bulk_counts['locked'], 'bookstore-theme' ),
		/* translators: %s: Number of Books. */
		'deleted'   => _n( '%s Book permanently deleted.', '%s Books permanently deleted.', $bulk_counts['deleted'],
			'bookstore-theme' ),
		/* translators: %s: Number of Books. */
		'trashed'   => _n( '%s Book moved to the Trash.', '%s Books moved to the Trash.', $bulk_counts['trashed'],
			'bookstore-theme' ),
		/* translators: %s: Number of Books. */
		'untrashed' => _n( '%s Book restored from the Trash.', '%s Books restored from the Trash.',
			$bulk_counts['untrashed'], 'bookstore-theme' ),
	);

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'bookstore_theme_bulk_updated_messages', 10, 2 );
