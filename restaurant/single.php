<?php get_header(); ?>    
<section class="clear container my-5">
	<div class="row">
		<div class="col-lg-8">
		<!-- THE LOOP -->
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="card"
			data-aos="fade-in"
			data-aos-easing="ease-in-sine"
			data-aos-duration="800"
			data-aos-anchor-placement="top-bottom">
				<small class="card-header"><?php the_time('M j, Y'); ?> by <span class="font-weight-bold"> <?php the_author_posts_link(); ?> </span></small>
       	<?php if(has_post_thumbnail()): ?>	
					<a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="Blog Post" data-title="<?php the_title(); ?>">		
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-100 card-img-top img-fluid img-thumbnail shadow-sm trans-500">					
					</a>
      	<?php endif; ?>
      	<div class="card-body">
        	<h3 class="card-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
          <p class="card-text"><?php the_content(); ?></p>
					<small>
						Filed under <span class="font-weight-bold"><?php the_category(', ') ?></span> by <span class="font-weight-bold"><?php the_author_posts_link(); ?></span><br />
						<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> 						
						<?php edit_post_link('Edit', ' &#124; ', ''); ?>
					</small>
					<?php if ( is_singular() && comments_open() ) { ?>
							<div class="comments-template">
								<?php comments_template( '', true ); ?>
							</div> 	
					<?php  } ?>
       </div><!-- END card body-->
    </div><!-- END card -->
		<?php endwhile;  ?>
  	<div class="col-12 text-center">
				<?php wp_pagenavi( ); ?> 
		</div>	
   	<?php else: ?>
    		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
  	</div><!-- END col-lg-9 --> 
  <div class="col-lg-4">
  	<?php get_sidebar(); ?> 
  </div>  
 </div><!-- end row --> 
</section>
<?php get_footer(); ?>