<?php

/*============================
/* Change date format */
/*===========================*/
add_filter( 'post_date_column_time' , 'woo_custom_post_date_column_time', 10, 2 );
function woo_custom_post_date_column_time( $h_time, $post ) {
    $h_time = get_the_time( __( 'Ymd', 'woocommerce' ), $post );
    return $h_time;
}
/*============================
/* Change order date format */
/*===========================*/
// Woocommerce show time on order
add_filter('woocommerce_admin_order_date_format', 'custom_post_date_column_time');
function custom_post_date_column_time($h_time, $post){
    return get_the_time(__('Y/m/d G:i', 'woocommerce'), $post);
}


/*============================
/* Add Discount percentage */
/*===========================*/
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );  
function bbloomer_show_sale_percentage_loop() {
   global $product;
   if ( ! $product->is_on_sale() ) return;
   if ( $product->is_type( 'simple' ) ) {
      $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100; }
//   } elseif ( $product->is_type( 'variable' ) ) {
//      $max_percentage = 0;
//      foreach ( $product->get_children() as $child_id ) {
//         $variation = wc_get_product( $child_id );
//         $price = $variation->get_regular_price();
//         $sale = $variation->get_sale_price();
//         if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
//         if ( $percentage > $max_percentage ) {
//            $max_percentage = $percentage;
//         }
//      }
//   }
   if ( $max_percentage > 0 ) echo "<div class='sale-perc text-white font-weight-bold'>-" . round($max_percentage) . "%</div>"; 
}


/*============================
/* Search by category */
/*===========================*/
function search_by_cat() {
    global $wp_query;
    if (is_search()) {
        $cat = intval($_GET['cat']);
        $cat = ($cat > 0) ? $cat : '';
        $wp_query->query_vars['cat'] = $cat;
    }
}
/*============================
/* Add sorting - unset  */
/*===========================*/
// Modify the default WooCommerce orderby dropdown//
// Options: menu_order, popularity, rating, date, price, price-desc
function cz_woocommerce_catalog_orderby( $orderby ) {
	unset($orderby["rating"]);
	unset($orderby["popularity"]);
	unset($orderby["price"]);
//	unset($orderby["price-desc"]);
	unset($orderby["menu-order"]);
//	unset($orderby["date"]);
	return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "cz_woocommerce_catalog_orderby", 20 );
/*============================
/* Sort custom field
/*===========================*/
function cz_add_postmeta_ordering_args( $args_sort_cz ) {
	$cz_orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) :
        apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	switch( $cz_orderby_value ) {
		case 'date_a':
			$args_sort_cz['orderby'] = 'date';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'price_a':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '_price';
			break;
		case 'price-desc':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'desc';
			$args_sort_cz['meta_key'] = '_price';
			break;
		case 'name':
			$args_sort_cz['orderby'] = 'title';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'named':
			$args_sort_cz['orderby'] = 'title';
			$args_sort_cz['order'] = 'desc';
			$args_sort_cz['meta_key'] = '';
			break;
		case 'discount':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'desc';
			$args_sort_cz['meta_key'] = '_custom_product_number_field';
			break;
		case 'discountd':
			$args_sort_cz['orderby'] = 'meta_value_num';
			$args_sort_cz['order'] = 'asc';
			$args_sort_cz['meta_key'] = '_custom_product_number_field';
			break;
	 case 'location':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'asc';
				$args_sort_cz['meta_key'] = 'woocommerce_custom_fields';
				break;
	 case 'locationd':
				$args_sort_cz['orderby'] = 'meta_value';
				$args_sort_cz['order'] = 'desc';
				$args_sort_cz['meta_key'] = 'woocommerce_custom_fields';
				break;
	}
	return $args_sort_cz;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'cz_add_postmeta_ordering_args' );
