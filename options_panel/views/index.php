<div class="wrap">

    <h2 class="fTitle"> تنظیمات قالب clab </h2>
    <div class="container">


        <div class="clab-settings-group">
            <form method="post" enctype="multipart/form-data">
                <label for="site-title">عنوان وبسایت</label>
                <input type="text" name="site-title" id="site-title"
                    value="<?= isset($clab_options['site-title']) ? esc_attr($clab_options['site-title']) : '' ?>">

                <label for="site-logo">لوگو سایت</label>
                <img src="<?= isset($clab_options['site-logo']) ? esc_url($clab_options['site-logo']) : '' ?>" alt="لوگو سایت">
                <input type="file" name="site-logo" id="site-logo">

                <label for="site-phone">شماره تماس</label>
                <input type="text" name="site-phone" id="site-phone"
                    value="<?= isset($clab_options['site-phone']) ? esc_attr($clab_options['site-phone']) : '' ?>">

                <label for="site-address">آدرس</label>
                <input type="text" name="site-address" id="site-address"
                    value="<?= isset($clab_options['site-address']) ? esc_attr($clab_options['site-address']) : '' ?>">

                <label for="site-time">ساعت کاری</label>
                <input type="text" name="site-time" id="site-time"
                    value="<?= isset($clab_options['site-time']) ? esc_attr($clab_options['site-time']) : '' ?>">

                <div class="clab-button-wrapper">
                    <button type="submit" name="save-options" class="button">ذخیره‌سازی</button>
                </div>
            </form>
        </div>


    </div>

</div>