<div class="section-gap">

    <div class="title-serves">
        <h3> آموزش‌ها </h3>
    </div>





    <?php

    $args = array(
        'post_type' => 'education',
        'posts_per_page' => 3, // تعداد پست‌ها
        'post_status' => 'publish', // فقط پست‌های منتشر شده
    );
    $recent_posts = new WP_Query($args);
    // سه پست آخر رو می‌خواهیم نمایش بدیم
    

    ?>

    <div class="row justify-content-center">
        <?php if ($recent_posts->have_posts()): ?>
            <?php while ($recent_posts->have_posts()):
                $recent_posts->the_post(); ?>
            <?= get_template_part('tpls/blog/cart'); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>













    <!-- لینک به صفحه همه پست‌ها -->
    <div class="text-center">
        <a class="custom-btn btn-12" href="<?= get_post_type_archive_link('education') ?>"><span> بزن بریم...
            </span><span> همه آموزش‌ها </span></a>
    </div>

</div>