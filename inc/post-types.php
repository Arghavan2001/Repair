<?php





// ثبت پست تایپ آموزش‌ها
function register_custom_post_type_education() {
    register_post_type('education', array(
        'labels' => array(
            'name' => 'آموزش‌ها',
            'singular_name' => 'آموزش',
            'add_new' => 'افزودن آموزش جدید',
            'add_new_item' => 'افزودن آموزش',
            'edit_item' => 'ویرایش آموزش',
            'new_item' => 'آموزش جدید',
            'view_item' => 'مشاهده آموزش',
            'search_items' => 'جستجوی آموزش‌ها',
            'not_found' => 'آموزشی یافت نشد',
            'menu_name' => 'آموزش‌ها'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'taxonomies' => array('category'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));
}
add_action('init', 'register_custom_post_type_education');

// اضافه کردن متاباکس برای لینک ویدیو
function add_education_video_link_meta_box() {
    add_meta_box(
        'education_video_link',
        'لینک ویدیو (مثلاً از آپارات)',
        'render_education_video_link_meta_box',
        'education',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_education_video_link_meta_box');

// رندر متاباکس لینک ویدیو
function render_education_video_link_meta_box($post) {
    $value = get_post_meta($post->ID, 'education_video_link', true);
    echo '<input type="text" name="education_video_link" style="width:100%" value="' . esc_attr($value) . '" placeholder="لینک ویدیو را وارد کنید">';
}

// ذخیره‌سازی لینک ویدیو
function save_education_video_link_meta_box($post_id) {
    if (array_key_exists('education_video_link', $_POST)) {
        update_post_meta(
            $post_id,
            'education_video_link',
            sanitize_text_field($_POST['education_video_link'])
        );
    }
}
add_action('save_post', 'save_education_video_link_meta_box');




























// ثبت پست تایپ خدمات
function register_custom_post_type_services() {
    register_post_type('service', array(
        'labels' => array(
            'name' => 'خدمات',
            'singular_name' => 'خدمت',
            'add_new' => 'افزودن خدمت جدید',
            'add_new_item' => 'افزودن خدمت ',
            'edit_item' => 'ویرایش خدمت',
            'new_item' => 'خدمت جدید',
            'view_item' => 'مشاهده خدمت',
            'search_items' => 'جستجوی خدمت',
            'not_found' => 'خدمتی یافت نشد',
            'menu_name' => 'خدمات'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail','comments'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-hammer'
    ));
   
}
add_action('init', 'register_custom_post_type_services');

// اضافه کردن متاباکس برای سرویس‌ها
function add_service_meta_box() {
    add_meta_box('service_details', 'لیست سرویس‌ها', 'render_service_meta_box', 'service', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_service_meta_box');

// ایجاد متاباکس برای سرویس‌ها
function render_service_meta_box($post) {
    $services = get_post_meta($post->ID, '_service_items', true);
    wp_nonce_field('save_service_meta_box', 'service_meta_box_nonce');
    ?>
    <div id="service-items-wrapper">
        <?php if (!empty($services)) {
            foreach ($services as $index => $service) { ?>
                <div class="service-item">
                    <input type="text" name="service_items[<?php echo $index; ?>][title]" placeholder="عنوان سرویس" value="<?php echo esc_attr($service['title']); ?>">
                    <input type="text" name="service_items[<?php echo $index; ?>][price]" placeholder="قیمت (مثلاً 200000)" value="<?php echo esc_attr($service['price']); ?>">
                    <button type="button" class="remove-service">حذف</button>
                </div>
        <?php }} ?>
    </div>
    <button type="button" id="add-service">افزودن سرویس</button>

    <style>
        .service-item { margin-bottom: 15px; border: 1px solid #ddd; padding: 10px; }
        .service-item input { display: block; margin-bottom: 8px; width: 100%; }
        .remove-service { background: #e00; color: #fff; padding: 5px; border: none; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let index = document.querySelectorAll('.service-item').length;

            document.getElementById('add-service').addEventListener('click', function () {
                const wrapper = document.getElementById('service-items-wrapper');
                const item = document.createElement('div');
                item.className = 'service-item';
                item.innerHTML = `
                    <input type="text" name="service_items[${index}][title]" placeholder="عنوان سرویس">
                    <input type="text" name="service_items[${index}][price]" placeholder="قیمت (مثلاً 200,000 تومان)">
                    <button type="button" class="remove-service">حذف</button>
                `;
                wrapper.appendChild(item);
                index++;
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-service')) {
                    e.target.closest('.service-item').remove();
                }
            });
        });
    </script>
    <?php
}

// ذخیره‌سازی اطلاعات سرویس‌ها
function save_service_meta_box($post_id) {
    if (!isset($_POST['service_meta_box_nonce']) || !wp_verify_nonce($_POST['service_meta_box_nonce'], 'save_service_meta_box')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['service_items'])) {
        $services = array_map(function ($item) {
            return [
                'title' => sanitize_text_field($item['title']),
                'price' => sanitize_text_field($item['price']),
            ];
        }, $_POST['service_items']);

        update_post_meta($post_id, '_service_items', $services);
    } else {
        delete_post_meta($post_id, '_service_items');
    }
}
add_action('save_post', 'save_service_meta_box');















// عدم نمایش نامک در پست تایپ‌ها


function remove_slug_metabox_for_custom_post_types() {
    remove_meta_box('slugdiv', 'education', 'normal');
    remove_meta_box('slugdiv', 'service', 'normal');
}
add_action('add_meta_boxes', 'remove_slug_metabox_for_custom_post_types', 11);











// ۱. ثبت پست تایپ درخواست‌ها
function register_custom_post_type_requests() {
    $labels = array(
        'name' => 'درخواست‌ها',
        'singular_name' => 'درخواست',
        'menu_name' => 'درخواست‌ها',
        'add_new' => 'افزودن جدید',
        'add_new_item' => 'افزودن درخواست جدید',
        'edit_item' => 'ویرایش درخواست',
        'new_item' => 'درخواست جدید',
        'view_item' => 'مشاهده درخواست',
        'all_items' => 'همه درخواست‌ها',
        'search_items' => 'جستجوی درخواست',
        'not_found' => 'درخواستی پیدا نشد.',
        'not_found_in_trash' => 'درخواستی در زباله‌دان پیدا نشد.',
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-status',
        'supports' => array('')
    );

    register_post_type('requests', $args);
}
add_action('init', 'register_custom_post_type_requests');

// ۲. متاباکس اطلاعات درخواست
function requests_add_meta_boxes() {
    add_meta_box(
        'request_info_box',
        'اطلاعات درخواست',
        'render_request_info_box',
        'requests',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'requests_add_meta_boxes');

function render_request_info_box($post) {
   
    ?>
    <label for="request_name">نام و نام خانوادگی:</label>
    <input type="text" name="request_name" style="width: 100%;" />

    <label for="request_phone">تلفن:</label>
    <input type="text" name="request_phone" style="width: 100%;" />

    <label for="request_device">دستگاه:</label>
    <select name="request_device" style="width: 100%;">
      <option value="">نوع دستگاه</option>
      <option>یخچال</option>
      <option>لباسشویی</option>
      <option>ظرفشویی</option>
    </select>

    <label for="request_description">توضیحات:</label>
    <input type="text" name="request_description" style="width: 100%;" />

    <label for="request_city">شهر</label>
    <input type="text" name="request_city" id="request_city" value="تهران" readonly  style="width: 100%;">

    <label>وضعیت درخواست:</label>
    <select name="request_status" style="width: 100%;">
        <option value="pending">در حال بررسی</option>
        <option value="done">انجام شده</option>
        <option value="cancelled">لغو شده</option>
    </select>
    <?php
}

function save_request_meta($post_id) {
    if (array_key_exists('request_name', $_POST)) {
        update_post_meta($post_id, '_request_name', sanitize_text_field($_POST['request_name']));
    }
    if (array_key_exists('request_phone', $_POST)) {
        update_post_meta($post_id, '_request_phone', sanitize_text_field($_POST['request_phone']));
    }
    if (array_key_exists('request_device', $_POST)) {
        update_post_meta($post_id, '_request_device', sanitize_text_field($_POST['request_device']));
    }
    if (array_key_exists('request_description', $_POST)) {
        update_post_meta($post_id, '_request_description', sanitize_text_field($_POST['request_description']));
    }
    if (array_key_exists('request_city', $_POST)) {
        update_post_meta($post_id, '_request_city', sanitize_text_field($_POST['request_city']));
    }
    if (array_key_exists('request_status', $_POST)) {
        update_post_meta($post_id, '_request_status', sanitize_text_field($_POST['request_status']));
    }


}
add_action('save_post', 'save_request_meta');

// ۳. ستون‌های سفارشی در جدول مدیریت
function add_requests_columns($columns) {
    $columns['request_name'] = 'نام';
    $columns['request_phone'] = 'تلفن';
    $columns['request_device'] = 'دستگاه';
    $columns['request_city'] = 'شهر';
    $columns['request_status'] = 'وضعیت';
    $columns['request_date'] = 'تاریخ ارسال';
    return $columns;
}
add_filter('manage_requests_posts_columns', 'add_requests_columns');

function show_requests_custom_columns($column, $post_id) {
    switch ($column) {
        case 'request_name':
            echo esc_html(get_post_meta($post_id, '_request_name', true));
            break;
        case 'request_phone':
            echo esc_html(get_post_meta($post_id, '_request_phone', true));
            break;
        case 'request_device':
            echo esc_html(get_post_meta($post_id, '_request_device', true));
            break;
        case 'request_description':
            echo esc_html(get_post_meta($post_id, '_request_description', true));
            break;
        case 'request_city':
            echo esc_html(get_post_meta($post_id, '_request_city', true));
            break;
        case 'request_status':
            $status = get_post_meta($post_id, '_request_status', true);
            $label = ['pending' => 'در حال بررسی', 'done' => 'انجام شده', 'cancelled' => 'لغو شده'];
            echo esc_html($label[$status] ?? 'نامشخص');
            break;
        case 'request_date':
            echo get_the_date('Y/m/d', $post_id);
            break;
    }
}
add_action('manage_requests_posts_custom_column', 'show_requests_custom_columns', 10, 2);

// ۴. مرتب‌سازی ستون‌ها
function requests_sortable_columns($columns) {
    $columns['request_name'] = 'request_name';
    $columns['request_city'] = 'request_city';
    $columns['request_status'] = 'request_status';
    return $columns;
}
add_filter('manage_edit-requests_sortable_columns', 'requests_sortable_columns');

function requests_orderby_custom_column($query) {
    if (!is_admin()) return;

    switch ($query->get('orderby')) {
        case 'request_name':
            $query->set('meta_key', '_request_name');
            $query->set('orderby', 'meta_value');
            break;
        case 'request_city':
            $query->set('meta_key', '_request_city');
            $query->set('orderby', 'meta_value');
            break;
        case 'request_status':
            $query->set('meta_key', '_request_status');
            $query->set('orderby', 'meta_value');
            break;
    }
}
add_action('pre_get_posts', 'requests_orderby_custom_column');

// ۵. فیلتر بر اساس شهر
function filter_requests_by_city() {
    global $typenow;
    if ($typenow == 'requests') {
        $cities = get_posts(array(
            'post_type' => 'requests',
            'posts_per_page' => -1,
            'meta_key' => '_request_city',
            'fields' => 'ids',
        ));

        $unique_cities = array_unique(array_map(function($id) {
            return get_post_meta($id, '_request_city', true);
        }, $cities));

        echo '<select name="request_city_filter">';
        echo '<option value="">همه شهرها</option>';
        foreach ($unique_cities as $city) {
            if (!$city) continue;
            $selected = (isset($_GET['request_city_filter']) && $_GET['request_city_filter'] == $city) ? 'selected' : '';
            echo '<option value="' . esc_attr($city) . '" ' . $selected . '>' . esc_html($city) . '</option>';
        }
        echo '</select>';
    }
}
add_action('restrict_manage_posts', 'filter_requests_by_city');

function filter_requests_by_city_query($query) {
    global $pagenow;
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'requests' && isset($_GET['request_city_filter']) && $_GET['request_city_filter'] != '') {
        $query->set('meta_query', array(
            array(
                'key' => '_request_city',
                'value' => sanitize_text_field($_GET['request_city_filter']),
                'compare' => '='
            )
        ));
    }
}
add_action('pre_get_posts', 'filter_requests_by_city_query');

// ۶. جستجو در متاها
function extend_requests_search($query) {
    global $pagenow;
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'requests' && $query->is_search()) {
        $search_term = $query->query_vars['s'];
        $query->set('s', '');
        $query->set('meta_query', array(
            'relation' => 'OR',
            array(
                'key' => '_request_name',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_request_phone',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_request_device',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_request_description',
                'value' => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_request_city',
                'value' => $search_term,
                'compare' => 'LIKE'
            )
        ));
    }
}
add_action('pre_get_posts', 'extend_requests_search');









