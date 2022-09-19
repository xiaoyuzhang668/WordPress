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
<!-- create custom login page 1. wordpress page, page-login.php, 2. do code, 3. change redirect url after log in-->
<section class="set">
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave1.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave8.png"></div>
</section>
<section class="set set2">
  <div><img class="nolazyload" src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave1.png"></div>
  <div><img class="nolazyload" src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave8.png"></div>
</section>
<section class="set set3">
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave1.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/leave8.png"></div>
</section>
<?php if ( !is_user_logged_in() ) {
			$args = array(
			'echo' => true,
//			'redirect' => site_url( $_SERVER['REQUEST_URI'] ),
			'form_id' => 'loginform',
			'label_username' => __( 'User Name' ),
			'label_password' => __( 'Password' ),
			'label_remember' => __( 'Remember Me' ),
			'label_log_in' => __( 'Log In ' ),
			'id_username' => 'user_login',
			'id_password' => 'user_pass',
			'id_remember' => 'rememberme',
			'id_submit' => 'wp-submit',
			'remember' => true,
			'value_username' => NULL,
			'value_remember' => false,
			'placeholder_username' => __( 'Your username...' ),
			'placeholder_password' => __( 'Your password...' )
			);
			?>
		<div class="container">
			<div class="row justify-content-center">
				<fieldset class="col-lg-5 loginBox" autocomplete="on">  
					<h3 class="text-white text-center">
					go back to <a class="login-click px-3 display-5 font-weight-bold" href="<?php echo get_home_url(); ?>">HOME</a> page.
					</h3>  
					 <?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; ?>
						<?php if ( $login === "failed" ) {
							echo '<h5 class="text-white font-weight-bold login-msg"><span class="text-danger">ERROR:</span>Username and/or password is invalid, please re-enter. </h5>';
						} elseif ( $login === "empty" ) {
							echo '<h5 class="text-white font-weight-bold login-msg"><span class="text-danger">ERROR:</span>Username and/or Password is empty, please re-enter. </h5>';
						} elseif ( $login === "false" ) {
							echo '<h5 class="text-white font-weight-bold login-msg"><span class="text-danger">ERROR:</span>You are logged out.</h5>';
						} ?>
						<legend><a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/assets/image/login/user.png" alt="User Icon" class="img-fluid user mx-auto d-block w-25"></a>
						</legend>   
						<h2 class="text-center mt-5">Log In</h2>        
							<?php wp_login_form( $args ); ?>  
				</fieldset>     
			</div> 
			<!--			if user not logged in-->
			<?php } else { ?>  
			<!--				if logged in-->
					<div class="my-5 text-center log-already">
						<fieldset>
							<h3 class="my-5 text-white display-4">You are logged in already. </h3>
							<div class="text-white font-weight-bold h2">Click <a class="text-white px-3 py-2" href="<?php bloginfo('wpurl'); ?>">HERE</a> to go to homepage.
							</div>
						</fieldset>
					</div>
			<?php } ?>
			<div class="social row d-flex justify-content-center">
					<ul class="list-unstyled d-md-flex p-5 mt-2 text-white">
							<li class="mr-md-5">
								<a href="https://www.wechat.com">
									<span></span>
									<span></span>
									<span></span>
									<span></span>  
									<span><i class="fab fa-weixin" aria-hidden="true"></i></span>                        
								</a>
							</li>
							<li class="mr-md-5">
								<a href="https://www.twitter.com">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span><i class="fab fa-twitter" aria-hidden="true"></i></span>
								</a>
							</li>          
							<li class="mr-md-5">
								<a href="https://www.instagram.com">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span><i class="fab fa-instagram" aria-hidden="true"></i></span>              
								</a>
							</li>
							<li class="mr-md-5">
								<a href="https://www.facebook.com">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span><i class="fab fa-facebook-f" aria-hidden="true"></i></span>              
								</a>
							</li>
							<li>
								<a href="https://www.youtube.com">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span><i class="fab fa-youtube" aria-hidden="true"></i></span>  
								</a>
							</li>
					</ul>   
			</div>
		</div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>  
  <script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/bootstrap.js'></script> 
</body>
</html>