<article class="bg-white post post-status bg-white shadow rounded">  
<!-- excerpt under the image , body over the image      -->
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
        <?php $backgroundImg = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); ?>
        <?php else : ?>
        <?php $backgroundImg = 'http://localhost/master_china/wp-content/uploads/2019/08/default.jpg'; ?>
        <?php endif; ?> 
        <div class="card h-100 animated fadeIn trans-200" style="
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), 
                          rgba(0, 0, 0, 0.4)), 
                          url('<?php echo $backgroundImg;?> '); 
                          background-position: top; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">
          <div class="card-body">            
              <a href="<?php the_permalink(); ?>"><h5 class="card-title text-white"><?php the_title(); ?></h5></a>                 
          </div><!-- end card body --> 
          <div class="text-center mb-3">
               <small class="post-meta text-white"><span class="author-name"><?php the_author_posts_link() ?></span> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>   
          </div><!-- end card footer -->                
        </div>
        <div class="px-2 pb-2">        
          <p class="mt-3 card-text"><?php the_excerpt(); ?></p>
        </div>
        <h6 class="post-meta">
            <?php edit_post_link('Edit', ' &#124; ', ''); ?>
        </h6> 
</article>
