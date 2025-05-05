<?php

$category = get_queried_object(); 
      // بررسی معتبر بودن دسته
if (!$category || !isset($category->term_id)) {
    wp_redirect(home_url('/404'));
    exit;
}
?>

<div class="section-gap">

<div class="title-serves">
        <h3>آموزش‌های مرتبط با"<?= $category -> name ?>"</h3>
    </div>

    <div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-12">

        <div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="row">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>
                <?= get_template_part('tpls/blog/cart'); ?>
                <?php endwhile; ?>
                <?= get_template_part('tpls/blog/pagination'); ?>
                <?php else: ?>
                    <p>پستی در این دسته‌بندی وجود ندارد.</p>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>




        </div>
    </div>
    </div>
  
</div>