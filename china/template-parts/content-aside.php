<article class="post post-aside p-3 shadow rounded">	
	<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
	<?php echo excerpt(35); ?>
	<h6 class="post-meta">
        <?php edit_post_link('Edit', ' &#124; ', ''); ?>
     </h6>
</article>