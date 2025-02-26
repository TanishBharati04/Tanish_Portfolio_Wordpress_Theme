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

// Add a Color Scheme section in your WordPress Theme Customizer that includes options for: Primary Color, Secondary Color, Background Color, Hyperlink Color.
function customize_color_scheme_register($wp_customize) {
    // Add Color Scheme Section
    $wp_customize->add_section('tanish_color_scheme', array(
        'title'       => __('Color Scheme', 'tanish'),
        'priority'    => 25,
        'description' => __('Customize the theme colors.', 'tanish'),
    ));

    // Primary Color
    $wp_customize->add_setting('tanish_primary_color', array(
        'default'   => '#3498db', // Default Blue
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_primary_color', array(
        'label'    => __('Primary Color', 'tanish'),
        'section'  => 'tanish_color_scheme',
        'settings' => 'tanish_primary_color',
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
}

add_action('customize_register', 'customize_color_scheme_register');
     
// Typography customization - font family and font size
function customize_typography_register($wp_customize) {
    // Add a section for Typography
    $wp_customize->add_section('tanish_typography', array(
        'title'       => __('Typography', 'tanish'),
        'priority'    => 30,
        'description' => __('Customize the font and typography settings.', 'tanish'),
    ));

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
    foreach ($elements as $el) {
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
};

add_action('customize_register', 'customize_typography_register');

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

// Layout Customization
function customize_layout_register($wp_customize) {
    // Add Layout Options Section
    $wp_customize->add_section('tanish_layout_options', array(
        'title'       => __('Layout Options', 'tanish'),
        'priority'    => 31,
        'description' => __('Select between Block Layout (boxed) or Wide Layout (full-width).', 'tanish'),
    ));

    // Add Layout Setting
    $wp_customize->add_setting('tanish_layout_type', array(
        'default'   => 'wide',
        'transport' => 'refresh', 
    ));

    // Add Layout Control (Radio Button)
    $wp_customize->add_control('tanish_layout_type', array(
        'label'    => __('Select Layout', 'tanish'),
        'section'  => 'tanish_layout_options',
        'type'     => 'radio',
        'choices'  => array(
            'block' => __('Block Layout (Boxed)', 'tanish'),
            'wide'  => __('Wide Layout (Full Width)', 'tanish'),
        ),
    ));
}
add_action('customize_register', 'customize_layout_register');

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
