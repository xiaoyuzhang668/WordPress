<?php
/*========================================
  run PHP in widget
  ========================================*/
function widget_text_exec_php( $widget_text ) {
    if( strpos( $widget_text, '<' . '?' ) !== false ) {
        ob_start();
        eval( '?>' . $widget_text );
        $widget_text = ob_get_contents();
        ob_end_clean();
    }
    return $widget_text;
}
add_filter( 'widget_text', 'widget_text_exec_php', 99 );
//add php code in widget
function php_execute($html){
if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
$html=ob_get_contents();
ob_end_clean();
}
return $html;
}
add_filter('widget_text','php_execute',100);
// enable shortcode execution in text widget
add_filter('widget_text','do_shortcode');
/*========================================
  add short code to do category count
  ========================================*/
function category_post_count( $atts ) {
    $atts = shortcode_atts( array(
        'category' => null,
        'type' => null
    ), $atts );
    $term = get_term_by( 'slug', $atts['category'], 'category');
    $tpt = $atts['type'];
    if( get_post_type() == $tpt ) {
        return $term->count;
    }
}
add_shortcode( 'category_post_count', 'category_post_count' );
/*========================================
  Display posts by category
  ========================================*/
//function wpb_total_lifestyle() {
//$category = get_category(1);
//$count = $category->category_count;
//return $count;
//}
//add_shortcode('total_lifestyle','wpb_total_lifestyle');
//=======================================================
// by category
//=========================================================*/
/*5 posts per page */
function wpb_postsbycategory_sidebar () {	
	$dashboardIcon = [ "Recipe", "Everyday", "Casual", "Festival"];
				$dashboardLength = count($dashboardIcon);
        $i = 0;
       while ($i < $dashboardLength) {	
				 	$plural = $dashboardIcon[$i];
					$string = str_replace(' ', '', $plural); 
					$singular = strtolower($string);		 
// the query
				 global $post; 
				 $current_id = get_the_ID();
				 $the_query = new WP_Query( array( 
					 'category_name' => $singular, /*CHANGE category name here*/
					 'posts_per_page' => 3, /*CHANGE per post number here*/
					 'post__not_in' => array($post->ID)) 
				); 
			// The Loop
			if ( $the_query->have_posts() ) {
				$string = null;
					$string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
									if ( has_post_thumbnail() ) {
									$string .= '<li>';
									$string .=  '<div class="border border-bottom-0 border-right-0 border-left-0 py-3 d-flex align-items-center sidebar-thumb"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 70, 70) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><br><small>' . get_the_excerpt() .'</small></a></span></div></li>'; 		
									} else { 
									// if no featured image is found
									$string .= '<hr class="style-six"';
									$string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
									$string .= '<small>' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' </small></a></li>'; 
									}
									}
					} else { ?>
					<p>No posts found in this criteria.</p>
			<?php }
			$string .= '</ul>'; 
			return $string; 
			wp_reset_postdata();
			}
 }
