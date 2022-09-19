<?php
$dashboardIcon = [ "Thai Food",  "Bars and Beverages", "Chinese Food", "Dim Sum", "Cafe", "Vietnamese", "Dumplings"];
				$dashboardLength = count($dashboardIcon);
        $i = 0;
       while ($i < $dashboardLength) {	
				 	$plural = $dashboardIcon[$i];
					$lower = str_replace(' ', '-', $plural); 
					$singular = strtolower($lower);		 
// the query 
				 global $post;  global $product; 
				 $the_query = new WP_Query( array( 
					 'post_type'=>'product', 
					 'product_cat' => $singular, /*CHANGE category name here*/
					 'posts_per_page' => -1, /*CHANGE per post number here*/
					 'post__not_in' => array($product->ID)	,
					 'orderby' => 'date',
					 'order' => 'DESC',
					 'paged' => get_query_var('paged'),
					 'post_status'=>'publish',
				 ) 
				); 	
			// The Loop
			if ( $the_query->have_posts() ) : $counter = 0;
				$query = new WP_Query( array(
							'tax_query' => array(
									array(
											'taxonomy' => 'product_cat',
											'field' => 'slug',
											'terms' => $singular, // Replace with the parent category ID
											'include_children' => true,
									),
							),
							'nopaging' => true,
							'fields' => 'ids',
					) );
				$total_count = esc_html( $query->post_count );  ?>
				<h6 class="pt-3 text-center"><a href="#"><?php echo $plural; ?><span class="badge badge-secondary"><?php echo $total_count; ?></span></a></h6>';
					$string .= '<div class='.$singular.'>';
					<?php while ( $the_query->have_posts() ) {
							$the_query->the_post();
									if ( has_post_thumbnail() ) {
									$string .= '<li>';
									$string .=  '<div class="border-top py-3 d-flex align-items-center"><a href="' . get_the_permalink() .'" rel="bookmark">'.get_the_post_thumbnail( $post->ID, array( 35, 35),  array( 'class' => 'rounded shadow-sm' ) ). '<span class="pl-4"><a href="' . get_the_permalink() .'" rel="bookmark">' .  wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</span></a></div></li>'; 		
									} else { 
									// if no featured image is found
									$string .= '<hr>';
									$string .= '<li class="py-2"><a href="' . get_the_permalink() .'" rel="bookmark">' . wp_trim_words( get_the_title(), 10 , '   .  .  .' ) . '</a></li>'; 
									}
									$i++; }
					} else { ?>
					<p>No posts found in this criteria.</p>
			<?php }
			$string .= '</div>'; 
			$i++; }
			return $string; 
			wp_reset_postdata();	

?>
<?php $teaSlider = [ "redtea", "whitetea", "oolongtea"];
				$teaSliderArray = ["Red Tea", "White Tea", "Oolong Tea"];
        $teaSliderLength = count($teaSlider);
        $i = 0;
        while ($i < $teaSliderLength)
        { ?>
<section class="sidebar-slider-<?php echo $teaSlider[$i];?>">
<h4 class="section-title pb-4 mb-5"><a href="<?php echo home_url().'/our-tea/'.$teaSlider[$i] ;?>"><?php echo $teaSliderArray[$i];?>    <span class="badge badge-secondary"><?php $count_posts = wp_count_posts($teaSlider[$i]); echo $count_posts->publish;  ?></span></a></h4>
  <div class="sidebar-nav-container float-right">           
      <i class="fas fa-chevron-left custom-pre-<?php echo $teaSlider[$i];?>"></i>
      <span class="custom-dots-<?php echo $teaSlider[$i];?>">
        <i class="small ml-2 fas fa-circle active custom-dot-<?php echo $teaSlider[$i];?>"></i>
        <i class="small fas fa-circle custom-dot-<?php echo $teaSlider[$i];?>"></i>
        <i class="small fas fa-circle custom-dot-<?php echo $teaSlider[$i];?>"></i>         
        <i class="small fas fa-circle custom-dot-<?php echo $teaSlider[$i];?>"></i>         
      </span>         
      <i class="ml-2 fas fa-chevron-right custom-next-<?php echo $teaSlider[$i];?>"></i>           
  </div>        
  <div class="owl-carousel owl-theme trans-500 mt-5 sidebar-<?php echo $teaSlider[$i];?>">
     <?php
          $args = array(
            'post_type' => $teaSlider[$i], 
            'posts_per_page' => 12,
						'orderby' => 'date' ,
            'order' => 'DESC',
            'paged' => get_query_var('paged'),
						'post_status'=>'publish',
					);
          $loop = new WP_Query( $args );
          ?>
        <?php if( $loop->have_posts() ):  $counter = 0;?>
          <?php  while ( $loop->have_posts() ) : $loop->the_post(); ?>                        			
						<?php if ($counter % 3 == 0 && $counter != 0): ?>
              </div>          
            <?php endif; ?>
            <?php if ($counter % 3 == 0 or $counter == 0): ?>
              <div class="post">          
            <?php endif; ?> 
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"> 
						<div class="py-3 sidebar-post row no-gutters">							
							<div class="col-3">
								 <?php the_post_thumbnail('sidebar-thumb', array('class' => 'sidebar-post-image rounded-circle shadow-sm trans-500' )); ?>
							</div>
							<div class="col-9 pl-3 sidebar-column align-self-center">
								<div>
									<h6 class="sidebar-post-title trans-500"><?php echo wp_trim_words( get_the_title(), 10 , '  .  .  .' ); ?></h6>
									<small><?php the_author(); ?> • <?php the_time('M j, Y'); ?></small>
								</div>
							</div>								
						</div>
						</a>       			          	                                                    
        <?php $counter++; endwhile; endif;  wp_reset_query(); ?>
	</div>
</section>
<?php if ($i != 2) echo "<hr class='style-eight pb-5 mt-5'>"; ?>
<?php $i++; } ?>