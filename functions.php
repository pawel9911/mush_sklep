<?php

/**
 * Global definitions
 */
require_once 'global-definitions.php';
require_once ('includes/custom-post-types.php');

/**
 * Theme styles (CSS) and scripts (JavaScript)
 */
add_action( 'wp_enqueue_scripts', function () {
    /**
     * scripts
     */
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/assets/build/main.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/src/libs/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '5.3', true );

    /**
     * styles
     */
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/build/main.min.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/assets/src/libs/bootstrap/css/bootstrap.min.css', array(), '5.3', 'all' );

});

/**
 * Register default menus
 */
add_action( 'after_setup_theme', function () {
    register_nav_menus( [
        'header' => __( 'Header menu', 'exchange' ),
        'footer' => __( 'Footer menu', 'exchange' ),
    ] );
} );


function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
