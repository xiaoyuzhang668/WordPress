<?php 
/*==================================
/* update paypal icon at checkout
/*==================================*/
//add_filter( 'woocommerce_paypal_icon', 'replace_paypal_icon' );
//function replace_paypal_icon() {
//   return home_url().'/wp-content/themes/restaurant/assets/image/core-image/paypal.png' ;
//}
/*=======================================
/* Add donation before checkout button
/*=======================================*/
add_action( 'woocommerce_review_order_before_submit', 'checkout_add_on', 9999 ); 
function checkout_add_on() {
   $product_ids = array( 481, 482, 483 );
   $in_cart = false;
   foreach( WC()->cart->get_cart() as $cart_item ) {
      $product_in_cart = $cart_item['product_id'];
      if ( in_array( $product_in_cart, $product_ids ) ) {
         $in_cart = true;
         break;
      }
   }
   if ( ! $in_cart ) {
      echo '<h4>Make a Donation?</h4>';
      echo '<div class="d-flex flex-row mb-md-0 mb-5"><a class="btn btn-green px-lg-5 px-1 mx-2"  href="?add-to-cart=481"> $2 </a><a class="btn btn-green px-lg-5 px-1 mx-2"  href="?add-to-cart=482"> $4 </a><a class="btn btn-green mr-md-5 mr-0 px-lg-5 px-1 mx-2" href="?add-to-cart=483"> $10 </a></div>';
   }
}
/*============================
/* Check out form message*/
/*===========================*/
add_action( 'woocommerce_before_checkout_form', 'checkout_message' );
function checkout_message() {
		echo '<p class="h5 text-primary font-weight-bold pb-3">Please fill all required fields. Thank you!</p>';
		echo '<hr class="pb-4 style15">';
}
/*============================
/* Change/update text field
/*===========================*/
function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Billing details' :
            $translated_text = __( 'Billing', 'woocommerce' );
            break;	
				case 'Ship to a different address?' :
            $translated_text = __( 'Ship to an address different from billing address?', 'woocommerce' );				
            break;	
    }
    return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );
/*============================
/* Default field change */
/*===========================*/
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['address_1']['label'] = "Address";
     return $address_fields;
}
/*==========================================
/* Check out country name optional */
/*=========================================*/
add_filter( 'woocommerce_billing_fields', 'my_optional_fields' );
function my_optional_fields( $address_fields ) {
	$address_fields['billing_country']['required'] = false;
	return $address_fields;
}
/*============================
/* Check out remove company */
/*===========================*/
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_company']);	
	unset($fields['shipping']['shipping_company']);	
return $fields;
}
/*============================
/* Update Comment placehoder */
/*===========================*/
add_filter( 'woocommerce_checkout_fields' , 'custom_comment_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_comment_override_checkout_fields( $fields ) {
     $fields['order']['order_comments']['placeholder'] = 'My special notes for this order';
		 $fields['order']['order_comments']['label'] = "<scan class='font-weight-bold'>Notes:</scan>";
     return $fields;
}
/*==========================================================
/* Add the custom select field dropdown for delivery option
/*==========================================================*/
//* 1. Add select field to the checkout page
add_action('woocommerce_before_order_notes', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {
	echo '<h4 class="mt-3">'.__('Preferred Time of Delivery').'</h4>';
	woocommerce_form_field( 'daypart', array(
	    'type'          => 'select',
	    'class'         => array( 'wps-drop' ),
	    'label'         => __( 'Delivery options' ),
			'required'  => true, 
	    'options'       => array(
	    		'blank'		=> __( 'Select a time', 'woocommerce' ),
	        'Immediately after order'	=> __( 'Immediately after order', 'woocommerce' ),
	        'In the afternoon'	=> __( 'In the afternoon', 'woocommerce' ),
	        'In the evening' 	=> __( 'In the evening', 'woocommerce' )
	    )
 ),
	$checkout->get_value( 'daypart' ));
}
//* 2. Process the checkout
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;
    // Check if set, if its not set add an error.
    if ($_POST['daypart'] == "blank")
     wc_add_notice( '<strong>Please select a preferred time of delivery under Delivery options</strong>', 'error' );
 }
