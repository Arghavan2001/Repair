<section class="section-gap pb-0 bg-white text-center">
<div class="container-cus sermen">
    <div class="col-6">
       
               
    <div class="right">
    <!--start responsive nav toggle button-->
    <div class="myhumburger">
        <i class="fas fa-bars"></i>
    </div>
    <!--end responsive nav toggle button-->

    <?php wp_nav_menu(['theme_location' => 'top',
                       'menu_class' => 'main-menu',
                       'walker' => new Menu_Walker_Nav_Menu(),
                       'container' => false]); ?>
</div>

               
    </div>
   
        
          <div class="col-6">
          <div class="left" id="search-box">
          <form method="get" action="<?= esc_url( home_url('/') ); ?>">
          <button class="search-icon" type="submit"><i class="fas fa-search"></i></button>
          <input type="text" placeholder="جستجو..." id="search-input"  name="s">
          </form>
</div>

          </div>
          
</div> 
</section>