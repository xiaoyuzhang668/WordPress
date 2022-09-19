<!-- Side navigation go daddy-->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" id="closeMenu"><i class="fas fa-times"></i></a>
    <a class="navbar-brand font-weight-bold" href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
    <nav class="navbar-default" role="navigation"> 
      <?php
          wp_nav_menu( array(
              'theme_location'    => 'primary',
              'depth'             => 5,
              'container'         => 'div',
              'menu_class'        => 'navbar-default',
              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
              'walker'            => new WP_Bootstrap_Navwalker())
          );
      ?>              
    </nav> 
    
    <div class="mx-3 mt-5">
      <?php get_search_form(); ?>
    </div>                 
</div><!-- end of sidenav -->
<header>
  <div class="container-fluid">
      <div class="row">
          <div class="col-12">                
              <nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top" id="navbar">
                <div class="container-fluid">
                  <a class="navbar-brand text-white text-uppercase font-weight-bold" href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>          
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php 
                          $args = array(
                                  'theme_location'    => 'primary',
                                  'menu'              => 'Primary Menu',
                                  'container'         => 'div',
                                  'container_class'   => 'collapse navbar-collapse',
                                  'container_id'      => 'navbarSupportedContent',
                                  'menu_class'        => 'navbar',
                                  'menu_id'           => 'navbar',
                                  'echo'              => true,
                                  'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                  'before'            => '',
                                  'after'             => '',
                                  'link_before'       => '',
                                  'link_after'        => '',
                                  'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                  'depth'             => 5,
                                  'walker'            => new WP_Bootstrap_Navwalker()
                              );
                              wp_nav_menu ($args);                       
                          ?> 
                          <span class="d-none d-lg-block ml-auto mr-2">
                            <?php echo do_shortcode("[awesome-weather owm_city_id='6094817' location='Ottawa, CA' forecast_days='hide' hide_stats='1' custom_bg_color='transparent' background_by_weather='0' hide_attribution='1' inline_style='width:30px;height:30px;color:#000;font-size:1em;'' units='C']"); ?>
                          </span>
                          <span>
                            <?php get_search_form(); ?>
                          </span>                       
                    </div><!-- end of navbar collapse -->
                    <span class="hamburger ml-auto trans-400 d-block d-lg-none" id="openMenu">
                        <i class="fas fa-bars"></i>
                    </span> 
                </div><!-- end of container -->
              </nav> 
          </div> <!-- end of col-12 -->                             
      </div><!-- end of row --> 
  </div><!-- end of container --> 
</header>
