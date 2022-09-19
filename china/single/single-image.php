<?php get_header(); ?>
<?php if (in_category('cooking')) : ?>
<?php $backgroundImg=get_theme_mod('cooking_image', get_bloginfo('template_url').'/images/cooking_image.jpg'); ?> 
<?php endif; ?> 
<?php if (in_category('lifestyle')) : ?>
<?php $backgroundImg=get_theme_mod('lifestyle_image', get_bloginfo('template_url').'/images/lifestyle_image.jpg'); ?> 
<?php endif; ?> 
<?php if (in_category('travel')) : ?>
<?php $backgroundImg=get_theme_mod('travel_image', get_bloginfo('template_url').'/images/travel_image.jpg'); ?> 
<?php endif; ?>   
<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>     
        <div class="featured" style="
        background-image: url('<?php echo $backgroundImg; ?>'); 
                          background-position: center; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">
            <div class="text-center">
              <div class="btn btn-secondary rounded-pill text-center px-4 text-uppercase category-btn trans-200">
                <a href="#" class="trans-200"><?php the_category(); ?></a>             
              </div><!-- end category --> 
              <div class="h2 text-white mt-4"><?php the_title(); ?></div>
            </div>
        </div><!-- end of background image -->
    	<div class="container my-5">
        <div class="row">
          <div class="col-lg-9">
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
              <div class="bg-white p-lg-5 p-1 mt-5 rounded shadow">   
                <?php $featured_img_url = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
                <a href="<?php echo $featured_img_url; ?>" data-lightbox="<?php the_title(); ?>" data-title="<?php the_title(); ?>">
                   <?php the_post_thumbnail('full', array('class' => 'mb-2 img-fluid rounded shadow animated fadeIn delay-1s trans-200 w-100')); ?>
                </a>                             
                <p><?php the_content(); ?></p> 
              </div>
              <div class="row mt-5 clear">
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
      </div>   <!-- end container -->      
    <?php endwhile; ?>
    <!-- end of the loop --> 
        <?php wp_reset_postdata(); ?> 
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
    <?php  if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-template mt-5 rounded">
            <?php comments_template( '', true ); ?>
        </div>
    <?php endif; ?>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>       