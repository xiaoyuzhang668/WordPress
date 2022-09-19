<?php
/*===============================
Login form logo and background
=================================*/
function my_login_logo() { ?>
    <style type="text/css">       
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
Redirect registration 
=================================*/
function my_registration_page_redirect() {
	global $pagenow;
	if ( ( strtolower($pagenow) == 'wp-login.php') && ( strtolower( $_GET['action']) == 'register' ) ) {
		wp_redirect( home_url( '/register-2/'));
	}
}
add_filter( 'init', 'my_registration_page_redirect' );
/*===============================
Customize log in
=================================*/
function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']); 
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');
/*===============================
If failed, redirect to login
=================================*/
function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' ); 
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);
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
Modify link in log in 
=================================*/
function my_log_in_out_menu_link( $items, $args ) {
   if ( $args->theme_location == 'secondary' ) {
      // if the user is logged in, add a log out link
      if ( is_user_logged_in() ) {
         $items .= '<span class="log-out"><a href="'. wp_logout_url( get_permalink() ) .'"><i class="mr-2 fas fa-user-times"></i>'. __("Log Out", "master" ) .'</a></span>';
      } else {
      // if the user is NOT logged in, add a log in link
				 $registration_page  = home_url( '/register-2/' );
         $items .= '<div class="d-flex flex-column flex-md-row"><span class="log-in pr-md-3 text-nowrap"><a href="'. wp_login_url( ) .'"><i class="mr-2 fas fa-user"></i>'. __( "Log In", "master" ) .'</a></span>';
         $items .= '<span class="registration text-nowrap pl-md-3"><a href="'. $registration_page .'"><i class="mr-2 fas fa-user-plus"></i>'.__("Sign Up", "master"). '</a></span>';
      }
   }
   return $items;
}
add_filter( 'wp_nav_menu_items', 'my_log_in_out_menu_link', 199, 2 );
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
/*===============================
Save to database
=================================*/
function my_new_user_registered( $user_id ) {
		if ( isset( $_POST['txtAddress'] ) )
			update_user_meta( $user_id, 'userAddress', $_POST['txtAddress'] );
		if ( isset( $_POST['txtCity'] ) )
			update_user_meta( $user_id, 'userCity', $_POST['txtCity'] );
		if ( isset( $_POST['txtCountry'] ) )
			update_user_meta( $user_id, 'userCountry', $_POST['txtCountry'] );
		if ( isset( $_POST['txtPostalcode'] ) )
			update_user_meta( $user_id, 'userPostalcode', $_POST['txtPostalcode'] );
		if ( isset( $_POST['txtPhone'] ) )
			update_user_meta( $user_id, 'userPhone', $_POST['txtPhone'] );
	}
