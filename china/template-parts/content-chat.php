<article class="bg-white post post-quote shadow rounded"> 
  <!--  content template  with image bottom, then body, footer-->
      <div class="card h-100 animated fadeIn trans-200 border-0 pt-3">      
            <a href="<?php the_permalink(); ?>"><h5 class="card-title px-2"><?php the_title(); ?></h5></a>
            <?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
            <img src="<?php echo $image[0]; ?>" class="img-fluid card-img-bottom animated fadeIn trans-200"> 
            <?php endif; ?> 
            <div class="px-2">
              <p class="card-text"><?php the_excerpt(); ?></p>
            </div>             
        <div class="card-footer text-center">
             <small class="post-meta"><?php the_author_posts_link() ?> • <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></small>   
        </div><!-- end card footer -->                
      </div>                
      <h6 class="post-meta">
        <?php edit_post_link('Edit', ' &#124; ', ''); ?>
      </h6>
</article>