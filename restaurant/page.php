<!-- GET HEADER.PHP -->
<?php get_header(); ?>
<!-- clearfix to clear both to any flex -->
<section class="clear">
    <div class="container">    
    <!-- RUN THE LOOP -->
    	<div class="row">
    		<div class="col-12">    			   
							 <?php if(have_posts()) : 
										 while(have_posts()) : 
												the_post(); ?> 		
											<h3 class="py-5 text-center">
												<?php the_title(); ?>
											</h3>									  
												<?php the_content(); ?>  
								<?php endwhile; 
										wp_pagenavi(); 
								else: ?>
										<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
								<?php endif; ?>
    		</div>
			</div>
    <!-- END OF THE LOOP -->
   </div><!-- END CONTAINER CONTENT -->
</section>
<style>
.woocommerce #respond input#submit, 
.woocommerce a.button, 
.woocommerce button.button, 
.woocommerce input.button {
    background-color: #89da59!important;
}
.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover, 
.woocommerce button.button:hover, 
.woocommerce input.button:hover {
	background-color: #000!important;
	font-weight: 600;
	color: #fff!important;
	-webkit-transition: all 500ms ease;
	-moz-transition: all 500ms ease;
	-ms-transition: all 500ms ease;
	-o-transition: all 500ms ease;
	transition: all 500ms ease;
}
.card-image {
	width: 68px;
	height: auto;
}
code {
	font-size: 100%;
	color: black;
}
@media(max-width:480px){
.woocommerce #payment #place_order, .woocommerce-page #payment #place_order {
    margin-top: 28px;
    padding-top: 28px;
	}
}
.woocommerce-input-wrapper {
	width: 100%;
}
		/*modify checkbox*/
input[type='checkbox'] {
    width:30px;
    height:30px;
    border-radius:5px;
    border:2px solid #555;
}
input[type='checkbox']:checked {
   background: url("link_to_another_image");
}
input[type='checkbox']:hover,
input[type='radio']:hover {
	cursor: pointer;
}
input[type='radio'] { transform: scale(2); }
.woocommerce ul.products li.product a img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 0 1em;
    box-shadow: 6px 6px 8px 1px #949294;
    border-radius: 10px;
    
}
.col-1,
.col-2 {
    max-width: 100%!important;
}
	body.woocommerce-account ul li.woocommerce-MyAccount-navigation-link--gift1 a::before{
	font-family: 'Font Awesome 5 Brands';
	font-weight: 900;
	margin-right: 28px;
  content: "\f3a3";	
}
.wcppec-checkout-buttons__separator {
    display: none;
}
.woocommerce form .form-row .optional {
    visibility: none!important;
}
span.optional {
    display:none!important;
    visibility: none!important;
}
strong {
    width: 100%;
}
</style>
<!-- LOAD FOOTER -->  
<?php get_footer(); ?>
  