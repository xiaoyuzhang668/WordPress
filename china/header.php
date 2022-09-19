<!DOCTYPE html>
<!-- language attribute -->
<html <?php language_attributes(); ?>>
  <head>  
    <!-- Required meta tags, 4 meta tags first, then other meta tags following -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- logo at tab -->    
    <link rel="icon" type="image/png" href="<?php bloginfo( 'template_url' ); ?>/images/core-image/logo.png">
    <!-- favico as logo tab on the tab -->
    <link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/images/core-image/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- page scroll animation link -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- animates.css in github -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"> 
    <!-- fancy box as light box  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">     
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/lightbox.min.css">
    <!-- sets url to the theme folder: style.css --> 
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
    <!-- set youtube player plugin, css file, then jquery file and last js file.   And also add js file in the footer  -->
    <link href="<?php bloginfo( 'template_url' ); ?>/css/jquery.mb.YTPlayer.css" media="all" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.mb.YTPlayer.js"></script>
    <!-- sets site title and page title on tab: if it is front page, display description-->   
    <title>
      <?php is_front_page() ? bloginfo('description') : wp_title( '|', true,'right' ); ?> <?php bloginfo('name'); ?>  
    </title> 
    <?php
    /* Add this to support sites with sites with threaded comments enabled.*/
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    ?>
    <?php wp_head(); ?>
  </head>
<body <?php body_class(); ?>>  
<!-- Navbar 
  ======================================================= -->
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

<!-- Auto scroll social media icon 
  ======================================================= -->
<!-- <main>
  <div class="icon-bar">     
    <li><a href="https://www.linkedin.com" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li> 
    <li><a href="https://www.wechat.com" target="_blank" class="wechat"><i class="fab fa-weixin"></i></a></li>
    <li><a href="https://www.facebook.com" target="_blank" class="facebook"><i class="fab fa-facebook-square"></i></a></li>
    <li><a href="https://www.youtube.com" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a></li> 
    <li><a href="https://www.twitter.com" target="_blank" class="twitter"><i class="fab fa-twitter-square"></i></a></li>      
  </div>
</main> -->