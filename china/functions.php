<?php
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'global', get_stylesheet_uri() );
    if ( is_page(2539) ) {
      wp_enqueue_style( 'page-login', get_template_directory_uri() . '/css/page-login.css' );
    }
		if ( is_page(2543) ) {
      wp_enqueue_style( 'page-register', get_template_directory_uri() . '/css/page-register.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
// change login page logo
function my_login_logo() { ?>
    <style type="text/css">
        body.login {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-background.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center;               
        }
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/icon/login-image.png);
          height:80px;
          width:80px;
          background-size: 80px 80px;
          background-repeat: no-repeat;
          padding-bottom: 8px;
          border-radius: 8px;              
        }
        div#login p#nav a,
        div#login p#backtoblog a {
          font-weight: bold; 
          font-size: 28px;
        }
        div#login form#loginform {
          border-radius: 8px;
        }
        div#login form#loginform p.forgetmenot {
          display: none;
        }
        div#login form#loginform p.submit input#wp-submit {
           display: block;  
         width: 100%;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'China';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );
function login_error_override() {
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');
//go to home page after login
function admin_login_redirect( $redirect_to, $request, $user ) {
   global $user;   
   if( isset( $user->roles ) && is_array( $user->roles ) ) {
      if( in_array( "administrator", $user->roles ) ) {
      return $redirect_to;
      } 
      else {
      return home_url();
      }
   }
   else {
   return $redirect_to;
   }
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);
// 1. remove howdy from dashboard
add_filter('gettext', 'change_howdy', 10, 3);
function change_howdy($translated, $text, $domain) {
    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', 'Welcome', $translated);
    return $translated;
}
// 2. remove widgets_init// Main column (left):
function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_browser_nag']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    // bbpress
    unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);
    // yoast seo
    unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
    // gravity forms
    unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);
