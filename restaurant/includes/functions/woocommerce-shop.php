<?php
/*============================
/* Change read more */
/*===========================*/
//function cz_short_des_product() {
//   echo "<p class='text-justify'>".wp_trim_words( get_the_excerpt(), 18 , '   >> >>' )."</p>";	
//}
//add_action( 'woocommerce_after_shop_loop_item_title', 'cz_short_des_product', 40 );
/*=============================================
/* Add short descriptin before add to cart */
/*============================================*/
//function cz_single_short_des_product() {
//   echo "<p class='text-justify'>". get_the_excerpt()."</p>";	
//}
//add_action( 'woocommerce_before_add_to_cart_form', 'cz_single_short_des_product', 40 );
/*==============================================
/* Display Quote if price is empty or zero */
/*==============================================*/
add_filter( 'woocommerce_get_price_html', 'cz_price_free_zero_empty', 9999, 2 );   
function cz_price_free_zero_empty( $price, $product ){
    if ( '' === $product->get_price() || 0 == $product->get_price() ) {
        $price = '<span class="woocommerce-Price-amount amount">Quote</span>';
    }  
    return $price;
}
/*==============================
/* Change product pagination */
/*=============================*/
add_filter( 'woocommerce_pagination_args', 	'cz_woo_pagination' );
function cz_woo_pagination( $args ) {
	$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
	$args['next_text'] = '<i class="fa fa-angle-right"></i>';
	return $args;
}
/*================================================================================================
/* Change number of products that are displayed per page (shop page and product category page) */
/*===============================================================================================*/
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 6; 
  return $cols;
}
/*==============================================================================================
/* Change number of products that are displayed per column (shop and product category page) */
/*==============================================================================================*/
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        if ( is_product_category() ) {
            return 3;
        }  elseif ( is_shop() ) {
            return 3;
        } else { // for other archive pages and shop page
            return 4;
        } 
    }
}
/*====================================================================================
/* Add note - before shop loog */
/*====================================================================================*/
add_action( 'woocommerce_before_shop_loop', 'cz_add_note_loop', 25 );  
function cz_add_note_loop () {
   global $product;
	 echo "<br><p class='bg-light rounded p-3 d-block'>Spicy Level: &nbsp; &nbsp; <i class='text-danger fas fa-pepper-hot'></i> &nbsp; &nbsp;   Gluton Free: &nbsp; &nbsp; <i class='text-danger fas fa-apple-alt'></i> &nbsp; &nbsp;Vegetarian Option available: &nbsp; &nbsp; <i class='fas fa-carrot text-danger'></i></p>";
}
/*====================================================================================
/* Add Discount percentage - red under product in shop page  (not on single pag e)*/
/*====================================================================================*/
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );  
function bbloomer_show_sale_percentage_loop() {
   global $product;
   if ( ! $product->is_on_sale() ) return;
//   if ( $product->is_type( 'simple' ) ) {		 
       $saving_percentage = get_post_meta( get_the_ID(), '_custom_product_number_field', true );
		 	 $saving_percentage = round( $saving_percentage, 0 );
//   } ;
//		elseif ( $product->is_type( 'variable' ) ) {
//      $max_percentage = 0;
//      foreach ( $product->get_children() as $child_id ) {
//         $variation = wc_get_product( $child_id );
//         $price = $variation->get_regular_price();
//         $sale = $variation->get_sale_price();
//         if ( $price != 0 && ! empty( $sale ) ) $percentage = ceil((( $price - $sale ) / $price) * 100);
//         if ( $percentage > $max_percentage ) {
//            $max_percentage = $percentage;
//         }
//      }
//   };
   if ( $saving_percentage > 0 ) echo "<button class='btn-danger rounded mr-2'>-" . round($saving_percentage) . "%</button>"; 
//	 if ( $max_percentage > 0 ) echo "<button class='btn-danger rounded'>-" . round($max_percentage) . "%</button>";
}
/*====================================================================================
/* Add Spicy level and gluten free and vegetarian option 
/*====================================================================================*/
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_mealoption_loop', 25 ); 
function bbloomer_show_mealoption_loop() {
	global $product;
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
			echo ' <small class="text-danger"><i class="text-danger fas fa-apple-alt"></i></small>'; }
	if (!empty ($woocommerce_vegetarian_option)) {
			if (!empty ($woocommerce_gluton_free)) {
					echo ' / '; 
			if ((empty ($woocommerce_gluton_free)) && (!empty ($woocommerce_spicy_level)) ) {
					echo ' / '; }
		echo '  <small class="text-danger"><i class="fas fa-carrot text-danger"></i></small>'; }
	}	
}
/*====================================================================================
/* Add country - country origin on product and single page
/*====================================================================================*/
add_action( 'woocommerce_product_meta_start', 'cz_display_location', 6 ); 
add_action( 'woocommerce_after_shop_loop_item', 'cz_display_location', 6 ); 
function cz_display_location() {
	global $product; $post;
//	$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
	$woocommerce_country_name = $product->get_meta('_woocommerce_country_name');
	$product->cat =  '<div class="d-flex flex-row mt-0 pt-0">Category: &nbsp; &nbsp;  '.get_the_term_list(get_the_ID(), 'product_cat', '  ', ' , ', '').'</div>'; 
//	$woocommerce_country_name = WC()->countries->countries[$woocommerce_country];
  if ((!empty ($woocommerce_country_name)) && ( (is_shop()) || ( is_single() ) ) ) {
    echo "<p class='mt-3  mb-0 pb-0'>Origin: ".$woocommerce_country_name."</p>"; // Some text or HTML here
  }	else { echo "<p class='pt-2 pb-0 mb-0'>Origin: Unknown</p>"; }
	if ((is_shop())  || (is_product_category())){
    echo "<scan class='bg-light'>".$product->cat."</scan>"; // Some text or HTML here
  }
}
/*=================================================
/* Add product sold out circle on both*/
/*=================================================*/
add_action( 'woocommerce_before_shop_loop_item_title', 'cz_display_sold_out_loop_woocommerce' ); 
function cz_display_sold_out_loop_woocommerce() {
    global $product;
     if ( !$product->is_in_stock() ) {
        echo '<span class="soldout bg-danger text-white px-3 py-1 rounded mr-2">' . __( 'SOLD OUT', 'woocommerce' ) . '</span>';
    }
}
/*========================================
/* Add featured flash on both */
/*========================================*/
function wc_add_featured_product_flash() {
	global $product;
	if ( $product->is_featured() ) {
		echo '<span class="featured bg-success text-white px-3 mr-2 py-1 rounded">Featured</span>';
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'wc_add_featured_product_flash' );
add_action( 'woocommerce_before_single_product_summary', 'wc_add_featured_product_flash' );
/*==============================================================================
/* Modify sorting setting */
/*===========================================================================*/
/*============================
/* 1. Add sorting - unset  */
/*===========================*/
// Modify the default WooCommerce orderby dropdown//
// Options: menu_order name, popularity, rating, date, price, price-desc
function cz_woocommerce_catalog_orderby( $orderby ) {
	unset($orderby["rating"]);
	unset($orderby["popularity"]);
//	unset($orderby["price"]);
//	unset($orderby["price-desc"]);
//	unset($orderby["menu-order"]);
//	unset($orderby["date"]);
	return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "cz_woocommerce_catalog_orderby", 20 );
/*============================
/* 2. Sort custom field
/*===========================*/
function cz_add_postmeta_ordering_args( $args_sort_cz ) {
	$cz_orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) :
        apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	switch( $cz_orderby_value ) {
		case 'date_asceding':
			$args_sort_cz['orderby'] = 'date';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'name':
			$args_sort_cz['orderby'] = 'title';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'name_descending':
			$args_sort_cz['orderby'] = 'title';
			$args_sort_cz['order'] = 'desc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'discount':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'desc';
			$args_sort_cz['meta_key'] = '_custom_product_number_field';
			break;
		case 'discount_ascending':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '_custom_product_number_field';
			break;
	 case 'location':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'asc';
				$args_sort_cz['meta_key'] = '_woocommerce_country_name';
				break;
	 case 'location_descending':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'desc';
				$args_sort_cz['meta_key'] = '_woocommerce_country_name';
				break;
	case 'spicy':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'asc';
				$args_sort_cz['meta_key'] = '_woocommerce_spicy_level';
				break;
	case 'spicy_descending':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'desc';
				$args_sort_cz['meta_key'] = '_woocommerce_spicy_level';
				break;
	case 'gluten_free':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'desc';
				$args_sort_cz['meta_key'] = '_woocommerce_gluton_free';
				break;
	case 'gluten_free_no':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'asc';
				$args_sort_cz['meta_key'] = '_woocommerce_gluton_free';
				break;
	case 'vegetarian_option':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'desc';
				$args_sort_cz['meta_key'] = '_woocommerce_vegetarian_option';
				break;
	case 'vegetarian_option_no':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'asc';
				$args_sort_cz['meta_key'] = '_woocommerce_vegetarian_option';
				break;
	}
	return $args_sort_cz;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'cz_add_postmeta_ordering_args' );
