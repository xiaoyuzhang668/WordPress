<?php $catquery = new WP_Query( 'cat=5&posts_per_page=-1&offset=4' ); ?>    
	<?php if(has_post_thumbnail()): 
		$backgroundImg = wp_get_attachment_url ( get_post_thumbnail_id( get_the_ID()), 'full'); 
	else :
		$backgroundImg = get_bloginfo( 'template_url' ). "/images/default.jpg";
	endif;	
	?>	
<div class="col-12 slider-img float-right rounded shadow-lg">
	<div id="home-one" class="bg-white owl-carousel owl-theme">
    <?php 
    $args = array(
    'post_type' => 'post' ,
    'orderby' => 'date' ,
    'order' => 'DESC' ,
    'cat'         => '5',
    'paged' => get_query_var('paged'),
    'post_parent' => $parent,
    'posts_per_page' => -1
    ); 
    $q = new WP_Query($args);
    if ( $q->have_posts() ) :  while ( $q->have_posts() ) :  $q->the_post();
    ?>
		<div class="pb-2 d-flex flex-column round-image px-2" style="background-image: lightgray url('<?php echo $backgroundImg; ?>') cover no-repeat fixed center;"> 
          <h6 class="postmetadata mt-5 front-edit">
             <?php edit_post_link('Edit', ' &#124; ', ''); ?>
          </h6> 
          <h4><?php the_title(); ?></h4>
	          <p class="d-none d-md-block">
	          <?php $content = get_the_content();
	            $content = preg_replace("/<img(.*?)>/si", "", $content);
	          echo mb_strimwidth($content, 0, 100, '...');?></p>
          <div class="mt-auto text-center more-button">
            <a target="_blank" href="<?php the_permalink(); ?>" class="rounded-pill w-75 btn mx-auto btn-primary btn-block">More Information</a>
          </div>
          <!-- POST METADATA -->               
    	</div>
     <?php endwhile; ?>       
    <?php endif; ?> 
  </div><!-- end owl-carousel -->
</div>