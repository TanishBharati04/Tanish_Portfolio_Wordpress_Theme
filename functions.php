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

    // error_log('printing labels ------------------------------------------');
    // error_log(print_r($labels, 1));

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
        'search_items'       => __('Search Portfolio'),
        'not_found'          => __('No portfolio found'),
        'not_found_in_trash' => __('No portfolio found in Trash')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'portfolio'),
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

// Custom taxonomy named Skills for Portfolio Post Type
function register_skills_taxonomy() {
    register_taxonomy( 'skills',
     'portfolio', 
      array(
        'labels' => array(
            'name' => 'Skills',
            'singular_name' => 'Skill',
            'search_items' => 'Search Skills',
            'all_items' => 'All Skills',
            'edit_item' => 'Edit Skill',
            'update_item' => 'Update Skill',
            'add_new_item' => 'Add New Skill',
            'new_item_name' => 'New Skill Name',
            'menu_name' => 'Skills'
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'skills'),
        'show_in_rest' => true
      )
    );
}

add_action( 'init', 'register_skills_taxonomy' );

// Add a custom metabox for Project Details
function add_project_details_metabox() {
    add_meta_box( 'project_details', 
        'Project Details', 
        'render_project_details_metabox', 
        'project', 
        'normal', 
        'high', 
    );
}

add_action( 'add_meta_boxes', 'add_project_details_metabox' );

function render_project_details_metabox($post) {
    // Retrieve current values if available
    $project_start_date = get_post_meta( $post->ID, '_project_start_date', true );
    $project_end_date = get_post_meta( $post->ID, '_project_end_date', true );

    // Security nonce
    wp_nonce_field('save_project_details', 'project_details_nonce');

    ?>

    <style>
        .project-details-card {
            background:rgb(123, 133, 242);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(30, 26, 48, 0.1);
            max-width: 100%;
        }
        .project-details-card label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .project-details-card input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>

    <div class="project-details-card">
        <label for="project_start_date">Project Start Date:</label>
        <input type="date" id="project_start_date" name="project_start_date" value="<?php echo esc_attr($project_start_date); ?>">

        <label for="project_end_date">Project Completion Date:</label>
        <input type="date" id="project_end_date" name="project_end_date" value="<?php echo esc_attr($project_end_date); ?>">
    </div>
    <?php

}

// save the data when the user clicks Save/Update.
function save_project_details($post_id) {
    // Verify nonce
    if(!isset($_POST['project_details_nonce']) || !wp_verify_nonce( $_POST['project_details_nonce'], 'save_project_details' )) {
        return;
    }

    // Prevent autosave from overwriting values
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Ensure user has permission
    if(!current_user_can( 'edit_post', $post_id )) {
        return;
    }

    // Save Start Date
    if(isset($_POST['project_start_date'])) {
        update_post_meta( $post_id, '_project_start_date', sanitize_text_field( $_POST['project_start_date'] ));
    }

    // Save End Date
    if(isset($_POST['project_end_date'])) {
        update_post_meta( $post_id, '_project_end_date', sanitize_text_field( $_POST['project_end_date'] ));
    }
}

