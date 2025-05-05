<!--footer start-->
<footer class="app-footer bg-dark pb-0 border-0 text-md-left text-center">
    <div class="container">
        <div class="row align-items-center mb-md-5 mb-3">
            <div class="col-md-4">
                <img class="pr-3 mb-md-0 mb-4" src="assets/img/logo-color.png" srcset="assets/img/logo-color@2x.png 2x"
                    alt="">
            </div>
            <div class="col-md-8">
                <span class="font-lora h5 font-weight-normal">- یک بسته ساز قدرتمند خلاق برای بوت استرپ 4</span>
            </div>
        </div>
        <div class="row">





        <?php $site_phone = clab_options()['site-phone']; ?>
        <?php $site_address = clab_options()['site-address']; ?>

            <div class="col-12 col-md-3 mb-md-0 mb-4">
                <p ><?= $site_phone ?></p>
                <p ><?= $site_address ?></p>
            </div>
            <div class="col-12 col-md-3 mb-md-0 mb-4">
                <h6 class="mb-4">حرکت کن</h6>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_column_1',
                    'container' => false,
                    'menu_class' => 'footer-link',
                    'walker' => new Footer_Walker_Nav_Menu()
                ]);
                ?>
            </div>
            <div class="col-12 col-md-3 mb-md-0 mb-4">
                <h6 class="mb-4">پلتفرم</h6>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_column_2',
                    'container' => false,
                    'menu_class' => 'footer-link',
                    'walker' => new Footer_Walker_Nav_Menu()
                ]);
                ?>
            </div>
            <div class="col-12 col-md-3 mb-md-0 mb-4">
                <h6 class="mb-4">جامعه</h6>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_column_3',
                    'container' => false,
                    'menu_class' => 'footer-link',
                    'walker' => new Footer_Walker_Nav_Menu()
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="app-secondary-footer mt-md-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <span class="copyright">  تمام حقوق برای <?= clab_options()['site-title'] ?> محفوظ است.</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer end-->
<script src="<?= ASSETS_URL ?>vendor/jquery/jquery.min.js"></script>
<?= get_template_part('tpls/blog/form'); ?>
<?php wp_footer(); ?>
<!--basic scripts-->

<script src="<?= ASSETS_URL ?>vendor/popper.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/vl-nav/js/vl-menu.js"></script>
<script src="<?= ASSETS_URL ?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/owl/owl.carousel.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/jquery.animateNumber.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/jquery.countdown.min.js"></script>
<script src="<?= ASSETS_URL ?>vendor/typist.js"></script>
<script src="<?= ASSETS_URL ?>vendor/jquery.isotope.js"></script>
<script src="<?= ASSETS_URL ?>vendor/imagesloaded.js"></script>
<script src="<?= ASSETS_URL ?>vendor/visible.js"></script>




</body>

</html>