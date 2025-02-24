<?php get_header(); ?> <!-- Include Header -->

<main id="page-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1> <!-- Page Title -->

            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?> <!-- Featured Image -->

            <div class="content">
                <?php the_content(); ?> <!-- Page Content -->
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?> <!-- Include Footer -->
