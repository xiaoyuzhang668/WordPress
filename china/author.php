<?php get_header(); ?>
<div class="loader"></div>
<img src="<?php echo get_theme_mod('author_image', get_bloginfo('template_url').'/images/author_image.jpg'); ?>" class="img-fluid w-100" alt="Default Image"> 
<div class="container author-page mt-5">
<!-- This sets the $curauth variable -->
    <div class="row">
        <div class="col-lg-9">
                  <?php
                    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                    ?>
                    <h2 class="text-center mb-5">This is  <?php echo $curauth->nickname; ?>'s page: </h2>
                    <dl class="text-center">
                        <dt>Website</dt>
                        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
                        <dt>Profile</dt>
                        <dd><?php echo $curauth->user_description; ?></dd>
                    </dl>
                    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>                    
                <!-- The Loop -->
                    <?php if ( have_posts() ) : ?>
                        <div class="row text-center h5 mt-5 mb-3">
                            <div class="col">
                                Image
                            </div>
                            <div class="col">
                                Title
                            </div>
                            <div class="col">
                                Date
                            </div>
                            <div class="col">
                                Category
                            </div>
                        </div>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="row mb-3 mr-3 py-3 text-center border border-success">
                        <div class="col">
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('sidebar-thumb', array('class' => 'img-fluid rounded shadow animated fadeIn delay-1s trans-200')); ?></a>
                        </div>
                        <div class="col">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                             <?php the_title(); ?>
                            </a>
                        </div>
                        <div class="col">
                           <?php the_time('M d Y'); ?>
                        </div>
                        <div class="col">
                             <?php the_category('&');?>
                        </div>
                    </div>   
                    <?php endwhile; ?>  
                     <?php wp_pagenavi( array( )); ?>                                        
                    <?php else: ?>
                        <p><?php _e('No posts by this author.'); ?></p> 
                    <?php endif;  wp_reset_postdata(); ?>       
        </div>       
        <div class="col-lg-3 sidebar-background p-3">
            <?php get_template_part('template-parts/content','extra-sidebar'); ?>   
        </div>
    </div>             
</div>
<button onclick="topFunction()" class="myBtn" title="Go to top">Top</button>
<?php get_footer(); ?>