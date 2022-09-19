<?php get_header(); ?> 
<!--video header-->
<section>
	<div id="video_player">
	<?php $id_poster = get_theme_mod('video_poster1'); ?>
		<video autoplay muted controls loop class="embed-responsive embed-responsive-4by3" id="myVideoFrontPage" poster="<?php echo wp_get_attachment_url($id_poster); ?>">
			<?php $id_video = get_theme_mod('video_upload_1'); ?>
			<source src="<?php echo wp_get_attachment_url($id_video); ?>" type=video/mp4>
		</video>		
		<div class="carousel-caption d-none d-lg-block">	
			<div class="card caption-container">
				<div class="card-body">					
					<h6 class="font-weight-normal text text-center">
						<p><?php echo get_theme_mod('video_header1'); ?></p>
						<p class="text-justify"><?php echo get_theme_mod('video_subtext1'); ?></p>
					</h6>
					<button id="myBtnBox" class="btn btn-green2 w-100">Hide Caption</button>
				</div>				
				<div class="card-footer border-0 bg-transparent d-flex flex-row">
					<button id="myBtnVideo" class="btn btn-green2 mr-2">Pause</button>
					<button id="myBtnAudio" class="btn btn-green2 ml-2">Audio</button>
				</div>
			</div>					
		</div>
		<figcaption>
			<?php $i = 1; while ($i < 4)
        { ?> 
      <?php $id = get_theme_mod('video_upload_'.$i); ?>
      <?php $id2 = get_theme_mod('video_poster'.$i); ?>      
			<a href="<?php echo wp_get_attachment_url($id); ?>" class="<?php if ($i==1) echo 'active'; ?>"><img class="img-fluid" src="<?php echo wp_get_attachment_url($id2); ?>" alt="Front Page Video">
				<p><?php echo get_theme_mod('video_header'.$i); ?></p>
				<p class="text-justify"><?php echo get_theme_mod('video_subtext'.$i); ?></p>
			</a>
		<?php $i++; } ?>
		</figcaption>
	</div>
</section>

<!-- category section , loop to different pages -->
<section class="container category text-center my-5">
	<h3 class="my-5">News</h3>
	<div class="row mt-5">	
		<?php 
        $i = 1;
        while ($i < 4)
        { ?>   
		<div class="col-lg-4 mb-5">	   
			 <div class="height d-flex align-items-center justify-content-center shadow-sm" data-aos="fade-up"	data-aos-easing="ease-in-sine" data-aos-duration="900" data-aos-delay="<?php echo $i; ?>50"           
       style="
        background-image: url('<?php echo get_theme_mod('section'.$i, get_bloginfo('template_url').'/images/customizer/'.$categoryArray[$i].'.jpg'); ?>'); 
				background-position: center; 
				background-size: cover;
				background-repeat: no-repeat; 
				background-color: #fff;
				border-radius: 30px; ">        
          <a href="<?php bloginfo('url'); ?>/<?php echo get_theme_mod('section'.$i.'_link'); ?>" class="rounded-pill w-75 btn btn-green py-3 h5 btn-block"><?php echo ucfirst(get_theme_mod('section'.$i.'_text'));	 ?></a>   
        </div> 									
		</div> <!-- end column -->
 		<?php $i++; } ?>
	</div><!-- end row -->
</section>
<hr class="style15"> 
<!--tea category-->
<section class="container text-center my-5">   
	<h3 class="my-5">Our Restaurant Section</h3>
	<div class="row">
	<?php 
		$section = ["Department 1", "Department 2", "Department 3","Department 4", "Department 5", "Department 6", "Department 7", "Department 8"];
		$sectionLength = count($section);
     for ( $i=0; $i < $sectionLength; $i++) {
						$plural = $section[$i];
						$string = str_replace(' ', '-', $plural);
						$singular = strtolower($string);
         ?>   
		<div class="col-lg-3 col-md-6 mb-5">
			<div class="card h-100" data-aos="fade-up"	data-aos-easing="ease-in-sine" data-aos-duration="900" data-aos-delay="<?php echo $i; ?>50">
				<a href="<?php echo get_theme_mod($singular.'_image'); ?>" data-lightbox="Section Type" data-title="<?php echo get_theme_mod($singular.'_text'); ?>">
					<img src="<?php echo get_theme_mod($singular.'_image', get_bloginfo('template_url').'/assets/image/default.jpg'); ?>" alt="<?php echo $plural; ?> Category" class="card-img-top rounded img-thumbnail img-fluid">
				</a>
				<div class="card-body">
					<h5 class="card-title"><a href="<?php echo get_theme_mod($singular.'_link'); ?>"><?php echo get_theme_mod($singular.'_title'); ?></a></h5>
					<p class="card-text"><?php echo get_theme_mod($singular.'_text'); ?></p>
				</div>
				<div class="card-footer bg-transparent m-0 p-0">
					 <a href="<?php echo get_theme_mod($singular.'_link'); ?>" class="btn btn-green btn-block card-link"><?php echo get_theme_mod($singular.'_title'); ?></a>
				</div>			
			</div><!-- end card -->			
		</div><!-- end column -->
		<?php } ?>
	</div>
</section>
<?php wp_get_cat_postcount(1); ?>
<?php get_footer("frontpage"); ?>