/*============================
/* 3. Add sorting order
/*===========================*/
add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');
add_filter( 'woocommerce_default_catalog_orderby_options', 'wc_customize_product_sorting' );
function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
			  'name' => __( 'Name: A -> Z', 'woocommerce' ),
			  'name_descending' => __( 'Name: Z -> A', 'woocommerce' ),
        'date' => __( 'Date: latest to oldest', 'woocommerce' ),
        'date_ascending' => __( 'Date: oldest to latest', 'woocommerce' ),
        'price' => __( 'Price: low to high', 'woocommerce' ),
        'price-desc' => __( 'Price: high to low', 'woocommerce' ),   
        'discount' => __( 'Discount: high to low', 'woocommerce' ),   
        'discount_ascending' => __( 'Discount: low to high', 'woocommerce' ), 
				'location'  => __( 'Origin: A -> Z', 'woocommerce' ),
				'location_descending'  => __( 'Origin: Z -> A', 'woocommerce' ),
				'spicy'  => __( 'Spicy: 0 -> 5', 'woocommerce' ),
				'spicy_descending'  => __( 'Spicy: 5 -> 0', 'woocommerce' ),
				'gluten_free'  => __( 'Gluten Free: Yes -> No', 'woocommerce' ),
				'gluten_free_no'  => __( 'Gluten Free: No -> Yes', 'woocommerce' ),
				'vegetarian_option'  => __( 'Vegetarian Option available: Yes -> No', 'woocommerce' ),
				'vegetarian_option_no'  => __( 'Vegetarian Option available: No -> Yes', 'woocommerce' ),
    );
    return $sorting_options;
}
/*==================================
/* Change add to cart text
/*=================================*/
// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to Bag', 'woocommerce' ); 
}
// To change add to cart text on product archives(Collection) page - shop page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Buy', 'woocommerce' );
}
//Change select options for variable text
add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
	global $product;
	if ( $product->is_type( 'variable' ) ) {
		$text = $product->is_purchasable() ? __( 'Select Options', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
	}
	return $text;
}, 10 );
/*=============================================
/* Show quantity before add to cart
/*============================================*/
add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<div class="float-right"><form action="' . esc_url( $product->add_to_cart_url() ) . '" class="my-3 d-flex flex-row cart" method="post" enctype="multipart/form-data">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" class="ml-3 btn btn-green alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form></div><hr class="clear d-block d-lg-none">';
	}
	return $html;
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt' );
/*==================================
/* Show new badge if between 7 days
/*=================================*/
//add_action( 'woocommerce_before_shop_loop_item_title', 'new_badge_shop_page', 3 );          
//function new_badge_shop_page() {
//   global $product;
//   $newness_days = 7;
//   $created = strtotime( $product->get_date_created() );
//   if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
//      echo '<span class="itsnew float-right">' . esc_html__( 'New!', 'woocommerce' ) . '</span>';
//   }
//}
/*====================================================
/* Change sale flash image - sale-flash.php
/*====================================================*/
//add_filter('woocommerce_sale_flash', 'my_custom_sales_badge');
//function my_custom_sales_badge() {
//    $img = '<div class="sales-badge"></div>';
//    return $img;
//}		
/*=============================================================
/* Exclude donation product category - category exclusion
/*============================================================*/
function custom_pre_get_posts_query( $q ) {
    $tax_query = (array) $q->get( 'tax_query' );
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'donation' ), // Don't display products in the clothing category on the shop page.
           'operator' => 'NOT IN'
    );
    $q->set( 'tax_query', $tax_query );
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' ); 
/**  * Show products only of selected category. */
//function get_subcategory_terms( $terms, $taxonomies, $args ) { 
//	$new_terms 	= array();
//	$hide_category 	= array( 44 ); // Ids of the category you don't want to display on the shop page 	
// 	  // if a product category and on the shop page
//	if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && is_shop() ) {
//	    foreach ( $terms as $key => $term ) {
//		if ( ! in_array( $term->term_id, $hide_category ) ) { 
//			$new_terms[] = $term;
//		}
//	    }
//	    $terms = $new_terms;
//	}
//  return $terms;
//}
//add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );
/*=============================================================
/* Redine short description
/*============================================================*/
function wpa_filter_short_description( $desc ){
    global $product;
    if ( is_shop( $product->id ) )
        $desc= wp_trim_words( get_the_excerpt(), 38 , '   .  .  .' );
    return $desc;
}
add_filter( 'woocommerce_short_description', 'wpa_filter_short_description' );