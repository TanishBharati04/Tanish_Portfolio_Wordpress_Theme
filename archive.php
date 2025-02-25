<main id="archive-content">
    <h1>
        <?php 
            if (is_category()) {
                single_cat_title(); 
            } elseif (is_tag()) {
                single_tag_title(); 
            } elseif (is_author()) {
                echo 'Posts by ' . get_the_author();
            } elseif (is_year()) {
                echo 'Yearly Archives: ' . get_the_date('Y');
            } elseif (is_month()) {
                echo 'Monthly Archives: ' . get_the_date('F Y');
            } elseif (is_day()) {
                echo 'Daily Archives: ' . get_the_date('F j, Y');
            } elseif (is_post_type_archive()) {
                post_type_archive_title();
            } else {
                echo 'Archives';
            }
        ?>
    </h1>

    <?php if (have_posts()) : ?>
        <ul class="archive-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo get_the_excerpt(); ?></p>
                    <p><small>Posted on <?php echo get_the_date(); ?> in <?php the_category(', '); ?></small></p>
                </li>
            <?php endwhile; ?>
        </ul>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