// 3. add widget for tutorial
add_action( 'wp_dashboard_setup', 'register_my_dashboard_widget' );
    function register_my_dashboard_widget() {
    wp_add_dashboard_widget(
        'my_dashboard_widget',
        'My Dashboard Widget',
        'my_dashboard_widget_display'
    );
}
function my_dashboard_widget_display() {
    echo '<h1 style="color: red"><strong>Hello, Please find the <span style="color:black">Quick User Guide</span> on the right side. </h1> 
    <p>-> If there is any, User Guide in PDF format will be below this paragraph in this section inside Dashboard.  
    <p>-> Or
    <p>-> Go to the left side of the screen, find Dashboard</p> 
        <p> -> click Publishing Help </p>
        <p> -> under Help Topics on the right screen </p>
        <p> -> click the most recent User Guide </p>
     </strong>
     <p>Issues with wordpress, contact me at <a href="mailto: catzhang1@hotmail.ca">here.</a>';
}
add_action( 'wp_dashboard_setup', 'my_dashboard_setup_function' );
function my_dashboard_setup_function() {
    add_meta_box( 'my_dashboard_widget2', 'Quick User Guide', 'my_dashboard_widget_function', 'dashboard', 'side', 'high' );
}
function my_dashboard_widget_function() { 
    echo ' 
    <strong>&nbsp; 
<h2 style="color: red;">1. Update menu:</h2>
    <p>-> At the left side of the screen, find Appearance -> Menus -> Drag and drop the page to desired location. </p> 
&nbsp; <h2 style="color: red";>2. Update image:</h2>
        <p> -> At the left side of the screen, find Appearance -> Customize -> Carousel Images, Images Panel -> update image for each page. </p>
&nbsp; <h2 style="color: red";>3. Update post: </h2>
        <p> -> At the left side of the screen, find Appearance -> Posts -> See the following table for information where these posts are placed into. </p>
        <p>-> Post category is used to identify which page these multiple entries are going to be. </p>

Post categories: 
<table class="table" style="border: 2px solid black";>
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Post Category</th>
      <th scope="col">Post will be placed on which page</th>      
      <th scope="col">Display format</th>      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td style="padding-left: 18px";>Travel</td>
      <td>Front Page, Travel</td>
      <td>Filter, Infinite scroll </td>      
    </tr>
    <tr>
      <th scope="row">2</th>
      <td style="padding-left: 18px";>Cooking</td>
      <td>Front Page, Cooking</td>
      <td>Filter, Infinite scroll with button</td>       
    </tr>
    <tr>
      <th scope="row">3</th>
      <td style="padding-left: 18px";>Lifestyle</td>
      <td>Front Page, Lifestyle</td>
      <td>Filter, Infinite scroll with button</td>  
    </tr>
    <tr>
      <th scope="row">4</th>
      <td style="padding-left: 18px";>Video</td>
      <td>Front Page, Sidebar</td>
      <td>Thumbnail</td>        
    </tr>
    <tr>
      <th scope="row">5</th>
      <td style="padding-left: 18px";>Popular</td>
      <td>Front Page main video display most popular video</td>
      <td>Youtube auto player</td>       
    </tr>
    <tr>
      <th scope="row">6</th>
      <td style="padding-left: 18px";>Event</td>
      <td>Front Page sidebar</td>
      <td>Thumbnail</td>      
    </tr>         
  </tbody>
</table>
</strong>
';
}
// 4. remove sidebar widget
function remove_some_widgets(){
    // Unregister some of the TwentyTen sidebars
    unregister_sidebar( 'first-footer-widget-area' );
    unregister_sidebar( 'second-footer-widget-area' );
    unregister_sidebar( 'third-footer-widget-area' );
    unregister_sidebar( 'fourth-footer-widget-area' );
}
add_action( 'widgets_init', 'remove_some_widgets', 11 );
// 5. remove wordpress logo
/**REPLACE WP LOGO**/
function admin_css() {
echo '';
}
add_action('admin_head','admin_css');
/**END REPLACE WP LOGO**/
// 6. add 404 page, favicon at customize, customize permalinks to post name
// 7. add back to page button
add_action( 'ava_after_content', 'enfold_customization_back_button' );
function enfold_customization_back_button() {
    echo do_shortcode("[av_hr class='invisible' height='90' shadow='no-shadow' position='center' custom_border='av-border-thin' custom_width='50px' custom_border_color='' custom_margin_top='30px' custom_margin_bottom='30px' icon_select='yes' custom_icon_color='' icon='ue808' font='entypo-fontello']");
    $link = get_permalink( avia_get_option('blogpage') );
    echo do_shortcode("[av_button label='Back' link='manually,".$link."' link_target='' size='medium' position='left' icon_select='no' icon='ue800' font='entypo-fontello' color='theme-color' custom_bg='#444444' custom_font='#ffffff']");
};
// remove welcome screen
remove_action( 'welcome_panel', 'wp_welcome_panel' );
// plug in to install:  easy fancy box
//1. Advanced custom fields. / 2. All 404 Redirect to homepage/ 3. all-in-one wp migration - all-in-one wp migration file extension / 4. contact form 7  - contact form 7 conditional fields - flamingo / 5. google language translator / 6. loginpress - customizing the wordpress login  / wordpress related posts thumbnails / 7. Smush / 8. TablePress / 9. WP help / 10. WP news and scrolling widgets / 11. wp-pagenavi / 12. wps hide login   --- total there are 3 carousel --- 1.  Custom Post carousels with Owl, (good one) 2. Wonder Carousel, (fee) 3. Wordpress carousel.  (fee) 4. post carousel ? 5. responsive posts carousel (used)
// plug in to install:  easy fancy box
//1. Advanced custom fields. / 2. All 404 Redirect to homepage/ 3. all-in-one wp migration - all-in-one wp migration file extension / 4. contact form 7  - contact form 7 conditional fields - flamingo / 5. google language translator / 6. loginpress - customizing the wordpress login  / wordpress related posts thumbnails / 7. Smush / 8. TablePress / 9. WP help / 10. WP news and scrolling widgets / 11. wp-pagenavi / 12. wps hide login   --- total there are 3 carousel --- 1.  Custom Post carousels with Owl, (good one) 2. Wonder Carousel, (fee) 3. Wordpress carousel.  (fee) 4. post carousel ? 5. responsive posts carousel (used)
// 8. remove footer 
// function remove_footer_admin () { 
// echo '';
//  } 
// add_filter('admin_footer_text', 'remove_footer_admin');
// or change footer to something else
function remove_footer_admin () { 
echo 'Created by <a href="https://cathyzhang.ca" target="_blank">Cathy</a>'; 
} 
add_filter('admin_footer_text', 'remove_footer_admin');
// 9. change default gravatar
add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
function wpb_new_gravatar ($avatar_defaults) {
$myavatar = 'https://cathy-zhang.ca/wp-content/themes/cathy/images/hello.gif';
$avatar_defaults[$myavatar] = "Default Gravatar";
return $avatar_defaults;
}
// 10. wordpress copyright date
function wpb_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "© " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}
// 11. Remove Default Image Links in WordPress
function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );     
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);
// 12. remove help Tab
function oz_remove_help_tabs( $old_help, $screen_id, $screen ){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'oz_remove_help_tabs', 999, 3 );
// 13. remove screen option
// add_filter( 'screen_options_show_screen', '__return_false' );
// 14  remove screenoption
function wpse_edit_post_show_excerpt( $user_login, $user ) {
    $unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );
    $key = array_search( 'postexcerpt', $unchecked );
    if ( FALSE !== $key ) {
        array_splice( $unchecked, $key, 1 );
        update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
    }
}
add_action( 'wp_login', 'wpse_edit_post_show_excerpt', 10, 2 );
// 15. remove plugin updatefunction filter_plugin_updates( $value ) {
// function filter_plugin_updates( $value ) {
//     unset( $value->response['ultimate-social-media-icons/ultimate-social-media-icons.php'] );
//     return $value;
// }
// add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
// 16. remove version number 
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');
// 17. add custom logo on dashboard
function wpb_custom_logo() {
echo '
<style type="text/css">
#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/icon/heart.jpg) !important;
background-position: center center;
background-size: cover;
backgroun-repeat: no-repeat;
color:rgba(0, 0, 0, 0);
}
#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
background-position: 0 0;
}
</style>
';
}
//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');
// 18. enable shortcode execution in text widget
// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

