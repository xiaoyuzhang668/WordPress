<?php
/*==================================================
  run shortcode in widget - [shortcode]
  ==================================================*/
add_filter('widget_text','do_shortcode');
/*===================================================================================================================
/* Display total number of post for specific category- including child category,
echo post_category_child(productslug)  - add slug*/
/*==================================================================================================================*/
function post_category_child( $catslug ) {
    $q = new WP_Query( array(
        'nopaging' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $catslug,
                'include_children' => true,
            ),
        ),
        'fields' => 'ids',
    ) );
    return $q->post_count;
}
/*===================================================================================================================
/* Display total number of product for specific category- including child category,
echo product_category_child(productslug)  - add slug*/
/*==================================================================================================================*/
function product_category_child($catslug) {
 $query = new WP_Query( array(
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $catslug, // Replace with the parent category slug
            'include_children' => true,
        ),
    ),
    'nopaging' => true,
    'fields' => 'ids',
) );
	return esc_html( $query->post_count ); 
}	
/*===================================================================================================
  add short code to do specific category count - no child - echo do_shortcode('[category_post_count]')
  =====================================================================================================*/
//method 1
function category_post_count( $atts ) {
    $atts = shortcode_atts( array(
        'category' => 'everyday',  // change category slug here
        'type' => null
    ), $atts );
    $term = get_term_by( 'slug', $atts['category'], 'category');
    $tpt = $atts['type'];
    if( get_post_type() == $tpt ) {
        return $term->count;
    }
}
add_shortcode( 'category_post_count', 'category_post_count' );
/*====================================================
  Add shortcode to Display posts by category - no child - id
  ======================================================*/
//method two 
function wpb_total_lifestyle() {
	$category = get_category(1); // change category id here 
	$count = $category->category_count;
	return $count;
	}
add_shortcode('wpb_total_lifestyle','wpb_total_lifestyle');
/*===================================================================================================================
/* Display total number of post for specific category- including child category,echo wp_get_cat_postcount(1)  - add id*/
/*==================================================================================================================*/
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
/*============================================================================*/
// Shortcode to count product category - only count parent not including child
/*============================================================================*/
// echo do_shortcode [products-counter category="28"] or category="slug"
add_shortcode( 'products-counter', 'products_counter' );
function products_counter( $atts ) {
	$atts = shortcode_atts( [
	'category' => '',
	], $atts );
	$taxonomy = 'product_cat';
	if ( is_numeric( $atts['category'] ) ) {
	$cat = get_term( $atts['category'], $taxonomy );
	} else {
	$cat = get_term_by( 'slug', $atts['category'], $taxonomy );
	}
	if ( $cat && ! is_wp_error( $cat ) ) {
	return $cat->count;
	}
	return '';
}
/*===================================================================================================================
/* Display total number of post for specific category.  - not child category  echo count_cat_post(1) or slug */
/*==================================================================================================================*/
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
//===================================================================================
// Posts by category vertical slider in footer - [categoryposts_sidebar] - widget 1
//===================================================================================*/
/*5 posts per page */
function wpb_postsbycategory_sidebar () {	
	// the query
				 global $post; 
				 $current_id = get_the_ID();
				 $the_query = new WP_Query( array( 
					 	'post_type' => 'post' , /*CHANGE category name here - for post and product*/		
//					 'category_name' => 'cooking',  /*CHANGE category name here, specific to post type*/
						'paged' => get_query_var('paged'),
						'post_status'=>'publish',
						'orderby' => 'date' ,
						'order' => 'DESC' , 				
						'posts_per_page' => -1, /*CHANGE per post number here*/
						'post__not_in' => array($post->ID),
//					 	'taxonomy' => 'product_cat', /* for product specific */
						'hide_empty' => false,
//						'exclude' => array(43), //category IDs to exclude		 /* for product specific */				
						'include'    => $ids, 	
				 )															 
				); 
			// The Loop
			if ( $the_query->have_posts() ) {
				$string = null;
					$string .= '<div class="sidebar-container pl-0 pt-5">';
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
									if ( has_post_thumbnail() ) {
									$string .= '<div class="sidebar-post">';
									$string .=  '<div class="border-top row no-gutters py-3 d-flex align-items-center"><div class="col-2"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, 'sidebar-thumb', array( 'class' => 'shadow-sm img-fluid rounded' )  ). '</a></div><div class="col-10"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><div class="test-justify">' . wp_trim_words( get_the_excerpt(), 18 , '   >> >>' ) .'</div>Category: '.get_the_category()[0]->name.'</a></div></div></div>'; 	
									} else { 
									// if no featured image is found
									$string .= '<div class="my-3 sidebar-post"><hr><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span>';
									$string .= '<div class="text-justify">' . wp_trim_words( get_the_excerpt(), 28 , '   >> >>' ) .'</div>Category: '.get_the_category()[0]->name.'</a></div>'; 
									}
									}
					} else { ?> 
					<p>No posts found in this criteria.</p>
			<?php }
			$string .= '</div>'; 
			return $string; 
			wp_reset_postdata();
 }
