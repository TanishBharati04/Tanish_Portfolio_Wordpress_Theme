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
</main>

<?php get_footer(); ?>
