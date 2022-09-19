<!-- Largest Card With Image , travel category -->
<!-- GET HEADER.PHP -->
<?php get_header(); ?>  
 <?php 
  if(have_posts()): 
          if(has_post_thumbnail(  $post->ID )) : ?>
          <?php $backgroundImg = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
          <?php else : ?>
          <?php $backgroundImg = 'http://localhost/master_china/wp-content/uploads/2019/08/default.jpg'; ?>
          <?php endif; ?>
        <?php while(have_posts()): the_post(); ?>     
        <div class="featured" style="
        background-image: url('<?php echo $backgroundImg;?>'); 
                          background-position: center; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">
            <div class="text-center">
              <div class="btn btn-secondary rounded-pill text-center px-4 text-uppercase travel-btn trans-200">
                <a href="#" class="trans-200"><?php the_category(); ?></a>             
              </div><!-- end category --> 
              <div class="h2 text-white mt-4"><?php the_title(); ?></div>
            </div>
        </div><!-- end of background image -->
        <div class="container mt-5"> 
          <div class="row">
            <div class="col-lg-9">
              <div class="row">              
                <div class="col-lg-5 text-left">   
                    <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
                    <small class="post-meta ml-3"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>                  
                </div>
                <div class="col-lg-3 text-left mt-2">  
                    <?php echo do_shortcode ("[wp_ulike]");  ?>                       
                </div> 
                <div class="col mt-2 text-right">
                    <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                </div> 
              </div> 
              <div class="row mt-3">
                  <div class="col-12 bg-white p-lg-5 p-2 mb-5 rounded shadow">
                    <p><?php the_content(); ?></p>
                  </div>
                  <div class="col-6">   
                      <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
                      <small class="post-meta ml-3"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>                  
                  </div>
                  <div class="col-6">
                      <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                  </div>            
              </div>  
              <?php get_template_part('template-parts/content','related-author'); ?>
              <?php get_template_part('template-parts/content','pagination'); ?>            
            </div>         
            <div class="col-lg-3">
              <?php get_sidebar(); ?>
            </div> 
          </div>                 
        </div> <!-- end container -->            
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?> 
  <?php endif;    
  ?>
<div class="container">
      <?php  if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-template mt-5 rounded">
            <?php comments_template( '', true ); ?>
        </div>
    <?php endif; ?>
</div>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>