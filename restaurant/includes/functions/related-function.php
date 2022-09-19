<?php 
/*===============================
Exclude page from search result
=================================*/
// exclude page from search result
function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'downloads', 'product' ));
    }
  }
}
add_action('pre_get_posts','search_filter');
/*===============================
Create social icon shortcode
=================================*/
// function that runs when shortcode is called
function wpb_demo_shortcode() {  
// Things that you want to do. 
$message = 'Hello world!'; 
 
// Output needs to be return
return $message;
} 
// register shortcode
add_shortcode('greeting', 'wpb_demo_shortcode');

