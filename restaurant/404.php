<?php get_header('error'); ?>
<?php 
	$adminemail = get_option('admin_email'); 
	$website = get_bloginfo('url'); 
	$websitename = get_bloginfo('name'); 
	$failuremess = "A user tried to go to $website"
				.$_SERVER['REQUEST_URI']." and received a 404 (page not found) error. ";
	$failuremess .= "It wasn't their fault, so try fixing it.  
				They came from ".$website;
	mail($adminemail, "Bad Link To ".$_SERVER['REQUEST_URI'],
				$failuremess, "From: $websitename <noreply@$website>"); #email you about problem
?>
<div class="container">	
	<div class="offset-lg-1 row text-center align-items-center mt-5">
		<div class="col-lg-5">
			<p>Link broken.</p>
			<p>Page <?php echo " ".$_SERVER['REQUEST_URI']; ?> is not found.</p>
		</div>	
		<div class="count-center text-center mb-3 mb-lg-0 col-lg-6 align-items-center justify-content-center">
			<div class="counter rounded-circle text-white font-weight-bold h1 float-left" data-count="404">0</div>
		</div>
		<div class="col-lg-5">
			<img src="<?php bloginfo( 'template_url' ); ?>/assets/image/core-image/broken_world.jpg" alt="Broken World">
		</div>
		<div class="col-lg-6">
			<h4 class="pt-3 pt-lg-0">Please go back to <a href="<?php bloginfo('url'); ?>" class="px-3 py-2 rounded">HOME</a> page.</h4> 
		</div>		
	</div>	<!-- end of row -->		
</div><!-- end of container -->
	<script	src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
	<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/bootstrap.js'></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/error.js"></script>
</body>
</html>