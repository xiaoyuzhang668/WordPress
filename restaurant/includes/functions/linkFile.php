<?php
/*==============================
Include walker and customizer
================================*/
// Include custom navwalker for navigation menu
require get_template_directory().'/includes/class-wp-bootstrap-navwalker.php';
// inclusde customerizer file
require get_template_directory().'/includes/customizer.php'; // add customized fields
/*============================
/* Add bootstrap at admin*/
/*===========================*/
//add bootstrap to admin
function am_enqueue_admin_styles(){
    wp_register_style( 'am_admin_bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'am_admin_bootstrap');
}
add_action( 'admin_enqueue_scripts', 'am_enqueue_admin_styles' );
//add fontawesome js
function fontawesome_script (){
     wp_enqueue_script('fcd47938d5', 'https://kit.fontawesome.com/fcd47938d5.js');
//	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assetts/fontawesome/css/all.css' );
//	wp_enqueue_script('fontawesome_js', get_template_directory_uri() . '/assetts/fontawesome/js/all.js' );
}
add_action('admin_enqueue_scripts','fontawesome_script');
/*===============================
Disable contact form 7
=================================*/
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
/*===============================
Disable plugin 
=================================*/
add_action( 'wp_enqueue_scripts', 'sb_instagram_dequeue', 11 );
function sb_instagram_dequeue() {
	if ( ! is_page('123' ) ) {
		wp_dequeue_style( 'sb_instagram_styles' );
		wp_dequeue_script( 'sb_instagram_scripts' );
		remove_action( 'wp_head', 'sb_instagram_custom_css' ); // remove inline style
		// wp_dequeue_style('sb-font-awesome'); deactivated in plugins options
    }
}
/*===============================
Link different stylesheet
=================================*/
function wpdocs_theme_name_scripts() {
	wp_enqueue_style( 'global', get_stylesheet_uri() );
//	if ( is_front_page() ) { 
	wp_enqueue_style( 'aos_css', get_template_directory_uri() . '/css/aos.css' );
	wp_enqueue_script('aos_js', get_template_directory_uri() . '/js/aos.js' );
	wp_enqueue_style( 'lightbox_css', get_template_directory_uri()  .'/css/lightbox.min.css' );
	wp_enqueue_script('lightbox_js', get_template_directory_uri() . '/js/lightbox.min.js' );
	wp_enqueue_style( 'owl_css', get_template_directory_uri()  .'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'owl_map_css', get_template_directory_uri()  .'/css/owl.theme.default.min.css' );
	wp_enqueue_script('owl_js', get_template_directory_uri() . '/js/owl.carousel.min.js' );
	wp_enqueue_style( 'swiper_css', get_template_directory_uri()  .'/css/swiper.css' );
	wp_enqueue_script('swiper_js', get_template_directory_uri() . '/js/swiper.js' );
	wp_enqueue_style( 'tiny_css', get_template_directory_uri()  .'/css/tiny-slider.css' );
	wp_enqueue_script('tiny_js', get_template_directory_uri() . '/js/tiny-slider.js' );
	if ( is_page('login') ) {
		wp_enqueue_style( 'page-login', get_template_directory_uri() . '/css/page/page-login.css' );
	}
  if ( is_shop () ) {	
//		wp_queue_style ( 'global', get_stylesheet_uri() ); 
//		wp_enqueue_style ('shop', get_template_directory_uri(). '/css/page/shop.css');
	}
	if ( is_page('register') ) {
		wp_enqueue_style( 'page-register', get_template_directory_uri() . '/css/page/page-register.css' );
	}
	if ( is_page ('category') ) {
		wp_enqueue_style( 'category', get_template_directory_uri() . '/css/page/category.css' );
	}
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' ); 
/*===============================
Link different js
=================================*/
//add_action('wp_enqueue_scripts','Load_Template_Scripts_wpa83855');
//function Load_Template_Scripts_wpa83855(){
//    if ( is_page_template('single-product.php') ) {
//        wp_enqueue_script('single-product', '/js/single-product.js');
//    } 
//}
//	if (is_page('home')) {
//			wp_register_script('custom_script', get_template_directory_uri() . 
//			'/js/custom_script.js');
//			wp_enqueue_script('custom_script');
//	} 
/*===============================
Disable plugin 
=================================*/
// function lg_disable_cart66_plugin($plugins){
//      if(strpos($_SERVER['REQUEST_URI'], '/store/') === FALSE && !is_admin() ) {
//         $key = array_search( 'cart66/cart66.php' , $plugins );
//         if ( false !== $key ) { unset( $plugins[$key] ); }
//      }
//     return $plugins;
// }
// add_filter( 'option_active_plugins', 'lg_disable_cart66_plugin' );

//I know im late, but if anyone else has the same issue; you can alter the code above. Right now its looking for when it SHOULD be included, instead of when it shouldnt. You can set the start of the if statement to something like:
//
//if(strpos($_SERVER['REQUEST_URI'], '/your-excluded-url/') !== FALSE ...... rest-of-the-above-statement-here
//
//by setting ! in front of the !== statement, you say not(!)FALSE
?>