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