/*
  ===========================
  menu walker
  ===========================
*/
// Include custom navwalker for navigation menu
require get_template_directory().'/includes/class-wp-bootstrap-navwalker.php';
// inclusde customerizer file
require get_template_directory(). '/includes/customizer.php';
/*===========================
  include stylesheet and script
  ===========================*/
// hook stylesheet and js files
function china_script_enqueue(){
  // js jquery
  wp_enqueue_script('jquery', '', array(), '', true);
  wp_enqueue_style('carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '1.0.0', 'all');
  wp_enqueue_style('owltheme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), '1.0.0', 'all'); 
 wp_enqueue_script('customjs', get_template_directory_uri() . '/js/china.js', array(), '1.0.0', true); 
   wp_enqueue_script('owlthemejs', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '1.0.0', true); 
   wp_enqueue_script('infinitejs', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '1.0.0', true);
 }
add_action('wp_enqueue_scripts', 'china_script_enqueue');
//Link to fontawsome
function china_fontawesome_stylesheet() {
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
    wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'china_fontawesome_stylesheet');

/*
  ==============================
  Activate menu
  ==============================
*/
// add menu support
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

/*
=============================================
Theme Support function
=============================================
*/
// add theme support, preset wordpress hook, totally 10, here it is 3
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_image_size( 'product-thumb size', 150, 150, array( 'center', 'center' ) );
add_image_size( 'square-size', 400, 400, array( 'center', 'center' ) );
add_image_size( 'homepage-thumb', 9999, 400 );
add_image_size( 'fullpage-thumb', 1204, 360, array( 'top', 'left' ));
add_image_size( 'custom-size', 250, 300, array( 'center', 'center' ) );
add_image_size( 'sidebar-thumb', 120, 120, true ); // Hard Crop Mode
// add_image_size( 'homepage-thumb', 220, 180 ); // Soft Crop Mode
add_image_size( 'singlepost-thumb', 590, 9999 ); // Unlimited Height Mode
// there are 9 different post formats, preset wordpress format
add_theme_support('post-formats');
add_theme_support( 'post-formats', array( 'aside', 'chat', 'quote', 'gallery', 'image', 'status', 'link') );
add_theme_support('html5', array('search-form'));

/*========================================
  Sidebar function
  ========================================*/
function awesome_widget_setup(){
  register_sidebar(
    array(
      'name' => 'Sidebar',
      'id' => 'sidebar-1',
      'class' => 'custom',
      'description' => 'this is the standard sidebar',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>'
    )
  );

  register_sidebar(
    array(
      'name' => 'Sidebar2',
      'id' => 'sidebar-2',
      'class' => 'custom',
      'description' => 'this is the first sidebar 2 standard',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h1 class="widget-title">',
      'after_title' => '</h1>'
    )
  );
}
add_action('widgets_init','awesome_widget_setup');
/*========================================
  Display posts by category
  ========================================*/
//=======================================================
// by travel
//=========================================================*/
function wpb_postsbycategory() {
// the query
   global $post; 
$current_id = get_the_ID();
$the_query = new WP_Query( array( 'category_name' => 'travel', 'posts_per_page' => 3, 'post__not_in' => array($post->ID)) ); 

// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
            if ( has_post_thumbnail() ) {
            $string .= '<li class="my-5">';
            $string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail( $post->ID, array( 50, 50) ) . get_the_title() . '<br>' ;
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            } else { 
            // if no featured image is found
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            }
            }
    } else {
    // no posts found
}
$string .= '</ul>'; 
return $string; 
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts', 'wpb_postsbycategory'); 
// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');
//=======================================================
// by cooking
//=========================================================*/
function wpb_postsbycategory_cooking() {
// the query
   global $post; 
$the_query = new WP_Query( array( 'category_name' => 'cooking', 'posts_per_page' => 3, 'post__not_in' => array($post->ID) ) ); 

// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
            if ( has_post_thumbnail() ) {
            $string .= '<li class="my-5">';
            $string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail( $post->ID, array( 50, 50) ) . get_the_title() . '<br>' ;
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            } else { 
            // if no featured image is found
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            }
            }
    } else {
    // no posts found
}
$string .= '</ul>'; 
return $string; 
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts_cooking', 'wpb_postsbycategory_cooking'); 
// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');
//=======================================================
// by lifestyle
//=========================================================*/
function wpb_postsbycategory_lifestyle() {
// the query
  global $post; 
  $current_id = get_the_ID();
$the_query = new WP_Query( array( 'category_name' => 'lifestyle', 'posts_per_page' => 3, 'post__not_in' => array($post->ID))  ); 
 
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
            if ( has_post_thumbnail() ) {
            $string .= '<li class="my-5">';
            $string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail( $post->ID, array( 50, 50) ) . get_the_title() . '<br>' ;
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            } else { 
            // if no featured image is found
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' at ' . get_the_time('g:i a') . ' </small></a></li>'; 
            }
            }
    } else {
    // no posts found
}
$string .= '</ul>'; 
return $string; 
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts_lifestyle', 'wpb_postsbycategory_lifestyle'); 
// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');


