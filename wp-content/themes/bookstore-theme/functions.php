<?php

function load_bookstore_theme_scripts(): void {
	wp_enqueue_script( 'ourmainjs', get_theme_file_uri( '/build/index.js' ), array( 'wp-element' ), '1.0', true );
	wp_enqueue_style( 'ourmaincss', get_theme_file_uri( '/build/index.css' ) );
}

add_action( 'wp_enqueue_scripts', 'load_bookstore_theme_scripts' );

function setup_bookstore_theme(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'author-square', 400, 400, true );
	add_image_size( 'author-square-large', 800, 800, true );
}

add_action( 'after_setup_theme', 'setup_bookstore_theme' );

add_action( 'after_switch_theme', function () {
	$front_page_id = get_page_by_path( 'home' );

	if ( ! $front_page_id ) {
		// Create it if missing:
		$front_page_id = wp_insert_post( [
			'post_title'   => 'Home',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '',
		] );
	} else {
		$front_page_id = $front_page_id->ID;
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id );
} );

require 'post-types/book.php';
require 'taxonomies/author.php';
require 'taxonomies/genre.php';
require 'taxonomies/publisher.php';
require 'taxonomies/language.php';
require 'taxonomies/format.php';

require 'inc/book_gutenberg_helper_functions.php';

