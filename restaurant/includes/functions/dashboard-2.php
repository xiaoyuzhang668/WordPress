<?php 

	<?php		
				$cart_item_count = WC()->cart->get_cart_contents_count();
	$cart_count_span = '';
	if ( $cart_item_count ) {
		$cart_count_span = '<span class="count">'.$cart_item_count.'</span>';
	}
	$cart_link = '<li class="cart menu-item menu-item-type-post_type menu-item-object-page"><a href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '"><i class="fa fa-shopping-bag"></i>'.$cart_count_span.'</a></li>';

	// Add the cart link to the end of the menu.
	$items = $items . $cart_link;

	echo $items;?>
		  
/*==================================================
//Hide publish meta box
/*==================================================*/
//function hide_publish_metabox() {
//    $post_types = get_post_types( '', 'names' );
//    if( ! empty( $post_types ) ) {
//        foreach( $post_types as $type ) {
//            remove_meta_box( 'submitdiv', $type, 'side' );
//        }
//    }
//}
//add_action( 'do_meta_boxes', 'hide_publish_metabox' );
/*========================================
  Change sidebar widget
  ========================================*/
function remove_some_widgets(){
    unregister_sidebar( 'first-footer-widget-area' );
    unregister_sidebar( 'second-footer-widget-area' );
    unregister_sidebar( 'third-footer-widget-area' );
    unregister_sidebar( 'fourth-footer-widget-area' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );
/*========================================
  Remove wordpress logo
  ========================================*/
function admin_css() {
	echo '';
}
add_action('admin_head','admin_css');

/*========================================
  Remove version number
  ========================================*/ 
function wpb_remove_version() {
  return '';
  }
add_filter('the_generator', 'wpb_remove_version');
/*========================================
  Remove footer
  ========================================*/ 
function remove_footer_admin () { 
  echo 'Created by <a href="https://cathy-zhang.ca" target="_blank">Cathy Zhang</a>'; 
  } 
add_filter('admin_footer_text', 'remove_footer_admin');
/*========================================
  Wordpress copyright date
  ========================================*/ 
function wpb_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "© " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output;
}
/*========================================
  Remove jquery migrate
  ========================================*/ 
