<?php $site_img = isset(clab_options()['site-img']) && !empty(clab_options()['site-img'])? clab_options()['site-img'] : null; ?>
<!--page title start-->


<?php if ($site_img):?>
    <div style="background-image: url('<?= $site_img ?>');" class="col-md-12 d-flex flex-column justify-content-center align-items-center banner-ratio">
                      <!-- heading -->
     <h2 class="main-h2">
            <?= get_bloginfo('name') ?>
        </h2>
        <p class="main-p"><?= get_bloginfo('description'); ?></p>
    </div>

<?php else: ?>
    

    <div class="col-md-12 d-flex flex-column justify-content-center align-items-center">

<div class="context">
       
              <!-- heading -->
     <h2 class="main-h2">
            <?= get_bloginfo('name') ?>
        </h2>
        <p class="main-p"><?= get_bloginfo('description'); ?></p>


    </div>


<div class="area banner-ratio" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
    </div >
    </div>

    <?php endif; ?>
    </div >



  



<!--page title end-->