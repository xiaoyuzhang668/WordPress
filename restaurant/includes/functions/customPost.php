<?php
/*==============================================================
// 1.  Add Tea custom posty type -Add custom post grouped menu
/*==============================================================*/
 function frontpage_admin_menu() {
    add_menu_page(
        'Front Sections',
        'Front Sections',
        'manage_options',
        'front-sections',
        '',
        'dashicons-admin-home',
        -20
    );
 }
 add_action( 'admin_menu', 'frontpage_admin_menu' );
/*================================================
// Add tea
/*================================================*/
add_action( 'init', function () {  
	$options_foo = [ "Green Tea", "Red Tea", "White Tea", "Oolong Tea"]; 
	$length = count($options_foo);
        for ( $i=0; $i <$length; $i++) {
            $plural = $options_foo[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);					
            $labels = array(
                'name'                  => $plural,
                'singular_name'         => $plural,
                'add_new'               => "Add New $plural",
								'add_new_item'          => "New $plural",
                'edit_item'             => "Edit $plural",
                'new_item'              => "New $plural",
                'view_item'             => "View $plural",
                'view_items'            => "View $plural",
                'search_items'          => "Search $plural",
                "not_found"             => "No $plural Found",
                "not_found_in_trash"    => "No $plural Found in Trash",
                'all_items'             => "$plural",
                'attributes'            => "$plural Attributes",
                'parent_item_colon' 		=> "Parent $plural",
            );
            $supports = array('title', 'editor', 'thumbnail' /*, 'comments' */);
            $args = array(
								'hierarchical' 					=> true,
                'labels'                => $labels,
                'public'                => true,
								'has_archive' 					=> true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
								'query_var' 						=> true,
								'rewrite' 							=> true,
								'capability_type' 			=> 'post',
								'show_ui' 							=> true,
								'show_in_menu' 					=> true,
//								'show_in_menu' =>  'front-sections',
							  'show_in_menu' => 'edit.php',
								'show_in_nav_menus' 		=> true,
								'show_in_admin_bar' 		=> true, 
								'show_in_rest' 					=> true,
                'menu_position'         => $i+1,
                'menu_icon' 						=> get_template_directory_uri() . '/assets/image/dashicons/'.$singular.'.png' ,
//							  dashicon size 20px X 20px
                'supports'              => $supports,
                'can_export'            => 'true',
//							  'taxonomies'          	=> array( 'post_tag' ),
            );
            register_post_type($singular, $args);
        }
});
/*--------------------------------------------------------------------------------------
Edit  colum on post screen
--------------------------------------------------------------------------------------*/	
/*========================================================
 Sort on advanced custom field in order for sorting to work
  =========================================================*/
add_action( 'pre_get_posts', 'custom_orderby' );
    function custom_orderby( $query ) {
        if( ! is_admin() )
            return;
        $orderby = $query->get( 'orderby');
        if( 'origin' == $orderby ) {
            $query->set('meta_key','origin');
            $query->set('orderby','meta_value');
        }
        elseif ( 'price' == $orderby ) {
            $query->set('meta_key','price');
            $query->set('orderby','meta_value_num');
        }
        elseif ( 'ingredient' == $orderby ) {
            $query->set('meta_key','ingredient');
            $query->set('orderby','meta_value');
        }
    }
/*========================================
 Display on edit screen
  ========================================*/
