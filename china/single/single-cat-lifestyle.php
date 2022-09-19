<!-- GET HEADER.PHP -->
<?php get_header(); ?>
 <img src="<?php echo get_theme_mod('single_lifestyle_image', get_bloginfo('template_url').'/images/single_lifestyle_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
  <?php 
  if(have_posts()): 
    while(have_posts()): the_post(); ?>
      <div class="container entry">
        <div class="row">
          <div class="col-lg-9 lifestyle-img">  
              <div class="row">
                  <div class="col-lg-6 text-left">   
                      <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
                      <small class="post-meta ml-3"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>                  
                  </div>
                  <div class="col text-left mt-2">  
                      <?php echo do_shortcode ("[wp_ulike]");  ?>                       
                  </div> 
                  <div class="col mt-2">
                      <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                  </div>            
              </div>  
              <div class="row">
                  <div class="d-none d-lg-block btn btn-secondary rounded-pill text-center px-4 text-uppercase category-btn trans-200"><?php the_category(' '); ?></div>
              </div>  
              <div class="bg-white p-lg-3 px-1 my-5 rounded shadow">                                 
                  <h2 class="text-center my-5"><?php the_title(); ?></h2> 
                  <div class="mb-3">
                     <div class="text-center">  
                        <?php $featured_img_url = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
                        <a href="<?php echo $featured_img_url; ?>" data-lightbox="<?php the_title(); ?>" data-title="<?php the_title(); ?>">
                           <?php the_post_thumbnail('fullpage-thumb', array('class' => 'img-fluid shadow img-thumbnail rounded animated fadeIn delay-1s')); ?> 
                        </a>                              
                     </div> 
                  </div>  
                    <p><?php the_content(); ?></p> 
              </div>  
              <div class="row mt-5">
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
          <div class="col-lg-3 sidebar-background pt-3">      
                <!-- Print a link to this category -->
             <?php get_template_part('template-parts/content','extra-sidebar'); ?>                        
          </div>
        </div>                            
      </div>                  
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?> 
  <?php endif;    
  ?>
  <?php  if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-template mt-5 rounded">
            <?php comments_template( '', true ); ?>
        </div>
    <?php endif; ?>
  <button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>