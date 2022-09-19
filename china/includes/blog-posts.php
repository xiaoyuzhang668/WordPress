<!-- main blog filtering -->
<section class="blog-posts">
  <div class="container mt-3">        
    <div class="row">
      <div class="col-lg-9">
        <div class="row">        
          <div class="col-lg-3 mt-3">
            <div class="section-title">Latest Posts</div>
          </div>
          <div class="col-lg-9 my-5 d-flex flex-row align-items-center">
            <ul class="filters">
              <li data-filter="*" class="btn btn-secondary filter-active">All
                <span class="ml-2 badge badge-light"><?php echo count_cat_post(3)+count_cat_post(4)+count_cat_post(5); ?></span>
                <span class="sr-only">Total number of all posts</span>
              </li>
              <li data-filter=".lifestyle" class="btn btn-secondary">Lifestyle 
                <span class="ml-2 badge badge-light"><?php echo count_cat_post(3); ?></span>
                <span class="sr-only">Total number of posts for Lifestyle</span>
              </li>
              <li data-filter=".cooking" class="btn btn-secondary">Cooking
                <span class="ml-2 badge badge-light"><?php echo count_cat_post(4); ?></span>
                <span class="sr-only">Total number of posts for Cooking</span>
              </li>
              <li data-filter=".travel" class="btn btn-secondary">Travel
                <span class="ml-2 badge badge-light"><?php echo  count_cat_post(5); ?></span>
                <span class="sr-only">Total number of posts for Travel</span>
              </li>
            </ul>
          </div><!-- end of col-lg-9 -->
        </div><!-- end of row -->
      </div><!-- end col lg - 9-->         
    </div><!-- end row -->
  </div><!-- end of container -->
</section>
<section>
<div class="container">
  <div class="row">
    <div class="col-lg-9">   
        <div class="row grid">  
          <?php 
          $wpb_all_query = new WP_Query(
          array(
          'post_type'=>'post', 
          'paged' => get_query_var('paged'),
          'post_status'=>'publish',
          'orderby' => 'date' ,
          'order' => 'DESC' , 
          'hide_empty'     => 1,
          'depth'          => 1,
          'category__in' => array(3, 4, 5),
          'post_per_page'  => -1,
          )); ?> 
          <?php if ( $wpb_all_query->have_posts() ) : ?> 
            <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?> 
                <div class="col-lg-4 grid-item 
                    <?php $categories = get_the_category(get_the_id());
                  foreach ($categories as $category) {
                    echo $category->slug.' ';
                  }; ?>">
                <?php get_template_part('template-parts/content', get_post_format()); ?>                                  
                </div>
             <?php endwhile; ?>  
        </div><!-- end row and grid -->         
        <div class="text-center" id="infi-blog">        
          <div class="page-load-status d-block">
            <div class="loader-ellips infinite-scroll-request">
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
              <span class="loader-ellips__dot"></span>
            </div>
            <p class="infinite-scroll-last">You have reached the end of the page content.</p>
            <p class="infinite-scroll-error">You have reached the end of the page content.</p>
          </div><!-- end page - load status -->
        </div>
              <?php wp_pagenavi( array( 'query' => $wpb_all_query ) ); ?>                   
                <?php else : ?>
                      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
              <?php endif; wp_reset_query(); ?>          
    </div><!-- end column col-lg-9 -->
    <div class="col-lg-3 px-0">
      <div class="sidebar-background pl-3">
        <?php include "blog-posts-sidebar.php"; ?>
      </div>
    </div><!-- end column col-lg-3 -->
  </div> <!-- end row -->
</div> <!-- end container -->
</section>