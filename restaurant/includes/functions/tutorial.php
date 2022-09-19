<?php 
/*========================================
  Display screen number
  ========================================*/
//add_filter('current_screen', 'my_current_screen' ); 
//function my_current_screen($screen) {
//    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return $screen;
//    print_r($screen);
//    return $screen;
//}
/*===============================================================
  Add custom logo in dashboard - Customize , Dashboard setting
  ===============================================================*/
function wpb_custom_logo() {
echo '<style type="text/css">
      #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
      background-image: url(' . get_theme_mod('wpadminlogo_image') . ') !important;
      background-position: center center;
      background-size: cover;
      backgroun-repeat: no-repeat;
      color:rgba(0, 0, 0, 0);
			width: 32px;
			height: 32px;
      }
      #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
      background-position: 0 0;
      }
      </style>
';
}
add_action('wp_before_admin_bar_render', 'wpb_custom_logo');
/*===========================================================
  Change user avatar box Customize , Dashboard setting
  ===========================================================*/
function wpb_new_gravatar ($avatar_defaults) {
	$myavatar = get_theme_mod('useravatar_image', true);
	$avatar_defaults[$myavatar] = "Default Gravatar";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'wpb_new_gravatar' );
/*========================================
  Remove update link in Dashboard - Updates
  ========================================*/
function control_menu_items_shown() {
	if ( ! current_user_can( 'administrator' ) ) {
    remove_submenu_page( 'index.php', 'update-core.php' );
	}
}
add_action( 'admin_menu', 'control_menu_items_shown' );
/*========================================
  Remove admin bar - Dashbaord top line
  ========================================*/
add_action( 'wp_before_admin_bar_render', 'binaryfork_before_admin_bar_render', 999 ); 
function binaryfork_before_admin_bar_render() {
    global $wp_admin_bar;
//    $wp_admin_bar->remove_menu('wp-logo');				// Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');				// Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');				// Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');		// Remove the WordPress documentation
    $wp_admin_bar->remove_menu('support-forums');		// Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');				// Remove the feedback link	
//    $wp_admin_bar->remove_menu('site-name');			// Remove the site name menu
//    $wp_admin_bar->remove_menu('view-site');			// Remove the view site link
    $wp_admin_bar->remove_menu('updates');				// Remove the updates link
    $wp_admin_bar->remove_menu('comments');				// Remove the comments link
    $wp_admin_bar->remove_menu('new-content');			// Remove the content link
    $wp_admin_bar->remove_menu('seo-menu');			// Remove the content link
//  $wp_admin_bar->remove_menu('my-account');			// Remove the user details tab
//  $wp_admin_bar->remove_menu('logout');			// Remove the user details tab
//  $wp_admin_bar->remove_menu('customize');			// Remove customizer link
//  $wp_admin_bar->remove_menu('delete-cache');			// Remove WP Supercache Delete Cache link
  $wp_admin_bar->remove_menu('updraft_admin_node');	// Remove Updraft plugin link
  $wp_admin_bar->remove_menu('w3tc');					// Remove W3 total cache plugin link
}
/*========================================
  Remove widget left
  ========================================*/
function disable_default_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
//    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_browser_nag']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
//    // yoast seo
//    unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
//    // gravity forms
//    unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);
/*========================================
  Remove plugin meta box
  ========================================*/
function remove_plugin_metaboxes(){
	// Only run if the user is an Author or lower.
//	if ( ! current_user_can( 'delete_others_pages' ) ) {
//	only run if the user is not administrator
	if ( ! current_user_can( 'administrator' ) ) {
		// Remove Edit Flow Editorial Metadata
		remove_meta_box( 'ef_editorial_meta', 'post', 'side' );
	}
}
add_action( 'do_meta_boxes', 'remove_plugin_metaboxes' );
/*========================================
  Remove howdy and change into Welcome
  ========================================*/
add_filter( 'admin_bar_menu', 'replace_wordpress_howdy', 25 );
function replace_wordpress_howdy( $wp_admin_bar ) {
	$my_account = $wp_admin_bar->get_node('my-account');
	$newtext = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
	$wp_admin_bar->add_node( array(
	'id' => 'my-account',
	'title' => $newtext,
	) );
}
/*===============================================
  Disable Update WordPress nag and plugin update
  ===============================================*/
