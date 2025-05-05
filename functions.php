<?php
define('CLAB_URL', get_template_directory_uri() . '/');
define('CLAB_PATH', get_template_directory() . DIRECTORY_SEPARATOR);
define('ASSETS_URL', CLAB_URL . 'assets' . '/');

add_filter('show_admin_bar', '__return_false');


function load_clab_styles() {
    wp_enqueue_style('main', ASSETS_URL . 'css/main.css');
    wp_enqueue_style('custom', ASSETS_URL . 'css/custom.css',['main']);
    wp_enqueue_script('jquery');
    wp_enqueue_script('wow', ASSETS_URL . 'vendor/wow.min.js',['jquery'], null, true);
	wp_enqueue_script('main-js', ASSETS_URL . 'js/main.js',['jquery','wow'], null, true);
	wp_enqueue_script('persianumber', ASSETS_URL . 'js/persianumber.js',['main-js'], null, true);
	wp_enqueue_script('custom-js', ASSETS_URL . 'js/custom.js',['main-js'], null, true);
    wp_localize_script('custom-js', 'my_ajax',['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'load_clab_styles');



if(!function_exists('setup')):
function setup(){
	
    add_theme_support('title_tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_image_size('thumb', 730, 830 ,true);
	register_nav_menus([
        'top' => 'منوی بالا',
        'footer_column_1' => 'فوتر - ستون اول',
        'footer_column_2' => 'فوتر - ستون دوم',
        'footer_column_3' => 'فوتر - ستون سوم'
    ]);
}
endif;
add_action('after_setup_theme', 'setup');

if(!function_exists('registerSidebar')):
function registerSidebar() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'textdomain' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
		'before_widget' => '<div class="blog-widget mb-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="mb-4">',
		'after_title'   => '</h6>',
	) );
}
endif;
add_action('widgets_init', 'registerSidebar');




function search_includes($query) {
    if ( $query->is_search() && !is_admin() && $query->is_main_query() ) {
        $post_types = get_post_types(['public' => true, 'exclude_from_search' => false]);
        $query->set('post_type', $post_types);
    }
}
add_action('pre_get_posts', 'search_includes');



function only_education_in_categories($query) {
    if (!is_admin() && $query->is_main_query() && is_category()) {
        $query->set('post_type', 'education');
    }
}
add_action('pre_get_posts', 'only_education_in_categories');   


function enqueue_clab_admin_scripts($hook) {
    // بررسی اینکه آیا در صفحه تنظیمات قالب هستیم
    if ($hook === 'appearance_page_clab-panel') {
        wp_enqueue_media(); // بارگذاری اسکریپت‌های رسانه‌ای وردپرس
        wp_enqueue_script('clab-admin-script', get_template_directory_uri() . '/js/clab-admin.js', array('jquery'), null, true); // بارگذاری اسکریپت شما
    }
}
add_action('admin_enqueue_scripts', 'enqueue_clab_admin_scripts');

function modify_archive_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (
            is_post_type_archive('education') ||
            $query->is_search() ||
            $query->is_category()
        ) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'modify_archive_query');



if(is_admin()){

    include CLAB_PATH . 'options_panel/index.php';
}

    include CLAB_PATH . 'inc/post-types.php';
    include CLAB_PATH . 'options_panel/functions.php';
	include CLAB_PATH . 'classes/walker_nav_menu.php';
	include CLAB_PATH . 'classes/jdatetime.class.php';
	include CLAB_PATH . 'inc/my-funcs.php';










































    //WordPress SMTP
	function custom_smtp_config(PHPMailer $phpmailer) {
		$phpmailer->isSMTP(); // Use SMTP
		$phpmailer->Host       = 'smtp.gmail.com'; // Gmail SMTP server
		$phpmailer->SMTPAuth   = true; // Enable SMTP authentication
		$phpmailer->Port       = 587; // Use port 587 for TLS encryption
		$phpmailer->Username   = 'alinamvar@gmail.com'; // Full Gmail address
		$phpmailer->Password   = 'iopi dvxb mqcu plxe'; // App password (not your regular Gmail password)
		$phpmailer->SMTPSecure = 'tls'; // TLS encryption
		$phpmailer->From       = 'alinamvar@gmail.com'; // Sender email address
		$phpmailer->FromName   = 'PodShop'; // Sender name

		 // Enable debugging (level 2 for verbose output)
		 $phpmailer->SMTPDebug = 2;
		 $phpmailer->Debugoutput = function($str, $level) {
			 error_log("PHPMailer: [$level] $str");
		 };
	}
	
	add_action('phpmailer_init', 'custom_smtp_config');
    
	$result = wp_mail('alinamvar8090@gmail.com', 'sub', 'message');

