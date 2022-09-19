<?php get_header(); ?>
<div class="minHeight d-flex align-items-center justify-content-center" style="
        background-image: url('<?php echo get_theme_mod('search', get_bloginfo('template_url').'/assets/image/customizer/search.jpg'); ?>'); 
                          background-position: center; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; 
                          width: 100%;
													 box-shadow: 0 3000px rgba(255, 255, 255, 0.4) inset;
													}
                      		">          
	<div class="text-center">
		<?php global $wp_query; ?>          
		 <p class="display-4 font-weight-bold"><?php echo $wp_query->found_posts; ?><?php printf( __( ' Search Results Found for:  %s', 'shape' ), '<span>&nbsp;&nbsp;&nbsp;<u>' . get_search_query() . '</u></span>' ); ?> </p>
	</div>
</div><!-- end of background image -->
<div class="container my-5"> 
   <?php global $paged;
					if(empty($paged)) $paged = 1;
					$loop_counter = 1; 
					$results_per_page = get_query_var('posts_per_page'); ?>
   <?php if ( have_posts() ) : ?>     
	 <div class="row">          
			<?php while ( have_posts() ) : the_post(); ?>
			<?php																				 
						if( $paged == 1 ) {
						 $real_count = $loop_counter;
						 } else {
						 $real_count = $loop_counter + ( $paged * $results_per_page - $results_per_page);
						 }  
				?>							 
				<?php if ( has_post_thumbnail() ) {; ?>																						 
					<div class="col-lg-3 text-center d-lg-flex flex-row pb-lg-5">
						<?php $featured_img_url = /*wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID())*/get_the_post_thumbnail_url(get_the_ID(),'full'); 	?> 
						 <?php echo '<h5 class="mr-lg-5">' . $real_count . '.</h5>';	?>
						<a href="<?php echo $featured_img_url; ?>" data-lightbox="searchResult" data-title="<?php the_title(); ?>">
							<div data-aos="fade-in"
								data-aos-easing="ease-in-sine"
								data-aos-duration="1500"
								data-aos-anchor-placement="top-bottom">
						 			<?php the_post_thumbnail('square-thumb', array('class' => 'img-fluid w-100 rounded shadow-sm trans-500')); ?> 
							</div>
					 	</a>             
					</div><!-- col lg 3 -->
					<div class="col-lg-9 pt-2 pb-5">
						<h5><a href="<?php the_permalink() ?>"><?php search_title_highlight(); ?></a></h5>
						<p><?php echo search_excerpt_highlight(); ?></p>  
					</div><!-- col lg 9 -->                  
				<?php } else { ?> <!-- no thumbnail --> 	
							<div class="col-12 d-flex flex-row">
								<h5 class="mr-5"><?php echo $real_count."."; ?></h5>
								<a href="<?php the_permalink() ?>">
									<?php echo '<h5>'. search_title_highlight().    '</h5>';	?>     
								</a>
							</div>	
							<div class="col-12 pb-5">
								<p><?php echo search_excerpt_highlight(); ?></p> 
							</div>		
				<?php }; ?>
			<?php $loop_counter++;  endwhile; ?> 		
					<div class="col-12 text-center">
						<?php wp_pagenavi( array( )); ?>
					</div>							            
			<?php else : ?> 
				<p class="display-4">There is no <?php printf( __( 'search results for    %s.', 'shape' ), '<strong><u>' . get_search_query() . '</u></strong>' ); ?></p>
	</div><!-- end row --> 
	<?php endif;  wp_reset_postdata(); ?>      
</div><!-- end container --> 
<?php get_footer(); ?>