//add sorting order
add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');
function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'date' => __( 'Date: newest to oldest', 'woocommerce' ),
        'date_a' => __( 'Date: oldest to newest', 'woocommerce' ),
        'price_a' => __( 'Price: low to high', 'woocommerce' ),
        'price-desc' => __( 'Price: high to low', 'woocommerce' ),
    );
    return $sorting_options;
}
function cz_add_new_postmeta_orderby( $sortby ) {		
		$sortby['name'] = __( 'Name: A->Z', 'woocommerce' );
		$sortby['named'] =  __('Name: Z->A', 'woocommerce' );
		$sortby['discount'] =  __('Discount', 'woocommerce' );
		$sortby['discountd'] =  __('Discount: descending', 'woocommerce' );
   	$sortby['location'] = __( 'Manufacture location: A->Z', 'woocommerce' );
   	$sortby['locationd'] = __( 'Manufacture location: Z->A', 'woocommerce' );
   return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'cz_add_new_postmeta_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'cz_add_new_postmeta_orderby' );
/*-----------------------------------------------------------------------------------------------------
Post Edit List
?*-----------------------------------------------------------------------------------------------------*/
/*============================
/* Create tab
/*===========================*/
add_filter('woocommerce_product_data_tabs', 'cz_product_note' );
function cz_product_note( $tabs ){ 
	//unset( $tabs['inventory'] ); 
	$tabs['cathy'] = array(
		'label'    => 'Cathy Note',
		'target'   => 'cathy_product_note',
//		'class'    => array('show_if_virtual'),
		'priority' => 299,
	);
	return $tabs; 
}
//Tab content
add_action( 'woocommerce_product_data_panels', 'cz_product_note_panels' );
function cz_product_note_panels(){ 
	echo '<div id="cathy_product_note" class="panel woocommerce_options_panel hidden">'; 
	woocommerce_wp_text_input( array(
		'id'                => 'cathy_version',
		'value'             => get_post_meta( get_the_ID(), 'cathy_version', true ),
		'label'             => 'Plugin version',
		'description'       => 'Description of plugin',
		'desc_tip'    			=> true,
	) ); 
	woocommerce_wp_textarea_input( array(
		'id'          => 'cz_changelog',
		'value'       => get_post_meta( get_the_ID(), 'cz_changelog', true ),
		'label'       => 'Changelog',
		'desc_tip'    => true,
		'description' => 'Changelog here',
	) ); 
	woocommerce_wp_select( array(
		'id'          => 'cz_ext',
		'value'       => get_post_meta( get_the_ID(), 'cz_ext', true ),
		'wrapper_class' => 'show_if_downloadable',
		'label'       => 'File extension',
		'options'     => array( '' => 'Please select', 'zip' => 'Zip', 'gzip' => 'Gzip'),
	) ); 
	woocommerce_wp_checkbox( 
			array( 
			'id' => 'cz_flagship', 
			'class' => '', 
			'label' => '<i class="fas fa-heart text-danger"></i> Is this a flagship product? ',
			'desc_tip' =>true,
			'description' => 'Check this if this is a flagship product.',
			) 
		);
	woocommerce_wp_text_input(
			array(
					'id' => 'flagship_date',
					'value'   => get_post_meta( get_the_ID(), 'flagship_date', true ),
					'placeholder' => 'Select a date...',
					'label' => __('Indicate the date the product is flagship product', 'woocommerce'),
					'description' => 'Choose the date the product is flagship product.',
					'desc_tip' => 'true',
					'class' => 'date-picker',
			)
	);
	echo '</div>'; 
}
//save data
add_action( 'woocommerce_process_product_meta', 'cz_save_tab', 10, 2 );
function cz_save_tab( $id, $post ){ 
	global $post;
$text = $_POST['post_type'];
	//if( !empty( $_POST['super_product'] ) ) {
		update_post_meta( $id, 'cathy_version', $text );
		update_post_meta( $id, 'cz_changelog', $_POST['cz_changelog'] );
		update_post_meta( $id, 'cz_flagship', $_POST['cz_flagship'] );
		update_post_meta( $id, 'flagship_date', $_POST['flagship_date'] );
		update_post_meta( $id, 'cz_ext', $_POST['cz_ext'] );
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//} 
}
//add icon to panel
add_action('admin_head', 'cz_css_icon');
function cz_css_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.cathy_options.cathy_tab a:before{
		content: "\f487";
		color: red;
	}
	</style>';
}
/*============================
/* Add new country
/*===========================*/
add_filter( 'woocommerce_countries',  'add_my_country' );
function add_my_country( $countries ) {
  $new_countries = array(
	       'UN'  => __( 'Unknown', 'woocommerce' ),
	       'Unknown'  => __( '', 'woocommerce' ),
	 );
	return array_merge( $countries, $new_countries );
}
add_filter( 'woocommerce_continents', 'add_my_country_to_continents' );
function add_my_country_to_continents( $continents ) {
	$continents['EU']['countries'][] = 'Unknown';
	$continents[' ']['countries'][] = ' ';
	return $continents;
}
/*============================
/* Add product custom field general tab
/*===========================*/
// 1. Add new fields to product edit page (General tab)  
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
function woocommerce_product_custom_fields() {
    global $woocommerce, $post;
		echo '<div class="options_group bg-light border border-warning rounded">';	
		woocommerce_wp_checkbox( 
			array( 
			'id' => 'custom_badge', 
			'value'   => get_post_meta( get_the_ID(), 'custom_badge', true ),
			'class' => '', 
			'label' => '<scan class="text-danger">Show Custom Badge - check this to display custom text and price</scan>',
			'desc_tip' =>true,
			'description' => 'Check this if you want to add custom message for this product.',
			) 
		);
	  // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => 'custom_badge_text',
						'value'   => get_post_meta( get_the_ID(), 'custom_badge_text', true ),
            'placeholder' => 'Type custom message if you check custom badge',
            'label' => __('Custom Badge Text Field', 'woocommerce'),
						'description' => 'Type custom message if you check custom badge.',
            'desc_tip' => 'true',
        )
    );
		 // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => 'custom_price_text',
						'value'   => get_post_meta( get_the_ID(), 'custom_price_text', true ),
            'placeholder' => 'Type custom price if you want different price for this product',
            'label' => __('Custom Price Text Field (dynamic pricing, custom feature to work on......)', 'woocommerce'),
						'wrapper_class'  => 'show_if_simple',
						'description' => 'Type custom price if you want different price for this product.',
            'desc_tip' => 'true',
        )
    );
		echo '</div>';
	
		$countries_obj   = new WC_Countries();
    $countries   = $countries_obj->__get('countries');
		//	one way to add
	  $args = array(
			'type'  => 'select',
    	'id' => 'woocommerce_custom_fields',
			'label' => __('Manufacture Location', 'woocommerce'),		
			'value'   => get_post_meta( get_the_ID(), 'woocommerce_custom_fields', true ),
	    'class'         => array( 'wps-drop' ),
			'options'       => $countries,
			'default' => 'Unknown',
			'placeholder' => 'Manufacture country',
			'required'    => false,
			'description' => 'Select the country where this product is made, if left blank, Unknown will be displayed for this product.',
      'desc_tip' => 'true',
		);
	  echo '<div class="product_custom_field">';
		woocommerce_wp_select($args);  
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_number_field',
            'placeholder' => 'Discount',
						'wrapper_class' => 'show_if_simple',
            'label' => __('Calculated Discount (do not enter)', 'woocommerce'),
						'value'   => get_post_meta( get_the_ID(), '_custom_product_number_field', true ),
            'type' => 'number',
						'default' => '0',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
						'value'   => get_post_meta( get_the_ID(), '_custom_product_textarea', true ),
            'placeholder' => 'My note for this product',
            'label' => __('My note for this product', 'woocommerce')
        )
    );
    echo '</div>';
}
/*============================
/* Save product custom field
/*===========================*/
// Save Fields
// 2. Save checkbox via custom field  
add_action( 'save_post', 'save_badge_checkbox_to_post_meta' );  
function save_badge_checkbox_to_post_meta( $product_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( isset( $_POST['custom_badge'] ) ) {
            update_post_meta( $product_id, 'custom_badge', $_POST['custom_badge'] );
    } else delete_post_meta( $product_id, 'custom_badge' );
}
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save'); 
function woocommerce_product_custom_fields_save($post_id) {
	global $product; $post;	
		//     Custom Product Text Field
    $custom_badge_text = $_POST['custom_badge_text'];
    if (!empty($custom_badge_text)) {
        update_post_meta($post_id, 'custom_badge_text', esc_attr($custom_badge_text));
		} else {
				delete_post_meta( $post_id, 'custom_badge_text' );
	} 
	//	 Custom Product text Field
    $custom_price_text = $_POST['custom_price_text'];
    if (!empty($custom_price_text)) {
        update_post_meta($post_id, 'custom_price_text', esc_attr($custom_price_text));
	} else {
				delete_post_meta( $post_id, 'custom_price_text' );
	} 	
//	 if ( $product instanceof WC_Product &&  $product->is_type( 'simple' ) ) { 
	 	$custom_regular_price = $_POST['_regular_price'];
	 if (!empty($custom_regular_price)) { 
		 $discount_percentage = (($_POST['_regular_price'] - $_POST['_sale_price']) / ($_POST['_regular_price'])) * 100; 	}
	  if ($discount_percentage != 100 ) 
        update_post_meta($post_id, '_custom_product_number_field', esc_attr($discount_percentage)); 
		if ($discount_percentage == 100 )
			 	update_post_meta($post_id, '_custom_product_number_field', '0'); 	
	
//			update_post_meta( $id, 'custom_badge', $_POST['custom_badge'] );
			update_post_meta( $post_id, 'woocommerce_custom_fields', $_POST['woocommerce_custom_fields'] ); 
// Custom Product Textarea Field
    $_custom_product_textarea = $_POST['_custom_product_textarea'];
    if (!empty($_custom_product_textarea)) {
        update_post_meta($post_id, '_custom_product_textarea', esc_html($_custom_product_textarea));
	} else {
				delete_post_meta( $post_id, '_custom_product_textarea' );
	} 
}
/*============================
/* Custom badge for single product */
/*===========================*/
// -----------------------------------------
// Display badge @ single product page if checkbox checked  
add_action( 'woocommerce_product_meta_start', 'cz_display_location', 6 ); 
function cz_display_location() {
	global $product; $post;
//	$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
	$custom_fields_woocommerce = $product->get_meta('woocommerce_custom_fields');
	$custom_fields_woocommerce_title = WC()->countries->countries[$custom_fields_woocommerce];
  if (!empty ($custom_fields_woocommerce_title)) {
    echo "<p class='border-dark border border-left-0 border-right-0 border-bottom-0 bg-light pt-2'>Manufacture Location: ".$custom_fields_woocommerce_title." (".$custom_fields_woocommerce.") </p>"; // Some text or HTML here
  }	else { echo "<p class='border-dark border border-left-0 border-right-0 border-bottom-0 bg-light pt-2'>Manufacture Location: Unknown</p>"; }
}
add_action( 'woocommerce_single_product_summary', 'cz_display_badge_if_checkbox', 6 );  
function cz_display_badge_if_checkbox() {
	global $product; $post;
//	$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
	$custom_badge_text = $product->get_meta('custom_badge_text');    
    if (( get_post_meta( $product->get_id(), 'custom_badge', true ) ) && (!empty($custom_badge_text))) {
        echo '
				<div class="woocommerce-message">'.$custom_badge_text.'</div>';
    }
}
//custom price tag
function cz_change_product_html( $price_html, $product ) {
		global $product; $post;
	 	$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
	 	$custom_badge = ( get_post_meta( $product->get_id(), 'custom_badge', true ) );
    if (( get_post_meta( $product->get_id(), 'custom_badge', true )) && (!empty($custom_price_text))){
      $price_html = '<span class="amount">'.$custom_price_text.'</span>'; }
	 return $price_html;
}
add_filter( 'woocommerce_get_price_html', 'cz_change_product_html', 10, 2 );
/*============================
/* Save product custom field - one way
/*===========================*/
//function save_woocommerce_product_custom_fields($post_id) {
//    $product = wc_get_product($post_id);
//    $custom_fields_woocommerce_title = isset($_POST['woocommerce_custom_fields']) ? $_POST['woocommerce_custom_fields'] : '';
//    $product->update_meta_data('woocommerce_custom_fields', sanitize_text_field($custom_fields_woocommerce_title));
//    $product->save();
//}
//add_action('woocommerce_process_product_meta', 'save_woocommerce_product_custom_fields');
/*============================
/* Change specific price */
/*===========================*/
//function cz_change_product_html( $price_html, $product ) {
// if ( 5149 === $product->id ) {
// $price_html = '<span class="amount">$38.00 per Unit<br>(Buy 2 for $30/unit)</span>';
// }
// return $price_html;
//}
//add_filter( 'woocommerce_get_price_html', 'cz_change_product_html', 10, 2 );
//function sv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
// if ( 5149 === $cart_item['product_id'] ) {
// $price = '$38.00 per Unit<br>(Buy 2 for $30/unit)';
// }
// return $price;
//}
//add_filter( 'woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3 );

