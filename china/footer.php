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