// Widget area - sidebar
function register_custom_widget_areas() {
    register_sidebar(array(
        'name'          => 'Custom Sidebar',
        'id'            => 'custom_sidebar',
        'before_widget' => '<div class="custom-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'register_custom_widget_areas');

// Footer widget area
function register_footer_widget_area() {
    register_sidebar(array(
        'name'          => 'Footer Widgets',
        'id'            => 'footer_widgets',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'register_footer_widget_area');

// Themes Customization
function themes_customize_register($wp_customize) {
      // 🔹 Main Section: Theme Customization
    $wp_customize->add_panel('tanish_theme_customization', array(
        'title' => __('Theme Customization', 'tanish'),
        'priority' => 30,
        'description' => __('Customize colors, typography, and layout.', 'tanish'),
    ));

    /* ============================
       1️⃣ SUB-SECTION: COLOR SCHEME
       ============================ */
       $wp_customize->add_section('tanish_color_scheme', array(
            'title' => __('Color Scheme', 'tanish'),
            'priority' => 1,
            'panel' => 'tanish_theme_customization',
       ));

       // Primary Color
       $wp_customize->add_setting('tanish_primary_color', array(
        'default' => '#3498db', //Default blue
        'transport' => 'refresh',
       ));

       $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_primary_color', array(
        'label' => __('Primary Color'),
        'section' => 'tanish_color_scheme',
        'setting' => 'tanish_primary_color',
       )));

       // Secondary Color
        $wp_customize->add_setting('tanish_secondary_color', array(
            'default'   => '#2ecc71', // Default Green
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_secondary_color', array(
            'label'    => __('Secondary Color', 'tanish'),
            'section'  => 'tanish_color_scheme',
            'settings' => 'tanish_secondary_color',
        )));

        // Background Color
        $wp_customize->add_setting('tanish_bg_color', array(
            'default'   => '#ffffff', // Default White
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_bg_color', array(
            'label'    => __('Background Color', 'tanish'),
            'section'  => 'tanish_color_scheme',
            'settings' => 'tanish_bg_color',
        )));

        // Hyperlink Color
        $wp_customize->add_setting('tanish_link_color', array(
            'default'   => '#e74c3c', // Default Red
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_link_color', array(
            'label'    => __('Hyperlink Color', 'tanish'),
            'section'  => 'tanish_color_scheme',
            'settings' => 'tanish_link_color',
        )));

        /* ============================
        2️⃣ SUB-SECTION: TYPOGRAPHY
        ============================ */
        $wp_customize->add_section('tanish_typography', array(
        'title'       => __('Typography', 'tanish'),
        'priority'    => 2,
        'panel'       => 'tanish_theme_customization',));

        // Font Selection Dropdown
        $wp_customize->add_setting('tanish_font_family', array(
            'default'   => 'Poppins',
            'transport' => 'refresh',
        ));

        $wp_customize->add_control('tanish_font_family', array(
            'label'    => __('Font Family', 'tanish'),
            'section'  => 'tanish_typography',
            'type'     => 'select',
            'choices'  => array(
                'Poppins'    => 'Poppins',
                'Roboto'     => 'Roboto',
                'Lato'       => 'Lato',
                'Montserrat' => 'Montserrat',
                'Open Sans'  => 'Open Sans',
            ),
        ));

        // Font Sizes for Headings and Paragraph
        $elements = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p');
        foreach($elements as $el) {
            // Font Size
            $wp_customize->add_setting("tanish_{$el}_font_size", array(
                'default'   => 16,
                'transport' => 'refresh',
            ));

            $wp_customize->add_control("tanish_{$el}_font_size", array(
                'label'    => ucfirst($el) . ' Font Size',
                'section'  => 'tanish_typography',
                'type'     => 'number',
                'input_attrs' => array(
                    'min'  => 8,
                    'max'  => 72,
                    'step' => 1,
                ),
            ));

            // Font Size Unit
            $wp_customize->add_setting("tanish_{$el}_font_unit", array(
                'default'   => 'px',
                'transport' => 'refresh',
            ));

            $wp_customize->add_control("tanish_{$el}_font_unit", array(
                'label'    => ucfirst($el) . ' Font Size Unit',
                'section'  => 'tanish_typography',
                'type'     => 'select',
                'choices'  => array(
                    'px'  => 'Pixels (px)',
                    '%'   => 'Percentage (%)',
                    'em'  => 'em',
                    'rem' => 'rem',
                    'vw'  => 'Viewport Width (vw)',
                ),
            ));
        }

        /* ============================
        3️⃣ SUB-SECTION: LAYOUT OPTIONS
        ============================ */
        $wp_customize->add_section('tanish_layout_options', array(
            'title'       => __('Layout Options', 'tanish'),
            'priority'    => 3,
            'panel' => 'tanish_theme_customization',
        ));

        $wp_customize->add_setting('tanish_layout_type', array(
            'default'   => 'wide',
            'transport' => 'refresh', 
        ));

        $wp_customize->add_control('tanish_layout_type', array(
            'label'    => __('Select Layout', 'tanish'),
            'section'  => 'tanish_layout_options',
            'type'     => 'radio',
            'choices'  => array(
                'block' => __('Block Layout (Boxed)', 'tanish'),
                'wide'  => __('Wide Layout (Full Width)', 'tanish'),
            ),
        ));

        /* ============================
        4️⃣ SUB-SECTION: SOCIAL MEDIA SETTINGS
        ============================ */
        $wp_customize->add_section('tanish_social_media', array(
            'title' => __('Social Media Settings', 'tanish'),
            'priority' => 4,
            'panel' => 'tanish_theme_customization',
        ));

        // List of Social Media Platforms
        $social_platforms = array(
            'github' => 'Github',
            'linkedin' => 'LinkedIn',
            'x' => 'X',
            'youtube' => 'Youtube',
            'facebook' => 'Facebook',
        );

        foreach($social_platforms as $key => $label) {
            $wp_customize->add_setting("tanish_{$key}_link", array(
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'esc_url_raw',
            ));

            $wp_customize->add_control("tanish_{$key}_link", array(
                'label' => __("{$label} link", 'tanish'),
                'section' => 'tanish_social_media',
                'type' => 'url',
            ));
        }
}

