<div class="title-serves">
    <h3> همه آموزش‌ها </h3>
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