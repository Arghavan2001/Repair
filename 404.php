<?php get_header(); ?>

<div class="container error-page">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 text-center">
            <div class="error-content">
                <h1 class="error-title">404</h1>
                <p class="error-message">صفحه‌ای که دنبالش می‌گشتید پیدا نشد!</p>
                <a href="<?= home_url(); ?>" class="btn btn-primary error-btn">بازگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>