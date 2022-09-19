<section class="sidebar">	
    <hr class="style8 d-block d-lg-none my-5">
     		<h4 class="pb-5 text-center">
     			<?php if (is_woocommerce()) {
							echo "All Products";
							} else {
							echo "All Posts";
					 } ?>
     		</h4>
				<?php if ( is_active_sidebar( 'sidebar6' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar6' ); ?>
				<?php endif; ?> 
</section>
