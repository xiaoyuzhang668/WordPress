<?php get_header(); ?>
<div class="loader"></div>
<img src="<?php echo get_theme_mod('travel_image', get_bloginfo('template_url').'/images/travel_image.jpg'); ?>" class="img-fluid" alt="Default Image"> 
<section>
  <div class="container">        
    <div class="row">
      <div class="col-lg-9">             
        <div class="section-title">Travel Posts</div>                       
        <div class="row grid">  
          <?php if ( have_posts() ) : ?> 
            <?php while ( have_posts() ) : the_post(); ?> 
                <div class="col-lg-4 grid-item trans-200">
                <?php get_template_part('template-parts/content', get_post_format()); ?>                                  
                </div>
             <?php endwhile; ?>  
        </div><!-- end row and grid -->         
        <div class="text-center">        
          <div class="page-load-status d-block">
            <div class="loader-ellips infinite-scroll-request">
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
            </div>
            <p class="infinite-scroll-last">This is the end of content for Travel posts.</p>
            <p class="infinite-scroll-error">You have reached the end of the content for page Travel.</p>
          </div><!-- end of page-load-status -->
        </div>
              <?php wp_pagenavi(  ); ?>                   
                <?php else : ?>
                      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
              <?php endif; wp_reset_query(); ?>         
      </div>
      <div class="col-lg-3">
        <div class="row">
          <div class="col-12">               
               <?php include "includes/blog-videos-sidebar.php"; ?>     
          </div>
          <div class="col-12 mt-5">         
               <?php include "includes/blog-posts-sidebar.php"; ?>     
          </div> 
        </div>            
      </div><!-- end column col-lg-3 -->
    </div> <!-- end row -->
  </div> <!-- end container -->
</section>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>