add_shortcode('categoryposts_sidebar', 'wpb_postsbycategory_sidebar'); 
/*3 posts per page */
function wpb_postsbycategory_food_3() {
// the query
   global $post; 
   $current_id = get_the_ID();
   $the_query = new WP_Query( array( 
		 'category_name' => 'food',  /*CHANGE category name here*/
		 'posts_per_page' => 3, 
		 'post__not_in' => array($post->ID)) 
	); 
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
            if ( has_post_thumbnail() ) {
						$string .= '<hr class="style-six">';
            $string .= '<li>';
            $string .=  '<div class="mb-3 d-flex align-items-center"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 50, 50) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br><small>'. get_the_author(). ' •  ' . get_the_time('M j, Y') . '</small></a></span></div></li>';
            } else { 
            // if no featured image is found
						$string .= '<hr class="style-six"';
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
            $string .= '<small>' . get_the_author() . ' •  ' . get_the_time('M j, Y') . ' </small></a></li>'; 
            }
            }
    } else {?>
    <p>No posts found in this criteria.</p>
<?php  }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_food_3', 'wpb_postsbycategory_food_3'); 
//=======================================================
// by COOKING
//=========================================================*/
function wpb_postsbycategory_cooking() {
// the query
   	global $post; 
		$the_query = new WP_Query( array( 
			'category_name' => 'cooking',  /*CHANGE category name here*/
			'posts_per_page' => 3, 
			'post__not_in' => array($post->ID) ) 
		); 
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
           	if ( has_post_thumbnail() ) {
            $string .= '<li>';
            $string .=  '<div class="border border-bottom-0 border-right-0 border-left-0 py-3 d-flex align-items-center sidebar-thumb"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 70, 70) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><br><small>' . get_the_excerpt() .'</small></a></span></div></li>'; 			
            } else { 
            // if no featured image is found
						$string .= '<hr class="style-six"';
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . '</small></a></li>'; 
            }
            }
    } else { ?>
    <p>No posts found in this criteria.</p>
<?php  }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_cooking', 'wpb_postsbycategory_cooking'); 
/* 3 posts per page */
function wpb_postsbycategory_cooking_3() {
// the query
  global $post; 
	$the_query = new WP_Query( array( 
		'category_name' => 'cooking',  /*CHANGE category name here*/
		'posts_per_page' => 3, 
		'post__not_in' => array($post->ID) ) 
	); 
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
           	if ( has_post_thumbnail() ) {
						$string .= '<hr class="style-six">';
            $string .= '<li>';
            $string .=  '<div class="mb-3 d-flex align-items-center"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 50, 50) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br><small>'. get_the_author(). ' •  ' . get_the_time('M j, Y') . '</small></a></span></div></li>';						
            } else { 
            // if no featured image is found
						$string .= '<hr class="style-six"';							
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . '</small></a></li>'; 
            }
            }
    } else { ?>
    <p>No posts found in this criteria.</p>
<?php  }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_cooking_3', 'wpb_postsbycategory_cooking_3'); 
//=======================================================
// by LIFESTYLE
//=========================================================*/
function wpb_postsbycategory_lifestyle() {
// the query
  global $post; 
  $current_id = get_the_ID();
	$the_query = new WP_Query( array( 
		'category_name' => 'lifestyle',  /*CHANGE category name here*/
		'posts_per_page' => 3, 
//		'post__not_in' => array($post->ID)
	) );  
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
  $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
           	if ( has_post_thumbnail() ) {
						$string .= '<li>';
            $string .=  '<div class="border border-bottom-0 border-right-0 border-left-0 py-3 d-flex align-items-center sidebar-thumb"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 70, 70) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><br><small>' . get_the_excerpt() .'</small></a></span></div></li>'; 		  
            } else { 
            // if no featured image is found
						$string .= '<hr class="style-six"';
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . '</small></a></li>'; 
            }
            }
    } else { ?>
    <p>No posts found in this criteria.</p>
<?php }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_lifestyle', 'wpb_postsbycategory_lifestyle'); 
/* 3 posts per page */
function wpb_postsbycategory_lifestyle_3() {
// the query
  global $post; 
  $current_id = get_the_ID();
	$the_query = new WP_Query( array( 
		'category_name' => 'lifestyle',  /*CHANGE category name here*/
		'posts_per_page' => 3, 
		'post__not_in' => array($post->ID)) 
	);  
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
    $string .= '<ul class="postsbycategory widget_recent_entries pl-0">';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
           	if ( has_post_thumbnail() ) {
						$string .= '<hr class="style-six"';
            $string .= '<li class="my-5">';
            $string .=  '<div class="mb-3 d-flex align-items-center"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 50, 50) ). '</a><span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br><small>'. get_the_author(). ' •  ' . get_the_time('M j, Y') . '</small></a></span></div></li>';  
            } else { 
            // if no featured image is found
						$string .= '<hr class="style-six"';
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '<br>';
            $string .= '<small class="post-meta">' . get_the_author() . ' •  ' . get_the_time('M j, Y') . '</small></a></li>'; 
            }
            }
    } else { ?>
    <p>No posts found in this criteria.</p>
<?php }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_lifestyle_3', 'wpb_postsbycategory_lifestyle_3'); 
/*=======================================*/
//show only archive in blog
/*=======================================*/
add_filter( 'getarchives_join' , 'getarchives_join_filter');
function getarchives_join_filter( $join ) {
    global $wpdb;
    return $join . " INNER JOIN {$wpdb->term_relationships} tr ON ($wpdb->posts.ID = tr.object_id) INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)";
}
add_filter( 'getarchives_where' , 'getarchives_where_filter');
function getarchives_where_filter( $where ) {
    global $wpdb;
    return $where . " AND tt.taxonomy = 'category' AND tt.term_id='1' ";
    }
/*=======================================*/
//show only blog archive
/*=======================================*/
function wpse75668_filter_pre_get_posts( $query ) {
   if ( $query->is_main_query() && ! is_admin() ) {
      if ( is_date() ) {
        $query->set( 'cat', '1' );
     }
   }
 }
add_action( 'pre_get_posts', 'wpse75668_filter_pre_get_posts' );
//=======================================================
// register custom category widget
//=========================================================*/
function myprefix_widgets_init() {
    register_widget( 'WP_Widget_Categories_custom' );
}
add_action( 'widgets_init', 'myprefix_widgets_init' );
/**Duplicated and tweaked WP core Categories widget class */
class WP_Widget_Categories_Custom extends WP_Widget {
    function __construct() {
        $widget_ops = array( 'classname' => 'widget_categories widget_categories_custom', 'description' => __( "A list of categories, with slightly tweaked output.", 'master'  ) );
        parent::__construct( 'categories_custom', __( 'Categories Custom', 'master' ), $widget_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories Custom', 'master'  ) : $instance['title'], $instance, $this->id_base);
        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
        ?>
        <ul>
            <?php
            // Get the category list, and tweak the output of the markup.
            $pattern = '#<li([^>]*)><a([^>]*)>(.*?)<\/a>\s*\(([0-9]*)\)\s*<\/li>#i';  // removed ( and )
            // $replacement = '<li$1><a$2>$3</a><span class="cat-count">$4</span>'; // no link on span
            // $replacement = '<li$1><a$2>$3</a><span class="cat-count"><a$2>$4</a></span>'; // wrap link in span
            $replacement = '<li$1><div class="cat-section pl-lg-4"><h6 class="cat-name pr-3"><a$2>$3</a></h6><span></span> <h6 class="pl-3"><a$2>$4 Posts</a></h6></div>'; // give cat name and count a span, wrap it all in a link
        		$args = array(
                'orderby'       => 'name',
                'order'         => 'ASC',
                'show_count'    => 1,
                'title_li'      => '',
                'exclude'       => '99, 100',
                'echo'          => 0,
                'depth'         => 1,
        		);
            $subject      = wp_list_categories( $args );
            echo preg_replace( $pattern, $replacement, $subject );
            ?>
        </ul>
        <hr class="style-eight pb-5 mt-5">
        <?php
        echo $after_widget;
    }
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['count'] = 1;
        $instance['hierarchical'] = 0;
        $instance['dropdown'] = 0;
        return $instance;
    }
    function form( $instance )
    {
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr( $instance['title'] );
        $count = true;
        $hierarchical = false;
        $dropdown = false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title', 'master' ); ?>"><?php _e( 'Title:', 'master'  ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" <?php checked( $count ); ?> disabled="disabled" />
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', 'master'  ); ?></label>
        <br />
        <?php
    }
}
?>