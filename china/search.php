<?php get_header(); ?> 
<div class="featured search-page" style="
        background-image: url('<?php echo get_theme_mod('search_image', get_bloginfo('template_url').'/images/search_image.jpg'); ?>'); 
                          background-position: center; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">          
               <div class="page-header text-center text-white">
                <?php global $wp_query; ?>          
                <p class="page-title display-4"><?php echo $wp_query->found_posts; ?><?php printf( __( ' Search Results Found for: %s', 'shape' ), '<span><u>' . get_search_query() . '</u></span>' ); ?></p>
              </div><!-- .page-header --> 
</div><!-- end of background image -->
<div class="container search-result mt-5">
  <section id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
     	<?php global $paged;
					if(empty($paged)) $paged = 1;
					$loop_counter = 1; 
					$results_per_page = get_query_var('posts_per_page'); ?>
      <?php if ( have_posts() ) : ?>               
                <?php while ( have_posts() ) : the_post(); ?> 
      <?php																				 
						if( $paged == 1 ) {
						 $real_count = $loop_counter;
						 } else {
						 $real_count = $loop_counter + ( $paged * $results_per_page - $results_per_page);
						 }  
				?>
    <?php if ( has_post_thumbnail() ) {; ?>
    <div class="row my-3">
        <div class="col-lg-3 pt-5 pt-lg-2 text-center d-lg-flex flex-row">
            <?php $featured_img_url = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
             <a href="<?php echo $featured_img_url; ?>" data-lightbox="<?php the_title(); ?>" data-title="<?php the_title(); ?>">
              <?php echo '<li class="list-unstyled"><span class="mr-lg-5 font-weight-bold">' . $real_count . '.</span></li>';	?>
               <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded shadow animated fadeIn delay-1s trans-200')); ?> 
             </a>             
        </div>
        <div class="col-lg-9 pt-2">
          <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
              <p><?php echo excerpt(88); ?></p>  
        </div>               
    </div><!-- end row -->    
          <?php } else { ?> 
          <div class="pt-5 pt-lg-2 p-2">                  
              <a href="<?php the_permalink() ?>">
								<?php echo '<li class="list-unstyled"><span class="font-weight-bold d-flex flex-row">' . $real_count . '.<h4 class="ml-5">'.get_the_title(). '</h4></span></li>';	?>     
							</a>					
						<p><?php echo excerpt(68); ?></p> 
          </div>         
          <?php }; ?>
          <?php $loop_counter++; endwhile; ?> 
          <?php wp_pagenavi( array( )); ?>            
            <?php else : ?> 
                <p class="display-4">There is no <?php printf( __( 'search results for    %s', 'shape' ), '<span><strong><u>' . get_search_query() . '</u></strong></span>' ); ?></p> 
            <?php endif;  wp_reset_postdata(); ?> 
            </div>         
        </section><!-- #primary .content-area -->
</div>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>