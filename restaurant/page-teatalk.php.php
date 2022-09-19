<?php get_header(); ?>  
<section id="hero" class="carousel slide carousel-fade" data-ride="carousel" data-interval="1000">
		<ol class="carousel-indicators">
			<li data-target="#hero" data-slide-to="0" class="active"></li>
			<li data-target="#hero" data-slide-to="1"></li>
			<li data-target="#hero" data-slide-to="2"></li>
		</ol>
   	<div class="carousel-inner maxCarouselHeight">
   		<?php $i = 1;
        while ($i < 4)
        { ?> 
			<div class="carousel-item shadow-sm <?php if ($i==1) echo 'active'; ?>">
				<img class="d-block w-100" src="<?php echo get_theme_mod('image'.$i, get_bloginfo('template_url').'/images/customizer/default.jpg'); ?>" alt="Tea slide">
				<div class="carousel-caption float-right d-none d-md-block text-white px-3">
					<p><?php echo get_theme_mod('header'.$i); ?></p>
					<p class="pl-5"> -- <?php echo get_theme_mod('header'.$i.'_2'); ?></p>
					<p><?php echo get_theme_mod('subtext'.$i); ?></p>
				</div>
			</div>
		<?php $i++; } ?>
  	</div> 
  	<a class="carousel-control-prev" href="#hero" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#hero" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a> 
</section> 
 <?php get_template_part('template-parts/content', 'teatalk-user-guide1'); ?>  
<section class="my-5 clearfix teatalk-page">      
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
					<div class="page-post">
						<h1 class="text-center"><?php the_title(); ?></h1>         
								<p class="page-entry pt-3 teatalk">
								<?php the_content(); ?>
								</p><!-- page-entry --> 
						<h6 class="text-danger">
							<?php edit_post_link('Edit', ' &#124; ', ''); ?>
						</h6>	
					</div><!-- page-post --> 
					<hr>    
				<?php endwhile; wp_pagenavi( ); ?>
				<?php else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif;  wp_reset_postdata();?>	
			<section class="accordiong-section">
				<?php get_template_part('template-parts/content', 'teatalk-user-guide2'); ?>  
						<h3 class="py-5">Frequently Asked Question:</h3>
					<div class="bs-example">
						<div class="accordion" id="accordionExample"> 
										<?php 
												$wpb_all_query = new WP_Query(
												array(
												'post_type'=>'faq', 
												'paged' => get_query_var('paged'),
												'post_status'=>'publish',
												'orderby' => 'date' ,
												'order' => 'DESC' , 
												'posts_per_page'  => 8,
												)); ?>	
											<?php if($wpb_all_query->have_posts()): $i=0; ?>     															
											<?php while($wpb_all_query->have_posts()): $wpb_all_query->the_post(); ?>
							<div class="card">
								<div class="card-header" id="heading<?php echo $i; ?>">
									<h2 class="mb-0">
										<button class="btn btn-link btn-block text-left text-uppercase" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
											Q: <?php the_title(); ?>
										<i class="fas fa-plus float-right"></i>
										</button>
									</h2>
								</div>
								<div id="collapse<?php echo $i; ?>" class="collapse <?php if ($i==0) echo 'show'; ?>" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordionExample">
									<div class="card-body">
										<h5>Answer</h5>
										<?php the_content(); ?>
									</div>
								</div>
							</div>
							<?php $i++; endwhile; wp_reset_postdata(); ?>  														
							<?php	else: ?><!-- if no post -->
									<p>Sorry, no posts matched your criteria.</p>
							<?php endif;  ?>
						</div>
					</div>	
			</section>  
			</div>
			<div class="col-lg-4">
				<div class="pl-2"><?php include "includes/sidebar-slider-tea.php"; ?></div>
			</div>
		</div>		       
  </div><!-- END container  --> 
  <div class="sidenav text-nowrap text-left" id="mySidenav">
	    <a href="<?php echo home_url().'/our-tea/greentea' ;?>" id="greentea">Green Tea</a>  	  	
		  <a href="<?php echo home_url().'/our-tea/redtea' ;?>" id="redtea">Red Tea</a>
		  <a href="<?php echo home_url().'/our-tea/whitetea' ;?>" id="whitetea">White Tea</a>
		  <a href="<?php echo home_url().'/our-tea/oolongtea' ;?>" id="oolongtea">Oolong Tea</a>		
	</div>
</section>
<?php get_footer(); ?>