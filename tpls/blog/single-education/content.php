

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- عنوان آموزش -->
 <div class="title-serves">
<h1><?php the_title(); ?></h1>
</div>
<br>



<?php
// تابع برای استخراج ID از لینک یوتیوب
function get_youtube_video_id($url) {
    preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/)([a-zA-Z0-9_-]{11}))/i', $url, $matches);
    return $matches[1] ?? null;  // اگر ID پیدا نشد، مقدار null برمی‌گرداند
}

$video_link = get_post_meta(get_the_ID(), 'education_video_link', true);
if ($video_link):
    // بررسی لینک ویدیو (اگر از آپارات باشد)
    if (strpos($video_link, 'aparat.com') !== false):
        // استخراج ویدیو آیدی از لینک آپارات
        preg_match('/\/v\/([a-zA-Z0-9_-]+)/', $video_link, $matches);
        if (!empty($matches[1])):
            $video_id = $matches[1];
            ?>
            <div class="video-container">
                <iframe src="https://www.aparat.com/video/video/embed/videohash/<?= $video_id; ?>/vt/frame" 
                        frameborder="0" allowfullscreen></iframe>
            </div>
        <?php endif; ?>
    <?php elseif (strpos($video_link, 'youtube.com') !== false): ?>
        <!-- اگر لینک از یوتیوب باشد -->
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/<?= get_youtube_video_id($video_link); ?>" 
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen></iframe>
        </div>
    <?php else: ?>
        <!-- اگر لینک از پلتفرم دیگری باشد -->
        <div class="video-container">
            <iframe src="<?= esc_url($video_link); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    <?php endif; ?>
<?php endif; ?>


<!-- محتوای آموزش -->
<div class="education-content">
    <?php the_content(); ?>
</div>

<!-- دسته‌بندی‌ها -->
<div class="education-categories">
    <strong>دسته‌بندی‌ها:</strong>
    <?php
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            echo '<a href="catId=' . esc_url($category->term_id) . '" class="cat-link">';
            echo esc_html( $category->name );
            echo '</a> ';
        }
    }
    ?>
</div>

<?php endwhile; endif; ?>
<hr>



<!-- comment section -->
<?php comments_template(); ?>


<!-- نمایش پست‌های مرتبط -->
<section class="related-posts">
    <h2>پست‌های مرتبط</h2>
    <?php
    $current_post_id = get_the_ID();
    $categories = get_the_category($current_post_id);
    if (!empty($categories)) {
        // گرفتن شناسه‌های تمام دسته‌ها
        $category_ids = wp_list_pluck($categories, 'term_id');
    } else {
        $category_ids = array(); // اگر دسته‌بندی نداشت، آرایه خالی
    }
    $related_posts = getRelatedPosts($current_post_id, $category_ids, 3); // تعداد پست‌های مرتبط
    if (!empty($related_posts)) :
    ?>
        <div class="row justify-content-center">
            <?php foreach ($related_posts as $post) : ?>
                <?= get_template_part('tpls/blog/cart'); ?>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>پستی برای نمایش مرتبط پیدا نشد.</p>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</section>

