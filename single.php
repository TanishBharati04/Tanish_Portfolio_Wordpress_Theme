<?php get_header(); ?> <!-- Include header -->

<main id="post-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1> <!-- Post Title -->

            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?> <!-- Display Featured Image -->

            <div class="post-meta">
                <p>Published on: <?php echo get_the_date(); ?></p>
                <p>By: <?php the_author(); ?></p>
                <p>Category: <?php the_category(', '); ?></p>
            </div> <!-- Display Post Meta -->

            <div class="content">
                <?php the_content(); ?> <!-- Post Content -->
            </div>

            <div class="post-tags">
                <p><strong>Tags:</strong> <?php the_tags('', ', ', ''); ?></p>
            </div> <!-- Display Tags -->

            <div class="post-navigation">
                <div class="prev-post"><?php previous_post_link(); ?></div>
                <div class="next-post"><?php next_post_link(); ?></div>
            </div> <!-- Navigation to Next & Previous Posts -->

            <?php comments_template(); ?> <!-- Comments Section -->
        </article>
    <?php endwhile; ?>



</main>

<?php get_footer(); ?> <!-- Include Footer -->

