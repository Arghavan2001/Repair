
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <!--favicon icon-->
    <?php if ( has_site_icon() ): ?>
    <link rel="icon" type="image/png" href="<?= get_site_icon_url() ?>">
    <?php else : ?>
    <link rel="icon" type="image/webp" href="<?= ASSETS_URL ?>img/main/logo/default-logo.webp">
    <?php endif;?>
    <?php wp_head(); ?>

    <!--web fonts-->




    <!--[if (gt IE 9) |!(IE)]><!-->
    <!--<link rel="stylesheet" href="assets/vendor/custom-nav/css/effects/fade-menu.css"/>-->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/vl-nav/css/effects/slide-menu.css"/>
    <!--<![endif]-->

    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136585988-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-136585988-1');
    </script>
</head>

<body <?php body_class('bg-gray'); ?>>
    