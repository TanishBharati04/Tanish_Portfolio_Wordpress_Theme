<?php
function tanish_customize_register($wp_customize) {
    // Add Color Scheme Section
    $wp_customize->add_section('tanish_color_scheme', array(
        'title'       => __('Color Scheme', 'tanish'),
        'priority'    => 25,
        'description' => __('Choose a predefined color scheme.', 'tanish'),
    ));

    // Add Color Scheme Dropdown
    $wp_customize->add_setting('tanish_color_scheme', array(
        'default'   => 'light', // Default scheme
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('tanish_color_scheme', array(
        'label'    => __('Select Color Scheme', 'tanish'),
        'section'  => 'tanish_color_scheme',
        'type'     => 'select',
        'choices'  => array(
            'light'  => 'Light Mode',
            'dark'   => 'Dark Mode',
            'blue'   => 'Blue Theme',
            'green'  => 'Green Theme',
            'custom' => 'Custom Colors',
        ),
    ));

    // Custom Colors (Only visible if "Custom" is selected)
    $wp_customize->add_setting('tanish_primary_color', array(
        'default'   => '#3498db',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_primary_color', array(
        'label'    => __('Primary Color', 'tanish'),
        'section'  => 'tanish_color_scheme',
        'settings' => 'tanish_primary_color',
    )));

    $wp_customize->add_setting('tanish_secondary_color', array(
        'default'   => '#2ecc71',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tanish_secondary_color', array(
        'label'    => __('Secondary Color', 'tanish'),
        'section'  => 'tanish_color_scheme',
        'settings' => 'tanish_secondary_color',
    )));
}

add_action('customize_register', 'tanish_customize_register');

// Apply Predefined Color Scheme in wp_head
function tanish_dynamic_css() {
    $color_scheme = get_theme_mod('tanish_color_scheme', 'light');

    // Predefined color schemes
    if ($color_scheme === 'dark') {
        $primary   = '#222222';
        $secondary = '#444444';
        $bg        = '#000000';
        $text      = '#ffffff';
    } elseif ($color_scheme === 'blue') {
        $primary   = '#2980b9';
        $secondary = '#3498db';
        $bg        = '#ecf0f1';
        $text      = '#2c3e50';
    } elseif ($color_scheme === 'green') {
        $primary   = '#27ae60';
        $secondary = '#2ecc71';
        $bg        = '#f1f8f5';
        $text      = '#145214';
    } else { // Custom Colors
        $primary   = get_theme_mod('tanish_primary_color', '#3498db');
        $secondary = get_theme_mod('tanish_secondary_color', '#2ecc71');
        $bg        = get_theme_mod('tanish_bg_color', '#ffffff');
        $text      = '#333333';
    }
    ?>

    <style>
        :root {
            --primary-color: <?php echo esc_attr($primary); ?>;
            --secondary-color: <?php echo esc_attr($secondary); ?>;
            --background-color: <?php echo esc_attr($bg); ?>;
            --text-color: <?php echo esc_attr($text); ?>;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .btn {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: #fff;
        }

        .navbar, .footer {
            background-color: var(--secondary-color);
        }
    </style>

    <?php
}

add_action('wp_head', 'tanish_dynamic_css');

// Add a custom metabox for Project Details
// function add_project_details_metabox() {
//     add_meta_box( 'project_details', 
//         'Project Details', 
//         'render_project_details_metabox', 
//         'project', 
//         'normal', 
//         'high', 
//     );
// }

// add_action( 'add_meta_boxes', 'add_project_details_metabox' );

// function render_project_details_metabox($post) {
//     // Retrieve current values if available
//     $project_start_date = get_post_meta( $post->ID, '_project_start_date', true );
//     $project_end_date = get_post_meta( $post->ID, '_project_end_date', true );

//     // Security nonce
//     wp_nonce_field('save_project_details', 'project_details_nonce');

//     ?>

<!-- //     <style>
//         .project-details-card {
//             background:rgb(123, 133, 242);
//             padding: 15px;
//             border-radius: 8px;
//             box-shadow: 0px 2px 5px rgba(30, 26, 48, 0.1);
//             max-width: 100%;
//         }
//         .project-details-card label {
//             font-weight: bold;
//             display: block;
//             margin-top: 10px;
//         }
//         .project-details-card input {
//             width: 100%;
//             padding: 8px;
//             margin-top: 5px;
//             border: 1px solid #ccc;
//             border-radius: 5px;
//         }
//     </style> -->

<!-- //     <div class="project-details-card">
//         <label for="project_start_date">Project Start Date:</label>
//         <input type="date" id="project_start_date" name="project_start_date" value="<?php /*echo esc_attr($project_start_date);*/ ?>">

//         <label for="project_end_date">Project Completion Date:</label>
//         <input type="date" id="project_end_date" name="project_end_date" value="<?php /*echo esc_attr($project_end_date); */?>">
//     </div> -->
<?php 

// }

// // save the data when the user clicks Save/Update.
// function save_project_details($post_id) {
//     // Verify nonce
//     if(!isset($_POST['project_details_nonce']) || !wp_verify_nonce( $_POST['project_details_nonce'], 'save_project_details' )) {
//         return;
//     }

//     // Prevent autosave from overwriting values
//     if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//         return;
//     }

//     // Ensure user has permission
//     if(!current_user_can( 'edit_post', $post_id )) {
//         return;
//     }

//     // Save Start Date
//     if(isset($_POST['project_start_date'])) {
//         update_post_meta( $post_id, '_project_start_date', sanitize_text_field( $_POST['project_start_date'] ));
//     }

//     // Save End Date
//     if(isset($_POST['project_end_date'])) {
//         update_post_meta( $post_id, '_project_end_date', sanitize_text_field( $_POST['project_end_date'] ));
//     }
// }





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

// function create_project_post_type() {
//     $labels = array(
//         'name'               => __('Projects'),
//         'singular_name'      => __('Project'),
//         'menu_name'          => __('Projects'),
//         'name_admin_bar'     => __('Project'),
//         'add_new'            => __('Add New'),
//         'add_new_item'       => __('Add New Project'),
//         'new_item'           => __('New Project'),
//         'edit_item'          => __('Edit Project'),
//         'view_item'          => __('View Project'),
//         'all_items'          => __('All Projects'),
//         'search_items'       => __('Search Projects'),
//         'not_found'          => __('No projects found'),
//         'not_found_in_trash' => __('No projects found in Trash')
//     );

    // error_log('printing labels ------------------------------------------');
    // error_log(print_r($labels, 1));

//     $args = array(
//         'labels'             => $labels,
//         'public'             => true,
//         'publicly_queryable' => true,
//         'show_ui'            => true,
//         'show_in_menu'       => true,
//         'query_var'          => true,
//         'rewrite'            => array('slug' => 'projects'),
//         'capability_type'    => 'post',
//         'has_archive'        => true,
//         'hierarchical'       => false,
//         'menu_position'      => 5,
//         'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions'),
//         'taxonomies'         => array('category', 'post_tag'), // Enables categories & tags like blog posts
//         'show_in_rest'       => true // Enables Gutenberg editor
//     );

//     register_post_type('project', $args);
// }
// add_action('init', 'create_project_post_type');



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
