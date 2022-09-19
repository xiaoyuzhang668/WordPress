<?php
//Settings -> General -> Anyone can register -> Author
//update avatar image Setting -> Discussions -> avatar image update to default
//Settings -> Permalinks -> Common Setting to Post Name
/*===============================
Hook stylesheet and js files
=================================*/
/*============================
/* Format comment form */
/*===========================*/
// Hook js
function my_theme_scripts() {
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );
//text domain
add_action('after_setup_theme', 'wpdocs_theme_setup'); 
function wpdocs_theme_setup(){
    load_theme_textdomain('restaurant', get_template_directory() . '/languages');
}
//require_once( __DIR__ . '/includes/functions/advancedCustomField.php');  // if there is advanced custom field
// require_once( __DIR__ . '/includes/functions/comment_addField.php');   // if there is added comment field
require_once( __DIR__ . '/includes/functions/comment_format.php');  // standared  - conflict with woocommerce//
//require_once( __DIR__ . '/includes/functions/customPost.php');  // if there is custom post type
////require_once( __DIR__ . '/includes/functions/contactForm.php');
////require_once( __DIR__ . '/includes/functions/dashboard.php');
require_once( __DIR__ . '/includes/functions/form_validate.php');
require_once( __DIR__ . '/includes/functions/hideAdmin.php');  // standared  //
//require_once( __DIR__ . '/includes/functions/image-upload.php');
require_once( __DIR__ . '/includes/functions/linkFile.php');  // standard //
//require_once( __DIR__ . '/includes/functions/login.php');  // if want to modify login form
require_once( __DIR__ . '/includes/functions/login_normal.php');  // if want to modify login form
require_once( __DIR__ . '/includes/functions/postList.php');
////require_once( __DIR__ . '/includes/functions/postScreen.php');
////require_once( __DIR__ . '/includes/functions/readMore.php');
//require_once( __DIR__ . '/includes/functions/related-function.php');
require_once( __DIR__ . '/includes/functions/screen.php');
require_once( __DIR__ . '/includes/functions/sidebar.php');
////require_once( __DIR__ . '/includes/functions/single.php');
require_once( __DIR__ . '/includes/functions/tutorial.php');  // standard //
////require_once( __DIR__ . '/includes/functions/userProfile.php');
require_once( __DIR__ . '/includes/functions/woocommerce-cart.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-checkout.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-my-account.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-post-list.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-product-tab.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-shop.php');  // standard //
require_once( __DIR__ . '/includes/functions/woocommerce-single.php');  // standard //
/*============================
/* Add theme support */
/*===========================*/
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
/*============================
/* Add menu support */
/*===========================*/
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
?>