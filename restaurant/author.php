<?php get_header(); ?>
<div class="minHeight d-flex justify-content-center align-items-center" style="
	background-image: url('<?php echo get_theme_mod('author', get_bloginfo('template_url').'/assets/image/customizer/author.jpg'); ?>'); 
	background-position: center; 
  background-size: cover;
	background-repeat: no-repeat; 
	background-color: #777; ">  
	<?php
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	?>
	<h4 class="font-weight-bold display-4 text-center text-white">This is  <?php echo $curauth->display_name; ?>'s page </h4>
</div>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8">                  
			<div class="p-3 mb-3 border bg-light rounded shadow">
                <h2 class="mb-4">About: <?php echo $curauth->nickname; ?></h2>
                <div class="float-left mr-2">
                <?php echo get_avatar( $curauth->user_email , '90 '); ?>
                </div>
                <p><strong>Website:</strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br>
								<strong>Bio:</strong> <?php echo $curauth->user_description; ?>
   							<?php $country = get_user_meta( $curauth->ID, 'billing_country', true ); ?>
               	<?php $billing_country = WC()->countries->countries[ $country ]; ?>
                <br>Location: <?php echo $billing_country; ?></p>
            </div>
			<h3 class="pt-3 d-flex flex-row">
				Posts by <?php echo $curauth->nickname; ?>: 
				<?php if($wp_query->post_count > 0): ?>
					<?php echo "<span class='ml-4'><u>$wp_query->found_posts</u></span>" ?> 
				<?php endif; ?>
			</h3> 
			
			<?php if($wp_query->found_posts > 10): ?>
				<?php echo "<p>	10 posts/per page </p> 	" ?>
			<?php endif; ?>		 
			<?php global $paged;
					if(empty($paged)) $paged = 1;
					$loop_counter = 1; 
					$results_per_page = get_query_var('posts_per_page'); ?>                  
			<?php if ( have_posts() ) : ?>
				<div class="table-responsive-md">
					<table class="table table-striped border border-light rounded">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Image</th>
								<th scope="col">Title</th>
								<th scope="col">Category</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
						<tbody>												
						<?php while ( have_posts() ) : the_post(); ?>
							<?php																				 
									if( $paged == 1 ) {
									 $real_count = $loop_counter;
									 } else {
									 $real_count = $loop_counter + ( $paged * $results_per_page - $results_per_page);
									 }  
							?>
							<tr>
								<?php if (has_post_thumbnail()) : ?>
								<th class="pt-lg-4 text-center">
								<?php else: ?>
								<th class="text-center">
								<?php endif; ?>
									<?php /*echo get_post_meta($post->ID,'incr_number',true); */?>
									<?php echo '<li class="list-unstyled"><span class="font-weight-bold">' . $real_count . '.</span></li>';	?>
								</th>
								<td>
									<a href="<?php echo get_the_post_thumbnail_url(); ?>" data-lightbox="author-post" data-title="<?php the_title(); ?>">
										<?php the_post_thumbnail('sidebar-thumb', array('class' => 'img-fluid rounded shadow-sm animated fadeIn delay-1s trans-200', 'alt' => 'author-image')); ?>
									</a>
								</td>
								<td><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
									<?php echo wp_trim_words( get_the_title(), 8 , '   .  .  .' ); ?>
								</a></td>
	
								<td><?php the_category('&');?><?php echo get_the_term_list(get_the_ID(), 'product_cat', '', ' , ', ''); ?></td>
								<td class="text-nowrap"><?php the_time('M d Y'); ?></td>
							</tr>						
							<?php $loop_counter++;  endwhile; ?>  
						</tbody>
			 		</table>
				</div>
				<div class="text-center">
				 <?php wp_pagenavi( array( )); ?>   
				</div>                                     
			<?php else: ?>
					<p><?php _e('There are no posts by this author.'); ?></p> 
			<?php endif;  wp_reset_postdata(); ?>       
		</div>       
		<div class="col-lg-4">
	  		<?php get_sidebar(); ?> 
		</div>
	</div><!-- end row -->             
</div><!-- end container -->
<?php get_footer(); ?>