//Hide categories from WordPress category widget
function exclude_widget_categories($args){
    $exclude = "1,253,228,242,251,252";
    $args["exclude"] = $exclude;
    return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");



/*========================================
  Display total number of post for specific category.   two methods
  ========================================*/
function wp_get_cat_postcount($id) {
    $cat = get_category($id);
    $count = (int) $cat->count;
    $taxonomy = 'category';
    $args = array(
      'child_of' => $id,
    );
    $tax_terms = get_terms($taxonomy,$args);
    foreach ($tax_terms as $tax_term) {
        $count +=$tax_term->count;
    }
    return $count;
}
function count_cat_post($category) {
if(is_string($category)) {
    $catID = get_cat_ID($category);
}
elseif(is_numeric($category)) {
    $catID = $category;
} else {
    return 0;
}
$cat = get_category($catID);
return $cat->count;
}

/*========================================
  Custom Post Type
  ========================================*/
function awesome_custom_post_type(){
  $labels = array(
    'name' => 'Portfolio',
    'singular_name' => 'Portfolio',
    'add_new' => 'Add New Portfolio',
    'all_items' => 'All Portfolio',
    'add_new_item' => 'Add New Portfolio',
    'edit_item' => 'Edit Portfolio',
    'new_item' => 'New Portfolio',
    'view_item' => 'View Portfolio',
    'search_item' => 'Search Portfolio',
    'not_found' => "No portfolio found",
    'not_found_in_trash' > 'No portfolio found in trash',
    'parent_item_colon' => 'Parent Portfolio'
    );
  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'supports' => array(
      'title', 'editor','excerpt','thumbnail', 'revisions',
    ),
    // 'taxonomies' => array('category', 'post_tag'),
    'menu_position' => 5,
    'exclude_from_search' => false
  );
  register_post_type('portfolio', $args);
}
add_action('init', 'awesome_custom_Post_type');

// create taxonomy hierarchy or non-hierarchy for custom post type
function awesome_custome_taxonomies(){
  // add new taxonomy hierarchical
  $labels = array(
    'name' => 'Fields',
    'menu_name' => 'Fields',
    'singular_name' => 'Field',    
    'all_items' => 'All Fields',    
    'edit_item' => 'Edit Field',
    'update_item' => 'Update Field',
    'add_new_item' => 'Add New Field',
    'new_item_name' => 'New Field Name',
    'not_found' => "No field found",
    'not_found_in_trash' > 'No field found in trash',
    'parent_item' => 'Parent Field',
    'parent_item_colon' => 'Parent Field:',
    'search_items' => 'Search Fields'   
    );
  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'field')
    );
    register_taxonomy('field', array('portfolio'), $args);
  // add new taxonomy non-hierarchical
    register_taxonomy('software', 'portfolio', array(
      'label' => 'Software',
      'rewrite' => array('slug' => 'software'),
      'hierarchical' => false,
      'show_admin_column' => true,
    ));
}
add_action('init', 'awesome_custome_taxonomies');

