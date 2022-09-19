<?php get_header(); ?>    
<section class="clear">
		<!-- THE LOOP -->
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="card text-center"
			data-aos="fade-in"
			data-aos-easing="ease-in-sine"
			data-aos-duration="800"
			data-aos-anchor-placement="top-bottom">
       	<?php if(has_post_thumbnail()): ?>	
					<a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="Blog Post" data-title="<?php the_title(); ?>">		
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="minHeight w-100 card-img img-fluid shadow-sm trans-500">					
					</a>
      	<?php endif; ?>
      	<div class="card-img-overlay d-flex justify-content-center align-items-center">
        	<h3 class="card-title display-2 text-white"><?php the_title(); ?></h3>          
       </div><!-- END card image overlay-->
    </div><!-- END card --> 
    <div class="container">
    	<div class="row">
    		<div class="offset-lg-1">
    			<p><?php echo do_shortcode('[ea_bootstrap width="800px" scroll_off="true" layout_cols="2"]
');  ?></p>	
				</div>
    	</div>        	
    </div>  
		<?php endwhile;  ?>
  	<div class="col-12 text-center">
				<?php wp_pagenavi( ); ?> 
		</div>	
   	<?php else: ?>
    		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
</section>
<?php get_footer(); ?>