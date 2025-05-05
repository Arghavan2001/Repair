
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <?php wp_head(); ?>

    <!--web fonts-->

    <!--basic styles-->
    <link href="<?= ASSETS_URL ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/custom-icon/style.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/vl-nav/css/core-menu.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/animate.min.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/owl/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= ASSETS_URL ?>vendor/owl/assets/owl.theme.default.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--custom styles-->


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
    