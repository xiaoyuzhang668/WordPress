<?php 
/*========================================
  Enable comments in all posts
  ========================================*/
function default_comments_on( $data ) {
    if( $data['post_type'] == 'post' ) {
        $data['comment_status'] = 1;
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_on' );
/*========================================
  Remove welcome screeen
  ========================================*/
remove_action( 'welcome_panel', 'wp_welcome_panel' );
/*====================================
//Remove screen option
/*====================================*/
//add_filter( 'screen_options_show_screen', '__return_false' );
/*========================================
  Remove page edit screen
  ========================================*/
function remove_page_fields() {
	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); //removes comments status
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); //removes comments
	remove_meta_box( 'authordiv' , 'page' , 'normal' ); //removes author 
}
add_action( 'admin_menu' , 'remove_page_fields' );
/*========================================
  Remove post edit screen
  ========================================*/
function my_remove_meta_boxes() {
	if ( ! current_user_can( 'manage_options' ) ) {
		remove_meta_box( 'linktargetdiv', 'link', 'normal' );
		remove_meta_box( 'linkxfndiv', 'link', 'normal' );
		remove_meta_box( 'linkadvanceddiv', 'link', 'normal' );
		remove_meta_box( 'postexcerpt', 'post', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
		remove_meta_box( 'postcustom', 'post', 'normal' );
// 		remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
// 		remove_meta_box( 'commentsdiv', 'post', 'normal' );
		remove_meta_box( 'revisionsdiv', 'post', 'normal' );
		remove_meta_box( 'authordiv', 'post', 'normal' );
		remove_meta_box( 'sqpt-meta-tags', 'post', 'normal' );
	}
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );
/*=================================================
//Remove tag support from post screen
/*==================================================*/
function myprefix_unregister_tags() {
   unregister_taxonomy_for_object_type('post_tag', 'post');
	 unregister_taxonomy_for_object_type('post_tag', 'gallery');
//	 register_taxonomy( 'post_tag', array('post_tag', 'faq') );
}
add_action('init', 'myprefix_unregister_tags');
/*===============================================
// remove tag or category item from post dashboard
=================================================*/
function my_manage_columns( $columns ) {
    unset( $columns['tags'], $columns['formats'],  /* $columns['comments'], */ $columns['author'], $columns['date']);
    return $columns;
}
function my_column_init() {
    add_filter( 'manage_posts_columns' , 'my_manage_columns' );
}
add_action( 'admin_init' , 'my_column_init' );
/*===============================================
// remove tag or category item from page dashboard
=================================================*/
function my_page_manage_columns( $columns ) {
    unset( $columns['comments']);
    return $columns;
}
function my_page_column_init() {
    add_filter( 'manage_pages_columns' , 'my_page_manage_columns' );
}
add_action( 'admin_init' , 'my_page_column_init' );
/*========================================================
 Sort on advanced custom field in order for sorting to work
  =========================================================*/
add_action( 'pre_get_posts', 'post_custom_orderby' );
    function post_custom_orderby( $query ) {
        $orderby = $query->get( 'orderby');
        if( 'test' == $orderby ) {
            $query->set('meta_key','test');
            $query->set('orderby','meta_value');
        }
				if( 'category_level' == $orderby ) {
            $query->set('meta_key','category_level');
            $query->set('orderby','meta_value');
        }
        elseif ( 'level_2_selection' == $orderby ) {
            $query->set('meta_key','level_2_selection');
            $query->set('orderby','meta_value_num');
        }	
    }
/*================================================
// add post id and format in post admin page
/*================================================*/
add_filter('manage_post_posts_columns', 'posts_columns_id', 5);
add_action('manage_post_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_edit-post_sortable_columns', 'posts_column_register_sortable' );
function posts_columns_id($defaults){
		$defaults['cb'] = '<input type="checkbox" />';	
		$defaults['riv_post_thumbs'] = __('Thumbnails');
    $defaults['title'] = __('Title');
//    $defaults['wps_post_id'] = __('ID');
    $defaults['categories'] = __('Categories'); 
		$defaults['category_level'] = __('Category Level');	
		$defaults['test'] = __('Test');	
//    $defaults['comments'] = __('Comment'); 
	  $defaults['author'] = __('Author');
		$defaults['date'] = __('Published Date');  
		$defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
    if( has_post_thumbnail() ) {
        echo the_post_thumbnail('Thumbnail');
    } else {
        echo "<div style='color:red'> - no image for posts.</div>";
        }        
  echo "  
	<style> .column-riv_post_thumbs img{ max-height: 40px; max-width: 40px; border-radius: 50%; border: 2px green solid; } </style>
"; }	
//	if($column_name === 'wps_post_id'){
//				echo $id;
//	}
	if ($column_name === 'test') {
		$category_level = get_post_meta( $id, 'test', true );
		echo $category_level;
	}
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
  }
}
function posts_column_register_sortable( $columns ){
		$columns['category_level'] = 'category_level';
		$columns['categories'] = 'test';
		$columns['test'] = 'categories';
		$columns['author'] = 'author';
		return $columns;
}
/*================================================
// reorder column on post list
/*================================================*/
function crunchify_reorder_post_columns($columns) {
  $crunchify_columns = array();
  $author = 'author'; 
  foreach($columns as $key => $value) {
    if ($key==$author){
      $crunchify_columns['riv_post_thumbs'] = '';   // Move thumbnail column before author column
//      $crunchify_columns['location'] = '';   // Move author column before title column     
    }
      $crunchify_columns[$key] = $value;
  }
  return $crunchify_columns;
}
add_filter('manage_posts_columns', 'crunchify_reorder_post_columns');
/*================================================
// add page id and format in page admin page
/*================================================*/
add_filter('manage_pages_columns', 'pages_columns_id', 5);
add_action('manage_pages_custom_column', 'pages_custom_id_columns', 5, 2); 
function pages_columns_id($defaults){
		$defaults['cb'] = '<input type="checkbox" />';			
    $defaults['title'] = __('Title');
		$defaults['riv_post_thumbs'] = __('Thumbnails');
		$defaults['location'] = __('Location');
//    $defaults['wps_post_id'] = __('ID');
	  $defaults['author'] = __('Author');
		$defaults['date'] = __('Published Date'); 
    return $defaults;
}
function pages_custom_id_columns($column_name, $id){
//	if($column_name === 'wps_post_id'){
//				echo $id;
//	}
	if($column_name === 'riv_post_thumbs'){
    if( has_post_thumbnail() ) {
        echo the_post_thumbnail('Thumbnail');
    } else {
        echo "<div class='text-danger'> - no image for pages.</div>";
        }        
  echo "  
	<style> .column-riv_post_thumbs img{ max-height: 40px; max-width: 40px; border-radius: 50%; border: 2px green solid; } </style>
"; }
	if ($column_name === 'location') {
		$category_level = get_post_meta( $id, 'location', true );
		echo $category_level;
	}
}
/*================================================
// reorder column on page list
/*================================================*/
function crunchify_reorder_columns($columns) {
  $crunchify_columns = array();
  $author = 'author'; 
  foreach($columns as $key => $value) {
    if ($key==$author){
      $crunchify_columns['riv_post_thumbs'] = '';   // Move date column before title column
      $crunchify_columns['location'] = '';   // Move author column before title column     
    }
      $crunchify_columns[$key] = $value;
  }
  return $crunchify_columns;
}
add_filter('manage_pages_columns', 'crunchify_reorder_columns');
/*======================================================================================
/* Prevent users from forgetting featured image when adding new post or new custom post 
/*=====================================================================================*/
// add_action('save_post', 'pu_validate_thumbnail');
// function pu_validate_thumbnail($post_id) {
//  	if((get_post_type($post_id) != 'post')  && (get_post_type($post_id) != 'news') && (get_post_type($post_id) != 'branch') && (get_post_type($post_id) != 'customer')  && (get_post_type($post_id) != 'gallery') && (get_post_type($post_id) != 'whitetea') && (get_post_type($post_id) != 'redtea') && (get_post_type($post_id) != 'greentea') && (get_post_type($post_id) != 'oolongtea') && (get_post_type($post_id) != 'photography') )
// 		return;
//  	if ( !has_post_thumbnail( $post_id ) ) {
//  	set_transient( "pu_validate_thumbnail_failed", "true" );
//  	remove_action('save_post', 'pu_validate_thumbnail');
// 		wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
// 		add_action('save_post', 'pu_validate_thumbnail');
// } else {
// 	delete_transient( "pu_validate_thumbnail_failed" );
// }
// }
/*==========================================================
/*Display error message if users forget to upload image */
/*==========================================================*/
// add_action('admin_notices', 'pu_validate_thumbnail_error');
// function pu_validate_thumbnail_error() {
// 		if ( get_transient( "pu_validate_thumbnail_failed" ) == "true" ) {
// 		echo "<div id='message' class='error text-danger font-weight-bold'><p>A post thumbnail must be uploaded before a post can be saved.  Post status will be Draft if a featured image is not set.</p></div>";
// 	delete_transient( "pu_validate_thumbnail_failed" ); }
// }
/*======================================================
/* Change set featured image text to something else */
/*======================================================*/
function change_featured_image_text( $content ) {
    return $content = str_replace( __( 'Set featured image' ), __( 'Click here to upload your image' ), $content);
}
add_filter( 'admin_post_thumbnail_html', 'change_featured_image_text' );
/*===================================
//add export button to post screen
/*===================================*/
add_action( 'restrict_manage_posts', 'add_export_button' );
function add_export_button() {
    $screen = get_current_screen(); 
    if (isset($screen->parent_file) && ('edit.php' == $screen->parent_file)) {
        ?>
<!--        <scan class="ml-3 text-danger" id="image-note">Notes: image is mandatory for all posts.</scan>-->
        <input type="submit" name="export_all_posts" id="export_all_posts" class="button button-primary" value="Export All Posts">        
        <script type="text/javascript">
            jQuery(function($) {
                $('#export_all_posts').insertAfter('#post-query-submit');
							 	$('#image-note').insertAfter('.page-title-action');
            });
        </script>
        <?php
    }
}
add_action( 'init', 'func_export_all_posts' );
function func_export_all_posts() {
    if(isset($_GET['export_all_posts'])) {
        $arg = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => -1,
//								'category_name' => 'breakfast',
            ); 
        global $post;
        $arr_post = get_posts($arg);
        if ($arr_post) {
						header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv; charset=utf-8');
            header(sprintf( 'Content-Disposition: attachment; filename=wordpress-post-csv-%s.csv', date( 'dmY-His' ) ) );
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
 
           	$file = fopen('php://output', 'w');
					 	fputs( $file, "\xEF\xBB\xBF" ); 

						fputcsv($file, array('Title', 'URL', 'Post Content', 'Post Category', 'Category Level', 'Level 2 Selection', 'Post Thumbnail URL', 'Post Date')); 
					
            foreach ($arr_post as $post) {
                setup_postdata($post);
								fputcsv( $file, array( get_the_title(), get_the_permalink() , get_the_content(), get_the_category( $post->ID)[0]->name, get_field('category_level'), get_field('level_2_selection'), get_the_post_thumbnail_url(), get_the_date() ) );
            } 
            exit();
        }
    }
}
/*====================================
//add export button to page screen
/*====================================*/
add_action( 'restrict_manage_posts', 'add_page_export_button' );
function add_page_export_button() {
    $screen = get_current_screen(); 
    if (isset($screen->parent_file) && ('edit.php?post_type=page' == $screen->parent_file)) {
        ?>
        <input type="submit" name="export_all_pages" id="export_all_pages" class="button button-primary" value="Export All Pages">       
        <script type="text/javascript">
            jQuery(function($) {
                $('#export_all_pages').insertAfter('#post-query-submit');
            });
        </script>
        <?php
    }
}
add_action( 'init', 'func_export_all_pages' );
function func_export_all_pages() {
    if(isset($_GET['export_all_pages'])) {
        $arg = array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ); 
        global $post;
        $arr_post = get_posts($arg);
        if ($arr_post) { 
						header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv; charset=utf-8');
            header(sprintf( 'Content-Disposition: attachment; filename=wordpress-page-csv-%s.csv', date( 'dmY-His' ) ) );
						header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
 
            $file = fopen('php://output', 'w');
						fputs( $file, "\xEF\xBB\xBF" ); 
 
            fputcsv($file, array('Page Title', 'URL', 'Content', 'Location', 'Page Date'));
 
            foreach ($arr_post as $post) {
                setup_postdata($post);
                fputcsv($file, array(get_the_title(), get_the_permalink(), get_the_content(), get_field('location'), get_the_date()));
            } 
            exit();
        }
    }
}
/*=================================================
//Disable text editor and only use visual editor
/*==================================================*/
function my_editor_settings($settings) {
    if ( ! current_user_can('administrator') ) {
        $settings['quicktags'] = false;
        return $settings;
    } else {
        $settings['quicktags'] = true;
        return $settings;
    }
}
add_filter('wp_editor_settings', 'my_editor_settings');
/*=================================================
//Hightlight post status
/*==================================================*/
function custom_post_states( $post_states ) {
   foreach ( $post_states as &$state ){
   $state = '<span class="'.strtolower( $state ).' states">' . str_replace( ' ', '-', $state ) . '</span>';
   }
   return $post_states;
}
add_filter( 'display_post_states', 'custom_post_states' ); 
function custom_post_states_css(){
    echo '<style>
        .post-state .states{
            font-size:11px;
            padding:3px 8px 3px 8px;
            -moz-border-radius:2px;
            -webkit-border-radius:2px;
            border-radius:2px;
            }
        .post-state .password{background:#000;color:#fff;}
        .post-state .pending{background:#83CF21 !important;color:#fff;}
        .post-state .private{background:#E0A21B;color:#fff;}
        .post-state .draft{background:red;color:#fff;}
          </style>';
}
add_action('admin_head','custom_post_states_css');
?>