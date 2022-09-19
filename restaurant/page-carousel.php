<?php get_header(); ?>    
<section class="clear container my-5">
	<div class="slick-carousel">
	<?php 
							$wpb_all_query = new WP_Query(
							array(
							'post_type'=>'post', 
							'paged' => get_query_var('paged'),
							'post_status'=>'publish',
							'orderby' => 'date' ,
							'order' => 'DESC' , 
							'posts_per_page'  => -1,
							)); ?>      
		<!-- THE LOOP -->
		<?php if($wpb_all_query->have_posts()) : $count = 0; ?><?php while($wpb_all_query->have_posts()) : $wpb_all_query->the_post(); ?>
		<div class="card border-0"
			data-aos="fade-in"
			data-aos-easing="ease-in-sine"
			data-aos-duration="1500"
			data-aos-anchor-placement="top-bottom">
				<small class="card-header"><?php the_time('M j, Y'); ?> by <span class="font-weight-bold"> <?php the_author_posts_link(); ?> </span></small>
       	<?php if(has_post_thumbnail()): ?>	
					<a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="Blog Post" data-title="<?php the_title(); ?>">		
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="maxHeight w-100 card-img-top img-fluid img-thumbnail shadow-sm trans-500">					
					</a>
      	<?php endif; ?>
      	<div class="card-body">
        	<h3 class="card-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<p class="card-text"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_excerpt(); ?></a></p>
					<small>
						Filed under <scan class="font-weight-bold"><?php the_category(', ') ?></scan> by <scan class="font-weight-bold"><?php the_author_posts_link(); ?></scan><br />
						<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> 						
						<?php edit_post_link('Edit', ' &#124; ', ''); ?>
					</small>
       </div><!-- END card body-->
    </div><!-- END card -->
		<?php endwhile;  ?>
   	<?php else: ?>
    		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; wp_reset_postdata(); ?>
  </div><!-- END CONTENT -->  
</section>
<script>
jQuery(function($) {
 var slider = tns({
    container: '.slick-carousel',
		loop: true,
	 	gutter: 10,
	  lazyload: true,
		slideBy: "page",
		mouseDrag: true,
		swipeAngle: false,
		speed: 400,
	  autoplay: true,
	 	autoplayButton: false,
		autoplayButtonOutput: false,
    responsive: {
      576: {
        items: 1,
				controls: false,
      },
      768: {
				items: 2,
        gutter: 8,
				controls: false,
      },
      992: {
        items: 3,
				controls: true,
      }
    }
  });
});
</script>
<?php get_footer(); ?>