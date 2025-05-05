<?php $categories = get_the_category(); ?>
<?php $relatedPosts = getRelatedPosts(get_the_ID(), $categories[0] -> term_id,); ?>

<section class="section-gap bg-gray">
    <div class="container">
        <div class="row mb-lg-5 mb-4">
            <div class="col-md-8">
                <h5>پست های مشابه</h5>
            </div>
        </div>
        <div class="row justify-content-center">
        <?php foreach ($relatedPosts as $relatedPost) :  ?>
                <div class="col-md-4">
                <div class="card border-0 mb-md-0 mb-3 box-hover">
                    <a href="<?= $relatedPost['thumbnail-url'] ?>"><?= $relatedPost['thumbnail'] ?></a>
                    <div class="card-body py-4">
                        <a href="#" class="mb-2 d-block"><?= $relatedPost['category'] ?></a>
                        <h5 class="mb-4"><a href="<?= $relatedPost['link'] ?>"><?= $relatedPost['title'] ?></a></h5>
                        <div class="mb-4">
                            <p><?= $relatedPost['excerpt'] ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex align-items-center">
                            <img class="avatar-sm rounded-circle mr-3" src="<?= $relatedPost['avatar'] ?>" alt="<?= $relatedPost['author'] ?>">
                            <span><?= $relatedPost['author'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!--blog end-->