function register_recipes_post_type() {
    $args = array( 'public' => true, 'label' => 'Recipes' );
    register_post_type( 'recipe', $args );
}
add_action( 'init', 'register_recipes_post_type' );

/*========================================
 add support for format specific template for all formats
  ========================================*/
function use_post_format_templates ( $template ) {
    if ( is_single() && has_post_format() ) {
        $post_format_template = locate_template( 'single/single-' . get_post_format() . '.php' );
        if ( $post_format_template ) {
            $template = $post_format_template;
        }
    }
    return $template;
}   
add_filter( 'template_include', 'use_post_format_templates' );

/*========================================
  Single category post type
  ========================================*/
/* Define a constant path to our single template folder
*/
define('SINGLE_PATH', TEMPLATEPATH . '/single'); 
/**
* Filter the single_template with our custom function
*/
add_filter('single_template', 'my_single_template'); 
/**
* Single template function which will choose our template
*/
function my_single_template($single) {
global $wp_query, $post; 
/**
* Checks for single template by category
* Check by category slug and ID
*/
foreach((array)get_the_category() as $cat) : 
if(file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
return SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'; 
elseif(file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'; 
endforeach;
}



// hook into the init action and call custom_post_formats_taxonomies when it fires
// add_action( 'init', 'custom_post_formats_taxonomies', 0 );

// create a new taxonomy we're calling 'format'
// function custom_post_formats_taxonomies() {
//   // Add new taxonomy, make it hierarchical (like categories)
//   $labels = array(
//     'name'              => _x( 'Formats', 'taxonomy general name', 'textdomain' ),
//     'singular_name'     => _x( 'layout', 'taxonomy singular name', 'textdomain' ),
//     'search_items'      => __( 'Search Formats', 'textdomain' ),
//     'all_items'         => __( 'All Formats', 'textdomain' ),
//     'parent_item'       => __( 'Parent Format', 'textdomain' ),
//     'parent_item_colon' => __( 'Parent Format:', 'textdomain' ),
//     'edit_item'         => __( 'Edit Format', 'textdomain' ),
//     'update_item'       => __( 'Update Format', 'textdomain' ),
//     'add_new_item'      => __( 'Add New Format', 'textdomain' ),
//     'new_item_name'     => __( 'New Format Name', 'textdomain' ),
//     'menu_name'         => __( 'Format', 'textdomain' ),
//   );


//   $args = array(
//     'hierarchical'      => true,
//     'labels'            => $labels,
//     'show_ui'           => true,
//     'show_admin_column' => true,
//     'query_var'         => true,
//     'rewrite'           => array( 'slug' => 'format' ),
//     'capabilities' => array(
//       'manage_terms' => '',
//       'edit_terms' => '',
//       'delete_terms' => '',
//       'assign_terms' => 'edit_posts'
//     ),
//     'public' => true,
//     'show_in_nav_menus' => false,
//     'show_tagcloud' => false,
//   );
//   register_taxonomy( 'format', array( 'post' ), $args ); // our new 'format' taxonomy
// }


// programmatically create a few format terms
// function example_insert_default_format() { // later we'll define this as our default, so all posts have to have at least one format
//   wp_insert_term(
//     'Default',
//     'format',
//     array(
//       'description' => '',
//       'slug'    => 'default'
//     )
//   );
// }
// add_action( 'init', 'example_insert_default_format' );


// repeat the following 11 lines for each format you want
// function example_insert_map_format() {
//   wp_insert_term(
//     'Map', // change this to
//     'format',
//     array(
//       'description' => 'Adds a large map to the top of your post.',
//       'slug'    => 'map'
//     )
//   );
// }
// add_action( 'init', 'example_insert_map_format' );


// make sure there's a default Format type and that it's chosen if they didn't choose one
// function moseyhome_default_format_term( $post_id, $post ) {
//     if ( 'publish' === $post->post_status ) {
//         $defaults = array(
//             'format' => 'default' // change 'default' to whatever term slug you created above that you want to be the default
//             );
//         $taxonomies = get_object_taxonomies( $post->post_type );
//         foreach ( (array) $taxonomies as $taxonomy ) {
//             $terms = wp_get_post_terms( $post_id, $taxonomy );
//             if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
//                 wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
//             }
//         }
//     }
// }
// add_action( 'save_post', 'moseyhome_default_format_term', 100, 2 );


// replace checkboxes for the format taxonomy with radio buttons and a custom meta box
// function wpse_139269_term_radio_checklist( $args ) {
//     if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'format' ) {
//         if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
//             if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
//                 class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
//                     function walk( $elements, $max_depth, $args = array() ) {
//                         $output = parent::walk( $elements, $max_depth, $args );
//                         $output = str_replace(
//                             array( 'type="checkbox"', "type='checkbox'" ),
//                             array( 'type="radio"', "type='radio'" ),
//                             $output
//                         );
//                         return $output;
//                     }
//                 }
//             }
//             $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
//         }
//     }
//     return $args;
// }


// add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );


// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
  global $post;
  return '<a class="moretag text-dark" href="'. get_permalink($post->ID) . '">  &raquo; &raquo; &raquo; &raquo; </a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*========================================
  Update excerpt length instead of 55 words
  ========================================*/
function wpdocs_custom_excerpt_length( $length ) {
      return 12;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/*========================================
  Update excerpt different length
  ========================================*/
function excerpt($limit) {
       $excerpt = explode(' ', get_the_content(), $limit);
      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . ' <a class="moretag h5 text-dark" href="'. get_permalink() . '">  &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; </a>';
      } else {
          $excerpt = implode(" ", $excerpt);      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
      return $excerpt;
}
function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . ' <a class="moretag h5 text-dark" href="'. get_permalink() . '">  &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; &raquo; </a>';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
// Dataroots change the form placeholder on mouse click 
add_action( 'wp_enqueue_scripts', 'dr_placeholder_form' );
function dr_placeholder_form() {
  wp_enqueue_script( 'placeholder-form',  get_stylesheet_directory_uri() . '/js/placeholder-form.js', array( 'jquery' ), '1.0.0', true );
}
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
/*========================================
  Fixing console error
  ========================================*/
// function someMethodIThinkMightBeSlow() {
//     const $startTime = performance.now();
//     // Do the normal stuff for this function
//     const $duration = performance.now() - $startTime;
//     console.log(`someMethodIThinkMightBeSlow took ${duration}ms`);
// }

/*========================================
  Add thumnail in post list page
  ========================================*/
add_filter('manage_pages_columns', 'posts_columns', 5);
add_action('manage_pages_custom_column', 'posts_custom_columns', 5, 2);
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
add_filter('manage_post-type_posts_columns', 'posts_columns', 5);
add_action('manage_post-type_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
    if($column_name === 'riv_post_thumbs'){
    if( has_post_thumbnail() ) {
        echo the_post_thumbnail('Thumbnail');
    } else {
        _e('No Thumbnail For Post');
        }        
  echo "  
<style> .column-riv_post_thumbs img{ max-height: 100px; max-width: 100px;     } </style>
"; } }
// remove tag or category item from dashboard
function my_manage_columns( $columns ) {
    unset($columns['date'], $columns['tags']);
    return $columns;
}
function my_column_init() {
    add_filter( 'manage_posts_columns' , 'my_manage_columns' );
}
add_action( 'admin_init' , 'my_column_init' );
// add post views in admin page
  add_filter('manage_posts_columns', 'posts_columns_id', 5);
    add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
    add_filter('manage_pages_columns', 'posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2); 
function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    $defaults['get_post_format()'] = __('Formats');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
    if($column_name === 'wps_post_id'){
            echo $id;
    }
    if($column_name === 'get_post_format()'){
            echo get_post_format();
    }
}
// add post format in admin page
// add_filter('manage_posts_columns', 'posts_column_formats');
// add_action('manage_posts_custom_column', 'posts_custom_column_formats',5,2); 
// function posts_column_formats ($defaults){
//     $defaults['get_post_format()'] = __('Formats');
//     return $defaults;
// }
// function posts_custom_column_formats ($column_name, $id){    
//         echo get_post_format();   
// }

// add post format column to admin page
// function wpse26032_admin_posts_filter( &$query )
// {
//     if ( 
//         is_admin() 
//         AND 'edit.php' === $GLOBALS['pagenow']
//         AND isset( $_GET['p_format'] )
//         AND '-1' != $_GET['p_format']
//         )
//     {
//         $query->query_vars['tax_query'] = array( array(
//              'taxonomy' => 'post_format'
//             ,'field'    => 'ID'
//             ,'terms'    => array( $_GET['p_format'] )
//         ) );
//     }
// }
// add_filter( 'parse_query', 'wpse26032_admin_posts_filter' );
// function wpse26032_restrict_manage_posts_format()
// {
//     wp_dropdown_categories( array(
//          'taxonomy'         => 'post_format'
//         ,'hide_empty'       => 0
//         ,'name'             => 'p_format'
//         ,'show_option_none' => 'Select Post Format'
//     ) );
// }
// add_action( 'restrict_manage_posts', 'wpse26032_restrict_manage_posts_format' );

/*========================================
  Set first image in post content to be featured image
  ========================================*/
// function autoset_featured() {
// global $post;
// $already_has_thumb = has_post_thumbnail($post->ID);
// if (!$already_has_thumb)  {
// $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
// if ($attached_image) {
// foreach ($attached_image as $attachment_id => $attachment) {
// set_post_thumbnail($post->ID, $attachment_id);
// }
// }
// }
// }
// add_action('the_post', 'autoset_featured');
// add_action('save_post', 'autoset_featured');
// add_action('draft_to_publish', 'autoset_featured');
// add_action('new_to_publish', 'autoset_featured');
// add_action('pending_to_publish', 'autoset_featured');
// add_action('future_to_publish', 'autoset_featured');

/*========================================
  Auto link featured image to linked post content
  ========================================*/
// function wcs_auto_link_post_thumbnails( $html, $post_id, $post_image_id ) {
// $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
// return $html;
// }
// add_filter( 'post_thumbnail_html', 'wcs_auto_link_post_thumbnails', 10, 3 );

/*========================================
  Prevent users from forgetting featured image when adding new post
  ========================================*/
// add_action('save_post', 'pu_validate_thumbnail');
// function pu_validate_thumbnail($post_id) {
// // Only validate post type of post
// if(get_post_type($post_id) != 'post')
// return;
// // Check post has a thumbnail
// if ( !has_post_thumbnail( $post_id ) ) {
// // Confirm validate thumbnail has failed
// set_transient( "pu_validate_thumbnail_failed", "true" );
// // Remove this action so we can resave the post as a draft and then reattach the post
// remove_action('save_post', 'pu_validate_thumbnail');
// wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
// add_action('save_post', 'pu_validate_thumbnail');
// } else {
// // If the post has a thumbnail delete the transient
// delete_transient( "pu_validate_thumbnail_failed" );
// }
// }

/*========================================
  Display error message if users forget to upload image
  ========================================*/
// add_action('admin_notices', 'pu_validate_thumbnail_error');
// function pu_validate_thumbnail_error() {
// if ( get_transient( "pu_validate_thumbnail_failed" ) == "true" ) {
// echo "<div id='message' class='error'><p><strong>A post thumbnail must be set before saving the post.</strong></p></div>";
// delete_transient( "pu_validate_thumbnail_failed" ); }
// }

/*========================================
  Change set featured image text to something else
  ========================================*/
function change_featured_image_text( $content ) {
    return $content = str_replace( __( 'Set featured image' ), __( 'Click here to upload your image' ), $content);
}
add_filter( 'admin_post_thumbnail_html', 'change_featured_image_text' );
/*========================================
  Display related author posts
  ========================================*/
function get_related_author_posts() {
    global $authordata, $post; 
    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 3, 'category__in' => array(3, 4, 5), 'category__not_in' => array(251, 242, 252, 1, 253) ) );
    $output = '<div class="row">';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<div class="col-md-3"><a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) ;
        $output .=  apply_filters( 'the_time', $authors_post->post_time, $authors_post->ID ) .  '</a></div>';  
    }
    $output .= '</div>'; 
    return $output;
}
/*========================================
  Format comment form
  ========================================*/
  // reverse comment order
add_filter( 'comments_array', 'array_reverse' );
  // remove url
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');
// add new age field
function add_comment_fields($fields) { 
    $fields['age'] = '<p class="comment-form-age"><label for="age">' . __( 'Age' ) . '</label>' .
        '<input id="age" name="age" type="text" size="30"></p>';
    return $fields; 
}
add_filter('comment_form_default_fields','add_comment_fields');
// save new field Datafunction add_comment_meta_values($comment_id) {
function add_comment_meta_values($comment_id) { 
    if(isset($_POST['age'])) {
        $age = wp_filter_nohtml_kses($_POST['age']);
        add_comment_meta($comment_id, 'age', $age, false);
    } 
}
add_action ('comment_post', 'add_comment_meta_values', 1);
// move comment box at the bottom
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
} 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
/*========================================
  Comment form validation on the same page
  ========================================*/