add_action('after_setup_theme','remove_core_updates');
function remove_core_updates() {
 if( current_user_can('administrator')){return;}
// add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 	add_filter('pre_option_update_core','__return_null');
 	add_filter('pre_site_transient_update_core','__return_null');
	remove_action('load-update-core.php','wp_update_plugins');
	add_filter('pre_site_transient_update_plugins','__return_null');
	add_filter('pre_site_transient_update_themes','__return_null');
}
/*=======================================================================
 Remove plugin message on dashboard, increase category box in post list
  =======================================================================*/
add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
function ds_admin_theme_style() {
//	increase div category box
	 echo '<style> .categorydiv div.tabs-panel, .customlinkdiv div.tabs-panel, .posttypediv div.tabs-panel, .taxonomydiv div.tabs-panel, .wp-tab-panel {
    max-height: 1300px!important;}
		div.misc-pub-section {display: none; }
    </style>';
	if (!current_user_can( 'administrator' )) {
			echo '<style>.update-nag, div.updated, .woocommerce-message, 
			.analyst-notice, .frash-notice,  div#sfsi-social-media.postbox,  
			div.updated.woocommerce-message, 
			div#message.error, div.updated.sfsi_show_premium_notification, 
			div#message.updated.sfsi_show_premium_notification, 
			div.notice.notice-info.is-dismissible,
			div#feedzy_rss_feeds_logger_flag_notification.notice.notice-success.is-dismissible,  
			div.themeisle_sdk_notification, div#themeisle.postbox,
			div#wp-optimize-dashnotice.updated.below-h2，div#postbox-container-1.postbox-container, 
			div#wpclever_dashboard_widget.postbox,
			div#tinypng_dashboard_widget.postbox { display: none!important; }</style>';
	}
}
/*========================================
  Remove version number
  ========================================*/ 
function wpb_remove_version() {
  return '';
  }
add_filter('the_generator', 'wpb_remove_version');
/*========================================
  Remove footer
  ========================================*/ 
function remove_footer_admin () { 
  echo 'Created by <a href="https://cathy-zhang.ca" target="_blank">Cathy Zhang</a> in  <a href="https://www.wordpress.org" target="_blank">WordPress</a>.'; 
  } 
