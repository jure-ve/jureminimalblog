<?php
/**
 * Jure Minimal Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jure_Minimal_Blog
 */

if ( ! function_exists( 'jure_minimal_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function jure_minimal_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'jure-minimal-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Menu', 'jure-minimal-blog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'jure_minimal_blog_setup' );

/**
 * Enqueue scripts and styles.
 */
function jure_minimal_blog_scripts() {
	wp_enqueue_style( 'jure-minimal-blog-style', get_stylesheet_uri(), array(), '1.3' );
	wp_enqueue_script( 'jure-minimal-blog-search', get_template_directory_uri() . '/assets/search-toggle.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'jure_minimal_blog_scripts' );

/**
 * Fallback menu for primary-menu.
 */
function jure_minimal_blog_fallback_menu() {
	echo '<ul id="primary-menu" class="menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'jure-minimal-blog' ) . '</a></li>';
	echo '</ul>';
}