<div class="section-title">Newest Videos</div>
  <div class="sidebar-nav-container float-right">           
      <i class="fas fa-chevron-left custom-pre-vid"></i>
      <span class="custom-dots-vid">
        <i class="ml-2 fas fa-circle active custom-dot-vid"></i>
        <i class="fas fa-circle custom-dot-vid"></i>
        <i class="fas fa-circle custom-dot-vid"></i>         
      </span>         
      <i class="ml-2 fas fa-chevron-right custom-next-vid"></i>           
  </div>        
  <div class="owl-carousel owl-theme trans-500 mt-5 sidebar-video">
     <?php
          $args = array(
            'post_type' => 'post', 
            'posts_per_page' => 12,  
            'order' => 'DESC',
            'cat'         => '251',
            'paged' => get_query_var('paged'),
          );
          $loop = new WP_Query( $args );
          ?>
        <?php if( $loop->have_posts() ): ?>
          <?php $counter = 0; while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php if ($counter % 4 == 0 && $counter != 0): ?>
              </div>          
            <?php endif; ?>
            <?php if ($counter % 4 == 0 or $counter == 0): ?>
              <div class="post">          
            <?php endif; ?>      
                  <div class="sidebar-post mt-2"> 
                    <a data-fancybox href="<?php the_field('videourl'); ?>">
                      <div class="pl-3 row no-gutters">
                        <div class="col-8 col-lg-4">
                           <div class="sidebar-post-image img-fluid rounded"><?php the_post_thumbnail('square-size'); ?></div>
                        </div>
                        <div class="col-4 col-lg-8 sidebar align-self-center">
                          <div class="pl-3">
                            <h6 class="sidebar-post-title trans-500"><?php the_title(); ?></h6>
                            <small class="post-meta"><?php the_author(); ?> • <?php the_time('M j, Y'); ?></small>
                          </div>
                        </div>
                      </div> 
                    </a>                                                                         
                  </div>                                                                
            <?php $counter++; endwhile; 
             wp_reset_query(); ?>        
        <?php endif; ?>
  </div><!-- end owl carousel -->


