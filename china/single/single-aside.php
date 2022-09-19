<?php get_header(); ?>
 <img src="<?php echo get_theme_mod('content_aside_image', get_bloginfo('template_url').'/images/content_aside_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php if ( have_posts() ) : ?> 
    <!-- the loop -->
    <div class="container my-5 single">   
       <?php while ( have_posts() ) : the_post(); ?> 
        <div class="row">
            <div class="col-lg-6 text-left">   
                <span class="author-image"><?php echo get_avatar( get_the_author_meta('email'),'60'); ?></span>
                <small class="post-meta ml-3"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>                  
            </div>
            <div class="col text-right mt-2">  
                <?php echo do_shortcode ("[wp_ulike]");  ?>                       
            </div> 
            <div class="col mt-2">
                <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
            </div>            
        </div>  
        <div class="row">
            <div class="btn btn-secondary rounded-pill text-center px-4 ml-3 text-uppercase category-btn trans-200"><?php the_category(' '); ?></div>
        </div>
        <div class="bg-white p-lg-5 p-1 my-5 rounded shadow">       
            <h2 class="text-center mb-5"><?php the_title(); ?></h2>
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
	</div><!-- end container -->
    <button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>

