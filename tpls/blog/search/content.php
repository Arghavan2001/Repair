<div class="title-serves">
    <h3> نتایج جستجو برای: <?= get_search_query() ?></h۳>
</div>
<div class="container">
<div class="row justify-content-between">
    <div class="col-lg-12">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()):
                            the_post(); ?>
                           <?= get_template_part('tpls/blog/cart'); ?>
                        <?php endwhile; ?>
                        
                        <?= get_template_part('tpls/blog/pagination'); ?>
                    <?php else: ?>
                        <p> پستی مرتبط با "<?= get_search_query() ?>" یافت نشد. </p>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </div>




    </div>
</div>