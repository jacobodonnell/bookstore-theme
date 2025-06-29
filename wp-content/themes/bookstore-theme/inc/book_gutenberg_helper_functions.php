<?php

// Hide unnecessary panels in Gutenberg for books
function hide_book_gutenberg_panels(): void {
	$screen = get_current_screen();
	if ( $screen->post_type === 'book' ) {
		?>
        <script>
            wp.domReady(function () {
                wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-genre');
                wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-author');
                wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-publisher');
                wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-language');
                wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-format');
                // wp.data.dispatch('core/edit-post').removeEditorPanel('featured-image');
            });
        </script>
		<?php
	}
}

add_action( 'admin_footer', 'hide_book_gutenberg_panels' );


// ACF Image field is used for thumbnail so it can be Required
// This will save cover to thumbnail on Book save
function sync_acf_image_to_thumbnail( $post_id ): void {
	// Make sure this runs only for posts, not ACF options pages etc
	if ( get_post_type( $post_id ) !== 'book' ) {
		return;
	}

	$image    = get_field( 'cover', $post_id );
	$image_id = is_array( $image ) ? $image['ID'] : $image;
	if ( $image_id ) {
		set_post_thumbnail( $post_id, $image_id );
	} else {
		delete_post_thumbnail( $post_id );
	}
}

add_action( 'acf/save_post', 'sync_acf_image_to_thumbnail', 20 );


// Book prices are entered as dollars by user but saved to DB as cents
// 19.99 → 1999
function convert_price_to_cents( $value, $post_id, $field ): int {
	return (int) round( floatval( $value ) * 100 );
}

add_filter( 'acf/update_value/name=price', 'convert_price_to_cents', 10, 3 );


// Book prices are converted to dollars when displayed to user
function convert_price_to_dollars( $value, $post_id, $field ): float {
	if ( $value ) {
		$value = $value / 100; // 1999 → 19.99
	}

	return $value;
}

add_filter( 'acf/load_value/name=price', 'convert_price_to_dollars', 10, 3 );