$options_foo = [ "Green Tea", "Red Tea", "White Tea", "Oolong Tea"]; 
$length = count($options_foo);
  for ( $i=0; $i <$length; $i++) {
	$plural = $options_foo[$i];
	$string = str_replace(' ', '', $plural);
	$singular = strtolower($string);
add_action ( 'manage_'.$singular.'_posts_custom_column', 'custom_column', 10, 2 );
add_filter ( 'manage_edit-'.$singular.'_columns', 'add_new_columns');
add_filter('manage_edit-'.$singular.'_sortable_columns', 'members_column_register_sortable' );
}
function add_new_columns($columns) {
    $columns['cb'] = '<input type="checkbox" />';  
		$columns['riv_post_thumbs'] = _x('Thumbnails', 'column name');
	 	$columns['title'] = _x('Title', 'column name');	         
	 	$columns['origin'] = _x('Place of Origin', 'column name');	         
	 	$columns['price'] = _x('Price', 'column name');	         
	 	$columns['ingredient'] = _x('Ingredients', 'column name');	         
    $columns['date'] = _x('Date', 'column name'); 
    $columns['post_views'] = _x('Views', 'column name'); 
    return $columns;
}
function members_column_register_sortable( $columns ){
		$columns['price'] = 'price';
		$columns['ingredient'] = 'ingredient';
		$columns['origin'] = 'origin';
		return $columns;
}
/*================================================
// Add columns to post column
/*================================================*/
function custom_column ( $column, $post_id ) { 
	global $post;
   switch ( $column ) {
		case 'origin':
         echo get_field('origin');
       break;
    case 'price':
			 $price = get_post_meta( $post_id, 'price', true );
			 if ( ! $price ) {
					echo "<div style='color:red'>n/a</div>";    
				} else {
					echo '$ ' . number_format( $price, 0, '.', ',' ) . ' /500g';
				}
       break;
		case 'ingredient':
       $ingredient = get_post_meta( $post_id, 'ingredient', true );
			 if ( ! $ingredient ) {
					echo "<div style='color:red'>n/a</div>";    
				} else {
					echo  $ingredient;
				}
       break;
		 case 'post_views':
        echo getPostViews(get_the_ID());
			 break;
   }
};
/*--------------------------------------------------------------------------------------
2. Add download custom post type + taxonomy - Add Other customer post type
--------------------------------------------------------------------------------------*/
//add group menu
function support_admin_menu() {
    add_menu_page(
        'Support',
        'Support', /* name displayed on menu */
        'manage_options',
        'support',
        '',
        'dashicons-buddicons-community',
        0
    );
 }
add_action( 'admin_menu', 'support_admin_menu' );
//add sub menu
add_action( 'init', function () {  
	$options_foo = [ "Downloads", "FAQ",  "App Notes", "Knowledge Base", "Customizing"]; 
	$menu_icon = ['dashicons-format-aside', 'dashicons-megaphone', 'dashicons-images-alt2', 'dashicons-flag', 'dashicons-buddicons-community'];
        $length = count($options_foo);
  			for ( $i=0; $i <$length; $i++) {
            $plural = $options_foo[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);					
            $labels = array(
                'name'                  => $plural,
                'singular_name'         => $plural,
                'add_new'               => "Add New $plural",
								'add_new_item'          => "New $plural",
                'edit_item'             => "Edit $plural",
                'new_item'              => "New $plural",
                'view_item'             => "View $plural",
                'view_items'            => "View $plural",
                'search_items'          => "Search $plural",
                "not_found"             => "No $plural Found",
                "not_found_in_trash"    => "No $plural Found in Trash",
                'all_items'             => "$plural",
                'attributes'            => "$plural Attributes",
                'parent_item_colon' 		=> "Parent $plural",
            );
            $supports = array('title', 'editor', 'thumbnail');
            $args = array(
								'hierarchical' 					=> true,
                'labels'                => $labels,
//                'public'                => true,
//								'has_archive' 					=> true,
//                'exclude_from_search'   => false,
//                'publicly_queryable'    => true,
//								'query_var' 						=> true,
//								'rewrite' 							=> true,
//								'capability_type' 			=> 'post',
								'show_ui' 							=> true,
								'show_in_menu' 					=> 'support',
//								'show_in_nav_menus' 		=> true,
//								'show_in_admin_bar' 		=> true, 
//								'show_in_rest' 					=> true,
								'rewrite'            => array( 'slug' => $singular ),
								'taxonomies' => array( 'post_tag'),
                'menu_position'         => $i+4,
                'menu_icon' 						=> $menu_icon[$i],
                'supports'              => $supports,
//                'can_export'            => 'true'
            );
            register_post_type($singular, $args);
        }
});
/*========================================================
 Sort on advanced custom field in order for sorting to work
  =========================================================*/
