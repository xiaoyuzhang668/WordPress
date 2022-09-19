<?php
/*============================
/* Add New Fields to default */
/*===========================*/
function add_comment_fields($fields) { 
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );   	
		$fields['phone'] = '<div class="row mb-3">
		<div class="col-md-6 mb-3">
		<span class="comment-form-phone">
		<label for="phone">' . __( 'Phone', 'framework' ) . '<span class="text-danger"> * </span></label>
		<input id="phone" name="phone" placeholder="' . esc_attr__( "Your phone", "framework" ) . '" class="w-100 border-top-0 border-right-0 border-left-0 p-2" type="text" tabindex="3" ' . $aria_req . ' />
		</span>
		</div>';	
	
		$fields['country'] = '
		<div class="col-md-6 mb-3">
		<span class="comment-form-country">
		<label for="country">' . __( 'Country/Region', 'framework' ) . '<span class="text-danger"> * </span></label>		
 		<div>
			<select class="custom-select w-100 border-top-0 border-right-0 border-left-0 p-2" id="country" name="country" tabindex="4">
				<option hidden disabled selected value>Your country</option>
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
		</span>
		</div>
		</div>	
		';	
		return $fields; 
}
add_filter('comment_form_default_fields','add_comment_fields');
/*====================================================
/* Add New Fields after default above comment */
/*====================================================*/
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );
function additional_fields () {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' ); 	
	echo '<div class="row mb-3">
	<div class="col-12"><span class="comment-form-rating text-dark">
	<label for="rating pr-3">'. __('Rate this post  ', 'framework') . '</label>
  <span class="commentratingbox">';
    for( $i=1; $i <= 5; $i++ )
    echo '<span class="mx-2 commentrating"><input tabindex="5" type="radio" name="rating" id="rating" value="'. $i .'"/>  '. $i .' </span>';
  	echo'</span>
		</div>
		</div>';
	
  echo '<div class="row mb-3">
	<div class="col-12">
	<span class="comment-form-title">
	<label for="title">' . __( 'Comment Title', 'framework' ) . '<span class="text-danger"> * </span></label>
	<input id="title" name="title" placeholder="' . esc_attr__( "Comment Title", "framework" ) . '" class="w-100 border-top-0 border-right-0 border-left-0 p-2" type="text" tabindex="6" ' . $aria_req . ' />
	</span>
	</div>
	</div>'; 
}
/*====================================================
/* Save new fields  */
/*====================================================*/
add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') ){
	$phone = wp_filter_nohtml_kses($_POST['phone']);
	add_comment_meta( $comment_id, 'phone', $_POST['phone'] );
	}

	if ( ( isset( $_POST['country'] ) ) && ( $_POST['country'] != '') ){
	$country = wp_filter_nohtml_kses($_POST['country']);
	add_comment_meta( $comment_id, 'country', $_POST['country'] );
	}
	
	global $current_user; wp_get_current_user(); 
	if ( is_user_logged_in() ) { 
 	$country =  $current_user->userCountry;
 	$phone =  $current_user->userPhone;
 	$url =  $current_user->user_url;
	add_comment_meta ( $comment_id, 'country', $country);
	add_comment_meta ( $comment_id, 'phone', $phone);
	add_comment_meta ( $comment_id, 'url', $url);
	}

	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ){
  $rating = wp_filter_nohtml_kses($_POST['rating']);
  add_comment_meta( $comment_id, 'rating', $_POST['rating']);
	}
	
  if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '') ){
	$title = wp_filter_nohtml_kses($_POST['title']);
	add_comment_meta( $comment_id, 'title', $_POST['title'] );
	} 
}
/*====================================================
/* Add answers to comment text - display */
/*====================================================*/
add_filter( 'comment_text', 'modify_comment');
function modify_comment( $text ){
//  $plugin_url_path = WP_PLUGIN_URL;
  $plugin_url_path = get_bloginfo('template_directory');
	global $current_user; wp_get_current_user();	
	
  if( $commenttitle = get_comment_meta( get_comment_ID(), 'title', true ) ) {
    $commenttitle = '<strong>' . esc_attr( $commenttitle ) . '</strong><br>';
    $text = $commenttitle . $text;
  } 
	
  if( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
    $commentrating = '<p class="comment-rating d-flex align-items-center small pt-3">Rating:  <img src="'. $plugin_url_path .'/assets/image/core-image/'. $commentrating . 'star.gif" class="mx-2"><strong>'. $commentrating . ' / 5 </strong>';
    $text = $text . $commentrating;
  }
	
	if( ($country = get_comment_meta( get_comment_ID(), 'country', true ) ) && ( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true ) )) {
    $country = '&nbsp; from &nbsp; <strong>' . esc_attr( $country ) . '</strong></p><br>';
    $text =  $text . $country;
		return $text;
	} else {
    return $text;
  } 
}
//// Add the filter to check if the comment meta data has been filled or not
//
//add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
//function verify_comment_meta_data( $commentdata ) {
//	if ( ! isset( $_POST['rating'] ) )
//	wp_die( __( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with rating.' ) );
//	return $commentdata;
//}
/*====================================================
/* Add edit button to the screen display */
/*====================================================*/ 
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'title', __( 'Comment Metadata - Extended Comment' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}
function extend_comment_meta_box ( $comment ) {
    $phone = get_comment_meta( $comment->comment_ID, 'phone', true );
    $country = get_comment_meta( $comment->comment_ID, 'country', true );
		$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    $title = get_comment_meta( $comment->comment_ID, 'title', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <div class="container">
    	<div class="row">
    		<div class="col-md-6">
					<p>
						<label for="phone"><?php _e( 'Phone' ); ?></label>
						<input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
					</p>
				</div>
    		<div class="col-md-6">
					<p>
							<label for="title"><?php _e( 'Comment Title' ); ?></label>
							<input type="text" name="title" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
					</p>
    		</div>
    		<div class="col-md-6">
    			<p>
							<label for="country"><?php _e( 'Country' ); ?></label>
									<select class="custom-select" name="country" id="country">
										<option value="Afghanistan" <?php echo ($country == "Afghanistan")?  'selected="selected"' : '' ?>>Afghanistan</option>
										<option value="Åland Islands" <?php echo ($country == "Åland Islands")?  'selected="selected"' : '' ?>>Åland Islands</option>
										<option value="Albania" <?php echo ($country == "Albania")?  'selected="selected"' : '' ?>>Albania</option>
										<option value="Algeria" <?php echo ($country == "Algeria")?  'selected="selected"' : '' ?>>Algeria</option>
										<option value="American Samoa" <?php echo ($country == "American Samoa")?  'selected="selected"' : '' ?>>American Samoa</option>
										<option value="Andorra" <?php echo ($country == "Andorra")?  'selected="selected"' : '' ?>>Andorra</option>
										<option value="Angola" <?php echo ($country == "Angola")?  'selected="selected"' : '' ?>>Angola</option>
										<option value="Anguilla" <?php echo ($country == "Anguilla")?  'selected="selected"' : '' ?>>Anguilla</option>
										<option value="Antarctica" <?php echo ($country == "Antarctica")?  'selected="selected"' : '' ?>>Antarctica</option>
										<option value="Antigua and Barbuda" <?php echo ($country == "Antigua and Barbuda")?  'selected="selected"' : '' ?>>Antigua and Barbuda</option>
										<option value="Argentina" <?php echo ($country == "Argentina")?  'selected="selected"' : '' ?>>Argentina</option>
										<option value="Armenia" <?php echo ($country == "Armenia")?  'selected="selected"' : '' ?>>Armenia</option>
										<option value="Aruba" <?php echo ($country == "Aruba")?  'selected="selected"' : '' ?>>Aruba</option>
										<option value="Australia" <?php echo ($country == "Australia")?  'selected="selected"' : '' ?>>Australia</option>
										<option value="Austria" <?php echo ($country == "Austria")?  'selected="selected"' : '' ?>>Austria</option>
										<option value="Azerbaijan" <?php echo ($country == "Azerbaijan")?  'selected="selected"' : '' ?>>Azerbaijan</option>
										<option value="Bahrain" <?php echo ($country == "Bahrain")?  'selected="selected"' : '' ?>>Bahrain</option>
										<option value="Bahamas" <?php echo ($country == "Bahamas")?  'selected="selected"' : '' ?>>Bahamas</option>
										<option value="Bangladesh" <?php echo ($country == "Bangladesh")?  'selected="selected"' : '' ?>>Bangladesh</option>
										<option value="Barbados" <?php echo ($country == "Barbados")?  'selected="selected"' : '' ?>>Barbados</option>
										<option value="Belarus" <?php echo ($country == "Belarus")?  'selected="selected"' : '' ?>>Belarus</option>
										<option value="Belgium" <?php echo ($country == "Belgium")?  'selected="selected"' : '' ?>>Belgium</option>
										<option value="Belize" <?php echo ($country == "Belize")?  'selected="selected"' : '' ?>>Belize</option>
										<option value="Benin" <?php echo ($country == "Benin")?  'selected="selected"' : '' ?>>Benin</option>
										<option value="Bermuda" <?php echo ($country == "Bermuda")?  'selected="selected"' : '' ?>>Bermuda</option>
										<option value="Bhutan" <?php echo ($country == "Bhutan")?  'selected="selected"' : '' ?>>Bhutan</option>
										<option value="Bolivia, Plurinational State of" <?php echo ($country == "Bolivia, Plurinational State of")?  'selected="selected"' : '' ?>>Bolivia, Plurinational State of</option>
										<option value="Bonaire, Sint Eustatius and Saba" <?php echo ($country == "Bonaire, Sint Eustatius and Saba")?  'selected="selected"' : '' ?>>Bonaire, Sint Eustatius and Saba</option>
										<option value="Bosnia and Herzegovina" <?php echo ($country == "Bosnia and Herzegovina")?  'selected="selected"' : '' ?>>Bosnia and Herzegovina</option>
										<option value="Botswana" <?php echo ($country == "Botswana")?  'selected="selected"' : '' ?>>Botswana</option>
										<option value="Bouvet Island" <?php echo ($country == "Bouvet Island")?  'selected="selected"' : '' ?>>Bouvet Island</option>
										<option value="Brazil" <?php echo ($country == "Brazil")?  'selected="selected"' : '' ?>>Brazil</option>
										<option value="British Indian Ocean Territory" <?php echo ($country == "British Indian Ocean Territory")?  'selected="selected"' : '' ?>>British Indian Ocean Territory</option>
										<option value="Brunei Darussalam" <?php echo ($country == "Brunei Darussalam")?  'selected="selected"' : '' ?>>Brunei Darussalam</option>
										<option value="Bulgaria" <?php echo ($country == "Bulgaria")?  'selected="selected"' : '' ?>>Bulgaria</option>
										<option value="Burkina Faso" <?php echo ($country == "Burkina Faso")?  'selected="selected"' : '' ?>>Burkina Faso</option>
										<option value="Burundi" <?php echo ($country == "Burundi")?  'selected="selected"' : '' ?>>Burundi</option>
										<option value="Cambodia" <?php echo ($country == "Cambodia")?  'selected="selected"' : '' ?>>Cambodia</option>
										<option value="Cameroon" <?php echo ($country == "Cameroon")?  'selected="selected"' : '' ?>>Cameroon</option>
										<option value="Canada" <?php echo ($country == "Canada")?  'selected="selected"' : '' ?>>Canada</option>
										<option value="Cape Verde" <?php echo ($country == "Cape Verde")?  'selected="selected"' : '' ?>>Cape Verde</option>
										<option value="Cayman Islands" <?php echo ($country == "Cayman Islands")?  'selected="selected"' : '' ?>>Cayman Islands</option>
										<option value="Central African Republic" <?php echo ($country == "Central African Republic")?  'selected="selected"' : '' ?>>Central African Republic</option>
										<option value="Chad" <?php echo ($country == "Chad")?  'selected="selected"' : '' ?>>Chad</option>
										<option value="Chile" <?php echo ($country == "Chile")?  'selected="selected"' : '' ?>>Chile</option>
										<option value="China" <?php echo ($country == "China")?  'selected="selected"' : '' ?>>China</option>
										<option value="Christmas Island" <?php echo ($country == "Christmas Island")?  'selected="selected"' : '' ?>>Christmas Island</option>
										<option value="Cocos (Keeling) Islands" <?php echo ($country == "Cocos (Keeling) Islands")?  'selected="selected"' : '' ?>>Cocos (Keeling) Islands</option>
										<option value="Colombia" <?php echo ($country == "Colombia")?  'selected="selected"' : '' ?>>Colombia</option>
										<option value="Comoros" <?php echo ($country == "Comoros")?  'selected="selected"' : '' ?>>Comoros</option>
										<option value="Congo" <?php echo ($country == "Congo")?  'selected="selected"' : '' ?>>Congo</option>
										<option value="Congo, the Democratic Republic of the" <?php echo ($country == "Congo, the Democratic Republic of the")?  'selected="selected"' : '' ?>>Congo, the Democratic Republic of the</option>
										<option value="Cook Islands" <?php echo ($country == "Cook Islands")?  'selected="selected"' : '' ?>>Cook Islands</option>
										<option value="Costa Rica" <?php echo ($country == "Costa Rica")?  'selected="selected"' : '' ?>>Costa Rica</option>
										<option value="Côte d'Ivoire" <?php echo ($country == "Côte d'Ivoire")?  'selected="selected"' : '' ?>>Côte d'Ivoire</option>
										<option value="Croatia" <?php echo ($country == "Croatia")?  'selected="selected"' : '' ?>>Croatia</option>
										<option value="Cuba" <?php echo ($country == "Cuba")?  'selected="selected"' : '' ?>>Cuba</option>
										<option value="Curaçao" <?php echo ($country == "Curaçao")?  'selected="selected"' : '' ?>>Curaçao</option>
										<option value="Cyprus" <?php echo ($country == "Cyprus")?  'selected="selected"' : '' ?>>Cyprus</option>
										<option value="Czech Republic" <?php echo ($country == "Czech Republic")?  'selected="selected"' : '' ?>>Czech Republic</option>
										<option value="Denmark" <?php echo ($country == "Denmark")?  'selected="selected"' : '' ?>>Denmark</option>
										<option value="Djibouti" <?php echo ($country == "Djibouti")?  'selected="selected"' : '' ?>>Djibouti</option>
										<option value="Dominica" <?php echo ($country == "Dominica")?  'selected="selected"' : '' ?>>Dominica</option>
										<option value="Dominican Republic" <?php echo ($country == "Dominican Republic")?  'selected="selected"' : '' ?>>Dominican Republic</option>
										<option value="Ecuador" <?php echo ($country == "Ecuador")?  'selected="selected"' : '' ?>>Ecuador</option>
										<option value="Egypt" <?php echo ($country == "Egypt")?  'selected="selected"' : '' ?>>Egypt</option>
										<option value="El Salvador" <?php echo ($country == "El Salvador")?  'selected="selected"' : '' ?>>El Salvador</option>
										<option value="Equatorial Guinea" <?php echo ($country == "Equatorial Guinea")?  'selected="selected"' : '' ?>>Equatorial Guinea</option>
										<option value="Eritrea" <?php echo ($country == "Eritrea")?  'selected="selected"' : '' ?>>Eritrea</option>
										<option value="Estonia" <?php echo ($country == "Estonia")?  'selected="selected"' : '' ?>>Estonia</option>
										<option value="Ethiopia" <?php echo ($country == "Ethiopia")?  'selected="selected"' : '' ?>>Ethiopia</option>
										<option value="Falkland Islands (Malvinas)" <?php echo ($country == "Falkland Islands (Malvinas)")?  'selected="selected"' : '' ?>>Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands" <?php echo ($country == "Faroe Islands")?  'selected="selected"' : '' ?>>Faroe Islands</option>
										<option value="Fiji" <?php echo ($country == "Fiji")?  'selected="selected"' : '' ?>>Fiji</option>
										<option value="Finland" <?php echo ($country == "Finland")?  'selected="selected"' : '' ?>>Finland</option>
										<option value="France" <?php echo ($country == "France")?  'selected="selected"' : '' ?>>France</option>
										<option value="French Guiana" <?php echo ($country == "French Guiana")?  'selected="selected"' : '' ?>>French Guiana</option>
										<option value="French Polynesia" <?php echo ($country == "French Polynesia")?  'selected="selected"' : '' ?>>French Polynesia</option>
										<option value="French Southern Territories" <?php echo ($country == "French Southern Territories")?  'selected="selected"' : '' ?>>French Southern Territories</option>
										<option value="Gabon" <?php echo ($country == "Gabon")?  'selected="selected"' : '' ?>>Gabon</option>
										<option value="Gambia" <?php echo ($country == "Gambia")?  'selected="selected"' : '' ?>>Gambia</option>
										<option value="Georgia" <?php echo ($country == "Georgia")?  'selected="selected"' : '' ?>>Georgia</option>
										<option value="Germany" <?php echo ($country == "Germany")?  'selected="selected"' : '' ?>>Germany</option>
										<option value="Ghana" <?php echo ($country == "Ghana")?  'selected="selected"' : '' ?>>Ghana</option>
										<option value="Gibraltar" <?php echo ($country == "Gibraltar")?  'selected="selected"' : '' ?>>Gibraltar</option>
										<option value="Greece" <?php echo ($country == "Greece")?  'selected="selected"' : '' ?>>Greece</option>
										<option value="Greenland" <?php echo ($country == "Greenland")?  'selected="selected"' : '' ?>>Greenland</option>
										<option value="Grenada" <?php echo ($country == "Grenada")?  'selected="selected"' : '' ?>>Grenada</option>
										<option value="Guadeloupe" <?php echo ($country == "Guadeloupe")?  'selected="selected"' : '' ?>>Guadeloupe</option>
										<option value="Guam" <?php echo ($country == "Guam")?  'selected="selected"' : '' ?>>Guam</option>
										<option value="Guatemala" <?php echo ($country == "Guatemala")?  'selected="selected"' : '' ?>>Guatemala</option>
										<option value="Guernsey" <?php echo ($country == "Guernsey")?  'selected="selected"' : '' ?>>Guernsey</option>
										<option value="Guinea" <?php echo ($country == "Guinea")?  'selected="selected"' : '' ?>>Guinea</option>
										<option value="Guinea-Bissau" <?php echo ($country == "Guinea-Bissau")?  'selected="selected"' : '' ?>>Guinea-Bissau</option>
										<option value="Guyana" <?php echo ($country == "Guyana")?  'selected="selected"' : '' ?>>Guyana</option>
										<option value="Haiti" <?php echo ($country == "Haiti")?  'selected="selected"' : '' ?>>Haiti</option>
										<option value="Heard Island and McDonald Islands" <?php echo ($country == "Heard Island and McDonald Islands")?  'selected="selected"' : '' ?>>Heard Island and McDonald Islands</option>
										<option value="Holy See (Vatican City State)" <?php echo ($country == "Holy See (Vatican City State)")?  'selected="selected"' : '' ?>>Holy See (Vatican City State)</option>
										<option value="Honduras" <?php echo ($country == "Honduras")?  'selected="selected"' : '' ?>>Honduras</option>
										<option value="Hong Kong" <?php echo ($country == "Hong Kong")?  'selected="selected"' : '' ?>>Hong Kong</option>
										<option value="Hungary" <?php echo ($country == "Hungary")?  'selected="selected"' : '' ?>>Hungary</option>
										<option value="Iceland" <?php echo ($country == "Iceland")?  'selected="selected"' : '' ?>>Iceland</option>
										<option value="India" <?php echo ($country == "India")?  'selected="selected"' : '' ?>>India</option>
										<option value="Indonesia" <?php echo ($country == "Indonesia")?  'selected="selected"' : '' ?>>Indonesia</option>
										<option value="Iran, Islamic Republic of" <?php echo ($country == "Iran, Islamic Republic of")?  'selected="selected"' : '' ?>>Iran, Islamic Republic of</option>
										<option value="Iraq" <?php echo ($country == "Iraq")?  'selected="selected"' : '' ?>>Iraq</option>
										<option value="Ireland" <?php echo ($country == "Ireland")?  'selected="selected"' : '' ?>>Ireland</option>
										<option value="Isle of Man" <?php echo ($country == "Isle of Man")?  'selected="selected"' : '' ?>>Isle of Man</option>
										<option value="Israel" <?php echo ($country == "Israel")?  'selected="selected"' : '' ?>>Israel</option>
										<option value="Italy" <?php echo ($country == "Italy")?  'selected="selected"' : '' ?>>Italy</option>
										<option value="Jamaica" <?php echo ($country == "Jamaica")?  'selected="selected"' : '' ?>>Jamaica</option>
										<option value="Japan" <?php echo ($country == "Japan")?  'selected="selected"' : '' ?>>Japan</option>
										<option value="Jersey" <?php echo ($country == "Jersey")?  'selected="selected"' : '' ?>>Jersey</option>
										<option value="Jordan" <?php echo ($country == "Jordan")?  'selected="selected"' : '' ?>>Jordan</option>
										<option value="Kazakhstan" <?php echo ($country == "Kazakhstan")?  'selected="selected"' : '' ?>>Kazakhstan</option>
										<option value="Kenya" <?php echo ($country == "Kenya")?  'selected="selected"' : '' ?>>Kenya</option>
										<option value="Kiribati" <?php echo ($country == "Kiribati")?  'selected="selected"' : '' ?>>Kiribati</option>
										<option value="Korea, Democratic People's Republic of" <?php echo ($country == "Korea, Democratic People's Republic of")?  'selected="selected"' : '' ?>>Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of" <?php echo ($country == "Korea, Republic of")?  'selected="selected"' : '' ?>>Korea, Republic of</option>
										<option value="Kuwait" <?php echo ($country == "Kuwait")?  'selected="selected"' : '' ?>>Kuwait</option>
										<option value="Kyrgyzstan" <?php echo ($country == "Kyrgyzstan")?  'selected="selected"' : '' ?>>Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic" <?php echo ($country == "Lao People's Democratic Republic")?  'selected="selected"' : '' ?>>Lao People's Democratic Republic</option>
										<option value="Latvia" <?php echo ($country == "Latvia")?  'selected="selected"' : '' ?>>Latvia</option>
										<option value="Lebanon" <?php echo ($country == "Lebanon")?  'selected="selected"' : '' ?>>Lebanon</option>
										<option value="Lesotho" <?php echo ($country == "Lesotho")?  'selected="selected"' : '' ?>>Lesotho</option>
										<option value="Liberia" <?php echo ($country == "Liberia")?  'selected="selected"' : '' ?>>Liberia</option>
										<option value="Libya" <?php echo ($country == "Libya")?  'selected="selected"' : '' ?>>Libya</option>
										<option value="Liechtenstein" <?php echo ($country == "Liechtenstein")?  'selected="selected"' : '' ?>>Liechtenstein</option>
										<option value="Lithuania" <?php echo ($country == "Lithuania")?  'selected="selected"' : '' ?>>Lithuania</option>
										<option value="Luxembourg" <?php echo ($country == "Luxembourg")?  'selected="selected"' : '' ?>>Luxembourg</option>
										<option value="Macao" <?php echo ($country == "Macao")?  'selected="selected"' : '' ?>>Macao</option>
										<option value="Macedonia, the Former Yugoslav Republic of" <?php echo ($country == "Macedonia, the Former Yugoslav Republic of")?  'selected="selected"' : '' ?>>Macedonia, the Former Yugoslav Republic of</option>
										<option value="Madagascar" <?php echo ($country == "Madagascar")?  'selected="selected"' : '' ?>>Madagascar</option>
										<option value="Malawi" <?php echo ($country == "Malawi")?  'selected="selected"' : '' ?>>Malawi</option>
										<option value="Malaysia" <?php echo ($country == "Malaysia")?  'selected="selected"' : '' ?>>Malaysia</option>
										<option value="Maldives" <?php echo ($country == "Maldives")?  'selected="selected"' : '' ?>>Maldives</option>
										<option value="Mali" <?php echo ($country == "Mali")?  'selected="selected"' : '' ?>>Mali</option>
										<option value="Malta" <?php echo ($country == "Malta")?  'selected="selected"' : '' ?>>Malta</option>
										<option value="Marshall Islands" <?php echo ($country == "Marshall Islands")?  'selected="selected"' : '' ?>>Marshall Islands</option>
										<option value="Martinique" <?php echo ($country == "Martinique")?  'selected="selected"' : '' ?>>Martinique</option>
										<option value="Mauritania" <?php echo ($country == "Mauritania")?  'selected="selected"' : '' ?>>Mauritania</option>
										<option value="Mauritius" <?php echo ($country == "Mauritius")?  'selected="selected"' : '' ?>>Mauritius</option>
										<option value="Mayotte" <?php echo ($country == "Mayotte")?  'selected="selected"' : '' ?>>Mayotte</option>
										<option value="Mexico" <?php echo ($country == "Mexico")?  'selected="selected"' : '' ?>>Mexico</option>
										<option value="Micronesia, Federated States of" <?php echo ($country == "Micronesia, Federated States of")?  'selected="selected"' : '' ?>>Micronesia, Federated States of</option>
										<option value="Moldova, Republic of" <?php echo ($country == "Moldova, Republic of")?  'selected="selected"' : '' ?>>Moldova, Republic of</option>
										<option value="Monaco" <?php echo ($country == "Monaco")?  'selected="selected"' : '' ?>>Monaco</option>
										<option value="Mongolia" <?php echo ($country == "Mongolia")?  'selected="selected"' : '' ?>>Mongolia</option>
										<option value="Montenegro" <?php echo ($country == "Montenegro")?  'selected="selected"' : '' ?>>Montenegro</option>
										<option value="Montserrat" <?php echo ($country == "Montserrat")?  'selected="selected"' : '' ?>>Montserrat</option>
										<option value="Morocco" <?php echo ($country == "Morocco")?  'selected="selected"' : '' ?>>Morocco</option>
										<option value="Mozambique" <?php echo ($country == "Mozambique")?  'selected="selected"' : '' ?>>Mozambique</option>
										<option value="Myanmar" <?php echo ($country == "Myanmar")?  'selected="selected"' : '' ?>>Myanmar</option>
										<option value="Namibia" <?php echo ($country == "Namibia")?  'selected="selected"' : '' ?>>Namibia</option>
										<option value="Nauru" <?php echo ($country == "Nauru")?  'selected="selected"' : '' ?>>Nauru</option>
										<option value="Nepal" <?php echo ($country == "Nepal")?  'selected="selected"' : '' ?>>Nepal</option>
										<option value="Netherlands" <?php echo ($country == "Netherlands")?  'selected="selected"' : '' ?>>Netherlands</option>
										<option value="New Caledonia" <?php echo ($country == "New Caledonia")?  'selected="selected"' : '' ?>>New Caledonia</option>
										<option value="New Zealand" <?php echo ($country == "New Zealand")?  'selected="selected"' : '' ?>>New Zealand</option>
										<option value="Nicaragua" <?php echo ($country == "Nicaragua")?  'selected="selected"' : '' ?>>Nicaragua</option>
										<option value="Niger" <?php echo ($country == "Niger")?  'selected="selected"' : '' ?>>Niger</option>
										<option value="Nigeria" <?php echo ($country == "Nigeria")?  'selected="selected"' : '' ?>>Nigeria</option>
										<option value="Niue" <?php echo ($country == "Niue")?  'selected="selected"' : '' ?>>Niue</option>
										<option value="Norfolk Island" <?php echo ($country == "Norfolk Island")?  'selected="selected"' : '' ?>>Norfolk Island</option>
										<option value="Northern Mariana Islands" <?php echo ($country == "Northern Mariana Islands")?  'selected="selected"' : '' ?>>Northern Mariana Islands</option>
										<option value="Norway" <?php echo ($country == "Norway")?  'selected="selected"' : '' ?>>Norway</option>
										<option value="Oman" <?php echo ($country == "Oman")?  'selected="selected"' : '' ?>>Oman</option>
										<option value="Pakistan" <?php echo ($country == "Pakistan")?  'selected="selected"' : '' ?>>Pakistan</option>
										<option value="Palau" <?php echo ($country == "Palau")?  'selected="selected"' : '' ?>>Palau</option>
										<option value="Palestine, State of" <?php echo ($country == "Palestine, State of")?  'selected="selected"' : '' ?>>Palestine, State of</option>
										<option value="Panama" <?php echo ($country == "Panama")?  'selected="selected"' : '' ?>>Panama</option>
										<option value="Papua New Guinea" <?php echo ($country == "Papua New Guinea")?  'selected="selected"' : '' ?>>Papua New Guinea</option>
										<option value="Paraguay" <?php echo ($country == "Paraguay")?  'selected="selected"' : '' ?>>Paraguay</option>
										<option value="Peru" <?php echo ($country == "Peru")?  'selected="selected"' : '' ?>>Peru</option>
										<option value="Philippines" <?php echo ($country == "Philippines")?  'selected="selected"' : '' ?>>Philippines</option>
										<option value="Pitcairn" <?php echo ($country == "Pitcairn")?  'selected="selected"' : '' ?>>Pitcairn</option>
										<option value="Poland" <?php echo ($country == "Poland")?  'selected="selected"' : '' ?>>Poland</option>
										<option value="Portugal" <?php echo ($country == "Portugal")?  'selected="selected"' : '' ?>>Portugal</option>
										<option value="Puerto Rico" <?php echo ($country == "Puerto Rico")?  'selected="selected"' : '' ?>>Puerto Rico</option>
										<option value="Qatar" <?php echo ($country == "Qatar")?  'selected="selected"' : '' ?>>Qatar</option>
										<option value="Réunion" <?php echo ($country == "Réunion")?  'selected="selected"' : '' ?>>Réunion</option>
										<option value="Romania" <?php echo ($country == "Romania")?  'selected="selected"' : '' ?>>Romania</option>
										<option value="Russian Federation" <?php echo ($country == "Russian Federation")?  'selected="selected"' : '' ?>>Russian Federation</option>
										<option value="Rwanda" <?php echo ($country == "Rwanda")?  'selected="selected"' : '' ?>>Rwanda</option>
										<option value="Saint Barthélemy" <?php echo ($country == "Saint Barthélemy")?  'selected="selected"' : '' ?>>Saint Barthélemy</option>
										<option value="Saint Helena, Ascension and Tristan da Cunha" <?php echo ($country == "Saint Helena, Ascension and Tristan da Cunha")?  'selected="selected"' : '' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="Saint Kitts and Nevis" <?php echo ($country == "Saint Kitts and Nevis")?  'selected="selected"' : '' ?>>Saint Kitts and Nevis</option>
										<option value="Saint Lucia" <?php echo ($country == "Saint Lucia")?  'selected="selected"' : '' ?>>Saint Lucia</option>
										<option value="Saint Martin (French part)" <?php echo ($country == "Saint Martin (French part)")?  'selected="selected"' : '' ?>>Saint Martin (French part)</option>
										<option value="Saint Pierre and Miquelon" <?php echo ($country == "Saint Pierre and Miquelon")?  'selected="selected"' : '' ?>>Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and the Grenadines" <?php echo ($country == "Saint Vincent and the Grenadines")?  'selected="selected"' : '' ?>>Saint Vincent and the Grenadines</option>
										<option value="Samoa" <?php echo ($country == "Samoa")?  'selected="selected"' : '' ?>>Samoa</option>
										<option value="San Marino" <?php echo ($country == "San Marino")?  'selected="selected"' : '' ?>>San Marino</option>
										<option value="Sao Tome and Principe" <?php echo ($country == "Sao Tome and Principe")?  'selected="selected"' : '' ?>>Sao Tome and Principe</option>
										<option value="Saudi Arabia" <?php echo ($country == "Saudi Arabia")?  'selected="selected"' : '' ?>>Saudi Arabia</option>
										<option value="Senegal" <?php echo ($country == "Senegal")?  'selected="selected"' : '' ?>>Senegal</option>
										<option value="Serbia" <?php echo ($country == "Serbia")?  'selected="selected"' : '' ?>>Serbia</option>
										<option value="Seychelles" <?php echo ($country == "Seychelles")?  'selected="selected"' : '' ?>>Seychelles</option>
										<option value="Sierra Leone" <?php echo ($country == "Sierra Leone")?  'selected="selected"' : '' ?>>Sierra Leone</option>
										<option value="Singapore" <?php echo ($country == "Singapore")?  'selected="selected"' : '' ?>>Singapore</option>
										<option value="Sint Maarten (Dutch part)" <?php echo ($country == "Sint Maarten (Dutch part)")?  'selected="selected"' : '' ?>>Sint Maarten (Dutch part)</option>
										<option value="Slovakia" <?php echo ($country == "Slovakia")?  'selected="selected"' : '' ?>>Slovakia</option>
										<option value="Slovenia" <?php echo ($country == "Slovenia")?  'selected="selected"' : '' ?>>Slovenia</option>
										<option value="Solomon Islands" <?php echo ($country == "Solomon Islands")?  'selected="selected"' : '' ?>>Solomon Islands</option>
										<option value="Somalia" <?php echo ($country == "Somalia")?  'selected="selected"' : '' ?>>Somalia</option>
										<option value="South Africa" <?php echo ($country == "South Africa")?  'selected="selected"' : '' ?>>South Africa</option>
										<option value="South Georgia and the South Sandwich Islands" <?php echo ($country == "South Georgia and the South Sandwich Islands")?  'selected="selected"' : '' ?>>South Georgia and the South Sandwich Islands</option>
										<option value="South Sudan" <?php echo ($country == "South Sudan")?  'selected="selected"' : '' ?>>South Sudan</option>
										<option value="Spain" <?php echo ($country == "Spain")?  'selected="selected"' : '' ?>>Spain</option>
										<option value="Sri Lanka" <?php echo ($country == "Sri Lanka")?  'selected="selected"' : '' ?>>Sri Lanka</option>
										<option value="Sudan" <?php echo ($country == "Sudan")?  'selected="selected"' : '' ?>>Sudan</option>
										<option value="Suriname" <?php echo ($country == "Suriname")?  'selected="selected"' : '' ?>>Suriname</option>
										<option value="Svalbard and Jan Mayen" <?php echo ($country == "Svalbard and Jan Mayen")?  'selected="selected"' : '' ?>>Svalbard and Jan Mayen</option>
										<option value="Swaziland" <?php echo ($country == "Swaziland")?  'selected="selected"' : '' ?>>Swaziland</option>
										<option value="Sweden" <?php echo ($country == "Sweden")?  'selected="selected"' : '' ?>>Sweden</option>
										<option value="Switzerland" <?php echo ($country == "Switzerland")?  'selected="selected"' : '' ?>>Switzerland</option>
										<option value="Syrian Arab Republic" <?php echo ($country == "Syrian Arab Republic")?  'selected="selected"' : '' ?>>Syrian Arab Republic</option>
										<option value="Taiwan, Province of China" <?php echo ($country == "Taiwan, Province of China")?  'selected="selected"' : '' ?>>Taiwan, Province of China</option>
										<option value="Tajikistan" <?php echo ($country == "Tajikistan")?  'selected="selected"' : '' ?>>Tajikistan</option>
										<option value="Tanzania, United Republic of" <?php echo ($country == "Tanzania, United Republic of")?  'selected="selected"' : '' ?>>Tanzania, United Republic of</option>
										<option value="Thailand" <?php echo ($country == "Thailand")?  'selected="selected"' : '' ?>>Thailand</option>
										<option value="Timor-Leste" <?php echo ($country == "Timor-Leste")?  'selected="selected"' : '' ?>>Timor-Leste</option>
										<option value="Togo" <?php echo ($country == "Togo")?  'selected="selected"' : '' ?>>Togo</option>
										<option value="Tokelau" <?php echo ($country == "Tokelau")?  'selected="selected"' : '' ?>>Tokelau</option>
										<option value="Tonga" <?php echo ($country == "Tonga")?  'selected="selected"' : '' ?>>Tonga</option>
										<option value="Trinidad and Tobago" <?php echo ($country == "Trinidad and Tobago")?  'selected="selected"' : '' ?>>Trinidad and Tobago</option>
										<option value="Tunisia" <?php echo ($country == "Tunisia")?  'selected="selected"' : '' ?>>Tunisia</option>
										<option value="Turkey" <?php echo ($country == "Turkey")?  'selected="selected"' : '' ?>>Turkey</option>
										<option value="Turkmenistan" <?php echo ($country == "Turkmenistan")?  'selected="selected"' : '' ?>>Turkmenistan</option>
										<option value="Turks and Caicos Islands" <?php echo ($country == "Turks and Caicos Islands")?  'selected="selected"' : '' ?>>Turks and Caicos Islands</option>
										<option value="Tuvalu" <?php echo ($country == "Tuvalu")?  'selected="selected"' : '' ?>>Tuvalu</option>
										<option value="Uganda" <?php echo ($country == "Uganda")?  'selected="selected"' : '' ?>>Uganda</option>
										<option value="Ukraine" <?php echo ($country == "Ukraine")?  'selected="selected"' : '' ?>>Ukraine</option>
										<option value="United Arab Emirates" <?php echo ($country == "United Arab Emirates")?  'selected="selected"' : '' ?>>United Arab Emirates</option>
										<option value="United Kingdom" <?php echo ($country == "United Kingdom")?  'selected="selected"' : '' ?>>United Kingdom</option>
										<option value="United States" <?php echo ($country == "United States")?  'selected="selected"' : '' ?>>United States</option>
										<option value="United States Minor Outlying Islands" <?php echo ($country == "United States Minor Outlying Islands")?  'selected="selected"' : '' ?>>United States Minor Outlying Islands</option>
										<option value="Uruguay" <?php echo ($country == "Uruguay")?  'selected="selected"' : '' ?>>Uruguay</option>
										<option value="Uzbekistan" <?php echo ($country == "Uzbekistan")?  'selected="selected"' : '' ?>>Uzbekistan</option>
										<option value="Vanuatu" <?php echo ($country == "Vanuatu")?  'selected="selected"' : '' ?>>Vanuatu</option>
										<option value="Venezuela, Bolivarian Republic of" <?php echo ($country == "Venezuela, Bolivarian Republic of")?  'selected="selected"' : '' ?>>Venezuela, Bolivarian Republic of</option>
										<option value="Viet Nam" <?php echo ($country == "Viet Nam")?  'selected="selected"' : '' ?>>Viet Nam</option>
										<option value="Virgin Islands, British" <?php echo ($country == "Virgin Islands, British")?  'selected="selected"' : '' ?>>Virgin Islands, British</option>
										<option value="Virgin Islands, U.S." <?php echo ($country == "Virgin Islands, U.S.")?  'selected="selected"' : '' ?>>Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna" <?php echo ($country == "Wallis and Futuna")?  'selected="selected"' : '' ?>>Wallis and Futuna</option>
										<option value="Western Sahara" <?php echo ($country == "Western Sahara")?  'selected="selected"' : '' ?>>Western Sahara</option>
										<option value="Yemen" <?php echo ($country == "Yemen")?  'selected="selected"' : '' ?>>Yemen</option>
										<option value="Zambia" <?php echo ($country == "Zambia")?  'selected="selected"' : '' ?>>Zambia</option>
										<option value="Zimbabwe" <?php echo ($country == "Zimbabwe")?  'selected="selected"' : '' ?>>Zimbabwe</option>
									</select>														
					</p>				
    		</div>
    		<div class="col-md-6">
					<p class="pt-3">
							<label for="rating"><?php _e( 'Rating: ' ); ?></label>
									<span class="commentratingbox">
									<?php for( $i=1; $i <= 5; $i++ ) {
										echo '<span class="commentrating mx-3"><input type="radio" name="rating" id="rating" value="'. $i .'"';
										if ( $rating == $i ) echo ' checked="checked"';
										echo ' />'. $i .' </span>';
										}
									?>
									</span>
					</p>
    		</div>
			</div><!-- end row -->
		</div><!-- end container -->      
<?php }
/*====================================================
/* Update comment data */
/*====================================================*/
add_action( 'edit_comment', 'extend_comment_edit_metafields' );
function extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;
  
		if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') ) :
  	$phone = wp_filter_nohtml_kses($_POST['phone']);
  	update_comment_meta( $comment_id, 'phone', $phone );
  	else :
  	delete_comment_meta( $comment_id, 'phone');
  	endif;
	
		if ( ( isset( $_POST['country'] ) ) && ( $_POST['country'] != '') ) :
		$country = wp_filter_nohtml_kses($_POST['country']);
		update_comment_meta( $comment_id, 'country', $country );
		else :
		delete_comment_meta( $comment_id, 'country');
		endif;
	
		if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ):
		$rating = wp_filter_nohtml_kses($_POST['rating']);
		update_comment_meta( $comment_id, 'rating', $rating );
		else :
		delete_comment_meta( $comment_id, 'rating');
		endif;

		if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '') ):
		$title = wp_filter_nohtml_kses($_POST['title']);
		update_comment_meta( $comment_id, 'title', $title );
		else :
		delete_comment_meta( $comment_id, 'title');
		endif;
}
?>
<?php
//if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
//    exit();
//
//  $comments = get_comments();
//  foreach($comments as $comment) {
//    delete_comment_meta($comment->comment_ID, 'phone');
//    delete_comment_meta($comment->comment_ID, 'title');
//    delete_comment_meta($comment->comment_ID, 'rating');
//  }
?>