function comment_validation_init() {
if(is_singular() && comments_open() ) { ?>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#commentform').validate({ 
    // onfocusout: function(element) {
    //   this.element(element);
// },
rules: {
  author: {
    required: true,
    minlength: 1,
    normalizer: function(value) { return $.trim(value); }
  }, 
  email: {
    required: true,
    email: true
  }, 
  comment: {
    required: true,
    minlength: 1,
    normalizer: function(value) { return $.trim(value); }
  }
}, 
messages: {
  author: "Name should not be blank, please enter your name.",
  email: {
      required: "Email should not be blank, please enter an email address.",
      email: "Email is not valid, please enter a valid email address."
  },
  comment: "Message box should not be blank, please enter your message."
}, 
errorElement: "div",
errorPlacement: function(error, element) {
  element.after(error);
} 
});
});
</script>
<?php
}
}
add_action('wp_footer', 'comment_validation_init');
/*========================================
  My customized comment display
  ========================================*/

function wpse52737_enqueue_comment_reply_script() {
    if ( get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment_reply' );
    }
}
add_action( 'comment_form_before', 'wpse52737_enqueue_comment_reply_script' );
  // get comment date formate
// function smk_get_comment_time( $comment_id = 0 ){
//     return sprintf( 
//         _x( '%s ago', 'Human-readable time', 'text-domain' ), 
//         human_time_diff( 
//             get_comment_date( 'U', $comment_id ), 
//             current_time( 'timestamp' ) 
//         ) 
//     );
// }
// function my_change_comment_date_format( $date, $date_format, $comment ) {
//   return date( 'm.d.y', strtotime( $comment->comment_date ) );
// }
// add_filter( 'get_comment_date', 'my_change_comment_date_format', 10, 3 );
/**
 * Outputs a modified comment markup.
 *
 *
 * @see wp_list_comments()
 *
 * @param WP_Comment $comment Comment to display.
 * @param int        $depth   Depth of the current comment.
 * @param array      $args    An array of arguments.
 */