//* 3. Update the order meta with field value
 add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {
   if ($_POST['daypart']) update_post_meta( $order_id, 'daypart', esc_attr($_POST['daypart']));
 }
//* 4. Display field value on the order edition page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Delivery option').':</strong> ' . get_post_meta( $order->id, 'daypart', true ) . '</p>';
}
//* 5. Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys ) {
	$keys['Preferred time of delivery'] = 'daypart';
	return $keys;	
}
/*==================================================
/* Add shipping phone in shipping address */
/*==================================================*/
add_filter( 'woocommerce_checkout_fields' , 'custom_phone_override_checkout_fields' );
// 1. Our hooked in function - $fields is passed via the filter!
function custom_phone_override_checkout_fields( $fields ) {
     $fields['shipping']['shipping_phone'] = array(
        'label'     => __('Phone', 'woocommerce'),
				'placeholder'   => _x('Phone', 'placeholder', 'woocommerce'),
				'required'  => true,
				'class'     => array('form-row-wide'),
				'clear'     => true
     );
     return $fields;
}
/** 2.  Display field value on the order edit page */ 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'checkout_display_admin_order_meta', 10, 1 );
function checkout_display_admin_order_meta($order){
    echo '<p><strong>'.__('Phone From Checkout Form').':</strong> ' . get_post_meta( $order->get_id(), '_shipping_phone', true ) . '</p>';
}
/*============================
/* Add field below comment
/*===========================*/
//add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
//function my_custom_checkout_field( $checkout ) {
//    echo '<div id="my_custom_checkout_field"><h4 class="mt-3">' . __('My Field') . '</h4>';
//    woocommerce_form_field( 'my_field', array(
//        'type'          => 'text',
//				'required'    => true,
//        'class'         => array('d-flex flex-row my-field-class form-row-wide'),
//        'input_class'   => array('ml-3 flex-grow-1'),
//				'lable_class'   => array('pr-2'),
//        'label'         => __('Fill in this field'),
//        'placeholder'   => __('My extra field'),
//        ), $checkout->get_value( 'my_field' ));
//    echo '</div>';
//}
/** * Process the checkout - validate field  */
//add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
//function my_custom_checkout_field_process() {
//    // Check if set, if its not set add an error.
//    if ( ! $_POST['my_field'] )
//        wc_add_notice( __( "<strong>Please enter something into My Field</strong>" ), 'error' );
//}
///**  * Update the order meta with field value  */
//add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
//function my_custom_checkout_field_update_order_meta( $order_id ) {
//    if ( ! empty( $_POST['my_field_name'] ) ) {
//        update_post_meta( $order_id, 'my_field', sanitize_text_field( $_POST['my_field'] ) );
//    }
//}
///** * Display field value on the order edit page  */
//add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_field_order_meta', 10, 1 );
//function my_field_order_meta($order){
//    echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, 'my_field', true ) . '</p>';
//}
////* Add selection field value to emails
//add_filter('woocommerce_email_order_meta_keys', 'wps_myfield_order_meta_keys');
//function wps_myfield_order_meta_keys( $keys ) {
//	$keys['My field:'] = 'my_field';
//	return $keys;	
//}
/*============================
/* Display user name after note
/*===========================*/
//function custom_woocommerce_checkout_fields( $checkout_fields = array() ) {
//$checkout_fields['order']['imei'] = array(
//    'type'          => 'text',
//    'class'         => array('my-3 my-field-class form-row-wide'),
//    'label'         => __('Account name'),
//    'placeholder'   => __('auto-populate user name'),
//    'default' => $_GET['imei'],   
//    'custom_attributes' => array( 'disabled' => true)
//);
//return $checkout_fields;
//}
//add_filter( 'woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields' );
//// Save custom field
//add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta' );
//function custom_checkout_field_update_order_meta( $order_id ) {
//    if ( ! empty( $_POST['imei'] ) ) {
//        update_post_meta( $order_id, '_imei', sanitize_text_field( $_POST['imei'] ) );
//    }
//}