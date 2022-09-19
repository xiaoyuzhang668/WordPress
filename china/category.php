<?php get_header(); ?> 
<div class="loader"></div>
<?php if (is_category('cooking')) : ?>
 <img src="<?php echo get_theme_mod('cooking_image', get_bloginfo('template_url').'/images/cooking_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php endif; ?> 
<?php if (is_category('lifestyle')) : ?>
 <img src="<?php echo get_theme_mod('lifestyle_image', get_bloginfo('template_url').'/images/lifestyle_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php endif; ?> 
<?php if (is_category('event')) : ?>
 <img src="<?php echo get_theme_mod('event_image', get_bloginfo('template_url').'/images/event_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php endif; ?> 
<?php if (is_category('popular')) : ?>
 <img src="<?php echo get_theme_mod('popular_image', get_bloginfo('template_url').'/images/popular_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php endif; ?> 
<?php if (is_category('video')) : ?>
 <img src="<?php echo get_theme_mod('video_image', get_bloginfo('template_url').'/images/video_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php endif; ?> 
  <div class="container mt-5">      
    <?php 
    if(have_posts()):   ?>
      <h1 class="category-header text-center">Category: <?php single_cat_title( '', true ); ?></h1>
      <?php
      // Display optional category description
        if ( category_description() ) : ?>
          <div class="text-center"><?php echo category_description(); ?></div>
        <?php endif; ?>         
        <div class="category-container mt-3">
          <?php while(have_posts()): the_post(); ?>
            <?php static $count = 0;
                if ($count == "6") { break; }
            else { ?>
          <div class="row post trans-500"> 
            <div class="col-12"><?php if ($count == "0")  echo '<hr class="w-75 style-three float-lg-right">'; ?>
            </div> 
              <?php if (has_post_thumbnail()): ?>
                    <div class="col-lg-4 mt-3"> 
                        <?php $featured_img_url = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
                        <a href="<?php echo $featured_img_url; ?>" data-lightbox="<?php the_title(); ?>" data-title="<?php the_title(); ?>">
                          <?php the_post_thumbnail('full', array ('class' => 'w-100 img-fluid rounded shadow')); ?>
                        </a>                                              
                    </div>
                    <div class="col-lg-8 mt-3">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
                        <small>Posted on <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> by <?php the_author_posts_link() ?></small>                        
                        <p class="mt-3">
                         <?php echo excerpt(100); ?>
                        </p>                        
                        <p class="post-meta">
                          <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed'); ?>
                        </p>
                    </div>
              <?php else : ?>
                    <div class="col-12">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h2 class="text-center"><?php the_title(); ?></h2></a>
                        <div class="text-center"><small>Posted on <?php the_time('F j, Y'); ?>  at <?php the_time('g:i a'); ?> by <?php the_author_posts_link() ?></small></div>
                        <p class="mt-3">
                         <?php echo excerpt(100); ?>
                        </p>                              
                        <p class="post-meta">
                          <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed'); ?>
                        </p>
                    </div>
              <?php endif; ?>
                    <div class="col-12">
                      <!-- not horizontal line at the last row -->
                      <?php if( $wp_query->current_post < $wp_query->post_count-1 ) echo '<hr class="w-75 style-three float-lg-right">';?>
                      <h6 class="post-meta">
                        <?php edit_post_link('Edit', ' &#124; ', ''); ?>
                      </h6>
                    </div> 
          </div><!-- end of row and post -->
            <?php $count++; } ?>
            <?php  endwhile; ?>  
            <?php wp_pagenavi( ); ?> 
        </div><!-- end of category container -->
        <div class="page-load-status">
          <div class="loader-ellips infinite-scroll-request">
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
            <span class="loader-ellips__dot"></span>
          </div>
          <p class="infinite-scroll-last">
            This is the end of content for category: <?php single_cat_title( '', true ); ?>
          </p>
          <p class="infinite-scroll-error">
            No more pages for category: <?php single_cat_title( '', true ); ?>to load. 
          </p>
        </div>
        <div class="text-center mt-5 ">
          <button class="view-more-button btn btn-secondary">
            View More <?php single_cat_title( '', true ); ?>
          </button>
        </div>
             
            <?php  endif; wp_reset_query();  ?>      
  </div><!-- end of container -->
  <button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>