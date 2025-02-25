<?php
function My_Portfolio_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_parent_theme_file_uri('/assets/css/index.css'));
    wp_enqueue_script('custom-js', get_parent_theme_file_uri('/assets/js/index.js'), array('jquery'), wp_get_theme()->get( 'Version' ), true);
}
add_action('wp_enqueue_scripts', 'My_Portfolio_scripts');
add_theme_support('post-thumbnails');

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

// function create_project_post_type() {
//     register_post_type( 'project', 
//         array (
//             'labels' => array (
//                 'name' => __('Projects'),
//                 'singular_name' => __('Project'),
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
//         )
//     );
// }

// add_action( 'init', 'create_project_post_type');

function create_project_post_type() {
    $labels = array(
        'name'               => __('Projects'),
        'singular_name'      => __('Project'),
        'menu_name'          => __('Projects'),
        'name_admin_bar'     => __('Project'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Project'),
        'new_item'           => __('New Project'),
        'edit_item'          => __('Edit Project'),
        'view_item'          => __('View Project'),
        'all_items'          => __('All Projects'),
        'search_items'       => __('Search Projects'),
        'not_found'          => __('No projects found'),
        'not_found_in_trash' => __('No projects found in Trash')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projects'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions'),
        'taxonomies'         => array('category', 'post_tag'), // Enables categories & tags like blog posts
        'show_in_rest'       => true // Enables Gutenberg editor
    );

    register_post_type('project', $args);
}
add_action('init', 'create_project_post_type');

// Layout for custom post type => custom_single.php
function create_portfolio_post_type() {
    $labels = array(
        'name'               => __('Portfolio'),
        'singular_name'      => __('Portfolio'),
        'menu_name'          => __('Portfolio Items'),
        'name_admin_bar'     => __('Portfolio'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Portfolio Item'),
        'new_item'           => __('New Portfolio Item'),
        'edit_item'          => __('Edit Portfolio Item'),
        'view_item'          => __('View Portfolio Items'),
        'all_items'          => __('All Portfolio Items'),
        'search_items'       => __('Search Portfolio\'s'),
        'not_found'          => __('No portfolio\'s found'),
        'not_found_in_trash' => __('No portfolio\'s found in Trash')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'portfolio\'s'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions'),
        'taxonomies'         => array('category', 'post_tag'), // Enables categories & tags like blog posts
        'show_in_rest'       => true // Enables Gutenberg editor
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'create_portfolio_post_type');
