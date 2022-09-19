<div class="border border-white border-right-0 border-left-0 py-3 h5">             
 <a href="<?php echo esc_url( get_category_link(3) ); ?>" title="Lifestyle">Lifestyle</a>             
 <span class="ml-2 badge badge-light"><?php echo count_cat_post(3); ?></span> 
</div>                                  
  <?php echo wpb_postsbycategory_lifestyle() ?>                 
<div class="border border-white border-right-0 border-left-0 py-3 h5">
 <a href="<?php echo esc_url( get_category_link(5) ); ?>" title="Travel">Travel</a>
 <span class="ml-2 badge badge-light"><?php echo count_cat_post(5); ?></span> 
</div> 
 <?php echo wpb_postsbycategory() ?>    
<div class="border border-white border-right-0 border-left-0 py-3 h5">          
 <a href="<?php echo esc_url( get_category_link(4) ); ?>" title="Cooking">Cooking</a>
 <span class="ml-2 badge badge-light"><?php echo count_cat_post(4); ?></span> 
</div>
 <?php echo wpb_postsbycategory_cooking() ?>    