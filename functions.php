<?php
function My_Portfolio_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_parent_theme_file_uri('/assets/css/index.css'));
    wp_enqueue_script('custom-js', get_parent_theme_file_uri('/assets/js/index.js'), array('jquery'), wp_get_theme()->get( 'Version' ), true);
}
add_action('wp_enqueue_scripts', 'My_Portfolio_scripts');

// function tanish_portfolio_menus() {
//     register_nav_menus(array(
//         'primary-menu' => __('Primary Menu', 'tanish-portfolio')
//     ));
// }
// add_action('after_setup_theme', 'tanish_portfolio_menus');

// add_action( 'after_setup_theme', 'theme_slug_setup' );

// function theme_slug_setup() {
// 	add_editor_style( array(
// 		get_stylesheet_uri(),
// 		get_parent_theme_file_uri( 'assets/css/index.css' )
// 	) );
// }
