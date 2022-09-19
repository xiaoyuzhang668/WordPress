<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Required meta tags, 4 meta tags first, then other meta tags following -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- sets pingbacks address for blogging: -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- logo at tab -->    
    <link rel="icon" type="image/png" href="<?php bloginfo( 'template_url' ); ?>/images/core-image/logo.png">
    <!-- favico as logo tab on the tab -->
    <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/images/core-image/favicon.ico"> 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- page scroll animation link -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/animate.css">
    <!-- fancy box as light box  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/lightbox.min.css">
		<!--    owl carousel-->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/owl.theme.default.min.css"> 
    <!--    date and time picker-->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/datepicker.min.css"> 
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/timepicki.min.css"> 
    <!-- sets url to the theme folder: style.css --> 
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' ); ?>/css/page-login.css">
		<!--    fontawesome-->
		<script src="https://kit.fontawesome.com/fcd47938d5.js"></script>
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/modernizr.custom.79639.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.validate.min.js"></script>
		<!--		 back to previous page-->
		 <script>
			 function goBack() { window.history.back() }
		 </script>
   	<!-- sets site title and page title on tab: if it is front page, display description-->  
    <title><?php is_front_page() ? bloginfo('description') : wp_title( '|', true,'right' ); ?> <?php bloginfo('name'); ?></title>
    <?php
    /* Add this to support sites with sites with threaded comments enabled.*/
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    ?>    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- create custom login page 1. wordpress page, 2. template, 3. assign template to page, 4. do code, 5. change redirect url after log in-->
<section class="set">
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave1.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave8.png"></div>
</section>
<section class="set set2">
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave1.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave8.png"></div>
</section>
<section class="set set3">
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave1.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave2.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave3.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave4.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave5.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave6.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave7.png"></div>
  <div><img src="<?php bloginfo( 'template_url' ); ?>/images/leaves/leave8.png"></div>
</section>

<?php if ( !is_user_logged_in() ) {

$args = array(
'echo' => true,
'redirect' => home_url(), 
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
  <div class="row mt-1">
    <fieldset class="col-lg-4 offset-lg-4 loginBox">  
      <h3 class="text-white text-center">
			go back to <a class="home-link h1 px-2 text-white" href="<?php echo home_url(); ?>">HOME</a> page
			</h3>  
       <?php $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0; ?>
				<?php if ( $login === "failed" ) {
					echo '<h5 class="text-white font-weight-bold login-msg"><strong><span class="text-danger">ERROR:</span></strong> Username and/or password is invalid, please re-enter. </h5>';
				} elseif ( $login === "empty" ) {
					echo '<h5 class="text-white font-weight-bold login-msg"><strong><span class="text-danger">ERROR:</span></strong> Username and/or Password is empty, please re-enter. </h5>';
				} elseif ( $login === "false" ) {
					echo '<h5 class="text-white font-weight-bold login-msg"><strong><span class="text-danger">ERROR:</span></strong> You are logged out.</h5>';
				} ?>
        <legend><a href="<?php echo get_option('home'); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/user.png" alt="User Icon" class="img-fluid user mx-auto d-block w-25"></a>
 				</legend>   
        <h2 class="text-center mt-5">Log In</h2>        
          <?php wp_login_form( $args ); ?>  
    </fieldset>     
  </div>  
  <?php } else { ?>
  		<div class="my-5 text-center log-already">
  			<fieldset>
					<h3 class="my-5 text-white display-4">You are logged in already. </h3>
					<p class="text-white font-weight-bold h2">Click <a class="text-white px-3 py-2" href="<?php bloginfo('wpurl'); ?>">HERE</a> to go to homepage. </h3>
				</p>
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
          <li>
            <a href="https://www.twitter.com">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <span><i class="fab fa-twitter" aria-hidden="true"></i></span>
            </a>
          </li>          
          <li class="ml-md-5">
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
          <li class="ml-md-5">
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
  <script defer src="<?php bloginfo( 'template_url' ); ?>/js/owl.carousel.min.js"></script>
</body>
</html>