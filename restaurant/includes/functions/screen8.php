<?php 
/*=====================================
// add theme support on post-thumbnail, 
/*=====================================*/
add_theme_support('post-thumbnails');
add_image_size( 'sidebar-thumb', 50, 50, true ); // Hard Crop Mode
add_image_size( 'product-thumb', 200, 200, array( 'center', 'center' ) );
add_image_size( 'custom-thumb', 346, 9999, array( 'center', 'center' ) ); // Unlimited Height Mode, 3 columns
add_image_size( 'square-thumb', 400, 400, array( 'center', 'center' ) );
add_image_size( 'homepage-thumb', 9999, 400, array( 'top', 'left' ));
add_image_size( 'singlepost-thumb', 700, 9999 ); // Unlimited Height Mode, soft crop mode
/*=====================================
// add post format
/*=====================================*/
// there are 9 different post formats, preset wordpress format
// add_theme_support('post-formats');
// add_theme_support( 'post-formats', array( 'aside', 'chat', 'quote', 'gallery', 'image', 'status', 'link', 'video') );
add_theme_support('html5', array('search-form'));
/*====================
// add menu support
/*====================*/
function awesome_menu_support(){
	add_theme_support('menus');
	register_nav_menus(
	array(
      'primary' => __( 'Primary Menu' ),
      'secondary' => __( 'Secondary Menu'),
      'footer' => __( 'Footer Menu'),
      'extra' => __( 'Extra Menu'),
      'extra2' => __( 'Extra Menu 2')
  	)
  );
}
add_action('init', 'awesome_menu_support');
/*================
// Add sidebar
/*================*/
function awesome_widget_setup(){	
	$dashboardIcon = [ "Sidebar 1", "Sidebar 2", "Sidebar 3", "Sidebar 4", "Sidebar 5", "Sidebar 6"];
	$dashboardLength = count($dashboardIcon);
       $i = 0;
       while ($i < $dashboardLength) {	
				 	$plural = $dashboardIcon[$i];
					$string = str_replace(' ', '', $plural); 
					$singular = strtolower($string);		
  register_sidebar(
    array(
      'name' => $plural,
      'id' => $singular,
      'class' => 'custom',
      'description' => 'this is the '.$plural.' custom sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h5 class="widget-title pb-3 text-center">',
      'after_title' => '</h5>'
    )
  );
	$i++; }  
}
add_action('widgets_init','awesome_widget_setup');
/*=======================================
//define different post number for pages
/*=======================================*/
add_action('pre_get_posts', 'ci_paging_request');
function ci_paging_request($wp) {
	//We don't want to mess with the admin panel.
	if(is_admin()) return;
	$num = get_option('posts_per_page', 15);
	if( is_home() )
		$num = 4;
	if( is_archive() )
		$num = 6;
	if( is_author() )
		$num = 10;
	if( is_category() or is_tag() )
		$num = 6;
	if( is_category('lifestyle') )
		$num = 4;
	if( is_category('food') )
		$num = 6;
	if( is_category('travel') )
		$num = -1; // -1 means No limit
	if( ! isset( $wp->query_vars['posts_per_page'] ) ) {
		$wp->query_vars['posts_per_page'] = $num;
	}
}
/*=======================================================
//define total search number per page, then pagination
/*=======================================================*/
add_filter('request', 'change_wp_search_size');
function change_wp_search_size($queryVars) {
    if ( isset($_REQUEST['s']) ) // Make sure it is a search page
        $queryVars['posts_per_page'] = 6; // Change 10 to the number of posts you would like to show
    return $queryVars; // Return our modified query variables
}
/*=======================================
//post word count
/*=======================================*/
function word_count() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    return $word_count;
}
/*=======================================
//post title word count
/*=======================================*/
function title_word_count() {
    $title = get_post_field( 'post_title', $post->ID );
    $title_word_count = str_word_count( strip_tags( $title ) );
    return $title_word_count;
}
/*=======================================
//get first image at post
/*=======================================*/
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}
/*=======================================
//get first and second paragraph
/*=======================================*/
function get_first_paragraph(){
    global $post;
    $str = wpautop( get_the_content() );
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags($str, '<a><strong><em>');
    return '<p>' . $str . '</p>';
}
function get_the_post(){
    global $post;
    $str = wpautop( get_the_content() );
    $str = substr( $str, (strpos( $str, '</p>')));
    return $str;
}
/*=====================================================================================
//add content after third paragraph of single post, change number after $content_block 
/*=====================================================================================*/
//add_filter('the_content', 'mte_add_incontent_ad');
//function mte_add_incontent_ad($content)
//{	if(is_single()){
//		$content_block = explode('<p>',$content);
//		if(!empty($content_block[2]))
//		{	$content_block[2] .= '<h5 class="font-weight-bold">This is message section.  Could be banner, ad etc. for single post of specific category. It is located at the third paragraph.  If the article has less than 2 paragraphs, it will not show up. </h5>';
//		}
//		for($i=1;$i<count($content_block);$i++)
//		{	$content_block[$i] = '<p>'.$content_block[$i];
//		}
//		$content = implode('',$content_block);
//	}
//	return $content;	
//}
/*=======================================*/
// allow dupliate comments
/*=======================================*/
function enable_duplicate_comments_preprocess_comment($comment_data) {
  //add some random content to comment to keep dupe checker from finding it
  $random = md5(time());  
  $comment_data['comment_content'] .= "disabledupes{" . $random . "}disabledupes";   
  return $comment_data;
}
add_filter('preprocess_comment', 'enable_duplicate_comments_preprocess_comment');
function enable_duplicate_comments_comment_post($comment_id) {
  global $wpdb;  
  //remove the random content
  $comment_content = $wpdb->get_var("SELECT comment_content FROM $wpdb->comments WHERE comment_ID = '$comment_id' LIMIT 1");  
  $comment_content = preg_replace("/disabledupes{.*}disabledupes/", "", $comment_content);
  $wpdb->query("UPDATE $wpdb->comments SET comment_content = '" . $wpdb->escape($comment_content) . "' WHERE comment_ID = '$comment_id' LIMIT 1");   
  /*    add your own dupe checker here if you want  */
}
add_action('comment_post', 'enable_duplicate_comments_comment_post'); 
/*=======================================
// tea menu icon to add beside menu text
/*=======================================*/
function cz_menu_icon_image () {
    ?>
        <style type="text/css">
           .greentea-menu {
							background-image: url("<?php echo get_theme_mod( 'greentea_menu_image' ); ?>")
						}
						.redtea-menu {
							background-image: url("<?php echo get_theme_mod( 'redtea_menu_image');?>")
						}
						.whitetea-menu {
							background-image: url("<?php echo get_theme_mod( 'whitetea_menu_image');?>")
						}
						.oolongtea-menu {
							background-image: url("<?php echo get_theme_mod( 'oolongtea_menu_image');?>")
						}
						.greentea-menu, 
						.redtea-menu,
						.whitetea-menu,
						.oolongtea-menu {
							background-repeat: no-repeat;
							background-position: left;
							height: 68px;
							padding-left: 68px;
							margin-left: 18px;
							display: flex;
							line-height: 60px;
						}
        </style>
    <?php
}
add_action( 'wp_head', 'cz_menu_icon_image' );
/*=======================================
//search form and result
/*=======================================*/
function search_excerpt_highlight() {
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);
    echo '<p>' . $excerpt . '</p>';
}
function search_title_highlight() {
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);
    echo '<h5>'.$title.'</h5>';
}
function search_content_highlight() {
        $content = get_the_content();
        $keys = implode('|', explode(' ', get_search_query()));
        $content = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $content);
        echo '<p>' . $content . '</p>';
    }
/*=======================================
//add sequential number
/*=======================================*/
//function updateNumbers() {
//  global $wpdb;
//  $querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_author = 1 ORDER BY $wpdb->posts.post_date DESC";
//	$pageposts = $wpdb->get_results($querystr, OBJECT);
//  $counts = 0 ;
//  if ($pageposts):
//    foreach ($pageposts as $post):
//      setup_postdata($post);
//      $counts++;
//      add_post_meta($post->ID, 'incr_number', $counts, true);
//      update_post_meta($post->ID, 'incr_number', $counts);
//    endforeach;
//  endif;
//}   
//add_action ( 'publish_post', 'updateNumbers' );
//add_action ( 'deleted_post', 'updateNumbers' );
//add_action ( 'edit_post', 'updateNumbers' );
/*=======================================*/
// link post thumbnail to post content open
/*=======================================*/
/* Auto link featured image to linked post content*/
//function wcs_auto_link_post_thumbnails( $html, $post_id, $post_image_id ) {
//  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
//  return $html;
// }
//add_filter( 'post_thumbnail_html', 'wcs_auto_link_post_thumbnails', 10, 3 );
?>