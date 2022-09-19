<div class="super-container">
  <!-- headline carousel image , add image under appearance -> customize -> carousel -->
  <img src="<?php echo get_theme_mod('image1', get_bloginfo('template_url').'/images/default.jpg'); ?>" class="d-block w-100 home-image" alt="Default Image">   
  <div class="carousel">   
    <div class="carousel-caption container text-left d-none d-lg-block"> 
        <div class="row px-0"> 
        <!-- post in travel, lifestyle and cooking  -->
         <?php $args = array(
              'post_type' => 'post',            
              'category__in' => array(3, 4, 5),
              'paged' => get_query_var('paged'),
              'post_status'=>'publish',
              'orderby' => 'date' ,
              'order' => 'DESC' , 
              'hide_empty'     => 1,
              'depth'          => 1,
              'posts_per_page' => 4,
           );           
          $catquery = new WP_Query($args); ?>              
            <?php if ($catquery->have_posts()):  $i = 0; ?>          
                <?php while($catquery->have_posts()) : $catquery->the_post(); ?>
                <?php                 
                if($i==0): $column = 12; $oneClass="show";
                else: $column = 3; $class="no-show"; $similar="similar-post"; 
                endif; 
                ?> 
                <div class="col-lg-<?php echo $column;?> ">                
                  <div class="btn btn-secondary rounded-pill text-center px-4 text-uppercase category-btn trans-200 <?php echo $class; ?>">
                    <a href="#" class="trans-200"><?php the_category(); ?></a>
                  </div><!-- end category -->                                
                  <div class="header-slider-item-title">
                    <a href="<?php the_permalink(); ?>">
                      <h3 class="trans-200 <?php echo $similar; ?>"><?php the_title(); ?></h3></a>       
                      <small class="trans-200 d-none d-lg-block my-3"><?php the_category(); ?></small>
                      <p class="text-white <?php echo $class; ?>"><?php echo excerpt(35); ?></p>                  
                  </div> <!-- end header-slider-item-title -->
                  <div class="mt-3 header-slider-item-link <?php echo $class; ?>">    
                    <a href="<?php the_permalink(); ?>">
                      <svg version="1.1" id="link_arrow_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
                      <polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
                      </svg>
                    </a>
                  </div><!-- header - slider - item - link -->                
                </div> <!-- end column -->                             
              <?php $i++; endwhile; wp_reset_postdata(); endif;      
              ?>  
        </div><!-- end row -->
    </div><!-- end carousel caption -->
  </div><!-- end carousel container -->
  <div class="slider-img float-right">
        <div class="home-one">
          <div id="china-carousel" class="carousel slide carousel-fade" data-interval="7000" data-ride="carousel">       
            <div class="carousel-inner">            
                <?php $args = array(
                  'meta_query' => array( 
                      array(
                          'key' => '_thumbnail_id',
                      ) 
                  ),
                  'type' => 'post',
                  'paged' => get_query_var('paged'),
                  'post_status'=>'publish',
                  'orderby' => 'date' ,
                  'order' => 'DESC' , 
                  'hide_empty' => 1,
                  'depth' => 1,               
                  'category__in' => array(3, 4, 5),
                  'offset' => 4,
                  'posts_per_page' => -1
                 );           
                $q = new WP_Query($args); ?>
                <?php if ($q->have_posts()):  $count = 0; ?>          
                <?php while($q->have_posts()) : $q->the_post(); ?>        
                <div class="carousel-item d-none d-lg-block <?php if ($count == 0): echo 'active'; endif; ?>">
                  <?php the_post_thumbnail('custom-size', array('class' => 'img-fluid rounded shadow-lg animated fadeIn delay-1s trans-200')); ?>                               
                  <div class="slider-next-tint trans-400"></div>
                  <div class="carousel-caption slider-next-title trans-400 animated bounceIn delay-1s">
                      <?php the_title( sprintf('<h4 class="text-left d-none d-lg-block px-3"><a href="%s">', esc_url(get_permalink()) ),'</a></h4>'); ?>
                      <small><?php the_category(' '); ?></small>   
                      <h6 class="post-meta">
                          <?php edit_post_link('Edit', ' &#124; ', ''); ?>
                      </h6>           
                  </div>
                </div> <!-- end carousel item --> 
                <?php $count++; endwhile; ?> 
              <?php endif; wp_reset_query(); ?>           
            </div><!-- end carousel innner -->
            <div class="slider-next-icon d-none d-lg-block">
              <a class="carousel-control-prev" href="#china-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#china-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div><!-- end china carousel -->
        </div> <!-- end home one -->   
  </div> <!-- end slider image -->  
</div> <!-- end super container -->