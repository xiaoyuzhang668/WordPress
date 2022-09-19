<?php get_header(); ?>    
<section class="clear container delivery my-5">
 <?php         // HERE we print the notices
        wc_print_notices(); ?>
        <p class='bg-light rounded p-3 d-block'>Spicy Level: &nbsp; &nbsp; <i class='text-danger fas fa-pepper-hot'></i> &nbsp; &nbsp;   Gluton Free: &nbsp; &nbsp; <i class='text-danger fas fa-apple-alt'></i> &nbsp; &nbsp;Vegetarian Option available: &nbsp; &nbsp; <i class='fas fa-carrot text-danger'></i></p>
  <?php	
					$args = array(
						'taxonomy' => 'product_cat',
						'hide_empty' => false,
						'exclude' => array(44), //category IDs to exclude
						'number'     => $number,
						'posts_per_page' => -1,
						'orderby' => 'description',
    				'order'   => 'DESC',
						'include'    => $ids, 
						'parent' => 0,
				);
				$product_categories = get_terms( 'product_cat', $args );
				$count = count($product_categories);
				if ( $count > 0 ){
						foreach ( $product_categories as $product_category ) {								
							$string_category = str_replace(' ', '_', $product_category->name );
							$string_category = strtolower($string_category);
								echo '<div class="d-flex flex-row py-5 justify-content-center"><h4><a href="' . get_term_link( $product_category ) . '">' . $product_category->name . '    </a> ('.product_category_child($product_category).')</h4>';
								$args = array(
										'posts_per_page' => -1,
									 	'paged' => get_query_var('paged'),
					 					'post_status'=>'publish',
										'tax_query' => array(
												'relation' => 'AND',
												array(
														'taxonomy' => 'product_cat',
														'field' => 'slug',
														// 'terms' => 'white-wines'
														'terms' => $product_category->slug
												),
												array( // the category query (exclude)
														'taxonomy' => 'product_cat',
														'field'    => 'slug', // Or 'name' or 'term_id'
														'terms'    => 'donation',
														'operator' => 'NOT IN', // Excluded
												),
										),
										'post_type' => 'product',
										'orderby' => 'date',
					 					'order' => 'DESC'
								);
								$products = new WP_Query( $args ); ?>
							<button class="btn btn-green ml-3 <?php echo $product_category->slug; ?>" onclick="<?php echo $string_category.'()'; ?>">Collapse</button></div>
								<div id="<?php echo $product_category->slug; ?>">	
										<?php		echo '<div class="row">'; ?>
											<?php	while ( $products->have_posts() ) {
														$products->the_post();
														?>
														<div class="col-lg-2">
														 <a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="Single Product" data-title="<?php the_title(); ?>">
															 <?php the_post_thumbnail('product-thumb', array ('class' => 'card-img w-100 img-fluid rounded shadow-sm mb-3', 'alt' => get_the_title())); ?>
														
																<div class="card-img-overlay">
																	<div class=" d-flex flex-row">
																		<?php if ( $product->is_featured() ) {
																			echo '<span class="featured-delivery bg-success text-white px-3 py-1 rounded">Featured</span>';
																		}  ?>
																	<?php  if ( !$product->is_in_stock() ) {
																				echo '<span class="soldout bg-danger text-white px-3 py-1 rounded">' . __( 'SOLD OUT', 'woocommerce' ) . '</span>';
																		} ?>
																	</div>													
																</div>
															 </a>
														</div>
														<div class="col-lg-2 card-title">
															<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
																title="<?php echo esc_attr( $product->get_title() ); ?>">
																		<h5><?php echo $product->get_title(); ?></h5>
																	<?php	global $product;
																		$woocommerce_spicy_level = $product->get_meta('_woocommerce_spicy_level');
																		$woocommerce_vegetarian_option = $product->get_meta('_woocommerce_vegetarian_option');
																		$woocommerce_gluton_free = $product->get_meta('_woocommerce_gluton_free');
																		if (!empty ($woocommerce_spicy_level)) {
																			if ($woocommerce_spicy_level == 1 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
																			if ($woocommerce_spicy_level == 2 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
																			if ($woocommerce_spicy_level == 3 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
																			if ($woocommerce_spicy_level == 4 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } 
																			if ($woocommerce_spicy_level == 5 ) { echo "<small><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i><i class='text-danger fas fa-pepper-hot'></i></small>"; } }
																		if (!empty ($woocommerce_gluton_free)) {
																				if (!empty ($woocommerce_spicy_level)) {
																						echo ' / '; }
																				echo ' <small class="text-danger"><i class="text-danger fas fa-apple-alt"></i></small>'; }
																		if (!empty ($woocommerce_vegetarian_option)) {
																				if (!empty ($woocommerce_gluton_free)) {
																						echo ' / '; 
																				if ((empty ($woocommerce_gluton_free)) && (!empty ($woocommerce_spicy_level)) ) {
																						echo ' / '; }
																			echo '  <small class="text-danger"><i class="fas fa-carrot text-danger"></i></small>'; }
																		}	?>
															</a>
														</div>
														<div class="col-lg-6 card-text">
																<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
																title="<?php echo esc_attr( $product->get_title() ); ?>">
																	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt )?>
																</a>
														</div>
														<div class="col-lg-2 text-center mb-5">		
															<?php echo $product->get_price_html(); ?><br>
<?php
                            echo apply_filters(
                                'woocommerce_loop_add_to_cart_link',
                                sprintf(
                                    '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn-green %s product_type_%s">%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    $product->is_purchasable() ? 'add_to_cart_button' : '',
                                    esc_attr( $product->product_type ),
                                    esc_html( $product->add_to_cart_text() )
                                       ),
                                $product
                            );?>
														</div>
														<?php
												}
												echo "</div></div><hr>";
						}	 }?> 							
</section>
<script>
function bars_and_beverages() {
  var x = document.getElementById("bars-and-beverages");
	c = document.querySelector("button.bars-and-beverages") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}	
function cafe() {
  var x = document.getElementById("cafe");
	c = document.querySelector("button.cafe") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}	
function chinese_food() {
  var x = document.getElementById("chinese-food");
	c = document.querySelector("button.chinese-food") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}	
function thai_food() {
  var x = document.getElementById("thai-food");
	c = document.querySelector("button.thai-food") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}
function pasta() {
  var x = document.getElementById("pasta");
	c = document.querySelector("button.pasta") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}
function dim_sum() {
  var x = document.getElementById("dim-sum");
	c = document.querySelector("button.dim-sum") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}
function dumplings() {
  var x = document.getElementById("dumplings");
	c = document.querySelector("button.dumplings") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}
function vietnamese() {
  var x = document.getElementById("vietnamese");
	c = document.querySelector("button.vietnamese") ;
  if (x.style.display === "none") {
    x.style.display = "block";
		c.innerHTML = "Collapse";
  } else {
    x.style.display = "none";
		c.innerHTML = "Show";
  }
}
	 jQuery(function($) {
		  var x = document.getElementById("btnshow");
        // if our custom button is clicked
        $(".alt").on("click", function() {

             x.style.display = "block";

        });
    });
    </script>
<?php get_footer(); ?>