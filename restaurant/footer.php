<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<hr class="style8">
<div class="container-fluid clear">
	<div class="row">
		<div class="col-12 col-md-4 col-lg-3 py-5">
			<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar1' ); ?>
			<?php endif; ?>
		</div>
		<div class="bg-light col-12 col-md-8 col-lg-4 py-5">
			<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar2' ); ?>
			<?php endif; ?>
		</div>
		<div class="col-12 col-md-6 col-lg-2 py-5">
			<?php if ( is_active_sidebar( 'sidebar3' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar3' ); ?>
			<?php endif; ?>
		</div>
		<div class="bg-light col-12 col-md-6 col-lg-3 py-5">
			<?php if ( is_active_sidebar( 'sidebar4' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar4' ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<hr class="style15">
<footer>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9 bg-light order-md-1 order-2 p-5">
        <div class="text-center">
					<h4 class="text-uppercase"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h4>
          <div class="mt-3 d-flex justify-content-center">
            <ul class="list-group list-group-horizontal"> 
            	<?php $facebook = get_theme_mod('facebook_social_menu'); 
										$twitter = get_theme_mod('twitter_social_menu'); 
										$linkedin = get_theme_mod('linkedin_social_menu'); 
										$youtube = get_theme_mod('youtube_social_menu'); 
										$wechat = get_theme_mod('wechat_social_menu');  
										$weibo = get_theme_mod('weibo_social_menu');  ?>
								<?php if (!empty ($youtube)) {							
										echo "<li class='youtube'><a target='_blank' href=".$youtube."><i class='fab fa-youtube mr-lg-5 mr-3'></i></a></li>"; }  ?>
								<?php if (!empty ($twitter)) {							
										echo "<li class='twitter'><a target='_blank' href=".$twitter."><i class='fab fa-twitter mr-lg-5 mr-3'></i></a></li>"; }  ?>							
								<?php if (!empty ($facebook)) {							
										echo "<li class='facebook'><a target='_blank' href=".$facebook."><i class='fab fa-facebook mr-lg-5 mr-3'></i></a></li>"; }  ?>
								<?php if (!empty ($linkedin)) {							
										echo "<li class='linkedin'><a target='_blank' href=".$linkedin."><i class='fab fa-linkedin mr-lg-5 mr-3'></i></a></li>"; }  ?>
								<?php if (!empty ($wechat)) {							
										echo "<li class='wechat'><a target='_blank' href=".$wechat."><i class='fab fa-weixin mr-lg-5 mr-3'></i></a></li>"; }  ?> 
           			<?php if (!empty ($weibo)) {							
										echo "<li class='wechat'><a target='_blank' href=".$weibo."><i class='fab fa-weibo''></i></a></li>"; }  ?> 
            </ul>
          </div>
          <div class="pt-5 copyright text-dark-50"> 
            Copyright <?php echo wpb_copyright(); ?><a class="px-lg-5 px-2" href="<?php bloginfo('url'); ?>"> <?php bloginfo('name'); ?></a> All rights reserved. 
          </div> 
        </div>
      </div>         
      <div class="col-md-3 order-md-2 order-1 pt-5 bg-secondary">       
            <h6 class="text-white text-center text-lg-left">Subscribe</h6>
            <div class="mt-4"><?php echo do_shortcode('[contact-form-7 id="518" title="Subscribe Form" html_name="subscribeForm" html_id="subscribeForm"]'); ?> </div>
      </div>    
    </div>
	</div><!-- container -->
</footer>
<?php wp_footer(); ?>
 <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> 
	<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/bootstrap.js'></script> 
	<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/tiny-slider.js'></script> 
<!--
  /*=======================================
// menu icon to add beside menu text
/*=======================================*/
//used in menu icon  50px X 50px
-->
<?php
		$menuIcon = [ "Menu 1 Icon", "Menu 2 Icon", "Menu 3 Icon", "Menu 4 Icon", "Menu 5 Icon", "Menu 6 Icon", "Menu 7 Icon", "Menu 8 Icon"];
		$menuLength = count($menuIcon);
		for ( $i=0; $i < $menuLength; $i++) {
			$plural = $menuIcon[$i];
			$string = str_replace(' ', '', $plural); 
			$singular = strtolower($string);		
			echo '<style type="text/css">
							.'.$singular.'  {
									background-image: url(" '. get_theme_mod( $singular ). ' ");
						}					
							.'.$singular.' {
							background-repeat: no-repeat;
							background-position: left;
							height: 68px;
							padding-left: 68px;
							margin-left: 18px;
							display: flex;
							line-height: 60px;
						}
							</style>';	}	
	?>
	<script>
		(function($) {
           AOS.init();
						lightbox.option({
							'disableScrolling': false,
							'fadeDuration': 900,
							'imageFadeDuration': 900,
							'resizeDuration': 200,
							'wrapAround': true
						})
    })(jQuery);
		jQuery(function($) {
			 var slider = tns({
					container: '.sidebar-container',
					items: 3,
				  axis: "vertical", 
					loop: true,
//					gutter: 10,
					lazyload: true,
					slideBy: "page",
					mouseDrag: true,
					swipeAngle: false,
					speed: 400,
					autoplay: true,
				  controls: false,
					nav: false,
					autoplayButton: false,
					autoplayButtonOutput: false,
				});
			});
</script>
</body>
</html>