add_action( 'pre_get_posts', 'download_custom_orderby' );
    function download_custom_orderby( $query ) {
        if( ! is_admin() )
            return;
        $orderby = $query->get( 'orderby');
        if( 'name_downloads' == $orderby ) {
            $query->set('meta_key','name_downloads');
            $query->set('orderby','meta_value');
        }
        elseif ( 'type_downloads_general' == $orderby ) {
            $query->set('meta_key','type_downloads_general');
            $query->set('orderby','meta_value_num');
        }
        elseif ( 'size_downloads' == $orderby ) {
            $query->set('meta_key','size_downloads');
            $query->set('orderby','meta_value');
        }
				elseif ( 'document_downloads' == $orderby ) {
            $query->set('meta_key','document_downloads');
            $query->set('orderby','meta_value');
        }
    }
/*========================================
 Display on edit screen
  ========================================*/
$options_foo = [ "Downloads" ]; 
$length = count($options_foo);
  for ( $i=0; $i <$length; $i++) {
	$plural = $options_foo[$i];
	$string = str_replace(' ', '', $plural);
	$singular = strtolower($string);
add_action ( 'manage_'.$singular.'_posts_custom_column', 'download_custom_column', 10, 2 );
add_filter ( 'manage_edit-'.$singular.'_columns', 'download_add_new_columns');
add_filter('manage_edit-'.$singular.'_sortable_columns', 'download_column_register_sortable' );
}
function download_add_new_columns($columns) {
    $columns['cb'] = '<input type="checkbox" />';  
	 	$columns['title'] = _x('Title', 'column name');	         
	 	$columns['type_downloads_general'] = _x('Downloads Type', 'column name');	         
	 	$columns['name_downloads'] = _x('Name', 'column name');	         
	 	$columns['document_downloads'] = _x('Type', 'column name');	         
	 	$columns['size_downloads'] = _x('Size(mb)', 'column name');	         
	 	$columns['author'] = _x('Author', 'column name');	         
    $columns['date'] = _x('Date', 'column name'); 
    $columns['post_views'] = _x('Views', 'column name'); 
    return $columns;
}
function download_column_register_sortable( $columns ){
		$columns['type_downloads_general'] = 'type_downloads_general';
		$columns['name_downloads'] = 'name_downloads';
		$columns['document_downloads'] = 'document_downloads';
		$columns['size_downloads'] = 'size_downloads';
		$columns['author'] = 'author';
		return $columns;
}
/*================================================
// Add columns to post column
/*================================================*/
function download_custom_column ( $column, $post_id ) { 
	global $post;
   switch ( $column ) {
		case 'type_downloads_general':
         echo get_field('type_downloads_general');
       break;
		case 'name_downloads':
         echo get_field('name_downloads');
       break;
		case 'document_downloads':
         echo get_field('document_downloads');
       break;
		case 'size_downloads':
         echo get_field('size_downloads');
       break;
    case 'post_views':
        echo getPostViews(get_the_ID());
			 break;
   }
};
/*========================================================
 2.1   technical  menu except download - Sort on advanced custom field in order for sorting to work
  =========================================================*/
add_action( 'pre_get_posts', 'technical_custom_orderby' );
    function technical_custom_orderby( $query ) {
        if( ! is_admin() )
            return;
        $orderby = $query->get( 'orderby');
        if( 'name_downloads' == $orderby ) {
            $query->set('meta_key','name_downloads');
            $query->set('orderby','meta_value');
        }
        elseif ( 'type_downloads_general' == $orderby ) {
            $query->set('meta_key','type_downloads_general');
            $query->set('orderby','meta_value_num');
        }
        elseif ( 'size_downloads' == $orderby ) {
            $query->set('meta_key','size_downloads');
            $query->set('orderby','meta_value');
        }
				elseif ( 'document_downloads' == $orderby ) {
            $query->set('meta_key','document_downloads');
            $query->set('orderby','meta_value');
        }
    }
/*========================================
 Display on edit screen
  ========================================*/
