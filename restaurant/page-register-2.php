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
<!--main navigation-->
<div class="header w-100"></div>
  <input type="checkbox" class="sticky-top p-5 openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sticky-top pt-3 sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
   <span class="pt-3 pl-5 ml-5 lan text-white"><?php include( TEMPLATEPATH . '/includes/language.php' ); ?></span>	
	<div class="navbar-inner" id="sidebarMenu">     
				<?php
					$args = array(
								'theme_location' => 'extra3', // the one used on register_nav_menus
								'depth'             => 5,
								'container'         => 'div',
								'menu_class'        => 'navbar-default sidebarMenuInner',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker());
					wp_nav_menu( $args );
				?>     
	</div><!-- sidebarMenu -->
<div class="container">
	<div class="row pt-5 mt-5 d-flex justify-content-center">
		<?php global $wpdb, $user_ID; 
					//Check whether the user is already logged in 
		
			if ($user_ID) { ?> <!-- if not logged in -->
					<div class="text-center">
						<h3 class="my-5">You are logged in already. </h3>
						<p>Click <a class="text-danger px-3" href="<?php bloginfo('wpurl'); ?>">HERE</a> to go back to homepage. </p>
					</div>		
			<?php }  else {
					$errors = array ();
					$success = 0;
					if( $_SERVER['REQUEST_METHOD'] == 'POST' )  {							
							$txtUsername = esc_sql($_REQUEST['txtUsername']); 
							$txtEmail = esc_sql($_REQUEST['txtEmail']);
							$txtAddress = esc_sql($_REQUEST['txtAddress']);
							$txtCity = esc_sql($_REQUEST['txtCity']);
							$txtCountry = esc_sql($_REQUEST['txtCountry']);
							$txtPhone = esc_sql($_REQUEST['txtPhone']);
					  	$password = esc_sql($_REQUEST['txtPassword']);
  						$confPassword = esc_sql($_REQUEST['txtConfPassword']); 
							
							if ( empty($txtUsername) ) {
									$errors['txtUsername'] = "Username should not be blank"; 
								}	elseif ( strpos($txtUsername, ' ') !== false )	{   
									$errors['txtUsername'] = "Sorry, no spaces allowed in usernames"; 
								} elseif( username_exists( $txtUsername ) ) {  
									$errors['txtUsername'] = "Username already exists, please try another"; 
								} 
							if ( empty($txtEmail) ) {
									$errors['txtEmail'] = "Email address should not be blank.";
								} elseif ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $txtEmail) ) {
									$errors['txtEmail'] = "Email address is not valid.";		
								} elseif( email_exists( $txtEmail ) ) {  
									$errors['txtEmail'] = "This email address is already in use";  
								}  
						// Check password is valid 
						if ( empty($password) ) {
									$errors['txtPassword'] = "Password should not be blank.";
						} elseif (0 === preg_match("/.{10,}/", $_POST['txtPassword'])) {  
          				$errors['txtPassword'] = "Password must be at least 10 characters";  
						}
						if ( empty($confPassword) ) {
									$errors['txtConfPassword'] = "Confirm Password should not be blank.";
						} elseif (0 === preg_match("/.{10,}/", $_POST['txtConfPassword'])) {  
          				$errors['txtConfPassword'] = "Confirm Password must be at least 10 characters";  
						}  
        // Check password confirmation_matches  
        if(0 !== strcmp($_POST['txtPassword'], $_POST['txtConfPassword'])) {   $errors['txtConfPassword'] = "Passwords do not match";  
        }     
        // Check terms of service is agreed to  
//        if($_POST['terms'] != "Yes") {  
//            $errors['terms'] = "You must agree to Terms of Service";  
//        }  
						
				if(0 === count($errors)) {     
            $password = $_POST['txtPassword'];    
//						$random_password = wp_generate_password( 12, false ); 
            $new_user_id = wp_create_user( $txtUsername, $password, $txtEmail );     
            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
			 
						$from = get_option('admin_email'); 
						$headers = 'From: '.$from . "\r\n"; 
						$subject = "Registration successful"; 
						$message = "Registration successful.\nYour login details\nUsername: $txtUsername\nPassword: $password.  Go to website". get_home_url() ." to log in."; 
						$login = home_url( '/login/' );
						// Email password and other details to the user
						wp_mail( $txtEmail, $subject, $message, $headers ); 
						echo "	<div class='mt-5 text-center registration-success' style='line-height: 2em;'>
						<p class='mt-5'>Thank you for your registration. </p>
						<p>Your username is <span class='field-text px-3 py-2' style='background-color: rgba( 40, 167, 69, 0.9); 
						color:#fff;
						border-radius: 6px;
						border: 1px solid #fff;'>$txtUsername</span> 
						<p>email address is <span class='field-text px-3 py-2' style='background-color: rgba( 40, 167, 69, 0.9);
						color:#fff;
						border-radius: 6px;
						border: 1px solid #fff;'>$txtEmail</p>. 
						<p>Please <a href='$login'  class='text-purple'>LOG IN HERE </a>using your user name and password.</p>
						<p>Or check your email for login details including user name and password.</p></div>"; 
            $success = 1;     
            //header( 'Location:' . get_bloginfo('url') . '/login/?success=1&u=' . $username );     
				}
					}
		}; 
	?>
