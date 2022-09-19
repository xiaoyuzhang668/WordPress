<?php 
/*-----------------------------------------------------------------------------------------------------
Shopping Cart
?*-----------------------------------------------------------------------------------------------------*/
/*============================
/* Empty shopping cart
/*===========================*/
add_action( 'woocommerce_cart_actions', 'woocommerce_empty_cart_button' );
function woocommerce_empty_cart_button() {
	echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="button" title="' . esc_attr( 'Empty Cart', 'woocommerce' ) . '">' . esc_html( 'Empty Cart', 'woocommerce' ) . '</a>';
}
add_action( 'wp_loaded', 'woocommerce_empty_cart_action', 20 );
function woocommerce_empty_cart_action() {
	if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
		WC()->cart->empty_cart();
		$referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
		wp_safe_redirect( $referer );
	}
}
/*================================================
/* Return to shop change link */
/*================================================*/
function wc_empty_cart_redirect_url() {	
	$shop_page  = home_url( '/shop' );
  return $shop_page;
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url', 20 );
/*=====================================
/* Add continue shopping in cart
/*=====================================*/
add_action( 'woocommerce_before_cart_table', 'woo_add_continue_shopping_button_to_cart' );
function woo_add_continue_shopping_button_to_cart() {
 $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); 
 echo '<div class="woocommerce-message">';
 echo ' <a href="'.$shop_page_url.'" class="button text-center">Continue Shopping →</a> More?';
 echo '</div>';
}
/*============================================================
/* Get total saving before order total in cart and review
/*==============================================================*/ 
function wc_discount_total_30() { 
    global $woocommerce;      
    $discount_total = 0;      
    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values) {          
   	$_product = $values['data'];  
        if ( $_product->is_on_sale() ) {
        $regular_price = $_product->get_regular_price();
        $sale_price = $_product->get_sale_price();
        $discount = ($regular_price - $sale_price) * $values['quantity'];
        $discount_total += $discount;
        }  
    }            
    if ( $discount_total > 0 ) {
    echo '<tr class="cart-discount">
    <th>'. __( 'You Saved', 'woocommerce' ) .'</th>
    <td data-title=" '. __( 'You Saved', 'woocommerce' ) .' ">'
    . wc_price( $discount_total + $woocommerce->cart->discount_cart ) .'</td>
    </tr>';
    } 
} 
// Hook our values to the Basket and Checkout pages 
add_action( 'woocommerce_cart_totals_after_order_total', 'wc_discount_total_30', 99);
add_action( 'woocommerce_review_order_after_order_total', 'wc_discount_total_30', 99);
/*============================================
/* Cross sells under Cart page
/*============================================*/
// ---------------------------------------------
// Remove Cross Sells From Default Position  
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); 
// Replace cross sell content by text 
add_action( 'woocommerce_cart_collaterals', 'woocommerce_payment_note' ); 
	function woocommerce_payment_note () {	
		echo "<h6 class='my-3'>We accept the following payment options: </h6>";
		echo "<div class='row  d-flex align-items-center'>
							<div class='col-7 py-3'>
								<img src='https://www.restaurant.cathy-zhang.ca/wp-content/uploads/2020/06/paypal.png' alt=''>
							</div>
							<div class='col-5'>
								Paypal
							</div>
							<div class='col-7 py-3'>
								<img class='card-image' src='https://www.restaurant.cathy-zhang.ca/wp-content/uploads/2020/06/visa.png' alt=''>
								<img class='card-image mx-3' src='https://www.restaurant.cathy-zhang.ca/wp-content/uploads/2020/06/amex.png' alt=''>
								<img class='card-image' src='https://www.restaurant.cathy-zhang.ca/wp-content/uploads/2020/06/mastercard.png' alt=''>
							</div> 
							<div class='col-5'>
								Credit Card
							</div>
							<div class='col-7 py-3 mb-5'>
								<img class='img-fluid' src='https://www.restaurant.cathy-zhang.ca/wp-content/uploads/2020/06/alipay.png' alt=''>
							</div>
							<div class='col-5'>
								Alipay
							</div>
						</div>";
	}
// ---------------------------------------------
// Add them back UNDER the Cart Table// 
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
// ---------------------------------------------
// Display Cross Sells on 3 columns instead of default 4 
add_filter( 'woocommerce_cross_sells_columns', 'change_cross_sells_columns' ); 
	function change_cross_sells_columns( $columns ) {
	return 3;
} 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

add_action( 'woocommerce_single_product_summary', 'my_woocommerce_template_single_rating', 10 );

function my_woocommerce_template_single_rating() {
    global $product;

    if ( $product->post->comment_status === 'open' )
        wc_get_template( 'single-product/rating.php' );

    return true;
}