$options_foo = [ "FAQ",  "App Notes", "Knowledge Base", "Customizing"]; 
$length = count($options_foo);
  for ( $i=0; $i <$length; $i++) {
	$plural = $options_foo[$i];
	$string = str_replace(' ', '', $plural);
	$singular = strtolower($string);
add_action ( 'manage_'.$singular.'_posts_custom_column', 'technical_custom_column', 10, 2 );
add_filter ( 'manage_edit-'.$singular.'_columns', 'technical_add_new_columns');
add_filter('manage_edit-'.$singular.'_sortable_columns', 'technical_column_register_sortable' );
}
function technical_add_new_columns($columns) {
    $columns['cb'] = '<input type="checkbox" />';  
	 	$columns['title'] = _x('Title', 'column name');	 
	 	$columns['author'] = _x('Author', 'column name');	         
    $columns['date'] = _x('Date', 'column name'); 
    $columns['post_views'] = _x('Views', 'column name'); 
    return $columns;
}
function technical_column_register_sortable( $columns ){
		$columns['author'] = 'author';
		return $columns;
}
/*================================================
// Add columns to post column
/*================================================*/
function technical_custom_column ( $column, $post_id ) { 
	global $post;
   switch ( $column ) {
		case 'post_views':
        echo getPostViews(get_the_ID());
			 break;
   }
};
/*--------------------------------------------------------------------------------------
3.  News menu - Add Other customer post type, grouped under News
--------------------------------------------------------------------------------------*/
//add group menu
function news_admin_menu() {
    add_menu_page(
        'News',
        'News', /* name displayed on menu */
        'manage_options',
        'news',
        '',
        'dashicons-megaphone',
        0
    );
 }
add_action( 'admin_menu', 'news_admin_menu' );
//add sub menu
add_action( 'init', function () {  
	$options_foo = [ "News Release", "Solution",  "News" ]; 
	$menu_icon = ['dashicons-format-aside', 'dashicons-megaphone', 'dashicons-images-alt2' ];
        $length = count($options_foo);
  			for ( $i=0; $i <$length; $i++) {
            $plural = $options_foo[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);					
            $labels = array(
                'name'                  => $plural,
                'singular_name'         => $plural,
                'add_new'               => "Add New $plural",
								'add_new_item'          => "New $plural",
                'edit_item'             => "Edit $plural",
                'new_item'              => "New $plural",
                'view_item'             => "View $plural",
                'view_items'            => "View $plural",
                'search_items'          => "Search $plural",
                "not_found"             => "No $plural Found",
                "not_found_in_trash"    => "No $plural Found in Trash",
                'all_items'             => "$plural",
                'attributes'            => "$plural Attributes",
                'parent_item_colon' 		=> "Parent $plural",
            );
            $supports = array('title', 'editor', 'thumbnail');
            $args = array(
								'hierarchical' 					=> true,
                'labels'                => $labels,
                'public'                => true,
								'has_archive' 					=> true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
								'query_var' 						=> true,
								'rewrite' 							=> true,
								'capability_type' 			=> 'post',
								'show_ui' 							=> true,
								'show_in_menu' 					=> 'news',
								'show_in_nav_menus' 		=> true,
								'show_in_admin_bar' 		=> true, 
								'show_in_rest' 					=> true,
								'taxonomies'          => array('news-category','category' ),
                'menu_position'         => $i+4,
                'menu_icon' 						=> $menu_icon[$i],
                'supports'              => $supports,
                'can_export'            => 'true'
            );
            register_post_type($singular, $args);
        }
});
/*========================================
  Add taxonomy for News custom post
  ========================================*/
