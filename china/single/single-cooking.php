<!-- Largest Card With Image , travel category -->
<!-- GET HEADER.PHP -->
<?php get_header(); ?>  
 <?php 
  if(have_posts()): 
    while(have_posts()): the_post(); ?>       
        <?php if(has_post_thumbnail(  $post->ID )) : ?>
          <?php $backgroundImg = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'fullpage-thumb'); ?>
          <?php else : ?>
          <?php $backgroundImg = 'http://localhost/master_china/wp-content/uploads/2019/08/default.jpg'; ?>
          <?php endif; ?>
        <div class="featured" style="
        background-image: url('<?php echo $backgroundImg;?>'); 
                          background-position: top; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">
              <h5 class="text-center">single cooking<?php the_title(); ?></h5>
        </div>
        <div class="container mt-5">             
          <p><?php the_content(); ?></p>   
        </div>         
        <div class="card-footer">
          <div class="container">
           <?php get_template_part('template-parts/content','pagination'); ?>  
          <small class="post-meta"><?php the_author(); ?><span> <?php the_time('F j, Y'); ?></span> at <?php the_time('g:i a'); ?></small>   
          </div>
        </div>
  <?php endwhile; 
  endif;    
  ?>
<?php get_footer(); ?>