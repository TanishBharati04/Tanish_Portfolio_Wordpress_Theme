<?php



get_header();
?>

<main>
    <section id="about" class="about">
        <div class="personal-pic">
            <img src="<?php echo esc_url(get_parent_theme_file_uri( '/assets/images/Personal_pic.jpg' )); ?>" alt="Profile Picture">
        </div>
        <div class="personal-info">
            <h2>Hi, I’m Tanish</h2>
            <p>I am a Software Engineer Intern based in Pune, India. I am pursuing MSc Computer Science with expertise in Java, MERN Stack, Python, Machine Lesarning. Currently I’m working in WisdmLabs. </p>
            <div class="links">
                <a href="https://github.com" target="_blank"><img src="<?php echo esc_url(get_parent_theme_file_uri( 'assets/images/github.jfif' )); ?>" alt="Github"></a>
                <a href="https://linkedin.com" target="_blank"><img src="<?php echo esc_url(get_parent_theme_file_uri( 'assets/images/linkedin.jfif' )); ?>" alt="LinkedIn"></a>
                <a href="https://twitter.com" target="_blank"><img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/twitter.jfif')); ?>" alt="Twitter"></a>
            </div>
        </div>
    </section>

    <section id="skills" class="skills">
        <h2>Skills</h2>
        <div class="skills-grid">
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/Html.png')); ?>" alt="HTML Logo">
                <p>HTML</p>
            </div>
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/Css.png')); ?>" alt="CSS Logo">
                <p>CSS</p>
            </div>
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/Js.png')); ?>" alt="JavaScript Logo">
                <p>JavaScript</p>
            </div>
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/React.png')); ?>" alt="React Logo">
                <p>React</p>
            </div>
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/node.png')); ?>" alt="Node.js Logo">
                <p>Node.js</p>
            </div>
            <div class="skill-card">
                <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/Git.png')); ?>" alt="Git Logo">
                <p>Git</p>
            </div>
        </div>
    </section>

    <section id="projects" class="projects">
        <h2>Projects</h2>
        <div class="slider-container">
            <button class="arrow left-arrow" onclick="slideLeft()">&#10094;</button>

            <div class="project-grid">
                <?php
                    $args = array(
                        'post_type' => 'project',
                        'posts_per_page' => -1,
                    );
                    
                    $query = new WP_Query($args);

                    if($query->have_posts()) :
                        while($query->have_posts()) :
                            $query->the_post();
                ?>

                <div class="project-card">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="project-img">
                            <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                    
                    <p><?php the_excerpt(); ?></p>
                    <div class="view-btn">
                        <a href="<?php the_permalink(); ?>" class="button btn">View Project</a>
                    </div>
                </div>

                <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p style="text-align: center; color: red;">No projects found.</p>';
                    endif;
                ?>
            </div>

            <!-- <div class="project-grid">
                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/dummy_project_1.jfif')); ?>" alt="Project 1">
                    </div>
                    <h3>Project 1</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, harum optio quas blanditiis nostrum alias ratione asperiores sed doloremque amet provident quasi error. Ad harum enim repellendus expedita nulla doloremque.</p>
                </div>

                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/dummy_project_2.jfif')); ?>" alt="Project 2">
                    </div>
                    <h3>Project 2</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus ipsam necessitatibus saepe nobis vel, expedita in eaque quae totam alias doloribus sint est </p>
                </div>

                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/dummy_project_3.jfif')); ?>" alt="Project 3">
                    </div>
                    <h3>Project 3</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum veniam beatae rem excepturi ea vitae. Officia dicta consequatur eius porro molestiae </p>
                </div>

                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/dummy_project_4.jfif')); ?>" alt="Project 4">
                    </div>
                    <h3>Project 4</h3>
                    <p>A brief description of the project.</p>
                </div>
                
                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo esc_url(get_parent_theme_file_uri('assets/images/dummy_project_5.jfif')); ?>" alt="Project 5">
                    </div>
                    <h3>Project 5</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ea quibusdam nostrum nesciunt sapiente nulla fugit optio molestias, mollitia officiis animi nam alias, harum eveniet quas. Illum unde assumenda veritatis.</p>
                </div>
            </div> -->
            
            <button class="arrow right-arrow" onclick="slideRight()">&#10095;</button>
        </div>
    </section>

    <section id="contact" class="contact">
        <h2>Contact Me</h2>
        <form>
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </section>
</main>

<?php get_footer(); ?>