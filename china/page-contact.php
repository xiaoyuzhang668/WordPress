<?php get_header(); ?> 
  <?php 
  if(have_posts()): 
         while(have_posts()): the_post(); ?>     
        <div class="contact-featured" style="
        background-image: url('<?php echo get_theme_mod('contact_image', get_bloginfo('template_url').'/images/contact_image.jpg'); ?>'); 
                          background-position: center; 
                          background-size: cover; 
                          background-repeat: no-repeat; 
                          background-color: #fff; ">
         <div class="container pt-5">
           <div class="row mt-5">
             <div class="col-12 col-md-8 offset-md-2 text-center bg-white rounded shadow">
              <?php echo do_shortcode('[contact-form-7 id="2488" title="Contact2"]'); ?>
            </div>
           </div>     
          </div>                  
        </div><!-- end of background image -->                 
  <?php endwhile; 
  endif;    
  ?>
  <marquee behavior="scroll" direction="left" class="h3 mt-2">Feel free to contact me at 613-292-6109.</marquee>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>