//function cv_change_product_price_cart( $price, $cart_item, $cart_item_key ) {
//		$custom_badge = ( get_post_meta( $product->get_id(), 'custom_badge', true ) ); 
//		$custom_price_text = ( get_post_meta( $product->get_id(), 'custom_price_text', true ) );
//   if (($custom_badge == 'yes') && (!empty($custom_price_text))){
//      $price .= $custom_price_text; }	
//	 return $price;
//}
//add_filter( 'woocommerce_cart_item_price', 'cv_change_product_price_cart', 10, 3 );

/*============================
/* Display discount percentage
/*===========================*/
//add_action( 'woocommerce_after_shop_loop_item', 'mycode_show_discount_in_product_lists' ); // Product Loop
//add_action( 'woocommerce_single_product_summary', 'mycode_show_discount_in_product_lists' ); // Product Page
//function mycode_show_discount_in_product_lists() {
//	global $product;
//	$salediscount = get_post_meta( $product->id, '_custom_product_number_field', true );
//	if ( $salediscount > 0 ) {
//		echo '<div class="dfrps_salediscount">';
//		echo 'Save ' . $salediscount . '%';
//		echo '</div>';
//	}
//}
/*============================
/* Display product custom field 
/*===========================*/
//function woocommerce_custom_fields_display() {
//  global $post;
//  $product = wc_get_product($post->ID);
//   $custom_fields_woocommerce_title = $product->get_meta('woocommerce_custom_fields');
//  if ($custom_fields_woocommerce_title) {
//      printf(
//            '<div><label>%s</label><input type="text" id="woocommerce_product_custom_fields_title" name="woocommerce_product_custom_fields_title" value=""></div>',
//            esc_html($custom_fields_woocommerce_title)
//      );
//  }
//} 
//add_action('woocommerce_before_add_to_cart_button', 'woocommerce_custom_fields_display');
add_filter( 'woocommerce_loop_add_to_cart_link', 'cz_before_after_btn', 10, 3 ); 
function cz_before_after_btn( $add_to_cart_html, $product, $args ){
	global $product; $post;
	$custom_fields_woocommerce = $product->get_meta('woocommerce_custom_fields');
	$custom_fields_woocommerce_title = WC()->countries->countries[$custom_fields_woocommerce];
	$product->cat =  '<div class="d-flex flex-row">Category: &nbsp; &nbsp;  '.get_the_term_list(get_the_ID(), 'product_cat', '  ', ' , ', '').'</div>'; 
	if (($custom_fields_woocommerce_title) && ('Unknown' != ($custom_fields_woocommerce_title))) {
     $before = "<span class='border-dark border border-left-0 border-right-0 border-bottom-0'>Manufacture Location: ".$custom_fields_woocommerce_title." (".$custom_fields_woocommerce.") </span>".$product->cat; // Some text or HTML here
  }	else { $before = "<span class='border-dark border border-left-0 border-right-0 border-bottom-0'>Manufacture Location: Unknown</span>".$product->cat; }
	$after = ''; // Add some text or HTML here as well 
	return $before . $add_to_cart_html . $after;
}

