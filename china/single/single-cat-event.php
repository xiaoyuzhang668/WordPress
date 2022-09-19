<?php get_header(); ?>
 <img src="<?php echo get_theme_mod('single_event_image', get_bloginfo('template_url').'/images/template/event_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<?php if ( have_posts() ) : ?> 
    <!-- the loop -->
    <div class="container my-5">   
    <?php while ( have_posts() ) : the_post(); ?> 
    	<div class="row">
            <?php if(has_post_thumbnail()): ?>
                <div class="col-lg-4 mt-4">
                    <?php $fancybox_url = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'custom-size'); ?>     
                    <a data-type="image" class="fancybox" href='<?php echo $fancybox_url; ?>' data-caption="<?php the_title(); ?>" title="<?php the_title(); ?>">                           
                    <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded shadow animated fadeIn delay-1s trans-200', 'alt' => "<?php the_title(); ?>")); ?>
                    </a>
                </div>      
                <div class="col-lg-8 mb-4 mt-4">   
                    <div class="text-center mb-4">
                         <h2><?php the_title(); ?></h2>
                    </div>
                    <h6 class="text-center">
                        <p>Event Date: <?php the_field('event_date_and_time'); ?></p>
                        <p>Event Venue: <?php the_field('eventVenue'); ?></p>   
                    </h6>                    
                    <p><?php the_content(); ?></p>
                </div>
            <?php else: ?>
                <div class="col-12 mb-4"> 
                    <h5 class="mb-3">                      
                            <div class="text-center"><?php the_title(); ?></div>
                            <div class="mt-4 d-flex justify-content-center">
                                <p>Event Date: <?php the_field('event_date_and_time'); ?></p>
                                <p class="ml-5">Event Venue: <?php the_field('eventVenue'); ?></p>   
                            </div>                                      
                    </h5> 
                    <p><?php the_content(); ?></p>
                </div>
            <?php endif; ?>    		 
            <div class="col-12 col-lg-10 offset-lg-1 text-center h4 mt-5">         
                <!-- if reservation required is yes, show contact form, otherwise display message no reservation needed      -->
                <?php  if (get_field('reservation') == 'Yes') { ?>                                      
                    <?php echo do_shortcode('[contact-form-7 id="2125" title="Reservation"]'); ?>                   
                <?php } elseif (get_field('reservation') == 'No') { ?>
                    <p>No reservation is needed.  <br>Please come to <?php the_field('eventVenue'); ?> at <?php the_field('eventDate'); ?> to join.  <br>See you there. </p>   
                <?php } ?>
            </div>           
                <?php get_template_part('template-parts/content','pagination'); ?>             
        </div>
    <?php endwhile; ?>
    <!-- end of the loop --> 
        <?php wp_reset_postdata(); ?> 
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
    <?php  if ( comments_open() || get_comments_number() ) : ?>
        <div class="comments-template mt-5 rounded">
            <?php comments_template( '', true ); ?>
        </div>
    <?php endif; ?>
	</div><!-- end container -->
    <button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
</div>
<section class="footer clear">
<footer class="footer text-white-50 bg-dark mt-5 clear">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 order-lg-1 order-2 pt-5 pb-4">
        <div class="text-center">
          <a class="text-white text-uppercase h4" href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
          <div class="mt-3 d-flex justify-content-center">
            <ul class="text-white-50 list-group list-group-horizontal">
              <li class="weixin"><a target="_blank" href="http://www.wechat.com"><i class="fab fa-weixin mr-5"></i></a></li>                
              <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f mr-5"></i></a>
              <li class="instagram"><a target="_blank" href="http://www.instagram.com"><i class="fab fa-instagram mr-5"></i></a>
              <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fab fa-youtube mr-5"></i></a>
              <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
            </ul>
          </div>
          <div class="mt-5 copyright"> 
            Copyright <?php echo wpb_copyright(); ?> &ensp; &ensp;<a href="<?php bloginfo('url'); ?>"> <?php bloginfo('name'); ?></a> &ensp; &ensp; All rights reserved. 
          </div> 
        </div>
      </div>         
      <div class="col-lg-3 order-lg-2 order-1 pt-5 pb-4 bg-primary">       
            <div class="text-white h6">Subscribe</div>
            <div><?php echo do_shortcode('[contact-form-7 id="2369" title="Subscribe"]'); ?> </div>
            </div>    
      </div>
    </div>
  </div>
</footer>
</section>
<?php wp_footer(); ?>
 <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  <script defer src="<?php bloginfo( 'template_url' ); ?>/js/owl.carousel.min.js"></script>
  <!-- fancy box for light box -->
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.mb.YTPlayer.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/infinite-scroll.pkgd.min.js"></script>
<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/placeholder-form.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'template_url' ); ?>/js/lightbox.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
</body>
</html>

