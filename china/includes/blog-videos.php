<section class="blog-videos">
  <div class="container mt-2">
    <div class="row">
      <div class="col-lg-9">
        <div class="section-panel">
            <div class="section-title">Most Popular Videos</div>
        </div>
        <div class="player-container rounded my-5">  
              <?php $q = new WP_Query('cat=252'); 
               if ( $q->have_posts() ) : while ( $q->have_posts() ) :  $q->the_post();  
              ?>        
              <div id="bgndVideo" class="player" data-property="{videoURL:'<?php the_field('videourl'); ?>',containment:'self', mute:true, autoplay:false, volumn:50, showYTLogo:false, opacity:0.8, addRaster:false, realfullscreen:true, stopMovieOnBlur:true, anchor:'bottom,bottom', ratio:'4/3'}"></div>
              <?php endwhile; wp_reset_postdata(); endif; ?> 
              <div class="playlist w-25 h-100 d-none d-lg-block">               
                   <?php 
                      $args = array(
                      'post_type' => 'post' ,
                      'orderby' => 'date' ,
                      'order' => 'DESC' ,
                      'cat'   => '252',
                      'paged' => get_query_var('paged'),
                      'posts_per_page' => 3
                      ); 
                      $q = new WP_Query($args);
                      if ( $q->have_posts() ) : $i = 0; while ( $q->have_posts() ) :  $q->the_post();  
                      ?>
                        <?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square-size'); ?> 
                        <div class="video-container mt-5 <?php if($i==0): echo "active"; endif; ?>" onclick="jQuery('#bgndVideo').YTPChangeMovie({videoURL:'<?php the_field('videourl'); ?>'})">
                          <div class="video">
                            <div class="row">
                              <div class="col-4 d-flex flex-row align-items-center justify-content-center">
                                <div class="video-image"><div><img src="<?php echo $backgroundImg[0]; ?>" class="img-fluid circle-icon"></div><img class="play-img" src="<?php bloginfo( 'template_url' ); ?>/images/play.png" alt="play button"></div>
                              </div> <!-- end of col - 4 -->             
                              <div class="col-8 video-content">                       
                                  <div class="video-title"><?php the_title(); ?></div>
                                  <div class="video-info small"><span><?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></span></div>
                              </div> <!-- end of col-8 -->
                            </div> <!-- end of row -->                   
                          </div> <!-- end of video -->                
                        </div><!-- end of video container -->
                        <?php $i++; endwhile;
                          wp_reset_postdata();
                        ?>              
                    <?php endif; ?> 
              </div> <!-- end playlist-->                       
        </div><!-- end player container -->
      </div><!-- end col - lg - 9 -->
      <div class="col-lg-3 sidebar-background">
        <?php include "blog-videos-sidebar.php"; ?>
      </div><!-- end col lg 3 -->
    </div><!-- end row -->
  </div><!-- end container -->
</section>