//add_filter( 'woocommerce_loop_add_to_cart_link', 'misha_before_after_btn', 10, 3 ); 
//function misha_before_after_btn( $add_to_cart_html, $product, $args ){
//	global $product;
//	
//	$before = $product->cat; // Some text or HTML here
//	$after = ''; // Add some text or HTML here as well
// 
//	return $before . $add_to_cart_html . $after;
//}
//remove related sales
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//add product thumbnails
add_action( 'after_setup_theme', 'yourtheme_setup' ); 
function yourtheme_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}
/*============================
/* Action hook in inventory tab
/*===========================*/
//add more field to inventory tab
add_action( 'woocommerce_product_options_inventory_product_data', 'cz_option_group' ); 
function cz_option_group() {
	echo '<div class="option_group border border-dark rounded mt-3 bg-light">';
		  woocommerce_wp_textarea_input(
        array(
            'id' => 'inventory_note',
            'placeholder' => 'Inventory note for this product',
            'label' => __('Cathy inventory note for this product', 'woocommerce'),
						'description' => 'Add inventory note for this product',
					 	'desc_tip' => 'true',
        )
    );
    echo '</div>';
}
//update text field
add_action('woocommerce_process_product_meta', 'cz_inventory_save'); 
function cz_inventory_save($post_id) {
 $woocommerce_inventory_note = $_POST['inventory_note'];
    if (!empty($woocommerce_inventory_note))
        update_post_meta($post_id, 'inventory_note', esc_attr($woocommerce_inventory_note));
}
/*============================
/* Action hook in advanced tab
/*===========================*/
add_action( 'woocommerce_product_options_advanced', 'cz_adv_product_options');
function cz_adv_product_options(){ 
	echo '<div class="options_group border border-dark rounded mt-3 bg-light">'; 
	woocommerce_wp_checkbox( array(
		'id'      => 'super_product',
		'value'   => get_post_meta( get_the_ID(), 'super_product', true ),
		'label'   => 'This is a super product',
		'desc_tip' => true,
		'description' => 'If it is not a regular WooCommerce product',
	) ); 
	woocommerce_wp_text_input(
			array(
					'id' => 'withdraw_date',
					'value'   => get_post_meta( get_the_ID(), 'withdraw_date', true ),
					'placeholder' => 'Select a date...',
					'label' => __('Choose the date to withdraw this product', 'woocommerce'),
					'description' => 'Choose the date to withdraw this product.',
					'desc_tip' => 'true',
					'class' => 'date-picker',
			)
	);
	echo '</div>'; 
} 
add_action( 'woocommerce_process_product_meta', 'cz_save_fields', 10, 2 );
function cz_save_fields( $id, $post ){ 
	//if( !empty( $_POST['super_product'] ) ) {
		update_post_meta( $id, 'super_product', $_POST['super_product'] );
		update_post_meta( $id, 'withdraw_date', $_POST['withdraw_date'] );
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//} 
}

