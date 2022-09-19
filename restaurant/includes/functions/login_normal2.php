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
				div#login form#lostpasswordform {
					background-color: rgba(0, 0, 0, 0.2);
					border: none;
				}
				div#login form#lostpasswordform > p {
					color: #efed40;
				}
				input#user_login {
					border: none;
					background-color: transparent;
					height: 40px;
					color: #fff!important;
					font-size: 16px;
				}
				input#user_login:focus {
					outline: none;
				}
				::placeholder {
					color: rgba(255, 155, 255, 0.8);
				}
				form#lostpasswordform input[type="submit"] {
					margin-top: 18px;
					border: none;
					outline: none;
					height: 40px;
					text-shadow: none;
					color: #fff;
					font-size: 16px;
					background-color: #ff267e;
					cursor: pointer;
					border-radius: 20px ;
					display: block;
					width: 100%;
				}
				form#lostpasswordform input[type="submit"]:hover {
					background-color: #efed40;
					color: #000;
					-webkit-transition: all 500ms ease;
					-moz-transition: all 500ms ease;
					-ms-transition: all 500ms ease;
					-o-transition: all 500ms ease;
					transition: all 500ms ease;
				}       
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
/*===============================
Customize login error message
=================================*/
function custom_login_error_message() {
	return 'Please enter valid login credentials (correct user name or email address).';
}
add_filter('login_errors', 'custom_login_error_message');
//footer
//add_action( 'login_footer', 'your_custom_footer' );
//function your_custom_footer() {
//    // Add your content here
//    echo "<div class='text-white font-weight-bold text-center'><p>Reset Password.</p></div>";
//}
/*===============================
Add lost password in login form
=================================*/
add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
	return '<div class="float-left"><a class="text-white-50 h5" href=" '. wp_lostpassword_url(). '">Lost Password?</a></div>';
}
/*===============================
Add sign up in login form
=================================*/
add_action( 'login_form_bottom', 'add_user_signup_link' );
function add_user_signup_link() {
	$registration_page  = home_url( '/register-2/' );
	return '<div class="pb-2 text-center text-white">Need a new account?<a href="'. $registration_page .'" class="h5 pl-5 text-white-50"> Sign Up </a></div>';
}
/*===============================
New user registration redirect
=================================*/
//add_action( 'tml_new_user_registered', 'tml_new_user_registered' );
//function tml_new_user_registered( $user_id ) {
//    wp_set_auth_cookie( $user_id, false, is_ssl() );
//    wp_redirect( 'http://travel.cathyzhang.org' );
////    wp_redirect( admin_url( 'profile.php' ) );
//    exit;
//}
/*===============================
Go to home/admin page after log in
=================================*/
function admin_login_redirect( $redirect_to, $request, $user ) {
   global $user;   	
   if( isset( $user->roles ) && is_array( $user->roles ) ) {
      if( in_array( "administrator", $user->roles ) ) {
      return home_url();
      } 
      else {
      return home_url('wp-admin');
      }
   }
   else {
   return home_url('wp-admin');
   }
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);
/*===============================
Go to home page after log in
=================================*/
//function login_redirect( $redirect_to, $request, $user ){
//    return home_url('wp-admin');
//}
//add_filter( 'login_redirect', 'login_redirect', 10, 3 );
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
//         $user    = get_userdata( $user_id );
//         $email   = $user->user_email;
//         $myemail ="catzhang1@hotmail.ca";
//         $username = $user->user_login;
// 		$txtAddress = $user->txtAddress;
// 		$txtCity = $user->txtCity;
// 		$txtCountry = $user->txtCountry;
// 		$txtPostalcode = $user->txtPostalcode;
// 		$txtPhone = $user->txtPhone;
// 		$password = $user->user_pass;
// 		$website = 'New User Registration on '. get_home_url(); 
//     $message = 'Notice: '.$email . ' has registered to website  "' . get_home_url(). ' ". The username is '. $username ;
//     wp_mail( $myemail, $website, $message );
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