add_shortcode('categoryposts_sidebar', 'wpb_postsbycategory_sidebar');
//=======================================================
// short code to display by COOKING - widget 2
//=========================================================*/
function wpb_postsbycategory_cooking() {
// the query
  global $post; 
  $current_id = get_the_ID();
	$the_query = new WP_Query( array( 
		'post_type' => 'product',  /*CHANGE post type here - for post and product*/
//		'category_name' => 'cooking',  /*CHANGE category name here - specific to post type*/
		'posts_per_page' => 5, 
		'paged' => get_query_var('paged'),
		'post_status'=>'publish',
		'orderby' => 'date' ,
		'order' => 'DESC' , 				
		'post__not_in' => array($post->ID) ,
		'tax_query' => array(
				'relation' => 'AND',			
				array( // the category query (exclude)
						'taxonomy' => 'product_cat',
						'field'    => 'slug', // Or 'name' or 'term_id'
						'terms'    => 'donation',
						'operator' => 'NOT IN', // Excluded
				),
		),
		'hide_empty' => false,	
		'include'    => $ids, 
		'number'     => $number,
		)		
	) ;  	
// The Loop
if ( $the_query->have_posts() ) {
  $string = null;
  $string .= '<ul class="pl-0">';
    while ( $the_query->have_posts() ) {
				$the_query->the_post();
			 	$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
			 	$single_cat = array_shift( $product_cats );
           	if ( has_post_thumbnail() ) {
            $string .=  '<div class="border-top row py-3 d-flex align-items-center"><div class="col-2"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, 'sidebar-thumb', array( 'class' => 'shadow-sm img-fluid rounded' ) ). '</a></div><div class="col-10"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><div class="text-justify">' .   wp_trim_words( get_the_excerpt(), 28 , '   .  .  .' )  .'</div>Category: '.$single_cat->name.'</a></div></div>'; 		  
            } else { 
            // if no featured image is found
						$string .= '<hr>';
            $string .= '<li class="my-5"><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span><div class="text-justify">'.   wp_trim_words( get_the_excerpt(), 28 , '   .  .  .' ) ;
            $string .= '</div>Category: '.$single_cat->name. '</a></li>'; 
            }
            }
    } else { ?>
    <p>No posts found in this criteria.</p>
<?php }
$string .= '</ul>'; 
return $string; 
wp_reset_postdata();
}
add_shortcode('categoryposts_cooking', 'wpb_postsbycategory_cooking'); 
//=======================================================
// Posts by category on single single post sidebar 
//=========================================================*/
/*5 posts per page */
function postsbycategory_sidebar () {	
	// the query
				 global $post; 
				 $current_id = get_the_ID();	
	 if ( is_woocommerce() ) { 
	 			$the_query = new WP_Query( array( 
					 	'post_type' => 'product' , /*CHANGE category name here - for post and product*/		
//					 'category_name' => 'cooking',  /*CHANGE category name here, specific to post type*/
						'paged' => get_query_var('paged'),
						'post_status'=>'publish',
						'orderby' => 'date' ,
						'order' => 'DESC' , 				
						'posts_per_page' => -1, /*CHANGE per post number here*/
						'post__not_in' => array($post->ID),
//					 	'taxonomy' => 'product_cat', /* for product specific */
						'hide_empty' => false,
//						'exclude' => array(43), //category IDs to exclude		 /* for product specific */				
						'include'    => $ids, 
					  'tax_query'  => array(
            		array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug', // Or 'name' or 'term_id'
                'terms'    => array('donation'),
                'operator' => 'NOT IN', // Excluded
									)
							)
				 )
				);																				 
			 } else { 	
				 $the_query = new WP_Query( array( 
					 	'post_type' => 'post' , /*CHANGE category name here - for post and product*/		
//					 'category_name' => 'cooking',  /*CHANGE category name here, specific to post type*/
						'paged' => get_query_var('paged'),
						'post_status'=>'publish',
						'orderby' => 'date' ,
						'order' => 'DESC' , 				
						'posts_per_page' => -1, /*CHANGE per post number here*/
						'post__not_in' => array($post->ID),
//					 	'taxonomy' => 'product_cat', /* for product specific */
						'hide_empty' => false,
//						'exclude' => array(43), //category IDs to exclude		 /* for product specific */				
						'include'    => $ids, 	
				 ) 																 
				); }
			// The Loop
			if ( $the_query->have_posts() ) {
				$string = null;
					$string .= '<div class="category-sidebar-container pl-0 pt-5">';
					while ( $the_query->have_posts() ) {
							$the_query->the_post();
						 if  (is_woocommerce() )  { 
							 	$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
			 					$single_cat = array_shift( $product_cats );
						 		$category = $single_cat-> name; }
							else {
							 	$category = get_the_category()[0]->name;
							};
									if ( has_post_thumbnail() ) {
									$string .= '<div class="sidebar-post">';
									$string .=  '<div class="border-top row py-3 d-flex align-items-center"><div class="col-4"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, 'product-thumb', array( 'class' => 'shadow-sm rounded img-fluid' )  ). '</a></div><div class="col-8"><a href="' . get_the_permalink() .'" rel="bookmark"><div class="font-weight-bold">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</div><div class="text-justify">' . wp_trim_words( get_the_excerpt(), 14 , '   >> >>' ) .'</div><small>Category: '.$category.'</small></a></div></div></div>'; 	
									} else { 
									// if no featured image is found
									$string .= '<div class="my-3 sidebar-post"><hr><a href="' . get_the_permalink() .'" rel="bookmark"><span class="font-weight-bold">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span>';
									$string .= '<div class="text-justify">' . wp_trim_words( get_the_excerpt(), 14 , '   >> >>' ) .'</div><small>Category: '.$category.'</small></a></div>'; 
									}
									}
					} else { ?> 
					<p>No posts found in this criteria.</p>
			<?php }
			$string .= '</div>'; 
			return $string; 
			wp_reset_postdata();
 }
