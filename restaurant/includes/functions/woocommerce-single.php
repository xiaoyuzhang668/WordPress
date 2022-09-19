<?php 

/*=======================================================
/* Remove related product at the bottom - same category*/
/*=======================================================*/
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
/*==============================================
/* Add product thumbnail on single page*/
/*==============================================*/
add_action( 'after_setup_theme', 'yourtheme_setup' ); 
function yourtheme_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
/*====================================================================
/* Display sale data - sale price and sale date - on single product
/*===================================================================*/
add_filter( 'woocommerce_get_price_html', 'change_displayed_sale_price_html', 10, 2 );
function change_displayed_sale_price_html( $price, $product ) {
    // Only on sale products on frontend and excluding min/max price on variable products
    if( $product->is_on_sale() && ! is_admin() && ! $product->is_type('variable')){
        // Get product prices
        $regular_price = (float) $product->get_regular_price(); // Regular price
        $sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)
        // "Saving price" calculation and formatting
        $saving_price = wc_price( $regular_price - $sale_price );
        // "Saving Percentage" calculation and formatting
        $saving_percentage = get_post_meta( get_the_ID(), '_custom_product_number_field', true );
				$saving_percentage = round( $saving_percentage, 0 );
        // Append to the formated html price
				$price .= '<scan class="saved-sale pl-3">Save: '.$saving_price.' </scan>';
			 	if  ($product->is_type('simple')) $price .= '(<em class="sale-percentage">'.$saving_percentage.'</em>%)';
//        $price .= sprintf( __('<scan class="saved-sale pl-3">Save: %s <em>(%s)</em></scan>', 'woocommerce' ), $saving_price, $saving_percentage );
    }
    return $price;
}
/*====================================================================
/* Get sale date format show on single product and related product*/
/*====================================================================*/
add_filter( 'woocommerce_get_price_html', 'custom_price_html', 100, 2 );
function custom_price_html( $price, $product ) {
		global $post;
//		$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
    $sales_price_from = get_post_meta( $product->id, '_sale_price_dates_from', true );
    $sales_price_to   = get_post_meta( $product->id, '_sale_price_dates_to', true );
    if ( is_single() && $product->is_on_sale() && $sales_price_to != "" ) {
        $sales_price_date_from = date( "M-d-Y", $sales_price_from );
        $sales_price_date_to   = date( "M-d-Y", $sales_price_to );
        $price .= '<br><b>(Offer from ' . $sales_price_date_from . ' till ' . $sales_price_date_to . ')</b>';
    }
    return apply_filters( 'woocommerce_get_price', $price );
}
/*==========================================
/* Custom badge for single product */
/*==========================================*/
//add_action('woocommerce_before_add_to_cart_button', 'woocommerce_custom_fields_display');
//add_filter( 'woocommerce_loop_add_to_cart_link', 'cz_before_after_btn', 10, 3 ); 
//function cz_before_after_btn( $add_to_cart_html, $product, $args ){
//	global $product; $post;
//	$woocommerce_country = $product->get_meta('woocommerce_country');
//	$woocommerce_country_name = WC()->countries->countries[$woocommerce_country];
//	$product->cat =  '<div class="d-flex flex-row">Category: &nbsp; &nbsp;  '.get_the_term_list(get_the_ID(), 'product_cat', '  ', ' , ', '').'</div>'; 
//	
//	if ( is_shop() ) {
//	if (($woocommerce_country_name) && ('Unknown' != ($woocommerce_country_name))) {
//     $before = "<p class='border-dark border-top'>Origin: ".$woocommerce_country_name." (".$woocommerce_country.") </p>".$product->cat; // Some text or HTML here
//  }	else { $before = "<p class='border-dark border-top'>Origin: Unknown</p>".$product->cat; }
//	$after = ''; // Add some text or HTML here as well 
//	return $before . $add_to_cart_html . $after;
//} }
// 2. Display custom text and price @ single product page if checkbox checked
add_action( 'woocommerce_single_product_summary', 'cz_display_badge_if_checkbox', 6 );  
function cz_display_badge_if_checkbox() {
	global $product; $post;
//	$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
	$woocommerce_custom_text = $product->get_meta('_woocommerce_custom_badge_text');    
    if (( get_post_meta( $product->get_id(), '_woocommerce_custom_badge', true ) ) && (!empty($woocommerce_custom_text))) {
        echo '
				<div class="woocommerce-message">'.$woocommerce_custom_text.'</div>';
    }
	$woocommerce_spicy_level = $product->get_meta('_woocommerce_spicy_level');
	$woocommerce_vegetarian_option = $product->get_meta('_woocommerce_vegetarian_option');
	$woocommerce_gluton_free = $product->get_meta('_woocommerce_gluton_free');
	if (!empty ($woocommerce_spicy_level)) {
		if ($woocommerce_spicy_level == 1 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
		if ($woocommerce_spicy_level == 2 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
		if ($woocommerce_spicy_level == 3 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
		if ($woocommerce_spicy_level == 4 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
		if ($woocommerce_spicy_level == 5 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } }
	if (!empty ($woocommerce_gluton_free)) {
			if (!empty ($woocommerce_spicy_level)) {
					echo ' / '; }
			echo ' <small class="text-danger">Gluten Free</small>'; }
	if (!empty ($woocommerce_vegetarian_option)) {
			if (!empty ($woocommerce_gluton_free)) {
					echo ' / '; 
			if ((empty ($woocommerce_gluton_free)) && (!empty ($woocommerce_spicy_level)) ) {
					echo ' / '; }
		echo '  <small class="text-danger">Vegetarian Option available</small>'; }
	}
}
//3. Display custom price custom price tag
function cz_change_product_html( $price_html, $product ) {
		global $product; $post;
	 	$custom_price_text = ( get_post_meta( $product->get_id(), '_woocommerce_custom_price_text', true ) );
	 	$custom_badge = ( get_post_meta( $product->get_id(), '_woocommerce_custom_badge', true ) );
    if (( get_post_meta( $product->get_id(), 'custom_badge', true )) && (!empty($custom_price_text))){
      $price_html = '<span class="amount">'.$custom_price_text.'</span>'; }
	 return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'cz_change_product_html', 10, 2 );
/*============================================
/* Single product page
/*============================================*/
// Change "You may also like..." text in WooCommerce, upsell in single product page
add_filter('gettext', 'change_ymal');
function change_ymal($translated) {
	$translated = str_ireplace('You may also like', 'Upsells products', $translated);
	return $translated; 
}
// Change "You may be interested in..." text in WooCommerce - cross sell in checkout page
add_filter('gettext', 'change_ymal2');
function change_ymal2($translated) {
	$translated = str_ireplace('You may be interested in', 'Cross-sells products', $translated);
	return $translated; 
}
/*============================
/* Move shop success message to top
/*===========================*/
//remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 ); /*Single Product*/
//add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
//add_action( 'woocommerce_single_product_summary', 'wc_print_notices', 31 );
/*============================================
/* Add continue shopping and view cart
/*============================================*/
//function bbloomer_continue_shopping_button() {
//  if ( wp_get_referer() ) echo '<a class="button continue" href="./mamas-teas/">Continue Shopping</a>';
//}
//add_action( 'woocommerce_before_single_product', 'bbloomer_view_cart_button', 32 ); 
//function bbloomer_view_cart_button() {
//  if ( wp_get_referer() ) echo '<a class="button viewcart" href="./cart/">View Cart</a>';
//}