/*-----------------------------------------------------------------------------------------------------
Single Product page
?*-----------------------------------------------------------------------------------------------------*/
// Change "You may also like..." text in WooCommerce, upsell
add_filter('gettext', 'change_ymal');
function change_ymal($translated) {
	$translated = str_ireplace('You may also like', 'Upsells products', $translated);
	return $translated; 
}
// Change "You may be interested in..." text in WooCommerce
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

/*-----------------------------------------------------------------------------------------------------
Shopping Cart
?*-----------------------------------------------------------------------------------------------------*/
/*============================
/* Empty shopping cart
/*===========================*/
add_action( 'woocommerce_cart_coupon', 'woocommerce_empty_cart_button' );
function woocommerce_empty_cart_button() {
	echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="button text-center align-items-center" title="' . esc_attr( 'Empty Cart', 'woocommerce' ) . '">' . esc_html( 'Empty Cart', 'woocommerce' ) . '</a>';
}
add_action( 'wp_loaded', 'woocommerce_empty_cart_action', 20 );
function woocommerce_empty_cart_action() {
	if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
		WC()->cart->empty_cart();
		$referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
		wp_safe_redirect( $referer );
	}
}
/*============================
/* Return to shop change link */
/*===========================*/
function wc_empty_cart_redirect_url() {	
	$shop_page  = home_url( '/shop/all-products' );
  return $shop_page;
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url', 20 );
/*============================
/* Add continue shopping in cart
/*===========================*/
add_action( 'woocommerce_before_cart_table', 'woo_add_continue_shopping_button_to_cart' );
function woo_add_continue_shopping_button_to_cart() {
 $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); 
 echo '<div class="woocommerce-message">';
 echo ' <a href="'.$shop_page_url.'" class="button">Continue Shopping →</a> Would you like some more goods?';
 echo '</div>';
}
// ---------------------------------------------
// Remove Cross Sells From Default Position  
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); 
// ---------------------------------------------
// Add them back UNDER the Cart Table// 
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
// ---------------------------------------------
// Display Cross Sells on 3 columns instead of default 4 
add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' ); 
function bbloomer_change_cross_sells_columns( $columns ) {
return 3;
} 
// ---------------------------------------------
// Display Only 3 Cross Sells instead of default 4 
add_filter( 'woocommerce_cross_sells_total', 'bbloomer_change_cross_sells_product_no' );  
function bbloomer_change_cross_sells_product_no( $columns ) {
return 3;
}
/*-----------------------------------------------------------------------------------------------------
My Account
?*-----------------------------------------------------------------------------------------------------*/
/*============================
/* Add text before after navigation
/*===========================*/
add_action('woocommerce_before_account_navigation', 'cz_some_content_before');
function cz_some_content_before(){
	global $current_user; wp_get_current_user(); 
	echo "<h3 class='mb-5'>";
	echo 'Welcome to your dashboard: '. $current_user->display_name;
	echo "</h3>";
}
 
