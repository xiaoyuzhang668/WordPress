<?php get_header(); ?>    
<section class="clear container my-5">
  <?php	
					$args = array(
						'number'     => $number,
						'posts_per_page' => -1,
						'orderby' => 'description',
    				'order'   => 'DESC',
						'hide_empty' => $hide_empty,
						'include'    => $ids, 
						'parent' => 0
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
												)
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
														</div>
														<div class="col-lg-2 card-title">
															<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"
																title="<?php echo esc_attr( $product->get_title() ); ?>">
																		<h5><?php echo $product->get_title(); ?></h5>
															</a>
														</div>
														<div class="col-lg-6 card-text">
																<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt )?>
														</div>
														<div class="col-lg-2 text-center mb-5">		
															<?php echo $product->get_price_html(); ?><br>
																 <?php
																		echo apply_filters(
																				'woocommerce_loop_add_to_cart_link',
																				sprintf(
																						'<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn btn-green %s product_type_%s">%s</a>',
																						esc_url( $product->add_to_cart_url() ),
																						esc_attr( $product->get_id() ),
																						esc_attr( $product->get_sku() ),
																						$product->is_purchasable() ? 'add_to_cart_button' : '',
																						esc_attr( $product->product_type ),
																						esc_html( $product->add_to_cart_text() )
																				),
																				$product
																		);?>
																		
															
																		<a class="button viewcart" href="./cart/">View Cart</a>		
																		<a href="./cart/" id="btnshow" style="display: none; " class="button wc-forward">VIEW CART</a>				  
														</div>
														<?php
												}
												echo "</div></div><hr>";
						}	 }?> 							
</section>
<script>
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
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
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