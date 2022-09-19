<article class="bg-white post post-content shadow rounded"> 
  <!-- normal content template image top, then body, footer-->
      <div class="card h-100 border-0 animated fadeIn trans-200">
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <img src="<?php echo $image[0]; ?>" class="img-fluid card-img-top"> 
        <?php else : ?>
        <img src="<?php bloginfo( 'template_url' ); ?>/images/default.jpg" class="img-fluid card-img-top animated fadeIn trans-200" alt="<?php the_title(); ?>">
        <?php endif; ?>        
          <div class="card-body">
              <a href="<?php the_permalink(); ?>"><h5 class="card-title"><?php the_title(); ?></h5></a>
              <p class="card-text"><?php the_excerpt(); ?></p>
          </div><!-- end card body --> 
          <div class="card-footer text-center">
               <small class="post-meta"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>   
          </div><!-- end card footer -->                
      </div>
      <h6 class="post-meta">
        <?php edit_post_link('Edit', ' &#124; ', ''); ?>
      </h6>
</article>