<?php get_header(); ?>

<main id="portfolio-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="portfolio-<?php the_ID(); ?>" <?php post_class(); ?>>

            <h1><?php the_title(); ?></h1> <!-- Post Title -->
            <h2>This is single-portfolio.php file</h2>

            <?php if (has_post_thumbnail()) : ?>
                <div class="portfolio-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?> <!-- Featured Image -->

            <div class="portfolio-content">
                <?php the_content(); ?> <!-- Post Content -->
            </div>

            <div class="portfolio-meta">
                <p><strong>Project Date:</strong> <?php echo get_post_meta(get_the_ID(), 'project_date', true); ?></p>
                <p><strong>Client:</strong> <?php echo get_post_meta(get_the_ID(), 'client_name', true); ?></p>
            </div> <!-- Custom Meta Fields -->

            <div class="portfolio-navigation">
                <div class="prev"><?php previous_post_link('%link', '← Previous Project'); ?></div>
                <div class="next"><?php next_post_link('%link', 'Next Project →'); ?></div>
            </div> <!-- Navigation -->

        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
