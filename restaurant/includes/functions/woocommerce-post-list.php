<?php
/*================================================
// Add columns to product
/*================================================*/
//$columns['cb']  
//$columns['thumb']
//$columns['name'] 
//$columns['sku'] 
//$columns['is_in_stock']
//$columns['price']
//$columns['product_cat'] 
//$columns['product_tag']
//$columns['featured']
//$columns['product_type']
//$columns['date']
function add_product_column( $columns ) {
		unset( $columns['sku']  );
		unset( $columns['product_tag'] );
		$columns['gluton_free'] = __( 'Gluton Free', 'woocommerce' );
		$columns['vegetarian_option'] = __( 'Vege Option', 'woocommerce' );
		$columns['spicy_level'] = __( 'Spicy Level', 'woocommerce' );
		$columns['discount'] = __( 'Discount', 'woocommerce' );
		$columns['origin'] = __( 'Origin', 'woocommerce' );
		$columns['post_views'] = _x('Views', 'woocommerce');
    return $columns;
}
add_filter( 'manage_edit-product_columns', 'add_product_column', 10, 1 );
function add_product_column_content( $column, $post_id ) {
		global $product;
		switch ( $column ) {
		 case 'thumb':
       echo " <style> .column-thumb img{ max-height: 40px; max-width: 40px; border: 2px green solid; } </style>	";
       break;
     case 'gluton_free':
			$gluton_free = get_post_meta( $post_id, '_woocommerce_gluton_free', true ) ;
			if ( $gluton_free ) {
			 echo "<i class='text-danger fas fa-apple-alt'></i>"; }
       break;
		 case 'vegetarian_option':
       $gluton_free = get_post_meta ( $post_id, '_woocommerce_vegetarian_option', true );
			if ( $gluton_free ) {
			 echo "<i class='text-danger fas fa-carrot'></i>"; }
       break;
		 case 'spicy_level':
       $spicy_level = get_post_meta ( $post_id, '_woocommerce_spicy_level', true );
			if ( $spicy_level ) {
			 echo $spicy_level; }
       break;
     case 'discount':
			 $regular_price = get_post_meta ( $post_id, '_regular_price', true );
			 $discount = get_post_meta( $post_id, '_custom_product_number_field', true );
//			if ( $product instanceof WC_Product &&  $product->is_type( 'simple' ) ) {
			 if (!empty(  $discount )) {
				 echo number_format( $discount, 0, '.', ',' )."%" ;
				} else {
					echo "<div style='color:red'>n/a</div>";    
				}
       break;
			case 'origin':  
				$country_name = get_post_meta ( $post_id, '_woocommerce_country_name', true );
        echo $country_name;
			 break;
			case 'post_views': 
        echo getPostViews(get_the_ID());
			 break;
   }
}	
add_action( 'manage_product_posts_custom_column', 'add_product_column_content', 10, 2 );
/*=================================================
//Post views count
/*==================================================*/
//Set the Post Custom Field in the WP dashboard as Name/Value pair 
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);