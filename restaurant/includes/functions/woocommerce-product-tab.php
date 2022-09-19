<?php 
/*============================
/* Display post meta key on page head */
/*===========================*/
//add_action('wp_head', 'output_all_postmeta' );
//function output_all_postmeta() {
//	$postmetas = get_post_meta(get_the_ID());
//	foreach($postmetas as $meta_key=>$meta_value) {
//		echo $meta_key . ' : ' . $meta_value[0] . '<br/>';
//	}
//}
//SELECT meta_key FROM wp_postmeta WHERE post_id = POST_ID
/*============================
/* Unset tab on admin page
/*===========================*/
add_filter('woocommerce_product_data_tabs', 'cz_unset_product_tab' );
function cz_unset_product_tab( $tabs ){ 
	unset( $tabs['advanced'] ); 
//	unset( $tabs['inventory'] ); 
	return $tabs; 
}
/*============================
/* Unset marketplace tab
/*===========================*/
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );
/*=======================================================
/* Add product custom field in general tab
/*=======================================================*/
// 1. Add new fields to product edit page (General tab)  
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
function woocommerce_product_custom_fields() {
    global $woocommerce, $post;
		echo '<div class="options_group bg-light border border-warning rounded">';	
		woocommerce_wp_checkbox( 
			array( 
			'id' => '_woocommerce_custom_badge', 
			'value'   => get_post_meta( get_the_ID(), '_woocommerce_custom_badge', true ),
			'class' => '', 
			'label' => '<scan class="text-danger">Show Custom Badge - check this to display custom text and price</scan>',
			'desc_tip' =>true,
			'description' => 'Check this if you want to add custom message for this product.',
			) 
		);
	  // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_woocommerce_custom_badge_text',
						'value'   => get_post_meta( get_the_ID(), '_woocommerce_custom_badge_text', true ),
            'placeholder' => 'Type custom message if you check custom badge',
            'label' => __('Custom Badge Text Field', 'woocommerce'),
						'description' => 'Type custom message if you check custom badge.',
            'desc_tip' => 'true',
        )
    );
		 // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_woocommerce_custom_price_text',
						'value'   => get_post_meta( get_the_ID(), '_woocommerce_custom_price_text', true ),
            'placeholder' => 'Type custom price if you want different price for this product',
            'label' => __('Custom Price Text Field (number only)', 'woocommerce'),
						'wrapper_class'  => 'show_if_simple',
						'description' => 'Type custom price if you want different price for this product.',
            'desc_tip' => 'true',
						'type' => 'number',
						'default' => '0',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )			
    );
		echo '</div>';