add_shortcode('category_posts_sidebar', 'postsbycategory_sidebar'); 
//=======================================================
// Posts by category on post sidebar in single or category
//=========================================================*/
//in woocommerce
add_action('wp_head', 'wpb_hook_javascript');
function wpb_hook_javascript() {
  if  ((is_woocommerce() ) && (is_product_category())) { 
    ?>
        <script type="text/javascript">
          	jQuery(function($) {
							 var slider = tns({
									container: '.category-sidebar-container',
									items: 6,
									axis: "vertical", 
									loop: true,
				//					gutter: 10,
									lazyload: true,
									slideBy: "page",
									mouseDrag: true,
									swipeAngle: false,
									speed: 400,
									autoplay: true,
									controls: false,
									nav: false,
									autoplayButton: false,
									autoplayButtonOutput: false,
								});
							});
        </script>
    <?php
  }
//in post category sidebar
  if (is_category ()) { 
    ?>
        <script type="text/javascript">
          	jQuery(function($) {
							 var slider = tns({
									container: '.category-sidebar-container',
									items: 12,
									axis: "vertical", 
									loop: true,
				//					gutter: 10,
									lazyload: true,
									slideBy: "page",
									mouseDrag: true,
									swipeAngle: false,
									speed: 400,
									autoplay: true,
									controls: false,
									nav: false,
									autoplayButton: false,
									autoplayButtonOutput: false,
								});
							});
        </script>
    <?php
  }
//	if author
	if (is_author ()) { 
    ?>
        <script type="text/javascript">
          	jQuery(function($) {
							 var slider = tns({
									container: '.category-sidebar-container',
									items: 6,
									axis: "vertical", 
									loop: true,
				//					gutter: 10,
									lazyload: true,
									slideBy: "page",
									mouseDrag: true,
									swipeAngle: false,
									speed: 400,
									autoplay: true,
									controls: false,
									nav: false,
									autoplayButton: false,
									autoplayButtonOutput: false,
								});
							});
        </script>
    <?php
  }
//	if it is single
	  if ((is_single ()) && (!is_woocommerce()) ) { 
    ?>
        <script type="text/javascript">
          	jQuery(function($) {
							 var slider = tns({
									container: '.category-sidebar-container',
									items: 10,
									axis: "vertical", 
									loop: true,
				//					gutter: 10,
									lazyload: true,
									slideBy: "page",
									mouseDrag: true,
									swipeAngle: false,
									speed: 400,
									autoplay: true,
									controls: false,
									nav: false,
									autoplayButton: false,
									autoplayButtonOutput: false,
								});
							});
        </script>
    <?php
  }
}
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
<!--        <hr class="mt-5">-->
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