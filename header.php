<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <!-- Customizer color scheme -->
    <style>
    :root {
        --primary-color: <?php echo esc_attr(get_theme_mod('tanish_primary_color', '#3498db')); ?>;
        --secondary-color: <?php echo esc_attr(get_theme_mod('tanish_secondary_color', '#2ecc71')); ?>;
        --background-color: <?php echo esc_attr(get_theme_mod('tanish_bg_color', '#ffffff')); ?>;
        --link-color: <?php echo esc_attr(get_theme_mod('tanish_link_color', '#e74c3c')); ?>;
    }

    body {
        background-color: var(--background-color);
    }

    a {
        color: var(--link-color);
    }

    .btn {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .btn-secondary {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: #fff;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>

</head>
<body <?php body_class(get_theme_mod('tanish_layout_type', 'wide') . '-layout'); ?>>

<!-- <header>
    <h1><?php bloginfo('name'); ?></h1>
    <nav>
        <?php wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => false)); ?>
    </nav>
</header> -->


<header>
    <h1><?php bloginfo('name'); ?></h1>

    <nav>
        <a href="#about">About</a>
        <a href="#skills">Skills</a>
        <a href="#projects">Projects</a>
        <a href="#contact">Contact</a>

        <?php get_search_form(); ?>

        <button id="toggle-btn">
            <svg width="30" height="30" id="dark-icon">
                <path 
                    fill="black" 
                    d="
                        M 23, 5
                        A 12 12 0 1 0 23, 25
                        A 12 12 0 0 1 23, 5"
                />
            </svg>

            <svg width="30" height="30" id="light-icon" style="display: none;">
                <circle cx="15" cy="15" r="6" fill="white" />
                <line id="ray" stroke="white" stroke-width="2" stroke-linecap="round" x1="15" y1="1" x2="15" y2="4"></line>
                <use href="#ray" transform="rotate(45, 15, 15)" />
                <use href="#ray" transform="rotate(90, 15, 15)" />
                <use href="#ray" transform="rotate(135, 15, 15)" />
                <use href="#ray" transform="rotate(180, 15, 15)" />
                <use href="#ray" transform="rotate(225, 15, 15)" />
                <use href="#ray" transform="rotate(270, 15, 15)" />
                <use href="#ray" transform="rotate(315, 15, 15)" />
            </svg>
        </button>
    </nav>
</header>