function pressfore_modify_comment_output( $comment, $args, $depth ) {
  $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
  ?>
  <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
  <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <div class="comment-meta w-100 p-5">
      <div class="comment-author text-white vcard">
        <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
        <?php
        /* translators: %s: comment author link */
        printf( __( '%s <span class="says">says:</span>' ),
            sprintf( '<b class="fn ml-5 pl-5 text-white">%s</b>', get_comment_author_link( $comment ) )
        );
        ?>
      </div><!-- .comment-author -->

      <div class="comment-metadata ml-5">
        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>" class="text-white">
          <time datetime="<?php comment_time( 'c' ); ?>">
            <?php
            printf( _x( '%s ago', '%s = human-readable time difference', 'china' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
            ?>
          </time>
        </a>
        <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
        <span class="reply">
        <?php comment_reply_link(); ?>
      </span>
         <?php comment_reply_link(   __( 'Reply to me' ), '<span class="reply">', '</span>' ); ?>
      </div><!-- .comment-metadata -->
      
      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
      <?php endif; ?>
    </div><!-- .comment-meta -->

    <div class="comment-content">
      <?php comment_text(); ?>
    </div><!-- .comment-content -->
  </article><!-- .comment-body -->
  <?php
}

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
        <div class="comment-author vcard d-flex align-items-center justify-content-between">
           <div class="comment-meta commentmetadata">
          <?php 
            if ( $args['avatar_size'] != 0 ) { ?>
             <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
               <?php }; 
            printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
            <?php 
              if ( $comment->comment_approved == '0' ) { ?>
                  <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
              } ?>       
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
              <time datetime="<?php comment_time( 'c' ); ?>">
                <?php
                printf( _x( '%s ago', '%s = human-readable time difference', 'china' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
                ?>
              </time>
            </a><?php 
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>              
        </div>
        <div class="reply btn btn-secondary rounded-pill text-center px-4 text-uppercase travel-btn trans-200"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div>
        </div>
        <div class="mt-3"><?php comment_text(); ?></div>

       <?php 
      if ( 'div' != $args['style'] ) : ?>
          </div><?php 
      endif;
}
// allow dupliate comments
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

// exclude page from search result
function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }
  }
}
add_action('pre_get_posts','search_filter');
//remove jquery migrate
?>