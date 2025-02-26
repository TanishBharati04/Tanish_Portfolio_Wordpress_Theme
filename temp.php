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