function tr_create_news_taxonomy() {
    register_taxonomy(
        'news-category',
        'news',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'news-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'tr_create_news_taxonomy' );
/*========================================
  Add taxonomy for Solution custom post
  ========================================*/
function tr_create_solution_taxonomy() {
    register_taxonomy(
        'solution-category',
        'solution',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'solution-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'tr_create_solution_taxonomy' );
/*========================================
  Edit news custom post list interface
  ========================================*/
$options_foo = [  "News Release", "Solution",  "News"  ]; 
$length = count($options_foo);
for ( $i=0; $i < $length ; $i++) {
	$plural = $options_foo[$i];
	$string = str_replace(' ', '', $plural);
	$singular = strtolower($string);
add_filter ( 'manage_edit-'.$singular.'_columns', 'add_new_custom_columns');
}
function add_new_custom_columns($news_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';  
		$new_columns['riv_post_thumbs'] = __('Thumbnails');
	 	$new_columns['title'] = _x('Title', 'column name');
		$new_columns['author'] = __('Author'); 
    $new_columns['date'] = _x('Publised Date', 'column name'); 
	 	$new_columns['wps_post_id'] = __('ID');
    return $new_columns;
}
/*==================================================
//4. Add export button to custom post screen
/*==================================================*/
add_action( 'restrict_manage_posts', function () { 
	$options_foo = [ "Green Tea", "Red Tea", "White Tea", "Oolong Tea",  "Photography", "Gallery" ]; 
   $length = count($options_foo);
		for ( $i=0; $i < $length ; $i++) {
            $plural = $options_foo[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);
    				$screen = get_current_screen(); 
    if (isset($screen->parent_file) && ("edit.php?post_type=$singular" == $screen->parent_file)) {
        ?>
        <scan class="mx-3 text-danger" id="image-note">Notes: image is mandatory for all <?php echo $plural; ?> posts.</scan>
        <input type="submit" name="export_all_<?php echo $singular; ?>" id="export_all_<?php echo $singular; ?>" class="button button-primary mr-2" value="Export All Published <?php echo $plural; ?>">
        <script type="text/javascript">
            jQuery(function($) {
							$('#image-note').insertAfter('a.page-title-action');
							$('#export_all_<?php echo $singular; ?>').insertAfter('#image-note');							
            });
        </script>
        <?php
    };
	}
});
/*==================================================
//Add export function
/*==================================================*/
add_action( 'init', 'func_export_all' );
function func_export_all() {
		$options_foo = [ "Green Tea", "Red Tea", "White Tea", "Oolong Tea", "Photography", "Gallery" ]; 
        $length = count($options_foo);
				for ( $i=0; $i < $length ; $i++) {
            $plural = $options_foo[$i];
						$string = str_replace(' ', '', $plural);
						$singular = strtolower($string);
    	if(isset($_GET['export_all_'.$singular])) {
        $arg = array(
                'post_type' => $singular,
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ); 
        global $post;
        $arr_post = get_posts($arg);
        if ($arr_post) { 
						header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv; charset=utf-8');
            header(sprintf( "Content-Disposition: attachment; filename=wordpress-$singular-csv-%s.csv", date( 'dmY-His' ) ) );
						header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
 
            $file = fopen('php://output', 'w');
						fputs( $file, "\xEF\xBB\xBF" ); 
 
            fputcsv($file, array('Title', 'URL', 'Content', 'Post Thumbnail URL', 'Published Date', 'Author'));
 
            foreach ($arr_post as $post) {
                setup_postdata($post);
                fputcsv($file, array(get_the_title(), get_the_permalink(), get_the_content(), get_the_post_thumbnail_url(),   get_the_date(), get_the_author() ));
            } 
            exit();
        }
    }
	}
}
/*--------------------------------------------------------------------------------------
Customize menu item
--------------------------------------------------------------------------------------*/
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
     'index.php',  
     'edit.php?post_type=front-sections', 
     'edit.php?post_type=support',   
     'edit.php?post_type=news',  		 
     'edit.php?post_type=gallery',
     'edit.php?post_type=page', // this is the default page menu
     'edit.php', // this is the default POST admin menu 
		 'themes.php',
 );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');
/*--------------------------------------------------------------------------------------
Add seperator after menu
--------------------------------------------------------------------------------------*/
add_action('admin_init', 'add_separators_admin_menu'); 
function add_separators_admin_menu() {
    //ADD SEPARATORS AFTER THESE MENU ITEMS
    $separatorsAfter = ['Dashboard',  'Appearance','Posts'];
    /////////////////////////////////////// 
    global $menu;
    if (is_admin()) {
        foreach((array) $separatorsAfter as $s){
            foreach ((array)$menu as $key => $item) {
                if (strpos($item[0], $s) !== false) {
                    array_splice($menu, $key+1, 0, array(array(
                        0 => '',
                        1 => 'read',
                        2 => 'separator-last',
                        3 => '',
                        4 => 'wp-menu-separator'
                    )));
                    break;
                }
            }
        }
    }
}
/*========================================
  Sort custom post type by date in dashboard
  ========================================*/
function wpse_819391_post_types_admin_order( $wp_query ) {
  if ( is_admin() && !isset( $_GET['orderby'] ) ) {     
    // Get the post type from the query
    $post_type = $wp_query->query['post_type'];
    if ( in_array( $post_type, array('news','announcement','faq') ) ) {
      $wp_query->set('orderby', 'date');
      $wp_query->set('order', 'DESC');
    }
  }
}
add_filter('pre_get_posts', 'wpse_819391_post_types_admin_order');
/*========================================
  Disable comments
  ========================================*/
add_action( 'init', 'remove_custom_post_comment' );
function remove_custom_post_comment() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'news', 'comments' );
}
/*========================================
  Check custom post type
  ========================================*/
function is_custom_post_type( $post = NULL ) {
    $all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );
    // there are no custom post types
    if ( empty ( $all_custom_post_types ) )
        return FALSE;
    $custom_types      = array_keys( $all_custom_post_types );
    $current_post_type = get_post_type( $post );
    // could not detect current type
    if ( ! $current_post_type )
        return FALSE;
    return in_array( $current_post_type, $custom_types );
}



