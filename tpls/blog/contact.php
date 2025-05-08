<?php

$options = clab_options();
?>
<section class="pb-0 bg-white text-center">
    <br>
<div class="contact-wrapper">
    <h1>تماس با ما</h1>

    <div class="contact-item">
    <i class="fas fa-phone-alt contact-icon"></i> 
        <div class="contact-number"><?= esc_html($options['site-phone']) ?></div>
    </div>

    <div class="contact-item">
        <div class="contact-icon">📍</div>
        <div><?= esc_html($options['site-address']) ?></div>
    </div>

    <div class="contact-item">
        <div class="contact-icon">⏰</div>
        <div><?= esc_html($options['site-time']) ?></div>
    </div>
</div>
</section>