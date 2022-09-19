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
    			<div class="col-lg-8">
    			<h1 class="py-5">Contact Us</h1>
					Please fill out the following contact form to send us inquiry or request, we will reply to you back in 24 hours.   Thank you.
						<?php echo do_shortcode('[contact-form-7 id="433" title="General" html_name="contactForm" html_id="contactForm"]'); ?>
					</div>
					<div class="col-lg-4 pt-4">
						<div class="card"
							data-aos="fade-in"
							data-aos-easing="ease-in-sine"
							data-aos-duration="800"
							data-aos-anchor-placement="top-bottom">							
								<img src="<?php echo get_theme_mod('contactform'); ?>" alt="<?php the_title(); ?>" class="w-100 card-img img-fluid shadow-sm rounded trans-500">	
								<div class="card-img-overlay">
									<div class="card-text h5 text-white">
										Comany Name: <h5 class="pl-3 pb-3"><?php echo get_theme_mod('my_company_name'); ?></h5>
										Address: <h5 class="pl-3 pb-3"><?php echo get_theme_mod('my_company_address'); ?></h5>
										Phone: <h5 class="pl-3 pb-3"><?php echo get_theme_mod('my_company_phone'); ?></h5>
										Email: <h5 class="pl-3 pb-3"><?php echo get_theme_mod('my_company_email'); ?></h5>
									</div>          
							 </div><!-- END card image overlay-->
						</div><!-- END card -->
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