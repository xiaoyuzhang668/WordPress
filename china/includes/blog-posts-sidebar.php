<div class="section-title">Future Events</div>
  <div class="sidebar-nav-container float-right">           
      <i class="fas fa-chevron-left custom-pre-event"></i>
      <span class="custom-dots-event">
        <i class="ml-2 fas fa-circle active custom-dot-event"></i>
        <i class="fas fa-circle custom-dot-event"></i>
        <i class="fas fa-circle custom-dot-event"></i>         
      </span>         
      <i class="ml-2 fas fa-chevron-right custom-next-event"></i>           
  </div>        
  <div class="owl-carousel owl-theme trans-500 mt-5 sidebar-event">
     <?php
          $args = array(
            'post_type' => 'post', 
            'posts_per_page' => 12,  
            'order' => 'DESC',
            'cat'         => '253',
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
                    <div class="sidebar-post"> 
                        <a href="<?php the_permalink(); ?>">
                          <div class="pl-3 mb-3 row d-flex align-items-center">
                            <div class="col-5 col-lg-3 text-center text-muted pl-0">
                             <?php $date = get_field("event_date_and_time", false, false);
                             $date = new DateTime($date); ?>
                              <p class="h1"><?php echo $date->format('j'); ?></p>
                              <p class="text-uppercase h3"><?php echo $date->format('M'); ?></p>                     
                            </div>
                            <div class="col-7 col-lg-9 sidebar d-flex align-items-center">
                              <div class="sidebar-post-content pr-3">
                                <h6 class="sidebar-post-title trans-500"><?php the_title(); ?></h6>
                                <p class="post-meta"><?php the_author(); ?> • <?php the_time('M j, Y'); ?></p>
                              </div>
                            </div>
                          </div> 
                        </a>                                                                         
                    </div>                                                                         
                  </div>                                                                
            <?php $counter++; endwhile; 
             wp_reset_query(); ?>        
        <?php endif; ?>
  </div><!-- end owl carousel -->