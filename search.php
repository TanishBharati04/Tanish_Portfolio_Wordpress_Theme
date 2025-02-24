<?php get_header(); ?>

<main id="search-results">
    <h1>Search Results for: <?php echo get_search_query(); ?></h1>

    <?php if (have_posts()) : ?>
        <ul class="search-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo get_the_excerpt(); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p>No results found. Try searching with different keywords.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
