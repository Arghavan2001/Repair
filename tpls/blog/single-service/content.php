
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- عنوان خدمت -->
<div class="title-serves">
<h1><?php the_title(); ?></h1>
</div>





<?php
// فقط در پست تایپ 'service' اجرا بشه

$services = get_post_meta(get_the_ID(), '_service_items', true);
if (!empty($services)) {
echo '<table class="service-table">';
echo '<thead><tr><th>عنوان سرویس</th><th>قیمت</th></tr></thead>';
echo '<tbody>';
foreach ($services as $service) {
    echo '<tr>';
    echo '<td>' . esc_html($service['title']) . '</td>';
    echo '<td>' . format_price(esc_html($service['price'])) . '</td>';
    echo '</tr>';
}
echo '</tbody></table>';
}

?>
<br>


<!-- محتوای خدمت -->
<div class="education-content">
    <?php the_content(); ?>
</div>



<?php endwhile; endif; ?>

<!-- comment section -->
<?php comments_template(); ?>