<?php if ( $success != 1 ) { ?>		
<?php if(get_option('users_can_register')) { ?>
<div class="container">
	<div class="row no-gutters">
		<div class="col-lg-5 align-items-center">
				<div class="bg-green shadow-sm rounded registration-container">
					<h4 class="pt-5 text-white text-center">Sign Up Instruction</h4>
					<ol class="p-5 text-white">
					<li>All fields are required.</li>
					<li>Username should not begin with a number.</li>
					<li>Username should contain at least 2 characters.</li>
					<li>Username should not contain any space.</li>
					<li>Letter, number or underscore only.</li>
					<li>Email address should be in valid format.</li>
					<li>Password should contain at least 10 characters.</li>
					<li>Password and confirm password should match.</li>
					<li>Main menu is on the top-left corner of the screen.</li>
				</ol>
				</div>
		</div>
		<div class="col-lg-7">
				<div class="p-5 rounded shadow-sm border border-success justify-content-center registration-container">
			<form method="post" name="registration" autocomplete="on" id="registrationForm"> 			
				<div class="form-group"> 
					<input type="text" id="txtUsername" name="txtUsername" placeholder="your preferred user name" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtUsername) ) echo $txtUsername; ?>">
					<?php 											
					if (! empty($txtUsername) && (username_exists($txtUsername))) {
					echo "<p class='text-danger registration-error'>Username $txtUsername already exists, please choose another one.</p>";
					$error = 1; }	
					?>		
				</div>
				<div class="form-group">
					<input type="email" id="txtEmail" name="txtEmail" placeholder="your email address" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtEmail) ) echo $txtEmail; ?>">
					<?php if (! empty($txtEmail) && email_exists($txtEmail)) {
					echo "<p class='text-danger registration-error'>Email address $txtEmail already exists, please use another one.</p>";
					$error = 1;
					}	?>
				</div>
				<div class="form-group">
					<input type="text" id="txtAddress" name="txtAddress" placeholder="your address" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtAddress) ) echo $txtAddress; ?>">
				</div>
				<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" id="txtCity" name="txtCity" placeholder="your city" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtCity) ) echo $txtCity; ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">			
								<div class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2">
									<select class="custom-select" name="txtCountry" id="txtCountry" >
										<option hidden disabled selected value="<?php if( ! empty($txtCountry) ) echo $txtCountry; ?>">your country</option>
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
							</div>							
						</div>					
				</div>				
				<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" id="txtPostalcode" name="txtPostalcode" placeholder="your postal code" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtPostalcode) ) echo $txtPostalcode; ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<input type="text" id="txtPhone" name="txtPhone" placeholder="your phone" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" value="<?php if( ! empty($txtPhone) ) echo $txtPhone; ?>">
							</div>							
						</div>					
				</div>						
				<div class="form-group">
					<input type="password" placeholder="your password" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" id="txtPassword" autocomplete="on" name="txtPassword">
				</div>
				<div class="form-group">					
					<input type="password" placeholder="confirm your password" class="rounded-pill border-top-0 border-right-0 border-left-0 form-control p-2" id="txtConfPassword" autocomplete="on" name="txtConfPassword">
				</div>
				<button type="submit" id="register-submit-btn" class="mt-5 font-weight-bold btn btn-block btn-green rounded-pill" name="submit">Sign Up</button>	
		</form>
			<p class="mt-5">Already have an account? <a href="<?php echo wp_login_url(); ?>">Login Here</a></p>		
	</div>
		</div>
	</div><!-- end row-->
</div>
	<?php } else {
			echo "Registration is currently disabled. Please try again later."; 
} 
}; ?>
	</div><!-- end row -->
</div><!-- end container -->
<?php get_footer('register'); ?>