<!-- Largest Card With Image , travel category -->
<!-- GET HEADER.PHP -->
<?php get_header(); ?>
<div class="loader"></div>
<img src="<?php echo get_theme_mod('single_image', get_bloginfo('template_url').'/images/archive_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<div class="container regular my-5">
  <h2 class="text-center pb-3">All Blog Posts</h2>
  <div class="row">
     <?php $args = array(
              'post_type' => 'post',            
              'paged' => get_query_var('paged'),
              'post_status'=>'publish',
              'orderby' => 'date' ,
              'order' => 'DESC' , 
              'hide_empty'     => 1,
              'depth'          => 1,
              'posts_per_page' => 9,
           );  
          $wpb_all_query = new WP_Query($args); ?>
  <?php 
  if($wpb_all_query->have_posts()):  ?>
    <?php while($wpb_all_query->have_posts()): $wpb_all_query->the_post(); ?> 
      <div class="col-lg-4 mb-3">     
        <div class="card h-100 rounded shadow">       
          <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', array('class' => 'img-fluid card-img-top animated fadeIn delay-1s trans-200')); ?> 
          <?php else : ?>
            <img src="<?php bloginfo( 'template_url' ); ?>/images/default.jpg" alt="<?php the_category(); ?>">
          <?php endif; ?>   
          <div class="card-body">   
            <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="card-text"><?php the_excerpt(); ?></p>   
          </div>         
          <div class="card-footer text-center">        
            <small class="post-meta">Filed under <?php the_category(', ') ?> by <?php the_author_posts_link() ?><br><span> <?php the_time('F j, Y'); ?></span></small>   
            <br><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
          </div>
        </div><!-- end card -->
      </div><!-- end col-lg-4 -->
  <?php endwhile; ?>         
     <div class="col-12 text-center"><?php wp_pagenavi( array( 'query' => $wpb_all_query ) ); ?> </div>
  <?php endif;  wp_reset_postdata(); ?>   
  </div>
</div>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>