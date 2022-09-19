<?php get_header(); ?>    
<section class="clear">
		<!-- THE LOOP -->
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="card"
			data-aos="fade-in"
			data-aos-easing="ease-in-sine"
			data-aos-duration="1500"
			data-aos-anchor-placement="top-bottom">
       	<?php if(has_post_thumbnail()): ?>	
					<a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="Blog Post" data-title="<?php the_title(); ?>">		
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="maxHeight w-100 card-img img-fluid shadow-sm trans-500">					
					</a>
      	<?php endif; ?>
      	<div class="card-img-overlay justify-content-center align-items-center">
        	<h3 class="card-title"><?php the_title(); ?></h3>          
					<?php if ( is_singular() && comments_open() ) { ?>
							<div class="comments-template">
								<?php comments_template( '', true ); ?>
							</div> 	
					<?php  } ?>
       </div><!-- END card body-->
    </div><!-- END card -->
    <p class="card-text"><?php the_content(); ?></p>
		<?php endwhile;  ?>
  	<div class="col-12 text-center">
				<?php wp_pagenavi( ); ?> 
		</div>	
   	<?php else: ?>
    		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
</section>
<?php get_footer(); ?>