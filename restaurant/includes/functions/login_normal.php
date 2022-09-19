<?php
/*===============================
Login form logo
=================================*/
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
/*===============================
Login form logo and background
=================================*/
function my_login_logo() { ?>
    <style type="text/css">
        .login {
          background-image: url(<?php echo get_theme_mod('login_background'); ?>);
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center; 
					background-attachment: fixed;
					background-color: rgba(156, 255, 125, 0.3);
        }
				div#login {
					padding-top: 12px;
				}			
				@media screen and (min-width: 992px) {
					div#login {
						padding-left: 25%;
						float:left;
					}			
				} 
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_theme_mod('login_image'); ?>);
          height:98px;
          width:80px;
          background-size: 80px 98px;
          background-repeat: no-repeat;
          padding-bottom: 6px;
          border-radius: 10px;  
					box-shadow: 5px 5px #efed40, 10px 10px #ff267e, 15px 15px greenyellow; 
        }
        div#login p#nav a,
        div#login p#backtoblog a {
          font-weight: bold; 
          font-size: 18px;
					color: rgba(0, 0, 0, 0.5); 
        }
				div#login p#backtoblog a {
						float: right;
				}
				div#login p#nav a:hover,
        div#login p#backtoblog a:hover {
         	color: rgba(0, 0, 0, 1);
					-webkit-transition: all 500ms ease;
					-moz-transition: all 500ms ease;
					-ms-transition: all 500ms ease;
					-o-transition: all 500ms ease;
					transition: all 500ms ease;	
        }
       	div#login form#lostpasswordform, 
				#login_error,
				.message {
          border-radius: 38px;
        }  
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
/*===============================
Customize login error message
=================================*/
function custom_login_error_message() {
	return 'User name or email address is not valid.';
}
add_filter('login_errors', 'custom_login_error_message');
/*======================================
Customize success registration message
=======================================*/
function change_tml_registration_message( $translated_text, $text, $domain ) {
	 	$website = get_home_url();
    if( $text === 'Registration complete. Please check your email.'
    ) {
        /* in the below, change the first argument to the message you want
           and the second argument to your theme's textdomain */
        $translated_text = __( 'Registration to '.$website.' is complete, please check your email which you used to register to check your detailed user name and password', 'restaurant' );
    }
    return $translated_text;
}
add_filter( 'gettext', 'change_tml_registration_message', 20, 3 );
//footer
//add_action( 'login_footer', 'your_custom_footer' );
//function your_custom_footer() {
//    // Add your content here
//    echo "<div class='text-white font-weight-bold text-center'><p>Reset Password.</p></div>";
//}
/*===============================
Go to home/admin page after log in
=================================*/
//function admin_login_redirect( $redirect_to, $request, $user ) {
//   global $user;   	
//   if( isset( $user->roles ) && is_array( $user->roles ) ) {
//      if( in_array( "administrator", $user->roles ) ) {
//      return home_url();
//      } 
//      else {
//      return home_url('wp-admin');
//      }
//   }
//   else {
//   return home_url('wp-admin');
//   }
//}
//add_filter("login_redirect", "admin_login_redirect", 10, 3);
/*===============================
Go to home page after log in
=================================*/
function login_redirect( $redirect_to, $request, $user ){
    return home_url();
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );
/*===============================
Go to home page after log out
=================================*/
//function logout_page() {
//  $login_page  = home_url( '/login/' );
//	$logout_page = home_url(); 
//  wp_redirect( $logout_page . "?login=false" );
//  exit;
//}
//add_action('wp_logout','logout_page');
/*===============================
Stay at current page after log out
=================================*/
function hungpd_dot_name_logout_redirect( $logouturl, $redir ){
return $logouturl . '&amp;redirect_to=http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
add_filter( 'logout_url', 'hungpd_dot_name_logout_redirect', 10, 2 );
/*===============================
Send email on registration
=================================*/
// function my_registration_email_alert( $user_id ) {
//	 $user    = get_userdata( $user_id );
//	 $email   = $user->user_email;
//	 $myemail ="catzhang1@hotmail.ca";
//	 $username = $user->user_login;
// 		$txtAddress = $user->txtAddress;
// 		$txtCity = $user->txtCity;
// 		$txtCountry = $user->txtCountry;
// 		$txtPostalcode = $user->txtPostalcode;
// 		$txtPhone = $user->txtPhone;
// 		$password = $user->user_pass;
//	  $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
// 		$website = 'New User Registration on test '. get_home_url(); 
//     $message = 'Notice: '.$email . ' has registered to website  "' . get_home_url(). ' ". The username is '. $username ;
//     wp_mail( $myemail, sprintf(__('[%s] New User Registration'), $blogname), $message );
// 		if ( !is_wp_error($user_id) ) {
//          // Email login details to user
//          $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
//          $messageToUser = "Welcome! Your login details are as follows:" . "\r\n";
//          $messageToUser .= sprintf(__('Username: %s'), $username) . "\r\n";
//          $messageToUser .= sprintf(__('Password: %s'), $password) . "\r\n";
//          $messageToUser .= wp_login_url() . "\r\n";
//          wp_mail($email, sprintf(__('[%s] Your username and password'), $blogname), $messageToUser);
//     }
// }
// add_action('user_register', 'my_registration_email_alert');
?>