<?php get_header(); ?>
 <img src="<?php echo get_theme_mod('single_video_image', get_bloginfo('template_url').'/images/content_image_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php if ( have_posts() ) : ?> 
    <!-- the loop -->
    <?php while ( have_posts() ) : the_post(); ?>  
    	<div class="container mt-5">
    		<div class="mb-4">
    			<h2 class="text-center"><?php the_title(); ?></h2>
    		</div>              
            <div id="bgndVideo" class="player mb-5 rounded shadow" data-property="{videoURL:'<?php the_field('videourl'); ?>',containment:'self', mute:true, autoplay:false, volumn:50, showYTLogo:true, addRaster:false, realfullscreen:true, stopMovieOnBlur:true, anchor:'bottom, bottom', ratio:'4/3'}"></div>
            <p><?php the_content(); ?></p> 
            <?php get_template_part('template-parts/content','pagination'); ?>    
        </div>         
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

                                 

