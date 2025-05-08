<?php 
add_action('admin_menu', 'add_clab_panel');
add_action('admin_enqueue_scripts', 'clab_panel_assets');
add_action('save-clab-options', 'save_clab_options');


function add_clab_panel(){
    add_theme_page('تنظیمات قالب', 'تنظیمات قالب Repair', 'manage_options', 'clab-panel', 'show_clab_panel');
}

function show_clab_panel(){
   

    if(isset($_POST['save-options'])){
        do_action('save-clab-options');
    }

 
    $clab_options = get_option('clab-options', []);
    
    include CLAB_PATH.'options_panel/views/index.php';

}

function save_clab_options(){
    $clab_options = get_option('clab-options', []);
    
       
            $clab_options= [
               
                'site-phone' => (isset($_POST['site-phone']) && !empty($_POST['site-phone'])) ? sanitize_text_field($_POST['site-phone']) : 'شماره شما',
                'site-address' => (isset($_POST['site-address']) && !empty($_POST['site-address'])) ? sanitize_text_field($_POST['site-address']) : 'آدرس شما',
                'site-time' => (isset($_POST['site-time']) && !empty($_POST['site-time'])) ? sanitize_text_field($_POST['site-time']) : 'ساعت کار شما'
        
            ];
      
            // چک کردن آپلود عکس
    if ( isset( $_FILES['site-img'] ) && ! empty( $_FILES['site-img']['name'] ) ) {
        // تنظیمات آپلود
        $uploaded_file = $_FILES['site-img'];

        // بارگذاری توابع مورد نیاز وردپرس برای آپلود فایل
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

        // تنظیمات آپلود
        $upload_overrides = array( 'test_form' => false );

        // آپلود فایل
        $movefile = wp_handle_upload( $uploaded_file, $upload_overrides );



        if ( $movefile && ! isset( $movefile['error'] ) ) {
            // فایل با موفقیت آپلود شد، آدرس فایل ذخیره شده رو دریافت می‌کنیم
            $logo_url = $movefile['url'];

            // ذخیره آدرس فایل در تنظیمات
            $clab_options['site-img'] = $logo_url;
        } else {
            // در صورت خطا
            echo 'خطا در آپلود فایل: ' . $movefile['error'];
        }
    }

    // اگر کاربر گزینه حذف تصویر رو انتخاب کرده بود
if ( isset($_POST['delete-site-img']) && $_POST['delete-site-img'] == '1' ) {
    unset($clab_options['site-img']);
}

        
    update_option('clab-options', $clab_options);
    
}

function clab_panel_assets(){

    wp_register_style('clab_panel_style', CLAB_URL . 'options_panel/assets/css/options-panel.css');
    wp_register_script('clab_panel_script', CLAB_URL . 'options_panel/assets/js/options-panel.js');
    wp_enqueue_style('clab_panel_style');
    wp_enqueue_script('clab_panel_script');
}