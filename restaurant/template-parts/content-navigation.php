<nav id="navbar_top" class="navbar navbar-expand-lg navbar-light bg-light"> 
 <?php $logo = get_theme_mod('logo_image'); ?>       	
  <a class="navbar-brand d-flex flex-row" href="<?php echo get_option('home'); ?>">
  	<img class="img-fluid rounded" src="<?php echo wp_get_attachment_url($logo); ?>" alt="Logo Image">
 		<div class="pl-3">
  		<h1><?php bloginfo('name'); ?></h1>
  		<h6 class="d-none d-lg-block"><?php bloginfo('description'); ?></h6>
   	</div>
  </a>
  <?php if (! is_page('reservation')) { ?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<div onclick="myFunction(this)">						
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
				</div>
			</button>
  <?php }; 	?>
  <?php if ( is_page('reservation')) { ?>
	<a class="navbar-brand d-block d-lg-none" href="<?php echo get_option('home'); ?>">Home</a>
  <?php }; 	?>
  <div id="navbarSupportedContent" class="collapse navbar-collapse">
			<?php 
			$args = array(
							'theme_location'    => 'primary',
							'menu'              => 'Primary Menu',
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'navbarSupportedContent',
							'menu_class'        => 'navbar',
							'menu_id'           => 'navbar',
							'echo'              => true,
							'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
							'before'            => '',
							'after'             => '',
							'link_before'       => '',
							'link_after'        => '',
							'items_wrap'        => '<ul id="%1$s" class="%2$s d-flex flex-column breadcrumb-item px-0 flex-lg-row justify-content-start">%3$s</ul>',
							'depth'             => 5,
							'walker'            => new WP_Bootstrap_Navwalker()
					);
					wp_nav_menu ($args);  													                                               
//					echo do_shortcode('[language-switcher]'); 
					$current_language = get_locale();
					$facebook = get_theme_mod('facebook_social_menu'); 
					$twitter = get_theme_mod('twitter_social_menu'); 
					$linkedin = get_theme_mod('linkedin_social_menu'); 
					$youtube = get_theme_mod('youtube_social_menu'); 
					$wechat = get_theme_mod('wechat_social_menu'); 
					$weibo = get_theme_mod('weibo_social_menu'); 
					if( $current_language == 'en_US' ){
						if (!empty ($facebook)) {							
							echo "<div class='text-center'><a target='_blank' href=".$facebook."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/facebook.png alt='Facebook'</a>"; }
						if (!empty ($twitter)) {							
								echo "<a target='_blank' href=".$twitter."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/twitter.png alt='Twitter'><a>"; }
						if (!empty ($youtube)) {							
								echo "<a target='_blank' href=".$youtube."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/youtube.png alt='YouTube'></a>"; }
						if (!empty ($linkedin)) {							
								echo "<a target='_blank' href=".$linkedin."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/linkedin.png alt='LinkedIn'></a></div>"; }
					}
					if( $current_language == 'zh_CN' ){
						if (!empty ($weibo)) {							
							echo "<div class='text-center'><a target='_blank' href=".$weibo."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/weibo.jpg alt='Weibo'></a>"; }
						if (!empty ($wechat)) {							
							echo "<a target='_blank' href=".$wechat."><img class='ml-2' src=".get_bloginfo('template_directory')."/assets/image/social-icon/wechat.jpg alt='WeChat'></a></div>"; }
					}
			?>			
	</div>
</nav>
<style>
/*======================================
Logo
========================================*/
@media screen and (max-width: 992px) {
	.navbar-brand img  {
  	width: 60px!important;
	}
	.navbar-brand h1  {
  	font-size: 23px!important;
	}
	#navbarSupportedContent {
		background-color: #89da59!important;
		margin-top: 18px;
		padding-bottom: 12px;
		border-radius: 8px;
		z-index: 10000;
	}
} 
nav.scrolled {
	background-color: #89da59;
	height: 80px;
	box-shadow: 0px 5px 5px #89da59;
	transition: background-color 500ms linear;
	transition: height 500ms linear;
	z-index: 1000;
}
.fixed-top {
	position: fixed;
  top: 0px;
  left: 0px;
  -webkit-backface-visibility: hidden;
</style>
<script>
// ---------------------------------------------- //
    // When scroll up, and menu fixed top
    // ---------------------------------------------- //
	jQuery(document).ready(function ($) {
		if ($(window).width() > 992) {
  	$(window).scroll(function(){  
     if ($(this).scrollTop() > 20) {
        $('#navbar_top').addClass("fixed-top");
        // add padding top to show content behind navbar
        $('body').css('padding-top', $('.navbar').outerHeight() + 'px');
      }else{
        $('#navbar_top').removeClass("fixed-top");
         // remove padding top from body
        $('body').css('padding-top', '0');
      }   
  		});
		} // end if
	});
		// navbar scrolling effect
	jQuery(document).ready(function ($) {
			$(document).scroll(function () {
				var $nav = $(".navbar");
				$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
			});
		});
</script>