//// hook into the init action and call create_book_taxonomies when it fires
//add_action( 'init', 'create_download_taxonomies', 0 );
//// create two taxonomies, genres and writers for the post type "book"
//function create_download_taxonomies() {
//	// Add new taxonomy, make it hierarchical (like categories)
//	$labels = array(
//		'name'              => _x( 'Types', 'taxonomy general name', 'textdomain' ),
//		'singular_name'     => _x( 'Types', 'taxonomy singular name', 'textdomain' ),
//		'search_items'      => __( 'Search Types', 'textdomain' ),
//		'all_items'         => __( 'All Types', 'textdomain' ),
//		'parent_item'       => __( 'Parent Types', 'textdomain' ),
//		'parent_item_colon' => __( 'Parent Types:', 'textdomain' ),
//		'edit_item'         => __( 'Edit Types', 'textdomain' ),
//		'update_item'       => __( 'Update Types', 'textdomain' ),
//		'add_new_item'      => __( 'Add New Types', 'textdomain' ),
//		'new_item_name'     => __( 'New Types Name', 'textdomain' ),
//		'menu_name'         => __( 'Types', 'textdomain' ),
//	);
//
//	$args = array(
//		'hierarchical'      => true,
//		'labels'            => $labels,
//		'show_ui'           => true,
//		'show_admin_column' => true,
//		'update_count_callback' => '_update_post_term_count',
//		'query_var'         => true,
//		'rewrite'           => array( 'slug' => 'type' ),
//	);
//
//	register_taxonomy( 'type', array( 'downloads' ), $args );
//}

/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
// */
/*=================================================
// Set radio button for category and taxonomy
/*==================================================*/
//function wpse_139269_term_radio_checklist( $args ) {
//    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'type' /* <== Change to your required taxonomy */ ) {
//        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
//            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
//                /**
//                 * Custom walker for switching checkbox inputs to radio.
//                 *
//                 * @see Walker_Category_Checklist
//                 */
//                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
//                    function walk( $elements, $max_depth, ...$args ) {
//                        $output = parent::walk( $elements, $max_depth, ...$args );
//                        $output = str_replace(
//                            array( 'type="checkbox"', "type='checkbox'" ),
//                            array( 'type="radio"', "type='radio'" ),
//                            $output
//                        );
//                        return $output;
//                    }
//                }
//            }
//            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
//        }
//    }
//    return $args;
//}
//add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );
/*=================================================
// Set default tag name if omitted in custom post faq
/*==================================================*/
//function set_archive_tag_on_publish($post_id,$post) {
//  if ($post->post_type == 'faq'
//    && $post->post_status == 'publish') {
//      wp_set_post_tags( $post_id, 'Atrchive', true );
//    }
//  }
//add_action('save_post','set_archive_tag_on_publish',10,2);
?>