//	get country field from woocommerce
		$countries_obj   = new WC_Countries();
    $countries   = $countries_obj->__get('countries');
		//	one way to add
	  $args = array(
			'type'  => 'select',
    	'id' => '_woocommerce_country',
			'label' => __('Origin', 'woocommerce'),		
			'value'   => get_post_meta( get_the_ID(), '_woocommerce_country', true ),
	    'class'         => array( 'wps-drop' ),
			'options'       => $countries,
			'default' => 'Unknown',
			'placeholder' => 'Origin country',
			'required'    => false,
			'description' => 'Select the country where this meal origins, if left blank, Unknown will be displayed for this meal.',
      'desc_tip' => 'true',
		);
	
	  echo '<div class="woocomerce_country">';
		woocommerce_wp_select($args);  
    //Custom Product Number Field
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_woocommerce_textarea',
						'value'   => get_post_meta( get_the_ID(), '_woocommerce_textarea', true ),
            'placeholder' => 'My note for this product',
            'label' => __('My note for this product', 'woocommerce')
        )
    );
    echo '</div>';
}
/*===================================================
/* 2. Add new country and contient if there is any
/*====================================================*/
add_filter( 'woocommerce_countries',  'add_my_country' );
function add_my_country( $countries ) {
  $new_countries = array(
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
/*===================================================
/* 3. Save data
/*====================================================*/
add_action( 'woocommerce_process_product_meta', 'cz_save_tab', 10, 2 );
function cz_save_tab( $id, $post ){ 
	global $post; global $product;
	//if( !empty( $_POST['super_product'] ) ) {
		update_post_meta( $id, '_woocommerce_custom_badge', $_POST['_woocommerce_custom_badge'] );
		update_post_meta( $id, '_woocommerce_custom_badge_text', $_POST['_woocommerce_custom_badge_text'] );
		update_post_meta( $id, '_woocommerce_custom_price_text', $_POST['_woocommerce_custom_price_text'] );
		update_post_meta( $id, '_woocommerce_country', $_POST['_woocommerce_country'] );
		update_post_meta( $id, '_woocommerce_textarea', $_POST['_woocommerce_textarea'] );	
		$woocommerce_country = $_POST['_woocommerce_country'];
		$woocommerce_country_name = WC()->countries->countries[$woocommerce_country];
 		update_post_meta( $id, '_woocommerce_country_name', $woocommerce_country_name, true );		
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//} 
}
/*=========================================
/* Add product custom field general tab
/*==========================================*/
// 1. Add new fields to product edit page (General tab)  - get discount
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields_2');
function woocommerce_product_custom_fields_2() {
    global $woocommerce, $post;
		echo '<div class="options_group bg-light border border-warning rounded">';	
		woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_number_field',
            'placeholder' => 'Discount',
//						'wrapper_class' => 'show_if_simple',
            'label' => __('Calculated Discount (enter manually for variable product only)', 'woocommerce'),
						'value'   => get_post_meta( get_the_ID(), '_custom_product_number_field', true ),
            'type' => 'number',
						'default' => '0',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0',
								'disabled' => true,
            ), 					
        )
    );
		echo '</div>';	
}
/*============================
/* Save product custom field
/*===========================*/
// Save Fields
// 2. Save checkbox via custom field  
add_action( 'woocommerce_process_product_meta', 'cz_save_product_tab_fields', 10, 2 );
function cz_save_product_tab_fields( $id, $post ){ 
	global $product; $post;
//	 if ( $product instanceof WC_Product &&  $product->is_type( 'simple' ) ) { 
	 	$custom_regular_price = $_POST['_regular_price'];
	 	$variable_discount = $_POST['_custom_product_number_field'];
	 	if (!empty($custom_regular_price)) { 
		 $discount_percentage = (($_POST['_regular_price'] - $_POST['_sale_price']) / ($_POST['_regular_price'])) * 100; 	
		if ($discount_percentage != 100 ) 
        update_post_meta($id, '_custom_product_number_field', esc_attr($discount_percentage)); 
		if ($discount_percentage == 100 )
			 	update_post_meta($id, '_custom_product_number_field', '0'); 	
	//	update spicy level
//	$spicy_level = isset( $_POST['spicy_level'] ) ? $_POST['spicy_level'] : '';
//    update_post_meta( $id, 'spicy_level', $spicy_level );
	} else {
		  update_post_meta($id, '_custom_product_number_field', $_POST['_custom_product_number_field']); 
	 }
}
/*=========================================
/* Save discount - if adding from below
/*=========================================*/
//add_action( 'woocommerce_process_product_meta', 'save_custom_field' );
//function save_custom_field( $post_id ) {  
//	$custom_regular_price = $_POST['_regular_price'];
//	if (empty($custom_regular_price)) {
//  $custom_field_value = isset( $_POST['meta[5227][value]'] ) ? $_POST['meta[5227][value]'] : '';  
//  $product = wc_get_product( $post_id );
//  $product->update_meta_data( 'custom_product_number_field', $custom_field_value );
//  $product->save();
//	}
//}
/*=========================================
/* Create new tab named - Meal Options
/*=========================================*/
//1. Create tab named Meal Options
add_filter('woocommerce_product_data_tabs', 'cz_product_note' );
function cz_product_note( $tabs ){ 
	//unset( $tabs['inventory'] ); 
	$tabs['cathy'] = array(
		'label'    => 'Meal Options',
		'target'   => 'cathy_product_note',
//		'class'  => 'show_if_simple',
//		'class'    => array('show_if_virtual'),
		'priority' => 0,
	);
	return $tabs; 
}
//2. add icon to panel
add_action('admin_head', 'cz_css_icon');
function cz_css_icon(){
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.cathy_options.cathy_tab a:before{
		content: "\f487";
		color: red;
	}
	</style>';	
}
//3. Add Tab content
add_action( 'woocommerce_product_data_panels', 'cz_product_note_panels' );
function cz_product_note_panels(){ 
	echo '<div id="cathy_product_note" class="panel woocommerce_options_panel hidden"><div class="row mx-3 p-3 bg-light border border-warning rounded"><div class="col-lg-6 border-right">'; 
	woocommerce_wp_checkbox( 
			array( 
			'id' => '_woocommerce_gluton_free', 
			'value'   => get_post_meta( get_the_ID(), '_woocommerce_gluton_free', true ),
			'class' => '', 
			'label' => '<i class="text-danger fas fa-apple-alt"></i> Gluton free option availabe? ',
			'desc_tip' =>true,
			'description' => __( 'Check this box if the meal is gluton free.' ),
			) 
		);
	  // Custom Product Text Field
   	woocommerce_wp_checkbox( 
			array( 
			'id' => '_woocommerce_vegetarian_option', 
			'value'   => get_post_meta( get_the_ID(), '_woocommerce_vegetarian_option', true ),
			'class' => '', 
			'label' => '<i class="text-danger fas fa-carrot"></i> Vegetarian option available? ',
			'desc_tip' => true,
			'description' => __( 'Check this box if the meal has vegetarian option available.'),
			) 
		);
	echo '</div><div class="col-lg-6">';
		 // Custom Product Text Field
    // Radio Buttons field
    woocommerce_wp_radio( 
			array(
        'id'            => '_woocommerce_spicy_level',
				'value'   => get_post_meta( get_the_ID(), '_woocommerce_spicy_level', true ),
        'wrapper_class' => 'pt-5 list-group list-group-horizontal',
        'label'         => 'Spicy level<br>',
				'desc_tip' => true,
        'description'   =>  __('Describe the level of spicy food.'),
				'class'  => array('list-group-item'),
				'input_class' => array ('list-group-item'),
				'label_class' => (''),
        'options'     => array(
						'0'      	=> __('Not spicy'),
            '1'       => __('Mild'),
            '2'       => __('Medium'),
            '3'       => __('Hot'),
            '4'       => __('Hell'),
            '5'       => __('Mexican'),
        )
    ) );   
		echo '</div></div>';
		woocommerce_wp_textarea_input( array(
			'id'          => '_woocommerce_changelog',
			'value'       => get_post_meta( get_the_ID(), '_woocommerce_changelog', true ),
			'label'       => 'Changelog',
			'desc_tip'    => true,
			'description' => 'Changelog here',
		) ); 
		woocommerce_wp_select( array(
			'id'          => '_woocommerce_version',
			'value'       => get_post_meta( get_the_ID(), '_woocommerce_version', true ),
	//		'wrapper_class' => 'show_if_downloadable',
			'label'       => 'Version Change',
			'options'     => array( '' => 'Please select', 'v1' => 'Version 1', 'v2' => 'Version 2', 'v3' => 'Version 3', 'v4' => 'Version 4', 'v5' => 'Version 5'),
		) ); 
		woocommerce_wp_text_input(
				array(
						'id' => '_woocommerce_product_release',
						'value'   => get_post_meta( get_the_ID(), '_woocommerce_product_release', true ),
						'placeholder' => 'Select a date when this meal was added by our chef...',
						'label' => __('Indicate the date when this meal was added by our chef', 'woocommerce'),
						'description' => 'Choose the date when this meal was added by our chef.',
						'desc_tip' => 'true',
						'class' => 'date-picker',
				)
		);
	echo '</div>'; 
}
//4. save data
add_action( 'woocommerce_process_product_meta', 'cz_save_tab_2', 10, 2 );
function cz_save_tab_2 ( $id, $post ){ 
	global $post;
	//if( !empty( $_POST['super_product'] ) ) {
		update_post_meta( $id, '_woocommerce_gluton_free', $_POST['_woocommerce_gluton_free'] );
		update_post_meta( $id, '_woocommerce_vegetarian_option', $_POST['_woocommerce_vegetarian_option'] );
		update_post_meta( $id, '_woocommerce_spicy_level', $_POST['_woocommerce_spicy_level'] );
		update_post_meta( $id, '_woocommerce_changelog', $_POST['_woocommerce_changelog'] );
		update_post_meta( $id, '_woocommerce_version', $_POST['_woocommerce_version'] );
		update_post_meta( $id, '_woocommerce_product_release', $_POST['_woocommerce_product_release'] );
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//} 
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
            'id' => '_inventory_note',
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
 $woocommerce_inventory_note = $_POST['_inventory_note'];
    if (!empty($woocommerce_inventory_note))
        update_post_meta($post_id, '_inventory_note', esc_attr($woocommerce_inventory_note));
}
/*========================================
/* Set price and title required field
/*========================================*/
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
//		product price can not be blank
      var val = $('#product-type').val();    	
			regular_price = $.trim($('#_regular_price').val());
				if ((val === 'simple') && ( $.trim($('#_regular_price').val()) == '' || $.trim($('#_regular_price').val()) == 0  ) ) {
					$('#_regular_price').prop('required',true);  // Set price field as required.
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
		$(document).ready(function() {
			var val = $('#product-type').val(); 
			if  (val == 'variable' ){   
				$('#_custom_product_number_field').prop('disabled', false);
		}
		});
		$(document).ready(function () {
				$("#product-type").change(function () {
						var x = $(this).val();
		//        alert($(this).val());
						if (x == 'variable') {
            alert("This is a variable project, discount needs to be entered manually if there is any.");
            $('#_custom_product_number_field').prop('disabled', false);
						document.getElementById('_custom_product_number_field').style.background = "rgba(255, 0, 0, 0.5)";
        } else {
						$('#_custom_product_number_field').prop('disabled', true);  // Readonly other than variable.
				}
    });
});	
</script>
<?php
}
}