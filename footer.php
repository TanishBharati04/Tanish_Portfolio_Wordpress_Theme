<footer>
    <?php if (is_active_sidebar('footer_widgets')) : ?>
        <footer class="footer-widgets">
            <?php dynamic_sidebar('footer_widgets'); ?>
        </footer>
    <?php endif; ?>

    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> . All rights reserved.</p>
    <?php wp_footer(); ?>
</footer>
</body>
</html>

<!-- 
<footer>
        <p>&copy; 2023 Tanish Portfolio. All rights reserved.</p>
</footer> -->