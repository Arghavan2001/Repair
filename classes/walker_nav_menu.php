<?php
class Menu_Walker_Nav_Menu extends Walker_Nav_Menu {
    // شروع سطح جدید از منو
    public function start_lvl( &$output, $depth = 0, $args = null ) {
       
            $output .= "\n<ul class=\"sub-menu\">\n";
        
    }

    // پایان سطح جدید از منو
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }

    // شروع هر آیتم منو
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        

        $classes = empty($item->classes) ? [] : (array) $item->classes;

        if ($item->title === 'آموزش‌ها') {
            $classes[] = 'menu-item-has-children';
        }

        
        // باز کردن تگ <li> و اضافه کردن کلاس‌ها
        $output .= '<li class="' . esc_attr(implode(' ', $classes)) . '">';

        // لینک منو
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';

        // بررسی اینکه آیا عنوان آیتم "آموزش‌ها" است
        if ($item->title === 'آموزش‌ها') {
            // دریافت پست‌ها با پست تایپ education
            $posts = get_posts([
                'post_type'      => 'education',  // پست تایپ education
                'posts_per_page' => -1,           // همه پست‌ها رو بگیر
                'fields'         => 'ids',        // فقط شناسه‌ها رو بگیر
            ]);

            // بررسی اینکه پست‌ها وجود دارند
            if (!empty($posts)) {
                // دریافت دسته‌بندی‌ها که به پست تایپ education مربوط هستند
                $education_categories = get_terms([
                    'taxonomy'   => 'category',  // استفاده از taxonomy پیش‌فرض category
                    'hide_empty' => true,         // فقط دسته‌هایی که دارای پست هستند
                    'orderby'    => 'name',      // مرتب‌سازی بر اساس نام
                    'order'      => 'ASC',       // ترتیب صعودی
                    'object_ids' => $posts,      // فیلتر بر اساس ID پست‌ها
                ]);

                // اگر دسته‌بندی‌هایی وجود داشت
                if (!empty($education_categories)) {
                    // شروع زیرمنو برای دسته‌بندی‌ها
                    $output .= '<ul class="sub-menu">';
                    foreach ($education_categories as $category) {
                        if ($category->slug === 'uncategorized') continue; // حذف دسته پیش‌فرض

                        // اضافه کردن هر دسته‌بندی به منو
                        $output .= '<li><a href="' . get_category_link($category->term_id) . '">'
                                 . esc_html($category->name) . '</a></li>';
                    }
                    $output .= '</ul>';
                }
            }
        }
    }

    // پایان هر آیتم منو
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}






class Footer_Walker_Nav_Menu extends Walker_Nav_Menu {
    // شروع سطح جدید از منو (برای زیرمنوها)
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ($depth > 0) {
            $output .= "\n<ul class=\"sub-menu\">\n";
        }
    }

    // پایان سطح جدید از منو
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }

    // شروع هر آیتم منو
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'd-block';

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes  = !empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
        $title       = apply_filters( 'the_title', $item->title, $item->ID );
        $output     .= '<a' . $attributes . '>' . esc_html( $title ) . '</a>';
    }

    // پایان هر آیتم منو
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }
}












?>