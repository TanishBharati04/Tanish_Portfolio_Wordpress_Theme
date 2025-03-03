<?php get_header(); ?>

<main class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article class="project-content">
            <h1><?php the_title(); ?></h1>

            <?php
            // Retrieve project start and completion year
            $start_date = get_post_meta(get_the_ID(), '_project_start_date', true);
            $end_date = get_post_meta(get_the_ID(), '_project_end_date', true);
            ?>

            <?php if ($start_date || $end_date): ?>
                <div class="project-meta" style="background:rgb(229, 23, 23); padding: 10px; border-radius: 8px; margin-top: 10px;">
                    <p><strong>Start Year:</strong> <?php echo esc_html($start_date); ?></p>
                    <p><strong>Completion Year:</strong> <?php echo esc_html($end_date); ?></p>
                </div>
            <?php endif; ?>

            <div class="project-details">
                <?php the_content(); ?>
            </div>
        </article>

    <?php endwhile; endif; ?>

        <!-- Related Post Functionality -->
        <?php
// Get the current post ID
$current_post_id = get_the_ID();

// Get the categories of the current post
$categories = wp_get_post_categories($current_post_id);

if ($categories) {
    $args = array(
        'category__in' => $categories,  // Fetch posts from the same categories
        'post__not_in' => array($current_post_id), // Exclude current post
        'posts_per_page' => 4, // Number of related posts to show
        'orderby' => 'rand',  // Show random related posts
    );

    $related_posts = new WP_Query($args);

    if ($related_posts->have_posts()) {
        echo '<h3>Related Posts</h3>';
        echo '<ul class="related-posts">';
        
        while ($related_posts->have_posts()) {
            $related_posts->the_post(); ?>
            
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>

        <?php }
        echo '</ul>';
    }
    wp_reset_postdata();
}
?>


</main>

<?php get_footer(); ?>