//add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
//function remove_jquery_migrate( $scripts ) {
//	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
//		$script = $scripts->registered['jquery'];
//
//		if ( $script->deps ) { // Check whether the script has any dependencies
//			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
//		}
//	}
// }
add_action('wp_default_scripts', function ($scripts) {
    if (!empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});
// silencer script
function jquery_migrate_silencer() {
    // create function copy
    $silencer = '<script>window.console.logger = window.console.log; ';
    // modify original function to filter and use function copy
    $silencer .= 'window.console.log = function(tolog) {';
    // bug out if empty to prevent error
    $silencer .= 'if (tolog == null) {return;} ';
    // filter messages containing string
    $silencer .= 'if (tolog.indexOf("Migrate is installed") == -1) {';
    $silencer .= 'console.logger(tolog);} ';
    $silencer .= '}</script>';
    return $silencer;
}
// for the frontend, use script_loader_tag filter
add_filter('script_loader_tag','jquery_migrate_load_silencer', 10, 2);
function jquery_migrate_load_silencer($tag, $handle) {
    if ($handle == 'jquery-migrate') {
        $silencer = jquery_migrate_silencer();
        // prepend to jquery migrate loading
        $tag = $silencer.$tag;
    }
    return $tag;
}
// for the admin, hook to admin_print_scripts
add_action('admin_print_scripts','jquery_migrate_echo_silencer');
function jquery_migrate_echo_silencer() {echo jquery_migrate_silencer();}
/*========================================
  Remove default image link
  ========================================*/
function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );     
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);
/*========================================
  Add user profile
  ========================================*/
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { ?>
    <h3 class="text-danger"><?php _e("Extra user profile information - User registration data input in WordPress, not the same as WooCommerce user data", "master"); ?></h3>
    <table class="form-table mb-5 bg-warning text-white rounded">
			<tr>
					<th><label for="userAddress" class="text-white pl-3"><?php _e("Address"); ?></label></th>
					<td>
							<input type="text" name="userAddress" id="userAddress" value="<?php echo esc_attr( get_the_author_meta( 'userAddress', $user->ID ) ); ?>" class="regular-text"><br>
							<span class="description"><?php _e("Please enter your address."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="userCity" class="text-white pl-3"><?php _e("City"); ?></label></th>
					<td>
							<input type="text" name="userCity" id="userCity" value="<?php echo esc_attr( get_the_author_meta( 'userCity', $user->ID ) ); ?>" class="regular-text"><br>
							<span class="description"><?php _e("Please enter your city."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="userPostalcode" class="text-white pl-3"><?php _e("Postal Code"); ?></label></th>
					<td>
							<input type="text" name="userPostalcode" id="userPostalcode" value="<?php echo esc_attr( get_the_author_meta( 'userPostalcode', $user->ID ) ); ?>" class="regular-text"><br>
							<span class="description"><?php _e("Please enter your postal code."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="userPhone" class="text-white pl-3"><?php _e("Phone"); ?></label></th>
					<td>
							<input type="text" name="userPhone" id="userPhone" value="<?php echo esc_attr( get_the_author_meta( 'userPhone', $user->ID ) ); ?>" class="regular-text"><br>
							<span class="description"><?php _e("Please enter your phone."); ?></span>
					</td>
			</tr>
			<tr>
					<th><label for="userCountry" class="text-white pl-3"><?php _e("Country"); ?></label></th>
					<td>
							<?php $selected = get_the_author_meta( 'userCountry', $user->ID ); ?>
								<div class="input-group">    
									<select class="custom-select" name="userCountry" id="userCountry">
										<option value="Afghanistan" <?php echo ($selected == "Afghanistan")?  'selected="selected"' : '' ?>>Afghanistan</option>
										<option value="Åland Islands" <?php echo ($selected == "Åland Islands")?  'selected="selected"' : '' ?>>Åland Islands</option>
										<option value="Albania" <?php echo ($selected == "Albania")?  'selected="selected"' : '' ?>>Albania</option>
										<option value="Algeria" <?php echo ($selected == "Algeria")?  'selected="selected"' : '' ?>>Algeria</option>
										<option value="American Samoa" <?php echo ($selected == "American Samoa")?  'selected="selected"' : '' ?>>American Samoa</option>
										<option value="Andorra" <?php echo ($selected == "Andorra")?  'selected="selected"' : '' ?>>Andorra</option>
										<option value="Angola" <?php echo ($selected == "Angola")?  'selected="selected"' : '' ?>>Angola</option>
										<option value="Anguilla" <?php echo ($selected == "Anguilla")?  'selected="selected"' : '' ?>>Anguilla</option>
										<option value="Antarctica" <?php echo ($selected == "Antarctica")?  'selected="selected"' : '' ?>>Antarctica</option>
										<option value="Antigua and Barbuda" <?php echo ($selected == "Antigua and Barbuda")?  'selected="selected"' : '' ?>>Antigua and Barbuda</option>
										<option value="Argentina" <?php echo ($selected == "Argentina")?  'selected="selected"' : '' ?>>Argentina</option>
										<option value="Armenia" <?php echo ($selected == "Armenia")?  'selected="selected"' : '' ?>>Armenia</option>
										<option value="Aruba" <?php echo ($selected == "Aruba")?  'selected="selected"' : '' ?>>Aruba</option>
										<option value="Australia" <?php echo ($selected == "Australia")?  'selected="selected"' : '' ?>>Australia</option>
										<option value="Austria" <?php echo ($selected == "Austria")?  'selected="selected"' : '' ?>>Austria</option>
										<option value="Azerbaijan" <?php echo ($selected == "Azerbaijan")?  'selected="selected"' : '' ?>>Azerbaijan</option>
										<option value="Bahrain" <?php echo ($selected == "Bahrain")?  'selected="selected"' : '' ?>>Bahrain</option>
										<option value="Bahamas" <?php echo ($selected == "Bahamas")?  'selected="selected"' : '' ?>>Bahamas</option>
										<option value="Bangladesh" <?php echo ($selected == "Bangladesh")?  'selected="selected"' : '' ?>>Bangladesh</option>
										<option value="Barbados" <?php echo ($selected == "Barbados")?  'selected="selected"' : '' ?>>Barbados</option>
										<option value="Belarus" <?php echo ($selected == "Belarus")?  'selected="selected"' : '' ?>>Belarus</option>
										<option value="Belgium" <?php echo ($selected == "Belgium")?  'selected="selected"' : '' ?>>Belgium</option>
										<option value="Belize" <?php echo ($selected == "Belize")?  'selected="selected"' : '' ?>>Belize</option>
										<option value="Benin" <?php echo ($selected == "Benin")?  'selected="selected"' : '' ?>>Benin</option>
										<option value="Bermuda" <?php echo ($selected == "Bermuda")?  'selected="selected"' : '' ?>>Bermuda</option>
										<option value="Bhutan" <?php echo ($selected == "Bhutan")?  'selected="selected"' : '' ?>>Bhutan</option>
										<option value="Bolivia, Plurinational State of" <?php echo ($selected == "Bolivia, Plurinational State of")?  'selected="selected"' : '' ?>>Bolivia, Plurinational State of</option>
										<option value="Bonaire, Sint Eustatius and Saba" <?php echo ($selected == "Bonaire, Sint Eustatius and Saba")?  'selected="selected"' : '' ?>>Bonaire, Sint Eustatius and Saba</option>
										<option value="Bosnia and Herzegovina" <?php echo ($selected == "Bosnia and Herzegovina")?  'selected="selected"' : '' ?>>Bosnia and Herzegovina</option>
										<option value="Botswana" <?php echo ($selected == "Botswana")?  'selected="selected"' : '' ?>>Botswana</option>
										<option value="Bouvet Island" <?php echo ($selected == "Bouvet Island")?  'selected="selected"' : '' ?>>Bouvet Island</option>
										<option value="Brazil" <?php echo ($selected == "Brazil")?  'selected="selected"' : '' ?>>Brazil</option>
										<option value="British Indian Ocean Territory" <?php echo ($selected == "British Indian Ocean Territory")?  'selected="selected"' : '' ?>>British Indian Ocean Territory</option>
										<option value="Brunei Darussalam" <?php echo ($selected == "Brunei Darussalam")?  'selected="selected"' : '' ?>>Brunei Darussalam</option>
										<option value="Bulgaria" <?php echo ($selected == "Bulgaria")?  'selected="selected"' : '' ?>>Bulgaria</option>
										<option value="Burkina Faso" <?php echo ($selected == "Burkina Faso")?  'selected="selected"' : '' ?>>Burkina Faso</option>
										<option value="Burundi" <?php echo ($selected == "Burundi")?  'selected="selected"' : '' ?>>Burundi</option>
										<option value="Cambodia" <?php echo ($selected == "Cambodia")?  'selected="selected"' : '' ?>>Cambodia</option>
										<option value="Cameroon" <?php echo ($selected == "Cameroon")?  'selected="selected"' : '' ?>>Cameroon</option>
										<option value="Canada" <?php echo ($selected == "Canada")?  'selected="selected"' : '' ?>>Canada</option>
										<option value="Cape Verde" <?php echo ($selected == "Cape Verde")?  'selected="selected"' : '' ?>>Cape Verde</option>
										<option value="Cayman Islands" <?php echo ($selected == "Cayman Islands")?  'selected="selected"' : '' ?>>Cayman Islands</option>
										<option value="Central African Republic" <?php echo ($selected == "Central African Republic")?  'selected="selected"' : '' ?>>Central African Republic</option>
										<option value="Chad" <?php echo ($selected == "Chad")?  'selected="selected"' : '' ?>>Chad</option>
										<option value="Chile" <?php echo ($selected == "Chile")?  'selected="selected"' : '' ?>>Chile</option>
										<option value="China" <?php echo ($selected == "China")?  'selected="selected"' : '' ?>>China</option>
										<option value="Christmas Island" <?php echo ($selected == "Christmas Island")?  'selected="selected"' : '' ?>>Christmas Island</option>
										<option value="Cocos (Keeling) Islands" <?php echo ($selected == "Cocos (Keeling) Islands")?  'selected="selected"' : '' ?>>Cocos (Keeling) Islands</option>
										<option value="Colombia" <?php echo ($selected == "Colombia")?  'selected="selected"' : '' ?>>Colombia</option>
										<option value="Comoros" <?php echo ($selected == "Comoros")?  'selected="selected"' : '' ?>>Comoros</option>
										<option value="Congo" <?php echo ($selected == "Congo")?  'selected="selected"' : '' ?>>Congo</option>
										<option value="Congo, the Democratic Republic of the" <?php echo ($selected == "Congo, the Democratic Republic of the")?  'selected="selected"' : '' ?>>Congo, the Democratic Republic of the</option>
										<option value="Cook Islands" <?php echo ($selected == "Cook Islands")?  'selected="selected"' : '' ?>>Cook Islands</option>
										<option value="Costa Rica" <?php echo ($selected == "Costa Rica")?  'selected="selected"' : '' ?>>Costa Rica</option>
										<option value="Côte d'Ivoire" <?php echo ($selected == "Côte d'Ivoire")?  'selected="selected"' : '' ?>>Côte d'Ivoire</option>
										<option value="Croatia" <?php echo ($selected == "Croatia")?  'selected="selected"' : '' ?>>Croatia</option>
										<option value="Cuba" <?php echo ($selected == "Cuba")?  'selected="selected"' : '' ?>>Cuba</option>
										<option value="Curaçao" <?php echo ($selected == "Curaçao")?  'selected="selected"' : '' ?>>Curaçao</option>
										<option value="Cyprus" <?php echo ($selected == "Cyprus")?  'selected="selected"' : '' ?>>Cyprus</option>
										<option value="Czech Republic" <?php echo ($selected == "Czech Republic")?  'selected="selected"' : '' ?>>Czech Republic</option>
										<option value="Denmark" <?php echo ($selected == "Denmark")?  'selected="selected"' : '' ?>>Denmark</option>
										<option value="Djibouti" <?php echo ($selected == "Djibouti")?  'selected="selected"' : '' ?>>Djibouti</option>
										<option value="Dominica" <?php echo ($selected == "Dominica")?  'selected="selected"' : '' ?>>Dominica</option>
										<option value="Dominican Republic" <?php echo ($selected == "Dominican Republic")?  'selected="selected"' : '' ?>>Dominican Republic</option>
										<option value="Ecuador" <?php echo ($selected == "Ecuador")?  'selected="selected"' : '' ?>>Ecuador</option>
										<option value="Egypt" <?php echo ($selected == "Egypt")?  'selected="selected"' : '' ?>>Egypt</option>
										<option value="El Salvador" <?php echo ($selected == "El Salvador")?  'selected="selected"' : '' ?>>El Salvador</option>
										<option value="Equatorial Guinea" <?php echo ($selected == "Equatorial Guinea")?  'selected="selected"' : '' ?>>Equatorial Guinea</option>
										<option value="Eritrea" <?php echo ($selected == "Eritrea")?  'selected="selected"' : '' ?>>Eritrea</option>
										<option value="Estonia" <?php echo ($selected == "Estonia")?  'selected="selected"' : '' ?>>Estonia</option>
										<option value="Ethiopia" <?php echo ($selected == "Ethiopia")?  'selected="selected"' : '' ?>>Ethiopia</option>
										<option value="Falkland Islands (Malvinas)" <?php echo ($selected == "Falkland Islands (Malvinas)")?  'selected="selected"' : '' ?>>Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands" <?php echo ($selected == "Faroe Islands")?  'selected="selected"' : '' ?>>Faroe Islands</option>
										<option value="Fiji" <?php echo ($selected == "Fiji")?  'selected="selected"' : '' ?>>Fiji</option>
										<option value="Finland" <?php echo ($selected == "Finland")?  'selected="selected"' : '' ?>>Finland</option>
										<option value="France" <?php echo ($selected == "France")?  'selected="selected"' : '' ?>>France</option>
										<option value="French Guiana" <?php echo ($selected == "French Guiana")?  'selected="selected"' : '' ?>>French Guiana</option>
										<option value="French Polynesia" <?php echo ($selected == "French Polynesia")?  'selected="selected"' : '' ?>>French Polynesia</option>
										<option value="French Southern Territories" <?php echo ($selected == "French Southern Territories")?  'selected="selected"' : '' ?>>French Southern Territories</option>
										<option value="Gabon" <?php echo ($selected == "Gabon")?  'selected="selected"' : '' ?>>Gabon</option>
										<option value="Gambia" <?php echo ($selected == "Gambia")?  'selected="selected"' : '' ?>>Gambia</option>
										<option value="Georgia" <?php echo ($selected == "Georgia")?  'selected="selected"' : '' ?>>Georgia</option>
										<option value="Germany" <?php echo ($selected == "Germany")?  'selected="selected"' : '' ?>>Germany</option>
										<option value="Ghana" <?php echo ($selected == "Ghana")?  'selected="selected"' : '' ?>>Ghana</option>
										<option value="Gibraltar" <?php echo ($selected == "Gibraltar")?  'selected="selected"' : '' ?>>Gibraltar</option>
										<option value="Greece" <?php echo ($selected == "Greece")?  'selected="selected"' : '' ?>>Greece</option>
										<option value="Greenland" <?php echo ($selected == "Greenland")?  'selected="selected"' : '' ?>>Greenland</option>
										<option value="Grenada" <?php echo ($selected == "Grenada")?  'selected="selected"' : '' ?>>Grenada</option>
										<option value="Guadeloupe" <?php echo ($selected == "Guadeloupe")?  'selected="selected"' : '' ?>>Guadeloupe</option>
										<option value="Guam" <?php echo ($selected == "Guam")?  'selected="selected"' : '' ?>>Guam</option>
										<option value="Guatemala" <?php echo ($selected == "Guatemala")?  'selected="selected"' : '' ?>>Guatemala</option>
										<option value="Guernsey" <?php echo ($selected == "Guernsey")?  'selected="selected"' : '' ?>>Guernsey</option>
										<option value="Guinea" <?php echo ($selected == "Guinea")?  'selected="selected"' : '' ?>>Guinea</option>
										<option value="Guinea-Bissau" <?php echo ($selected == "Guinea-Bissau")?  'selected="selected"' : '' ?>>Guinea-Bissau</option>
										<option value="Guyana" <?php echo ($selected == "Guyana")?  'selected="selected"' : '' ?>>Guyana</option>
										<option value="Haiti" <?php echo ($selected == "Haiti")?  'selected="selected"' : '' ?>>Haiti</option>
										<option value="Heard Island and McDonald Islands" <?php echo ($selected == "Heard Island and McDonald Islands")?  'selected="selected"' : '' ?>>Heard Island and McDonald Islands</option>
										<option value="Holy See (Vatican City State)" <?php echo ($selected == "Holy See (Vatican City State)")?  'selected="selected"' : '' ?>>Holy See (Vatican City State)</option>
										<option value="Honduras" <?php echo ($selected == "Honduras")?  'selected="selected"' : '' ?>>Honduras</option>
										<option value="Hong Kong" <?php echo ($selected == "Hong Kong")?  'selected="selected"' : '' ?>>Hong Kong</option>
										<option value="Hungary" <?php echo ($selected == "Hungary")?  'selected="selected"' : '' ?>>Hungary</option>
										<option value="Iceland" <?php echo ($selected == "Iceland")?  'selected="selected"' : '' ?>>Iceland</option>
										<option value="India" <?php echo ($selected == "India")?  'selected="selected"' : '' ?>>India</option>
										<option value="Indonesia" <?php echo ($selected == "Indonesia")?  'selected="selected"' : '' ?>>Indonesia</option>
										<option value="Iran, Islamic Republic of" <?php echo ($selected == "Iran, Islamic Republic of")?  'selected="selected"' : '' ?>>Iran, Islamic Republic of</option>
										<option value="Iraq" <?php echo ($selected == "Iraq")?  'selected="selected"' : '' ?>>Iraq</option>
										<option value="Ireland" <?php echo ($selected == "Ireland")?  'selected="selected"' : '' ?>>Ireland</option>
										<option value="Isle of Man" <?php echo ($selected == "Isle of Man")?  'selected="selected"' : '' ?>>Isle of Man</option>
										<option value="Israel" <?php echo ($selected == "Israel")?  'selected="selected"' : '' ?>>Israel</option>
										<option value="Italy" <?php echo ($selected == "Italy")?  'selected="selected"' : '' ?>>Italy</option>
										<option value="Jamaica" <?php echo ($selected == "Jamaica")?  'selected="selected"' : '' ?>>Jamaica</option>
										<option value="Japan" <?php echo ($selected == "Japan")?  'selected="selected"' : '' ?>>Japan</option>
										<option value="Jersey" <?php echo ($selected == "Jersey")?  'selected="selected"' : '' ?>>Jersey</option>
										<option value="Jordan" <?php echo ($selected == "Jordan")?  'selected="selected"' : '' ?>>Jordan</option>
										<option value="Kazakhstan" <?php echo ($selected == "Kazakhstan")?  'selected="selected"' : '' ?>>Kazakhstan</option>
										<option value="Kenya" <?php echo ($selected == "Kenya")?  'selected="selected"' : '' ?>>Kenya</option>
										<option value="Kiribati" <?php echo ($selected == "Kiribati")?  'selected="selected"' : '' ?>>Kiribati</option>
										<option value="Korea, Democratic People's Republic of" <?php echo ($selected == "Korea, Democratic People's Republic of")?  'selected="selected"' : '' ?>>Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of" <?php echo ($selected == "Korea, Republic of")?  'selected="selected"' : '' ?>>Korea, Republic of</option>
										<option value="Kuwait" <?php echo ($selected == "Kuwait")?  'selected="selected"' : '' ?>>Kuwait</option>
										<option value="Kyrgyzstan" <?php echo ($selected == "Kyrgyzstan")?  'selected="selected"' : '' ?>>Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic" <?php echo ($selected == "Lao People's Democratic Republic")?  'selected="selected"' : '' ?>>Lao People's Democratic Republic</option>
										<option value="Latvia" <?php echo ($selected == "Latvia")?  'selected="selected"' : '' ?>>Latvia</option>
										<option value="Lebanon" <?php echo ($selected == "Lebanon")?  'selected="selected"' : '' ?>>Lebanon</option>
										<option value="Lesotho" <?php echo ($selected == "Lesotho")?  'selected="selected"' : '' ?>>Lesotho</option>
										<option value="Liberia" <?php echo ($selected == "Liberia")?  'selected="selected"' : '' ?>>Liberia</option>
										<option value="Libya" <?php echo ($selected == "Libya")?  'selected="selected"' : '' ?>>Libya</option>
										<option value="Liechtenstein" <?php echo ($selected == "Liechtenstein")?  'selected="selected"' : '' ?>>Liechtenstein</option>
										<option value="Lithuania" <?php echo ($selected == "Lithuania")?  'selected="selected"' : '' ?>>Lithuania</option>
										<option value="Luxembourg" <?php echo ($selected == "Luxembourg")?  'selected="selected"' : '' ?>>Luxembourg</option>
										<option value="Macao" <?php echo ($selected == "Macao")?  'selected="selected"' : '' ?>>Macao</option>
										<option value="Macedonia, the Former Yugoslav Republic of" <?php echo ($selected == "Macedonia, the Former Yugoslav Republic of")?  'selected="selected"' : '' ?>>Macedonia, the Former Yugoslav Republic of</option>
										<option value="Madagascar" <?php echo ($selected == "Madagascar")?  'selected="selected"' : '' ?>>Madagascar</option>
										<option value="Malawi" <?php echo ($selected == "Malawi")?  'selected="selected"' : '' ?>>Malawi</option>
										<option value="Malaysia" <?php echo ($selected == "Malaysia")?  'selected="selected"' : '' ?>>Malaysia</option>
										<option value="Maldives" <?php echo ($selected == "Maldives")?  'selected="selected"' : '' ?>>Maldives</option>
										<option value="Mali" <?php echo ($selected == "Mali")?  'selected="selected"' : '' ?>>Mali</option>
										<option value="Malta" <?php echo ($selected == "Malta")?  'selected="selected"' : '' ?>>Malta</option>
										<option value="Marshall Islands" <?php echo ($selected == "Marshall Islands")?  'selected="selected"' : '' ?>>Marshall Islands</option>
										<option value="Martinique" <?php echo ($selected == "Martinique")?  'selected="selected"' : '' ?>>Martinique</option>
										<option value="Mauritania" <?php echo ($selected == "Mauritania")?  'selected="selected"' : '' ?>>Mauritania</option>
										<option value="Mauritius" <?php echo ($selected == "Mauritius")?  'selected="selected"' : '' ?>>Mauritius</option>
										<option value="Mayotte" <?php echo ($selected == "Mayotte")?  'selected="selected"' : '' ?>>Mayotte</option>
										<option value="Mexico" <?php echo ($selected == "Mexico")?  'selected="selected"' : '' ?>>Mexico</option>
										<option value="Micronesia, Federated States of" <?php echo ($selected == "Micronesia, Federated States of")?  'selected="selected"' : '' ?>>Micronesia, Federated States of</option>
										<option value="Moldova, Republic of" <?php echo ($selected == "Moldova, Republic of")?  'selected="selected"' : '' ?>>Moldova, Republic of</option>
										<option value="Monaco" <?php echo ($selected == "Monaco")?  'selected="selected"' : '' ?>>Monaco</option>
										<option value="Mongolia" <?php echo ($selected == "Mongolia")?  'selected="selected"' : '' ?>>Mongolia</option>
										<option value="Montenegro" <?php echo ($selected == "Montenegro")?  'selected="selected"' : '' ?>>Montenegro</option>
										<option value="Montserrat" <?php echo ($selected == "Montserrat")?  'selected="selected"' : '' ?>>Montserrat</option>
										<option value="Morocco" <?php echo ($selected == "Morocco")?  'selected="selected"' : '' ?>>Morocco</option>
										<option value="Mozambique" <?php echo ($selected == "Mozambique")?  'selected="selected"' : '' ?>>Mozambique</option>
										<option value="Myanmar" <?php echo ($selected == "Myanmar")?  'selected="selected"' : '' ?>>Myanmar</option>
										<option value="Namibia" <?php echo ($selected == "Namibia")?  'selected="selected"' : '' ?>>Namibia</option>
										<option value="Nauru" <?php echo ($selected == "Nauru")?  'selected="selected"' : '' ?>>Nauru</option>
										<option value="Nepal" <?php echo ($selected == "Nepal")?  'selected="selected"' : '' ?>>Nepal</option>
										<option value="Netherlands" <?php echo ($selected == "Netherlands")?  'selected="selected"' : '' ?>>Netherlands</option>
										<option value="New Caledonia" <?php echo ($selected == "New Caledonia")?  'selected="selected"' : '' ?>>New Caledonia</option>
										<option value="New Zealand" <?php echo ($selected == "New Zealand")?  'selected="selected"' : '' ?>>New Zealand</option>
										<option value="Nicaragua" <?php echo ($selected == "Nicaragua")?  'selected="selected"' : '' ?>>Nicaragua</option>
										<option value="Niger" <?php echo ($selected == "Niger")?  'selected="selected"' : '' ?>>Niger</option>
										<option value="Nigeria" <?php echo ($selected == "Nigeria")?  'selected="selected"' : '' ?>>Nigeria</option>
										<option value="Niue" <?php echo ($selected == "Niue")?  'selected="selected"' : '' ?>>Niue</option>
										<option value="Norfolk Island" <?php echo ($selected == "Norfolk Island")?  'selected="selected"' : '' ?>>Norfolk Island</option>
										<option value="Northern Mariana Islands" <?php echo ($selected == "Northern Mariana Islands")?  'selected="selected"' : '' ?>>Northern Mariana Islands</option>
										<option value="Norway" <?php echo ($selected == "Norway")?  'selected="selected"' : '' ?>>Norway</option>
										<option value="Oman" <?php echo ($selected == "Oman")?  'selected="selected"' : '' ?>>Oman</option>
										<option value="Pakistan" <?php echo ($selected == "Pakistan")?  'selected="selected"' : '' ?>>Pakistan</option>
										<option value="Palau" <?php echo ($selected == "Palau")?  'selected="selected"' : '' ?>>Palau</option>
										<option value="Palestine, State of" <?php echo ($selected == "Palestine, State of")?  'selected="selected"' : '' ?>>Palestine, State of</option>
										<option value="Panama" <?php echo ($selected == "Panama")?  'selected="selected"' : '' ?>>Panama</option>
										<option value="Papua New Guinea" <?php echo ($selected == "Papua New Guinea")?  'selected="selected"' : '' ?>>Papua New Guinea</option>
										<option value="Paraguay" <?php echo ($selected == "Paraguay")?  'selected="selected"' : '' ?>>Paraguay</option>
										<option value="Peru" <?php echo ($selected == "Peru")?  'selected="selected"' : '' ?>>Peru</option>
										<option value="Philippines" <?php echo ($selected == "Philippines")?  'selected="selected"' : '' ?>>Philippines</option>
										<option value="Pitcairn" <?php echo ($selected == "Pitcairn")?  'selected="selected"' : '' ?>>Pitcairn</option>
										<option value="Poland" <?php echo ($selected == "Poland")?  'selected="selected"' : '' ?>>Poland</option>
										<option value="Portugal" <?php echo ($selected == "Portugal")?  'selected="selected"' : '' ?>>Portugal</option>
										<option value="Puerto Rico" <?php echo ($selected == "Puerto Rico")?  'selected="selected"' : '' ?>>Puerto Rico</option>
										<option value="Qatar" <?php echo ($selected == "Qatar")?  'selected="selected"' : '' ?>>Qatar</option>
										<option value="Réunion" <?php echo ($selected == "Réunion")?  'selected="selected"' : '' ?>>Réunion</option>
										<option value="Romania" <?php echo ($selected == "Romania")?  'selected="selected"' : '' ?>>Romania</option>
										<option value="Russian Federation" <?php echo ($selected == "Russian Federation")?  'selected="selected"' : '' ?>>Russian Federation</option>
										<option value="Rwanda" <?php echo ($selected == "Rwanda")?  'selected="selected"' : '' ?>>Rwanda</option>
										<option value="Saint Barthélemy" <?php echo ($selected == "Saint Barthélemy")?  'selected="selected"' : '' ?>>Saint Barthélemy</option>
										<option value="Saint Helena, Ascension and Tristan da Cunha" <?php echo ($selected == "Saint Helena, Ascension and Tristan da Cunha")?  'selected="selected"' : '' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="Saint Kitts and Nevis" <?php echo ($selected == "Saint Kitts and Nevis")?  'selected="selected"' : '' ?>>Saint Kitts and Nevis</option>
										<option value="Saint Lucia" <?php echo ($selected == "Saint Lucia")?  'selected="selected"' : '' ?>>Saint Lucia</option>
										<option value="Saint Martin (French part)" <?php echo ($selected == "Saint Martin (French part)")?  'selected="selected"' : '' ?>>Saint Martin (French part)</option>
										<option value="Saint Pierre and Miquelon" <?php echo ($selected == "Saint Pierre and Miquelon")?  'selected="selected"' : '' ?>>Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and the Grenadines" <?php echo ($selected == "Saint Vincent and the Grenadines")?  'selected="selected"' : '' ?>>Saint Vincent and the Grenadines</option>
										<option value="Samoa" <?php echo ($selected == "Samoa")?  'selected="selected"' : '' ?>>Samoa</option>
										<option value="San Marino" <?php echo ($selected == "San Marino")?  'selected="selected"' : '' ?>>San Marino</option>
										<option value="Sao Tome and Principe" <?php echo ($selected == "Sao Tome and Principe")?  'selected="selected"' : '' ?>>Sao Tome and Principe</option>
										<option value="Saudi Arabia" <?php echo ($selected == "Saudi Arabia")?  'selected="selected"' : '' ?>>Saudi Arabia</option>
										<option value="Senegal" <?php echo ($selected == "Senegal")?  'selected="selected"' : '' ?>>Senegal</option>
										<option value="Serbia" <?php echo ($selected == "Serbia")?  'selected="selected"' : '' ?>>Serbia</option>
										<option value="Seychelles" <?php echo ($selected == "Seychelles")?  'selected="selected"' : '' ?>>Seychelles</option>
										<option value="Sierra Leone" <?php echo ($selected == "Sierra Leone")?  'selected="selected"' : '' ?>>Sierra Leone</option>
										<option value="Singapore" <?php echo ($selected == "Singapore")?  'selected="selected"' : '' ?>>Singapore</option>
										<option value="Sint Maarten (Dutch part)" <?php echo ($selected == "Sint Maarten (Dutch part)")?  'selected="selected"' : '' ?>>Sint Maarten (Dutch part)</option>
										<option value="Slovakia" <?php echo ($selected == "Slovakia")?  'selected="selected"' : '' ?>>Slovakia</option>
										<option value="Slovenia" <?php echo ($selected == "Slovenia")?  'selected="selected"' : '' ?>>Slovenia</option>
										<option value="Solomon Islands" <?php echo ($selected == "Solomon Islands")?  'selected="selected"' : '' ?>>Solomon Islands</option>
										<option value="Somalia" <?php echo ($selected == "Somalia")?  'selected="selected"' : '' ?>>Somalia</option>
										<option value="South Africa" <?php echo ($selected == "South Africa")?  'selected="selected"' : '' ?>>South Africa</option>
										<option value="South Georgia and the South Sandwich Islands" <?php echo ($selected == "South Georgia and the South Sandwich Islands")?  'selected="selected"' : '' ?>>South Georgia and the South Sandwich Islands</option>
										<option value="South Sudan" <?php echo ($selected == "South Sudan")?  'selected="selected"' : '' ?>>South Sudan</option>
										<option value="Spain" <?php echo ($selected == "Spain")?  'selected="selected"' : '' ?>>Spain</option>
										<option value="Sri Lanka" <?php echo ($selected == "Sri Lanka")?  'selected="selected"' : '' ?>>Sri Lanka</option>
										<option value="Sudan" <?php echo ($selected == "Sudan")?  'selected="selected"' : '' ?>>Sudan</option>
										<option value="Suriname" <?php echo ($selected == "Suriname")?  'selected="selected"' : '' ?>>Suriname</option>
										<option value="Svalbard and Jan Mayen" <?php echo ($selected == "Svalbard and Jan Mayen")?  'selected="selected"' : '' ?>>Svalbard and Jan Mayen</option>
										<option value="Swaziland" <?php echo ($selected == "Swaziland")?  'selected="selected"' : '' ?>>Swaziland</option>
										<option value="Sweden" <?php echo ($selected == "Sweden")?  'selected="selected"' : '' ?>>Sweden</option>
										<option value="Switzerland" <?php echo ($selected == "Switzerland")?  'selected="selected"' : '' ?>>Switzerland</option>
										<option value="Syrian Arab Republic" <?php echo ($selected == "Syrian Arab Republic")?  'selected="selected"' : '' ?>>Syrian Arab Republic</option>
										<option value="Taiwan, Province of China" <?php echo ($selected == "Taiwan, Province of China")?  'selected="selected"' : '' ?>>Taiwan, Province of China</option>
										<option value="Tajikistan" <?php echo ($selected == "Tajikistan")?  'selected="selected"' : '' ?>>Tajikistan</option>
										<option value="Tanzania, United Republic of" <?php echo ($selected == "Tanzania, United Republic of")?  'selected="selected"' : '' ?>>Tanzania, United Republic of</option>
										<option value="Thailand" <?php echo ($selected == "Thailand")?  'selected="selected"' : '' ?>>Thailand</option>
										<option value="Timor-Leste" <?php echo ($selected == "Timor-Leste")?  'selected="selected"' : '' ?>>Timor-Leste</option>
										<option value="Togo" <?php echo ($selected == "Togo")?  'selected="selected"' : '' ?>>Togo</option>
										<option value="Tokelau" <?php echo ($selected == "Tokelau")?  'selected="selected"' : '' ?>>Tokelau</option>
										<option value="Tonga" <?php echo ($selected == "Tonga")?  'selected="selected"' : '' ?>>Tonga</option>
										<option value="Trinidad and Tobago" <?php echo ($selected == "Trinidad and Tobago")?  'selected="selected"' : '' ?>>Trinidad and Tobago</option>
										<option value="Tunisia" <?php echo ($selected == "Tunisia")?  'selected="selected"' : '' ?>>Tunisia</option>
										<option value="Turkey" <?php echo ($selected == "Turkey")?  'selected="selected"' : '' ?>>Turkey</option>
										<option value="Turkmenistan" <?php echo ($selected == "Turkmenistan")?  'selected="selected"' : '' ?>>Turkmenistan</option>
										<option value="Turks and Caicos Islands" <?php echo ($selected == "Turks and Caicos Islands")?  'selected="selected"' : '' ?>>Turks and Caicos Islands</option>
										<option value="Tuvalu" <?php echo ($selected == "Tuvalu")?  'selected="selected"' : '' ?>>Tuvalu</option>
										<option value="Uganda" <?php echo ($selected == "Uganda")?  'selected="selected"' : '' ?>>Uganda</option>
										<option value="Ukraine" <?php echo ($selected == "Ukraine")?  'selected="selected"' : '' ?>>Ukraine</option>
										<option value="United Arab Emirates" <?php echo ($selected == "United Arab Emirates")?  'selected="selected"' : '' ?>>United Arab Emirates</option>
										<option value="United Kingdom" <?php echo ($selected == "United Kingdom")?  'selected="selected"' : '' ?>>United Kingdom</option>
										<option value="United States" <?php echo ($selected == "United States")?  'selected="selected"' : '' ?>>United States</option>
										<option value="United States Minor Outlying Islands" <?php echo ($selected == "United States Minor Outlying Islands")?  'selected="selected"' : '' ?>>United States Minor Outlying Islands</option>
										<option value="Uruguay" <?php echo ($selected == "Uruguay")?  'selected="selected"' : '' ?>>Uruguay</option>
										<option value="Uzbekistan" <?php echo ($selected == "Uzbekistan")?  'selected="selected"' : '' ?>>Uzbekistan</option>
										<option value="Vanuatu" <?php echo ($selected == "Vanuatu")?  'selected="selected"' : '' ?>>Vanuatu</option>
										<option value="Venezuela, Bolivarian Republic of" <?php echo ($selected == "Venezuela, Bolivarian Republic of")?  'selected="selected"' : '' ?>>Venezuela, Bolivarian Republic of</option>
										<option value="Viet Nam" <?php echo ($selected == "Viet Nam")?  'selected="selected"' : '' ?>>Viet Nam</option>
										<option value="Virgin Islands, British" <?php echo ($selected == "Virgin Islands, British")?  'selected="selected"' : '' ?>>Virgin Islands, British</option>
										<option value="Virgin Islands, U.S." <?php echo ($selected == "Virgin Islands, U.S.")?  'selected="selected"' : '' ?>>Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna" <?php echo ($selected == "Wallis and Futuna")?  'selected="selected"' : '' ?>>Wallis and Futuna</option>
										<option value="Western Sahara" <?php echo ($selected == "Western Sahara")?  'selected="selected"' : '' ?>>Western Sahara</option>
										<option value="Yemen" <?php echo ($selected == "Yemen")?  'selected="selected"' : '' ?>>Yemen</option>
										<option value="Zambia" <?php echo ($selected == "Zambia")?  'selected="selected"' : '' ?>>Zambia</option>
										<option value="Zimbabwe" <?php echo ($selected == "Zimbabwe")?  'selected="selected"' : '' ?>>Zimbabwe</option>
									</select>			
							</div>
							<span class="description"><?php _e("Please enter your country."); ?></span>
					</td>
			</tr>
    </table>
<?php }
/*========================================
  Save in database
  ========================================*/
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'userAddress', $_POST['userAddress'] );
    update_user_meta( $user_id, 'userCity', $_POST['userCity'] );
    update_user_meta( $user_id, 'userPostalcode', $_POST['userPostalcode'] );
    update_user_meta( $user_id, 'userPhone', $_POST['userPhone'] );
		update_user_meta( $user_id, 'userCountry', $_POST['userCountry'] );
}
/*========================================
  Remove additional css
  ========================================*/
add_action( 'customize_register', 'prefix_remove_css_section', 15 );
function prefix_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
?>