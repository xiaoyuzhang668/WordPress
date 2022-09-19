<?php 
/*============================
/* Remove tab
/*===========================*/
add_filter ( 'woocommerce_account_menu_items', 'cz_remove_my_account_links' );
function cz_remove_my_account_links( $menu_links ){ 
//	unset( $menu_links['edit-address'] ); // Addresses 
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	//unset( $menu_links['orders'] ); // Remove Orders
//	unset( $menu_links['downloads'] ); // Disable Downloads
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link 
	return $menu_links; 
}
/*============================
/* Rename tab
/*===========================*/
add_filter ( 'woocommerce_account_menu_items', 'cz_rename_downloads' ); 
function cz_rename_downloads( $menu_links ){ 
	global $current_user; wp_get_current_user(); 
	// $menu_links['TAB ID HERE'] = 'NEW TAB NAME HERE';
	$menu_links['dashboard'] = $current_user->display_name."'s Dashboard"; 
	$menu_links['downloads'] = 'My Download Files';
	return $menu_links;
}
/*=======================================
/* Add more tab - link to custom url
/*========================================*/
add_filter ( 'woocommerce_account_menu_items', 'cz_one_more_link' );
function cz_one_more_link( $menu_links ){ 
	// we will hook "anyuniquetext123" later
	$new = array( 'gift1' => 'Back to Home' ); 
	// or in case you need 2 links
	// $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' ); 
	// array_slice() is good when you want to add an element between the other ones
	$menu_links = array_slice( $menu_links, 0, 8, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true ); 
	return $menu_links;
} 
add_filter( 'woocommerce_get_endpoint_url', 'cz_hook_endpoint', 10, 4 );
function cz_hook_endpoint( $url, $endpoint, $value, $permalink ){ 
	if( $endpoint === 'gift1' ) { 
		// ok, here is the place for your custom URL, it could be external
		$url = site_url(); 
	}
	return $url; 
}
/*============================
/* Add new tab
/*===========================*/
/* * Step 1. Add Link (Tab) to My Account menu */
add_filter ( 'woocommerce_account_menu_items', 'cz_log_history_link', 40 );
function cz_log_history_link( $menu_links ){ 
	$menu_links = array_slice( $menu_links, 0, 12, true ) 
	+ array( 'log-history' => 'Log history' )
	+ array_slice( $menu_links, 5, NULL, true ); 
	return $menu_links; 
}
/* * Step 2. Register Permalink Endpoint */
add_action( 'init', 'cz_add_endpoint' );
function cz_add_endpoint() { 
	// WP_Rewrite 
	add_rewrite_endpoint( 'log-history', EP_PAGES ); 
}
/** Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint */
function user_last_login( $user_login, $user ){
    update_user_meta( $user->ID, '_last_login', time() );
}
add_action( 'wp_login', 'user_last_login', 10, 2 );
add_action( 'woocommerce_account_log-history_endpoint', 'cz_my_account_endpoint_content' );
function cz_my_account_endpoint_content() { 
	echo "Last time you logged in: ". human_time_diff(get_user_meta( get_current_user_id(), '_last_login', true )). ' ago.';
}
/* * Step 4 */
// Go to Settings > Permalinks and just push "Save Changes" button.
/*============================
/* Add text before  navigation
/*===========================*/
add_action('woocommerce_before_account_navigation', 'cz_some_content_before');
function cz_some_content_before(){
	global $current_user; wp_get_current_user(); 
	echo "<h3 class='mb-5'>";
	echo 'Welcome to your dashboard: '. $current_user->display_name;
	echo "</h3>";
}
/*============================
/* Add text  after navigation
/*===========================*/
add_action('woocommerce_after_account_navigation', 'cz_some_content_after');
function cz_some_content_after(){
	global $current_user; wp_get_current_user();
	echo "<h6 class='my-5 mt-lg-0 '>";
	echo 'If you are not '. $current_user->display_name. ', please <a href="'. wp_logout_url( get_permalink() ) .'"><i class="mr-2 fas fa-user-times"></i>'. __("Log Out", "woocommerce" ) .'</a>';
	echo "</h6>";
}
/*============================
/* Update My account title
/*===========================*/
add_action( 'woocommerce_login_form_start','cz_add_login_text' ); 
function cz_add_login_text() {
   echo '<h4>Registered Customers</h4><p>If you have an account with us, log in using your email address.</p>';
} 
add_action( 'woocommerce_register_form_start','cz_add_reg_text' ); 
function cz_add_reg_text() {
   echo '<h4>New Customers</h4><p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>';
}
/*===============================================
/* My account page - add registration fields
/*================================================*/
// 1. ADD FIELDS  
add_action( 'woocommerce_register_form_start', 'add_name_woo_account_registration' );  
function add_name_woo_account_registration() {
    ?>  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
     <div class="clear"></div>  
    <?php
}  
///////////////////////////////
// 2. VALIDATE FIELDS  
add_filter( 'woocommerce_registration_errors', 'validate_name_fields', 10, 3 );  
function validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
//        $errors->add( 'billing_first_name_error', __( 'First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( 'Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}  
///////////////////////////////
// 3. SAVE FIELDS  
add_action( 'woocommerce_created_customer', 'save_name_fields' );  
function save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }  
}
/*====================================
/* My account page - add select fields
/*====================================*/
// 1. Show field @ My Account Registration  
add_action( 'woocommerce_register_form', 'extra_register_select_field' );  
function extra_register_select_field() {
    ?>  
<p class="form-row form-row-wide">
<label for="find_where"><?php _e( 'Where did you find us?', 'woocommerce' ); ?>  <span class="required">*</span></label>
<select name="find_where" id="find_where">
    <option value="goo">Google</option>
    <option value="fcb">Facebook</option>
    <option value="twt">Twitter</option>
</select>
</p>  
<?php    
}  
// -------------------
// 2. Save field on Customer Created action  
add_action( 'woocommerce_created_customer', 'save_extra_register_select_field' );   
function save_extra_register_select_field( $customer_id ) {
if ( isset( $_POST['find_where'] ) ) {
        update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}  
// -------------------
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)   
add_action( 'show_user_profile', 'show_extra_register_select_field', 30 );
add_action( 'edit_user_profile', 'show_extra_register_select_field', 30 ); 
add_action( 'woocommerce_edit_account_form', 'show_extra_register_select_field', 30 );   
function show_extra_register_select_field($user){ 
 if (empty ($user) ) {
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
  }    
?>            
<p class="form-row form-row-wide">
<label for=""><?php _e( 'Where did you find us?', 'woocommerce' ); ?>  <span class="required">*</span></label>
<select name="find_where" id="find_where">
    <option disabled value> -- select an option -- </option>
    <option value="goo" <?php if (get_the_author_meta( 'find_where', $user->ID ) == "goo") echo 'selected="selected" '; ?>>Google</option>
    <option value="fcb" <?php if (get_the_author_meta( 'find_where', $user->ID ) == "fcb") echo 'selected="selected" '; ?>>Facebook</option>
    <option value="twt" <?php if (get_the_author_meta( 'find_where', $user->ID ) == "twt") echo 'selected="selected" '; ?>>Twitter</option>
</select>
</p>  
<?php  
}  
// -------------------
// 4. Save User Field When Changed From the Admin/Front End Forms   
add_action( 'personal_options_update', 'save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'save_extra_register_select_field_admin' );   
function save_extra_register_select_field_admin( $customer_id ){
if ( isset( $_POST['find_where'] ) ) {
   update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}
/*========================================
/* My account page - purchased product
/*========================================*/
add_shortcode( 'my_purchased_products', 'products_bought_by_curr_user' );   
function products_bought_by_curr_user() {   
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;   
    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_is_paid_statuses() ),
    ) );   
    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if ( ! $customer_orders ) return;
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
        }
    }
    $product_ids = array_unique( $product_ids );
    $product_ids_str = implode( ",", $product_ids );   
    // PASS PRODUCT IDS TO PRODUCTS SHORTCODE
    return do_shortcode("[products ids='$product_ids_str']");   
}