<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Cathy Zhang, Portfolio, Leisure, Blog, Casual, WordPress theme built from sratch">
    <meta name="author" content="Cathy Zhang Personal Template"> 
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--    fontawesome-->
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/fontawesome/css/all.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  	<link href="<?php bloginfo( 'template_url' ); ?>/assets/fontawesome/css/brands.css" rel="stylesheet">
  	<link href="<?php bloginfo( 'template_url' ); ?>/assets/fontawesome/css/solid.css" rel="stylesheet">
 		<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.css">  
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/tiny-slider.css">  
    	<!--    owl carousel and tiny slider -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/owl.carousel.min.css">   
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/owl.theme.default.min.css">    
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
<!--<div class="loader"></div>-->
<header class="container-fluid">
<!--=========================================================
top line of header
=============================================================-->
	<div class="row">
		<!--=========================================================
			phone and email
			=============================================================-->
		<div class="col-lg-4 d-none d-lg-block">
			<?php 
			$phone = get_theme_mod('my_company_phone');
			$email = get_theme_mod('my_company_email');
			$website = home_url();
			if(!empty ($phone)) {
				echo "<i class='fas fa-phone'></i>  "; echo $phone."&nbsp; &nbsp;&nbsp;&nbsp;"; }			
			if(!empty ($email)) { 
				echo "<i class='fas fa-envelope'></i>  ";  echo '<a href="mailto:'.$email.'?Subject=I have question about the website '.$website. ' ">'.$email.'</a>'; } ?>
		</div>
		<div class="col-lg-4">
			<scan class="float-right"><?php get_search_form(); ?></scan>			
						<?php
									wp_nav_menu( array(
										'theme_location'    => 'secondary',
										'depth'             => 1,
										'container'         => 'scan',
										'menu_class'        => 'pl-5',
										'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
										'walker'            => new WP_Bootstrap_Navwalker())
										);
							?>          
		</div>
			<!--=========================================================
			cart and my account
			=============================================================-->
		<div class="col-lg-4 d-flex flex-row justify-content-end">
			<?php if ( is_user_logged_in() ) { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','template'); ?>"><?php _e('My Account','template'); ?></a>
			 <?php } 
			 else { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','template'); ?>"><?php _e('Login/Register','template'); ?></a>
			 <?php } ?>
				<!--					 cart-->
			 <nav role="navigation"> 
							<?php
									wp_nav_menu( array(
										'theme_location'    => 'extra',
										'depth'             => 1,
										'container'         => 'scan',
										'menu_class'        => 'pl-5',
										'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
										'walker'            => new WP_Bootstrap_Navwalker())
										);
							?>          
				</nav>	
		</div>
	</div><!-- end row -->
			<!--======================================================= -->
			<!-- template part header-navigation
			======================================================= -->
		<?php get_template_part('template-parts/content', 'navigation'); ?>	
</header> <!-- end header container ->   				
<!-- END HEADER -->