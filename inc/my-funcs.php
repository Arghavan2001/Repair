<?php

//تصویر پیشفرض  برای thumbnail
function set_default_post_thumbnail_if_empty($html, $post_id, $post_thumbnail_id, $size, $attr)
{
    if (get_post_type($post_id) === 'service') {
        if (empty($html) || strpos($html, 'default-thumbnail') !== false) {
            $default_image_url = ASSETS_URL . 'img/main/thums/8806258.jpg';
            $alt = get_the_title($post_id);
            $class = isset($attr['class']) ? esc_attr($attr['class']) : 'default-thumbnail-service';
            $html = '<img src="' . esc_url($default_image_url) . '" alt="' . esc_attr($alt) . '" class="' . $class . '" />';
        }
    } elseif (get_post_type($post_id) === 'education') { // برای پست تایپ آموزش‌ها
        if (empty($html) || strpos($html, 'default-thumbnail') !== false) {
            $default_image_url = ASSETS_URL . 'img/main/thums/def-thum.webp'; // تصویر پیش‌فرض آموزش‌ها
            $alt = get_the_title($post_id);
            $class = isset($attr['class']) ? esc_attr($attr['class']) : 'default-thumbnail-education';
            $html = '<img src="' . esc_url($default_image_url) . '" alt="' . esc_attr($alt) . '" class="' . $class . '" />';
        }
    }
    return $html;
}
add_filter('post_thumbnail_html', 'set_default_post_thumbnail_if_empty', 20, 5);




//جلوگیری از کد کردن متن فارسی
function custom_farsi_slug_from_title($data, $postarr)
{
    $target_post_types = ['service', 'education'];

    if (in_array($data['post_type'], $target_post_types) && empty($data['post_name'])) {
        // استفاده از عنوان به عنوان اسلاگ
        $data['post_name'] = sanitize_title($data['post_title'], '', 'save');
    }

    return $data;
}




//سه رقم جدا کردن اعداد
function convert_farsi_to_english_numbers($string)
{
    $farsi = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($farsi, $english, $string);
}

function convert_english_to_farsi_numbers($string)
{
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $farsi = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return str_replace($english, $farsi, $string);
}

function format_price($price)
{
    // حذف کاراکترهای مخفی مثل نیم‌فاصله یا space خاص
    $price = preg_replace('/[\x{200C}\x{200B}\x{FEFF}]/u', '', $price);

    // تبدیل ارقام فارسی به انگلیسی
    $price = convert_farsi_to_english_numbers($price);

    // پیدا کردن تمام عددها و فرمت کردنشون
    $formatted = preg_replace_callback('/\d+/', function ($matches) {
        return number_format($matches[0]);
    }, $price);

    // تبدیل دوباره به فارسی
    $formatted = convert_english_to_farsi_numbers($formatted);

    // اضافه کردن تومان
    return $formatted . ' تومان';
}






// ذخیره داده های فرم در متاباکس درخواست‌ها
function handle_form()
{


    // گرفتن داده‌های فرم
    $name = sanitize_text_field($_POST['fullName']);
    $phone = sanitize_text_field($_POST['phone']);
    $device = sanitize_text_field($_POST['device']);
    $description = sanitize_textarea_field($_POST['description']);
    $city = sanitize_text_field($_POST['city']);

    // ایجاد پست جدید
    $post_id = wp_insert_post([
        'post_type' => 'requests',
        'post_title' => $name,  // عنوان پست (می‌توانید تغییرش دهید)
        'post_status' => 'pending',  // یا هر وضعیت دیگری که می‌خواهید
        'post_author' => 1,  // یا شناسه کاربر مد نظر
    ]);

    if ($post_id) {
        // ذخیره متا فیلدها در پست جدید
        update_post_meta($post_id, '_request_name', $name);
        update_post_meta($post_id, '_request_phone', $phone);
        update_post_meta($post_id, '_request_device', $device);
        update_post_meta($post_id, '_request_description', $description);
        update_post_meta($post_id, '_request_city', $city);
    }

    // ارسال پاسخ متنی به صورت موفقیت
    echo "درخواست شما با موفقیت ارسال شد.";
    wp_die();  // پایان عملیات AJAX
}
add_action('wp_ajax_submit_request_form', 'handle_form');
add_action('wp_ajax_nopriv_submit_request_form', 'handle_form');


function custom_comment_callback($comment, $args, $depth)
{



    $comment_timestamp = get_comment_time('U'); // زمان کامنت به timestamp
    $jdate = new jDateTime(true, true, 'Asia/Tehran'); // فعال‌سازی تبدیل، تایم‌زون
    $persian_date = $jdate->date('j F Y ساعت H:i', $comment_timestamp);


    ?>
    <div id="comment-<?php comment_ID(); ?>" <?php comment_class('comment'); ?>>
        <div class="comment-author">
            <?php echo get_avatar($comment, $args['avatar_size']); ?>
            <div>
                <div class="comment-author-name"><?php comment_author(); ?></div>
                <div class="comment-meta">
                    <time datetime="<?php comment_time('c'); ?>">
                        <?= $persian_date ?>
                    </time>
                </div>
            </div>
        </div>

        <div class="comment-content">
            <?php comment_text(); ?>
        </div>

        <div class="reply">
            <?php
            comment_reply_link([
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'reply_text' => 'پاسخ',
                'before' => '',
                'after' => ''
            ], $comment);
            ?>
        </div>

        <?php if ($args['has_children']): ?>
            <div class="children">
            <?php endif; ?>




            <?php
}

function end_custom_comment_callback($comment, $args, $depth): void
{
    if ($args['has_children']) {
        echo '</div>'; // بستن فقط در صورت وجود children
    }
    echo '</div>'; // بستن div.comment اصلی
}

function getRelatedPosts($postId, $categoryIds = [], $count = 3)
{


    $args = [

        'post__not_in' => [$postId],
        'post_status' => 'publish',
        'posts_per_page' => $count,
        'post_type' => 'education'
    ];


    if (!empty($categoryIds)) {
        $args['category__in'] = $categoryIds;
    }


    $relatedPosts = new WP_Query($args);


    $relatedPostCollection = [];
    if ($relatedPosts->have_posts()):
        while ($relatedPosts->have_posts()):
            $relatedPosts->the_post();
            $relatedPostCollection[] = [
                'ID' => get_the_ID(),
                'title' => get_the_title(),
                'categories' => get_the_category(),
                'thumbnail' => get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'w-100 rounded']),
                'thumbnail-url' => get_the_post_thumbnail_url(),
                'link' => get_the_permalink(),
                'excerpt' => get_the_excerpt(),
                'author' => get_the_author(),
                'avatar' => get_avatar_url(get_the_author_meta('ID'))
            ];
        endwhile;
        wp_reset_postdata();
    endif;
    return $relatedPostCollection;
}



function mytheme_create_default_posts() {
    // فقط یک بار اجرا بشه
    if (get_option('mytheme_default_posts_created')) {
        return;
    }

    // ایجاد پست پیش‌فرض
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);
    wp_insert_post([
        'post_title'   => 'آموزش نمونه اول',
        'post_content' => 'این یک آموزش پیش‌فرض است.',
        'post_status'  => 'publish',
        'post_type'    => 'education'
    ]);

    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);
    wp_insert_post([
        'post_title'   => 'سرویس نمونه اول',
        'post_content' => 'محتوای دیگری برای تست.',
        'post_status'  => 'publish',
        'post_type'    => 'service'
    ]);

    // جلوگیری از اجرای مجدد
    update_option('mytheme_default_posts_created', true);
}
add_action('after_switch_theme', 'mytheme_create_default_posts');
