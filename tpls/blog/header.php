<?php
$site_logo = clab_options()['site-logo'];
$site_phone = clab_options()['site-phone'];
?>
<!--header start-->
<header class="app-header transparent-header transparent-header-dark-nav">
    <div class="container-cus">
        
            <div class="row justify-content-between mar-pa-0">
             
                <!--brand start-->
              

            <div class="right col-4">

            <div class="navbar-brand ">

                        <img class="logo-dark" src="<?= isset($site_logo) ? esc_url($site_logo) : '' ?>" alt="لوگو سایت">
                    
            </div>

          

            </div>
               
            



            

                <div class=" col-8 mar-pa-0 left">


                <div class="row justify-content-end mar-pa-0">
                <div class="header-contact">
<div class="contact-item">
<i class="fas fa-phone-alt"></i> <!-- آیکون تلفن -->
<span class="contact-number"><?= $site_phone ?></span> <!-- شماره -->
</div>
<div class="contact-item"><button id="open-form" class="custom-btn btn-12"><span> بزن بریم... </span><span> ثبت درخواست </span></button></div>
</div>
        
        
     
        </div> 
        </div>

               </div>
        </div>
        </div>
    
</header>
<!--header end-->
