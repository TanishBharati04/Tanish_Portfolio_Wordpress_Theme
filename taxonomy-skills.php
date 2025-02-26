<?php get_header(); ?>

<main>
    <h1>Skill: <?php single_term_title(); ?></h1>
    <h2>This is taxonomy-skills.php custom template for Portfolio Post Type</h2>
    <div class="portfolio-items">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
            </article>
        <?php endwhile; else : ?>
            <p>No portfolio items found under this skill.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
