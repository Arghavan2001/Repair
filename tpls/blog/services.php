<section class="section-gap">
        <div class="title-serves">
            <h3> خدمات </h3>
        </div>
    



    <?php

    $args = array(
    'post_type' => 'service',    
    'post_status' => 'publish', // فقط پست‌های منتشر شده
);
    $service_posts = new WP_Query($args);
   // سه پست آخر رو می‌خواهیم نمایش بدیم

 
    ?>

     <div class="services">
        <?php if($service_posts -> have_posts()): ?>
            <?php while($service_posts -> have_posts()) : $service_posts -> the_post(); ?>
            
               <div class="service-item">
                    
                <a href="<?php the_permalink(); ?>" >
                <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'service-image']); ?>
                        </a>
                        <h3><a href="<?php the_permalink(); ?>" class="service-title"><?php the_title(); ?></a></h3>
                   
                        </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>   
    
    

      
        </section>





