add_action('woocommerce_after_account_navigation', 'cz_some_content_after');
function cz_some_content_after(){
	global $current_user; wp_get_current_user();
	echo "<h6 class='my-5 mt-lg-0 '>";
	echo 'If you are not '. $current_user->display_name. ', please <a href="'. wp_logout_url( get_permalink() ) .'"><i class="mr-2 fas fa-user-times"></i>'. __("Log Out", "master" ) .'</a>';
	echo "</h6>";
}
/*============================
/* Set price and title required field
/*===========================*/
add_action( 'admin_head', 'cz_require_price_field' );
function cz_require_price_field() {
	global $post; global $product;
	$screen         = get_current_screen();
	$screen_id      = $screen ? $screen->id : ''; 
	if ( $screen_id == 'product' ) {
?>
<script	src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
jQuery(document).ready(function(jQuery){
  $( '#publish' ).on( 'click', function() {
			$('#title').prop('required',true);  // Set title field as required.
			title = $.trim($('#title').val());
					if ( title == '' ) {
						alert( 'Product title can not be blank.' );
						document.getElementById('title').style.background = "rgba(255, 0, 0, 0.5)";
						$('#title' ).focus();  // Focus on Weight field.
						return false;
					}	
      	var val = $('#product-type').val();    	
//			regular_price = $.trim($('#_regular_price').val());
				if ((val === 'simple') && ( $.trim($('#_regular_price').val()) == '' || $.trim($('#_regular_price').val()) == 0  ) ) {
					$('#_regular_price').prop('required',true);  // Set weight field as required.
					alert('Regular price for simple product could not be blank.') ;
						$( '.shipping_tab > a' ).click();  // Click on 'Shipping' tab.
						$( '#_regular_price' ).focus();  // Focus on price field.
						document.getElementById('_regular_price').style.background = "rgba(255, 0, 0, 0.5)";   // Focus on price field.
			//			$('#_regular_price').prop('required',true);  // Set price field as required.
					return false;
				} 
//				var val = $('#product-type').val();		
				$('#_regular_price').removeAttr('required');
				})
})	
</script>
<?php
}
}
/*============================
/* My account page
/*===========================*/
add_action( 'woocommerce_login_form_start','cz_add_login_text' ); 
function cz_add_login_text() {
   echo '<h4 class="bb-login-subtitle">Registered Customers</h4><p class="bb-login-description">If you have an account with us, log in using your email address.</p>';
} 
add_action( 'woocommerce_register_form_start','cz_add_reg_text' ); 
function cz_add_reg_text() {
   echo '<h4 class="bb-register-subtitle">New Customers</h4><p class="bb-register-description">By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>';
}
/*============================
/* My account page - add registration fields
/*===========================*/
// 1. ADD FIELDS  
add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );  
function bbloomer_add_name_woo_account_registration() {
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
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );  
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    return $errors;
}  
///////////////////////////////
// 3. SAVE FIELDS  
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );  
function bbloomer_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }  
}
/*============================
/* My account page - add select fields
/*===========================*/
// 1. Show field @ My Account Registration  
add_action( 'woocommerce_register_form', 'bbloomer_extra_register_select_field' );  
function bbloomer_extra_register_select_field() {
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
add_action( 'woocommerce_created_customer', 'bbloomer_save_extra_register_select_field' );   
function bbloomer_save_extra_register_select_field( $customer_id ) {
if ( isset( $_POST['find_where'] ) ) {
        update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}  
// -------------------
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)   
add_action( 'show_user_profile', 'bbloomer_show_extra_register_select_field', 30 );
add_action( 'edit_user_profile', 'bbloomer_show_extra_register_select_field', 30 ); 
add_action( 'woocommerce_edit_account_form', 'bbloomer_show_extra_register_select_field', 30 );   
function bbloomer_show_extra_register_select_field($user){ 
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
add_action( 'personal_options_update', 'bbloomer_save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'bbloomer_save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'bbloomer_save_extra_register_select_field_admin' );   
function bbloomer_save_extra_register_select_field_admin( $customer_id ){
if ( isset( $_POST['find_where'] ) ) {
   update_user_meta( $customer_id, 'find_where', $_POST['find_where'] );
}
}
/*============================
/* My account page - purchased product
/*===========================*/
add_shortcode( 'my_purchased_products', 'bbloomer_products_bought_by_curr_user' );   
function bbloomer_products_bought_by_curr_user() {   
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
/*============================
/* Set default for dropdown
/*===========================*/
add_filter( 'woocommerce_checkout_fields', 'bbloomer_set_checkout_field_input_value_default' ); 
function bbloomer_set_checkout_field_input_value_default($fields) {
    $fields['billing']['billing_city']['default'] = 'Ottawa';
    return $fields;
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
/* Change text field
/*===========================*/
function wc_billing_field_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Billing details' :
            $translated_text = __( 'Billing', 'woocommerce' );
            break;	
				case 'Ship to a different address?' :
            $translated_text = __( 'Ship to an address different to billing address?', 'woocommerce' );				
            break;	
    }
    return $translated_text;
}
add_filter( 'gettext', 'wc_billing_field_strings', 20, 3 );
/*============================
/* Check out phone optional */
/*===========================*/
add_filter( 'woocommerce_billing_fields', 'my_optional_fields' );
function my_optional_fields( $address_fields ) {
$address_fields['billing_phone']['required'] = false;
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
/* Comment placehoder */
/*===========================*/
add_filter( 'woocommerce_checkout_fields' , 'custom_comment_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_comment_override_checkout_fields( $fields ) {
     $fields['order']['order_comments']['placeholder'] = 'My special notes for this order';
		 $fields['order']['order_comments']['label'] = "<scan class='font-weight-bold'>Notes:</scan>";
     return $fields;
}
/*============================
/* Add shipping phone */
/*===========================*/
add_filter( 'woocommerce_checkout_fields' , 'custom_phone_override_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function custom_phone_override_checkout_fields( $fields ) {
     $fields['shipping']['shipping_phone'] = array(
        'label'     => __('Phone', 'woocommerce'),
				'placeholder'   => _x('Phone', 'placeholder', 'woocommerce'),
				'required'  => false,
				'class'     => array('form-row-wide'),
				'clear'     => true
     );
     return $fields;
}
/**
 * Display field value on the order edit page
 */ 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Phone From Checkout Form').':</strong> ' . get_post_meta( $order->get_id(), '_shipping_phone', true ) . '</p>';
}
/*============================
/* Default field change */
/*===========================*/
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields( $address_fields ) {
     $address_fields['address_1']['label'] = "Address";
     return $address_fields;
}
/*============================
/* Add the custom select field dropdow checkou
/*===========================*/
//* Add select field to the checkout page
add_action('woocommerce_before_order_notes', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {
	echo '<h4 class="mt-3">'.__('Next Day Delivery').'</h4>';
	woocommerce_form_field( 'daypart', array(
	    'type'          => 'select',
	    'class'         => array( 'wps-drop' ),
	    'label'         => __( 'Delivery options' ),
			'required'  => true, 
	    'options'       => array(
	    		'blank'		=> __( 'Select a day part', 'woocommerce' ),
	        'morning'	=> __( 'In the morning', 'woocommerce' ),
	        'afternoon'	=> __( 'In the afternoon', 'woocommerce' ),
	        'evening' 	=> __( 'In the evening', 'woocommerce' )
	    )
 ),
	$checkout->get_value( 'daypart' ));
}
//* Process the checkout
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;
    // Check if set, if its not set add an error.
    if ($_POST['daypart'] == "blank")
     wc_add_notice( '<strong>Please select a day part under Delivery options</strong>', 'error' );
 }
//* Update the order meta with field value
 add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {
   if ($_POST['daypart']) update_post_meta( $order_id, 'daypart', esc_attr($_POST['daypart']));
 }
//* Display field value on the order edition page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Delivery option').':</strong> ' . get_post_meta( $order->id, 'daypart', true ) . '</p>';
}
//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys ) {
	$keys['Daypart:'] = 'daypart';
	return $keys;	
}
/*============================
/* Add field below comment
/*===========================*/
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
function my_custom_checkout_field( $checkout ) {
    echo '<div id="my_custom_checkout_field"><h4 class="mt-3">' . __('My Field') . '</h4>';
    woocommerce_form_field( 'my_field', array(
        'type'          => 'text',
		'required'    => true,
        'class'         => array('d-flex flex-row my-field-class form-row-wide'),
        'input_class'   => array('ml-3 flex-grow-1'),
		'lable_class'   => array('pr-2'),
        'label'         => __('Fill in this field'),
        'placeholder'   => __('My extra field'),
        ), $checkout->get_value( 'my_field' ));
    echo '</div>';
}
/**
 * Process the checkout - validate field
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['my_field'] )
        wc_add_notice( __( "<strong>Please enter something into My Field</strong>" ), 'error' );
}
/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );
function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['my_field_name'] ) ) {
        update_post_meta( $order_id, 'my_field', sanitize_text_field( $_POST['my_field'] ) );
    }
}
/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_field_order_meta', 10, 1 );
function my_field_order_meta($order){
    echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, 'my_field', true ) . '</p>';
}
//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_myfield_order_meta_keys');
function wps_myfield_order_meta_keys( $keys ) {
	$keys['My field:'] = 'my_field';
	return $keys;	
}
/*============================
/* display user name after note
/*===========================*/
function custom_woocommerce_checkout_fields( $checkout_fields = array() ) {
$checkout_fields['order']['imei'] = array(
    'type'          => 'text',
    'class'         => array('my-3 my-field-class form-row-wide'),
    'label'         => __('Account name'),
    'placeholder'   => __('auto-populate user name'),
    'default' => $_GET['imei'],   
    'custom_attributes' => array( 'disabled' => true)
);
return $checkout_fields;
}
add_filter( 'woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields' );
// Save custom field
add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta' );
function custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['imei'] ) ) {
        update_post_meta( $order_id, '_imei', sanitize_text_field( $_POST['imei'] ) );
    }
}


?>