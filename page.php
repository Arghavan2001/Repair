<?php get_header('shop'); ?>
<?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post(); ?>
        <div class="title-serves">
            <h1><?php the_title(); ?></h1>
        </div>
        <br>
        <div class="education-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>