add_action( 'user_register', 'my_new_user_registered' );
/*===============================
Backend registration
=================================*/
add_action( 'user_new_form', 'crf_admin_registration_form' );
function crf_admin_registration_form( $operation ) {
	if ( 'add-new-user' !== $operation ) {
		// $operation may also be 'add-existing-user'
		return;
	}
	$txtAddress = ! empty( $_POST['txtAddress'] ) ? ( $_POST['txtAddress'] ) : '';
	$txtCity = ! empty( $_POST['txtCity'] ) ? ( $_POST['txtCity'] ) : '';
	$txtCountry = ! empty( $_POST['txtCountry'] ) ? ( $_POST['txtCountry'] ) : '';
	$txtPostalcode = ! empty( $_POST['txtPostalcode'] ) ? ( $_POST['txtPostalcode'] ) : '';
	$txtPhone = ! empty( $_POST['txtPhone'] ) ? ( $_POST['txtPhone'] ) : '';	
	?>
	 <h3><?php _e("Extra user profile information - User registration data input in WordPress, not the same as WooCommerce user data", "master"); ?></h3>
    <table class="form-table">
			<tr>
					<th><label for="txtAddress"><?php _e("Address"); ?></label></th>
					<td>
							<input type="text" name="txtAddress" id="txtAddress" value="<?php echo esc_attr($txtAddress) ; ?>" class="regular-text" /><br />
							<span class="description"><?php _e("Please enter your address."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="txtCity"><?php _e("City"); ?></label></th>
					<td>
							<input type="text" name="txtCity" id="txtCity" value="<?php echo esc_attr($txtCity) ; ?>" class="regular-text" /><br />
							<span class="description"><?php _e("Please enter your city."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="txtPostalcode"><?php _e("Postal Code"); ?></label></th>
					<td>
							<input type="text" name="txtPostalcode" id="txtPostalcode" value="<?php echo esc_attr($txtPostalcode) ; ?>" class="regular-text" /><br />
							<span class="description"><?php _e("Please enter your postal code."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="txtPhone"><?php _e("Phone"); ?></label></th>
					<td>
							<input type="text" name="txtPhone" id="txtPhone" value="<?php echo esc_attr($txtPhone) ; ?>" class="regular-text" /><br />
							<span class="description"><?php _e("Please enter your phone."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="txtCountry"><?php _e("Country"); ?></label></th>
					<td>
								<div class="input-group">
									<select class="custom-select" name="txtCountry" id="txtCountry">
										<option hidden disabled selected value="<?php echo esc_attr($txtCountry) ; ?>"><?php echo esc_attr($txtCountry) ; ?></option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Åland Islands">Åland Islands</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Anguilla">Anguilla</option>
										<option value="Antarctica">Antarctica</option>
										<option value="Antigua and Barbuda">Antigua and Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
										<option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Bouvet Island">Bouvet Island</option>
										<option value="Brazil">Brazil</option>
										<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
										<option value="Brunei Darussalam">Brunei Darussalam</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Cape Verde">Cape Verde</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Christmas Island">Christmas Island</option>
										<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo">Congo</option>
										<option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Côte Ivoire">Côte Ivoire</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Curaçao">Curaçao</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands">Faroe Islands</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="French Guiana">French Guiana</option>
										<option value="French Polynesia">French Polynesia</option>
										<option value="French Southern Territories">French Southern Territories</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guernsey">Guernsey</option>
										<option value="Guinea">Guinea</option>
										<option value="Guinea-Bissau">Guinea-Bissau</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
										<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
										<option value="Honduras">Honduras</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Isle of Man">Isle of Man</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jersey">Jersey</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="South Korea">South Korea</option>
										<option value="Korea, Republic of">Korea, Republic of</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Lao People Democratic Republic">Lao People Democratic Republic</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libya">Libya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macao">Macao</option>
										<option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malawi">Malawi</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Marshall Islands">Marshall Islands</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mayotte">Mayotte</option>
										<option value="Mexico">Mexico</option>
										<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
										<option value="Moldova, Republic of">Moldova, Republic of</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Montserrat">Montserrat</option>
										<option value="Morocco">Morocco</option>
										<option value="Mozambique">Mozambique</option>
										<option value="Myanmar">Myanmar</option>
										<option value="Namibia">Namibia</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="New Caledonia">New Caledonia</option>
										<option value="New Zealand">New Zealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niger">Niger</option>
										<option value="Nigeria">Nigeria</option>
										<option value="Niue">Niue</option>
										<option value="Norfolk Island">Norfolk Island</option>
										<option value="Northern Mariana Islands">Northern Mariana Islands</option>
										<option value="Norway">Norway</option>
										<option value="Oman">Oman</option>
										<option value="Pakistan">Pakistan</option>
										<option value="Palau">Palau</option>
										<option value="Palestine, State of">Palestine, State of</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Pitcairn">Pitcairn</option>
										<option value="Poland">Poland</option>
										<option value="Portugal">Portugal</option>
										<option value="Puerto Rico">Puerto Rico</option>
										<option value="Qatar">Qatar</option>
										<option value="Réunion">Réunion</option>
										<option value="Romania">Romania</option>
										<option value="Russian Federation">Russian Federation</option>
										<option value="Rwanda">Rwanda</option>
										<option value="Saint Barthélemy">Saint Barthélemy</option>
										<option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Martin (French part)">Saint Martin (French part)</option>
										<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Sao Tome and Principe">Sao Tome and Principe</option>
										<option value="Saudi Arabia">Saudi Arabia</option>
										<option value="Senegal">Senegal</option>
										<option value="Serbia">Serbia</option>
										<option value="Seychelles">Seychelles</option>
										<option value="Sierra Leone">Sierra Leone</option>
										<option value="Singapore">Singapore</option>
										<option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon Islands">Solomon Islands</option>
										<option value="Somalia">Somalia</option>
										<option value="South Africa">South Africa</option>
										<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
										<option value="South Sudan">South Sudan</option>
										<option value="Spain">Spain</option>
										<option value="Sri Lanka">Sri Lanka</option>
										<option value="Sudan">Sudan</option>
										<option value="Suriname">Suriname</option>
										<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
										<option value="Swaziland">Swaziland</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Syrian Arab Republic">Syrian Arab Republic</option>
										<option value="Taiwan, Province of China">Taiwan, Province of China</option>
										<option value="Tajikistan">Tajikistan</option>
										<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
										<option value="Thailand">Thailand</option>
										<option value="Timor-Leste">Timor-Leste</option>
										<option value="Togo">Togo</option>
										<option value="Tokelau">Tokelau</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Tunisia">Tunisia</option>
										<option value="Turkey">Turkey</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Uganda">Uganda</option>
										<option value="Ukraine">Ukraine</option>
										<option value="United Arab Emirates">United Arab Emirates</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="United States">United States</option>
										<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
										<option value="Viet Nam">Viet Nam</option>
										<option value="Virgin Islands, British">Virgin Islands, British</option>
										<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna">Wallis and Futuna</option>
										<option value="Western Sahara">Western Sahara</option>
										<option value="Yemen">Yemen</option>
										<option value="Zambia">Zambia</option>
										<option value="Zimbabwe">Zimbabwe</option>
									</select>			
							</div>
							<span class="description"><?php _e("Please enter your country."); ?></span>
					</td>
			</tr>
    </table>
<?php }
//creaste new user using wpcf7
function create_user_from_registration($cfdata) {
    if (!isset($cfdata->posted_data) && class_exists('wpcf7-form')) {
        // Contact Form 7 version 3.9 removed $cfdata->posted_data and now
        // we have to retrieve it from an API
        $submission = wpcf7-form::get_instance();
        if ($submission) {
            $formdata = $submission->get_posted_data();
        }
    } elseif (isset($cfdata->posted_data)) {
        // For pre-3.9 versions of Contact Form 7
        $formdata = $cfdata->posted_data;
    } else {
        // We can't retrieve the form data
        return $cfdata;
    }
    // Check this is the user registration form
    if ( $cfdata->title() == 'Register') {
        $password = wp_generate_password( 12, false );
        $email = $formdata['form-email-field'];
        $name = $formdata['form-name-field'];
        // Construct a username from the user's name
        $username = strtolower(str_replace(' ', '', $name));
        $name_parts = explode(' ',$name);
        if ( !email_exists( $email ) ) {
            // Find an unused username
            $username_tocheck = $username;
            $i = 1;
            while ( username_exists( $username_tocheck ) ) {
                $username_tocheck = $username . $i++;
            }
            $username = $username_tocheck;
            // Create the user
            $userdata = array(
                'user_login' => $username,
                'user_pass' => $password,
                'user_email' => $email,
                'nickname' => reset($name_parts),
                'display_name' => $name,
                'first_name' => reset($name_parts),
                'last_name' => end($name_parts),
                'role' => 'subscriber'
            );
            $user_id = wp_insert_user( $userdata );
            if ( !is_wp_error($user_id) ) {
                // Email login details to user
                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
                $message = "Welcome! Your login details are as follows:" . "\r\n";
                $message .= sprintf(__('Username: %s'), $username) . "\r\n";
                $message .= sprintf(__('Password: %s'), $password) . "\r\n";
                $message .= wp_login_url() . "\r\n";
                wp_mail($email, sprintf(__('[%s] Your username and password'), $blogname), $message);
            }
        }
    }
    return $cfdata;
}
add_action('wpcf7_before_send_mail', 'create_user_from_registration', 1);
?>