add_filter('admin_footer_text', 'remove_footer_admin');
//===========================================================
// Add widget for tutorial
//===========================================================*/
add_action( 'wp_dashboard_setup', 'register_my_dashboard_widget' );
  function register_my_dashboard_widget() {
		$website = home_url();
		$blog_title = get_bloginfo( 'name' );
    wp_add_dashboard_widget(
        'my_dashboard_widget',
        'Notes for using website <strong>'.$blog_title.'</strong><br>('.$website.')',
        'my_dashboard_widget_display'
    );
	}
	function my_dashboard_widget_display() {
		$website = home_url();
		$blog_title = get_bloginfo( 'name' );
    echo '
		<h1><strong>Please find the Quick User Guide on the right side.  </h1>
  	<p>-> One sample User Guide in pdf format could be found <a href="https://cathy-zhang.ca/wp-content/themes/cathy/images/sample-user-guide.pdf" target="_blank">here</a></p></strong>
		<p>Setting update: 
		<ol>
		  <li>Update default avatar and WP logo under Appearance -> Dashboard setting -> Tagline </li>
			<li>Setting -> General -> Site Title, Tagline, New User Default Role - Editor, Timezone - Toronto </li>
			<li>Setting -> General -> Membership -> Anyone can register</li>
			<li>Setting -> Writing -> Default Post Category -> Update from Uncategorized</li>
			<li>Setting -> Reading -> Your homepage displays -> Change Homepage and Posts page</li>
			<li>Setting -> Reading -> update blog pages show at most</li>
			<li>Setting -> Discussion -> Other comment settings -> Break 3 comments, Newer displayed first</li>
			<li>Setting -> Discussion -> Change Default Avatar</li>
			<li>Setting -> Permalinks -> Common Settings -> Check Post Name</li>
			<li>Post list page -> Uncheck tags,  author</li>
			<li>Posts -> Categories -> Add category description</li>
			<li>To log out -> Go back to website preview -> Click Log Out button on the right top side of the screen.</li>
			<li>Custom post list, search result exclusion (exclude page and include all custom post type), widget category exclusion</li>
			<li>Allow duplicate comments.</li>
			<li>WordPress Plugin used - 
				<ul style="list-style-type:square;" class="pl-5">
					<li>Advanced Custom Fields - Customize WordPress with powerful, professional and intuitive fields.</li>
					<li>Awesome Weather - A weather widget that actually looks cool.</li>
					<li>Clasic Editor - Enables the WordPress classic editor and the old-style Edit Post screen with TinyMCE, Meta Boxes, etc. Supports the older plugins that extend this screen.</li>
					<li>Compress JPEG & PNG images - Speed up your website. Optimize your JPEG and PNG images automatically with TinyPNG.</li>
					<li>Contact Form 7 - Just another contact form plugin. Simple but flexible.</li>
					<li>Contact Form 7 Conditional Fields - Adds support for conditional fields to Contact Form 7. This plugin depends on Contact Form 7.</li>
					<li>Contact Form CFDB7 - Save and manage Contact Form 7 messages. Never lose important data. Contact Form CFDB7 plugin is an add-on for the Contact Form 7 plugin.</li>
					<li>Easy Appointments - Simple and easy to use management system for Appointments and Bookings.</li>
					<li>Feedzy RSS Feeds Lite - A small and lightweight RSS aggregator plugin. Fast and very easy to use, it allows you to aggregate multiple RSS feeds into your WordPress site through fully customizable shortcodes & widgets.</li>
					<li> GTranslate - Makes your website multilingual and available to the world using Google Translate.</li>
					<li>Leaflet Map - A plugin for creating a Leaflet JS map with a shortcode. Boasts two free map tile services and three free geocoders.</li>
					<li>Max Mega Menu - An easy to use mega menu plugin. Written the WordPress way.</li>
					<li>Radio Buttons for Taxonomies - Use radio buttons for any taxonomy so users can only select 1 term at a time.</li>
					<li>Show Current Template - show the current template file name.</li>
					<li>TranslatePress - Multilingual - Experience a better way of translating your WordPress site using a visual front-end translation editor, with full support for WooCommerce and site builders.</li>
					<li>UpdraftPlus - Backup/Restore - Backup and restore: take backups locally, or backup to Amazon S3, Dropbox, Google Drive, Rackspace, (S)FTP, WebDAV & email, on automatic schedules.</li>
					<li>W3 Total Cache - The highest rated and most complete WordPress performance plugin. Dramatically improve the speed and user experience of your site. Add browser, page, object and database caching as well as minify and content delivery network (CDN) to WordPress.</li>
					<li>WooCommerce - An eCommerce toolkit that helps you sell anything. Beautifully.</li>
					<li>WooCommerce Grid / List toggle - Adds a grid/list view toggle to product archives.</li>
					<li>WooCommerce Menu Cart - Extension for your e-commerce plugin (WooCommerce, WP-Ecommerce, Easy Digital Downloads, Eshop or Jigoshop) that places a cart icon with number of items and total cost in the menu bar. </li>
					<li>WooCommerce PayPal Checkout Gateway - Accept all major credit and debit cards, plus Venmo and PayPal Credit in the US, presenting options in a customizable stack of payment buttons. Fast, seamless, and flexible.</li>
					<li>WOOF - WooCommerce Products Filter - WOOF - WooCommerce Products Filter. Flexible, easy and robust products filter for WooCommerce store site!</li>
					<li>WP ULike - WP ULike plugin allows to integrate a beautiful Ajax Like Button into your wordPress website to allow your visitors to like and unlike pages, posts, comments AND buddypress activities. Its very simple to use and supports many options.</li>
					<li>WP-Optimize - Clean, Compress, Cache - WP-Optimize makes your site fast and efficient. It cleans the database, compresses images and caches pages. Fast sites attract more traffic and users.</li>
					<li>WP-PageNavi - Adds a more advanced paging navigation to your WordPress blog.</li>
					<li>WPC Variations Radio Buttons for WooCommerce - WPC Variations Radio Buttons will replaces dropdown selects by radio buttons for the buyer more easier in selecting the variations.</li>
					<li>Yoast SEO - The first true all-in-one SEO solution for WordPress, including on-page content analysis, XML sitemaps and much more.</li>			
				</ul>
		</ol>
		</p>
		<p>Issues with wordpress, please contact me at <a href="mailto: catzhang1@hotmail.ca?Subject=I have issue with WordPress website '. $blog_title .' at '. $website . ' ">here.</a>
';
}
//===========================================================
// Add quick user guide
//===========================================================*/
add_action( 'wp_dashboard_setup', 'my_dashboard_setup_function' );
function my_dashboard_setup_function() {
    add_meta_box( 'my_dashboard_widget2', 'Quick User Guide:', 'my_dashboard_widget_function', 'dashboard', 'side', 'high' );
}
function my_dashboard_widget_function() { 
    echo ' 
    <ol>
		<h2><li>Update menu:</li></h2>
    <p>-> At the left side of the screen, find Appearance -> Menus</p> 
		<h2><li>Update video:</li></h2>
    <p> -> At the left side of the screen, find Appearance -> Customize -> find video section</p>
    <h2><li>Update image:</li></h2>
    <p> -> At the left side of the screen, find Appearance -> Customize -> Carousel, Images Panel or Slit Slider image</p>
    <h2><li>Update post: </li></h2>
    <p> -> At the left side of the screen, find Posts -> See the following table for information where these posts are placed. </p>
    <p>-> Post category is used to identify on which page these multiple entries are going to be placed. </p>
		</ol>
		<ol class="pl-0 ml-0">
    Post categories: 
    <table class="table table-striped table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Post Category</th>
          <th scope="col">Post will be placed on which page</th>      
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Blog</td>
          <td>Default post category.  Menu -> Blog -> Blog Archive.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Channel</td>
          <td>Menu -> Contact -> Channel.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Cooking</td>
          <td>Menu -> Our Story -> Newsletter -> Cooking.</td>     
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Course</td>
          <td>Menu -> Event -> Course.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Food</td>
          <td>Menu -> Our Story -> Newsletter -> Food.</td>        
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Founder</td>
          <td>Menu -> Our Story -> Founder.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Lifestyle</td>
          <td>Menu -> Our Story -> Newsletter -> Lifestyle.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Miscellaneous</td>
          <td>Menu -> Blog -> Miscellaneous vertical slider sidebar.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Party</td>
          <td>Menu -> Event -> Party.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Place</td>
          <td>Menu -> Our Story -> Place.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Video</td>
          <td>Menu -> New -> Video section.</td>      
        </tr> 
      </tbody>
    </table>  
		</ol>
';
}
//===========================================================
// Add quick user guide
//===========================================================*/
add_action( 'wp_dashboard_setup', 'my_dashboard_setup_registration3' );
function my_dashboard_setup_registration3() {
    add_meta_box( 'my_dashboard_widget3', 'Quick User Guide (continued):', 'my_dashboard_widget3' , 'dashboard', 'side', '');
}
function my_dashboard_widget3() { 
    echo ' 
   	<h2><li>Custom Post:</li></h2>
    <p>-> At the left side of the screen, find the following custom post type:</p> 
	
		Custom Post Types: 
    <ol class="pl-0 ml-0">
			<table class="table table-striped table-bordered table-hover" style="border: 2px solid black";>
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Post Type</th>
          <th scope="col">Post Description</th>      
        </tr>
      </thead>			
      <tbody>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Product</td>
          <td>WooCommerce on Shop page.</td>        
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Product FAQ</td>
          <td>Menu -> Product categories -> at the bottom of shop page - category.</td>        
        </tr>
        <tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Green Tea</td>
          <td>Menu -> Our Tea -> Green Tea</td>        
        </tr>
        <tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Red Tea</td>
          <td>Menu -> Our Tea -> Red Tea</td>     
        </tr>
        <tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>White Tea</td>
          <td>Menu -> Our Tea -> White Tea</td>      
        </tr>
        <tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Oolong Tea</td>
          <td>Menu -> Our Tea -> Oolong Tea</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>News</td>
          <td>Menu -> New -> News section.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Announcement</td>
          <td>Menu -> New -> Announcement section.</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>FAQ</td>
          <td>Menu -> Tea Talk</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Gallery</td>
          <td>Menu -> Contact -> Form -> Footer section</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Photography</td>
          <td>Menu -> Our Story -> Founder</td>      
        </tr>				
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Branch</td>
          <td>Menu -> Contact -> Form -> Offices -> Branch section</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Profile</td>
          <td>Menu -> Contact -> Form -> Offices -> Profile section</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Customer</td>
          <td>Menu -> Contact -> Form -> Offices -> Customer section</td>      
        </tr>
				<tr>
          <th scope="row" class="pl-4"><li></li></th>
          <td>Recognization</td>
          <td>Not set and not used yet</td>      
        </tr>
      </tbody>
    </table>  
		</ol>
';
}
?>