<?php
/**
 * Template Name: Custom Single Post
 * Template Post Type: post, portfolio
 */
get_header();
?>

<main id="custom-single">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <h2>This is single-custom-template.php file</h2>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