add_action('customize_register', 'themes_customize_register');

// Apply the Selected Font and Font Sizes
function tanish_typography_css() {
    $font_family = get_theme_mod('tanish_font_family', 'Poppins');
    
    $elements = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p');
    $custom_css = "<style> body { font-family: '$font_family', sans-serif; }";

    foreach ($elements as $el) {
        $font_size = get_theme_mod("tanish_{$el}_font_size", 16);
        $font_unit = get_theme_mod("tanish_{$el}_font_unit", 'px');
        $custom_css .= "$el { font-size: {$font_size}{$font_unit}; }";
    }

    $custom_css .= "</style>";
    echo $custom_css;
}
add_action('wp_head', 'tanish_typography_css');

// Ensure Font Files Are Enqueued Properly
function tanish_enqueue_fonts() {
    wp_enqueue_style('tanish-custom-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), null);
}
add_action('wp_enqueue_scripts', 'tanish_enqueue_fonts');

// Apply Layout Styles Dynamically
function tanish_layout_css() {
    $layout_type = get_theme_mod('tanish_layout_type', 'wide');

    if ($layout_type === 'block') {
        echo "<style>
            body {
                max-width: 1200px; /* Adjust as needed */
                margin: 0 auto;
                background-color: #f5f5f5;
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }
        </style>";
    } else {
        echo "<style>
            body {
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
            }
        </style>";
    }
}
add_action('wp_head', 'tanish_layout_css');

function tanish_customize_live_preview() {
    wp_enqueue_script('tanish-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery', 'customize-preview'), null, true);
}
add_action('customize_preview_init', 'tanish_customize_live_preview');

// function remove_customize_unpreviewable() {
//     ?>
//     <script>
//         document.addEventListener("DOMContentLoaded", function() {
//             document.querySelectorAll(".customize-unpreviewable").forEach(el => {
//                 el.classList.remove("customize-unpreviewable");
//             });
//         });
//     </script>
//     <?php
// }
// add_action('wp_footer', 'remove_customize_unpreviewable');


// Shortcode example
add_shortcode('project_slider', 'project_slider_callback');

function project_slider_callback() {
    return 'adding project slider';
}

// Guternberg blocks
function social_icon_blocks_register() {
    register_block_type(get_template_directory() . '/blocks/social-icons');
}

add_action('init', 'social_icon_blocks_register');

// Template parts
register_block_pattern_category(
    'tanish-portfolio-theme',
    array( 'label' => __( 'Tanish Theme Parts', 'tanish-portfolio-theme'))
);

// Breadcrumb navigation
function tanish_breadcrumbs() {
    if (is_front_page()) {
        return; // Don't show breadcrumbs on the homepage
    }

    echo '<nav class="breadcrumb">';
    echo '<a href="' . home_url() . '">Home</a> &raquo; ';

    if (is_category() || is_single()) {
        the_category(' &raquo; ');
        if (is_single()) {
            echo ' &raquo; <span>' . get_the_title() . '</span>';
        }
    } elseif (is_page()) {
        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_archive()) {
        echo '<span>' . get_the_archive_title() . '</span>';
    } elseif (is_search()) {
        echo '<span>Search results for "' . get_search_query() . '"</span>';
    } elseif (is_404()) {
        echo '<span>Page Not Found</span>';
    }

    echo '</nav>';
}
