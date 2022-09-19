<?php $orig_post = $post;
		global $post;
		$author_id=$post->post_author; 
		$args=	array(
				'author__in' => $author_id,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>3, // Number of related posts that will be shown.
				'category__in' => array(3, 4, 5)
				);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) :  ?>
			<div class="my-5">
				<h3 class="text-center relatedposts">Most Recent Posts by <?php the_author(); ?></h3>
			</div>
			<div class="row">			
			<?php while( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<div class="col-lg-4 mb-5">				
					<div class="relatedthumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid h-50 rounded shadow animated fadeIn delay-1s trans-200')); ?></a>
					</div>
					<div class="relatedtitle mt-3">
						<h5 class="text-center"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
					</div>	
					<div class="relatedcontent">
						<p><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_excerpt(); ?></a></p>
					</div>
					<div class="text-center">						
						<small class="post-meta text-center"><?php the_author_posts_link() ?> • <?php the_time('M j, Y'); ?> at <?php the_time('g:i a'); ?></small>
					</div>
				</div>
			<?php endwhile; endif; ?>
			</div>
			<?php $post = $orig_post;
			wp_reset_query(); ?>