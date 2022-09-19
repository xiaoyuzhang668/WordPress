<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<hr class="style8">
<div class="container-fluid">
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
              <li class="weixin"><a target="_blank" href="http://www.wechat.com"><i class="fab fa-weixin mr-5"></i></a></li> 
              <li class="linkedin"><a target="_blank" href="https://www.linkedin.com"><i class="fab fa-linkedin-in mr-5"></i></a></li>                
							<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f mr-5"></i></a></li>
							<li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fab fa-youtube mr-5"></i></a></li>
              <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
            </ul>
          </div>
          <div class="mt-5 copyright text-dark-50"> 
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
			
		jQuery(function($) {
			 var slider = tns({
					container: '.sidebar-container',
					items: 4,
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
// ---------------------------------------------- //
// Front page video
// ---------------------------------------------- //
let video = document.getElementById("myVideoFrontPage");
		btnVideo = document.getElementById('myBtnVideo');
		btnAudio = document.getElementById('myBtnAudio');
		btnBox = document.getElementById('myBtnBox');
		btnContainer = document.querySelector('.caption-container');
function hideBox () {
	btnContainer.style.display = "none";
}
btnBox.addEventListener("click", hideBox);	
function myFunctionVideo() {
  if (video.paused) {
    video.play();
    btnVideo.innerHTML = "Pause";
		btnVideo.style.width = "50%";
		btnAudio.style.display = "block";			
  } else {
    video.pause();
    btnVideo.innerHTML = 'Play';
		btnVideo.style.width = "100%";
		btnAudio.style.display = "none";			
  }
}
btnVideo.addEventListener("click", myFunctionVideo);
function myFunctionAudio() {
  if (video.muted) {
    video.muted=false;
    btnAudio.innerHTML = "Mute";
  } else {
    btnAudio.innerHTML = 'Audio';
		video.muted=true;
  }
}
btnAudio.addEventListener("click", myFunctionAudio);

var video_player = document.getElementById("video_player"),
links = video_player.getElementsByTagName('a');
for (var $i=0; $i<links.length; $i++) {
	links[$i].onclick = handler;
}
function handler(e) {
	e.preventDefault();
	videotarget = this.getAttribute("href");
	filename = videotarget.substr(0, videotarget.lastIndexOf('.')) || videotarget;
	video = document.querySelector("#video_player video");
	c = this.innerHTML.replace(/<img[^>]*>/g,"");	
	source = document.querySelectorAll("#video_player video source");
	document.querySelector("#video_player .text").innerHTML = c;
	document.getElementById('myBtnVideo').innerHTML = "Pause";
	source[0].src = filename + ".mp4";
	video.load();
	video.play(); 
	video.muted=true;
	document.getElementById('myBtnAudio').style.display = "block";
	document.getElementById('myBtnAudio').innerHTML = 'Audio';
	document.getElementById('myBtnVideo').style.width = "50%";
	document.querySelector('.caption-container').style.display = "block";
}

jQuery(document).ready(function ($) {
var $vid = $("#myVideoFrontPage");
function showControlsAt992() {
	var _992 = $(window).width() <= 992;
	$vid.prop("controls", _992);
}
showControlsAt992();
$(window).on("resize", showControlsAt992);
});	
//		add active to video poster
jQuery(document).ready(function ($) {
$('figcaption a').click(function() {
		$('figcaption a.active').removeClass("active");
		$(this).addClass("active");
});
});
	
</script> 
</body>
</html>