<footer>
    <!-- Widget Area -->
    <?php if (is_active_sidebar('footer_widgets')) : ?>
        <footer class="footer-widgets">
            <?php dynamic_sidebar('footer_widgets'); ?>
        </footer>
    <?php endif; ?>

    <!-- Social Media Setting Customization -->
     <div class="links">
        <?php

        $social_platforms = array(
            'github' => 'Github',
            'linkedin' => 'LinkedIn',
            'x' => 'X',
            'youtube' => 'Youtube',
            'facebook' => 'Facebook',
        );

        foreach($social_platforms as $key => $label) {
            $link = get_theme_mod("tanish_{$key}_link", '');

            if (!empty($link)) {
                echo '<a href="' . esc_url($link) . '" target="_blank" class="social_icon">';
                echo '<img src="' . esc_url(get_parent_theme_file_uri("assets/images/{$key}.jpg")) . '"  alt="' . esc_attr($label) . '">';
                echo '</a>';
            }
        }

        ?>
     </div>

    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> . All rights reserved.</p>
    <?php wp_footer(); ?>
</footer>
</body>
</html>

<!-- 
<footer>
        <p>&copy; 2023 Tanish Portfolio. All rights reserved.</p>
</footer> -->