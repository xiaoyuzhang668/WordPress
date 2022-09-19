<?php
/*============================
/* Remove url field */
/*===========================*/
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');
/*============================
/* Move comment box to bottom */
/*===========================*/
function wpb_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
} 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
/*====================================================
/* Define comment format
/*====================================================*/
function my_update_comment_field( $comment_field ) {
  $comment_field =
    '<p class="comment-form-comment">
				<label for="comment">' . __( "Comment", "framework" ) . '</label>
				<textarea id="comment" name="comment" placeholder="' . esc_attr__( "Enter comment here...", "framework" ) . '"  rows="5" class="border-top-0 border-right-0 border-left-0 p-2 w-100" aria-required="true" tabindex="7"></textarea>
		</p>';
  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'my_update_comment_field' );	
/*============================
/* Validate comment form */
/*===========================*/
function comment_validation_init() {
	if(is_singular() && comments_open() ) { ?><!---->
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.validate.js"></script>
	<script type="text/javascript">
jQuery(document).ready(function($) {	
$('#commentform').validate({ 
    // onfocusout: function(element) {
    //   this.element(element);
// },	
rules: {
  author: {
    required: true,
    normalizer: function(value) { return $.trim(value); }
  }, 
  email: {
    required: true,
		email: true
	},
	comment: {
    required: true,
    minlength: 10,
    normalizer: function(value) { return $.trim(value); }
  }
}, 
messages: {
  author: "<div class='text-danger'>Name should not be blank.</div>",
  email: {
	 required: "<div class='text-danger'>Email address should not be blank.</div>",
	 email: "<div class='text-danger'>Email address is not valid.</div>"
	},
  comment: {
	 required: "<div class='text-danger'>Comment should not be blank.</div>", 
	 minlength: "<div class='text-danger'>Comment should contain at least 10 characters.</div>"
	}
}, 
errorElement: "div",
errorPlacement: function(error, element) {
	var placement = $(element).data('error');
	if (placement) {
		$(placement).append(error)
	} else {
		error.insertAfter(element);
	}
}
});
});
</script>
<?php
}
}
add_action('wp_footer', 'comment_validation_init');
/*============================
/* Format comment reply - used */
/*===========================*/
function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body p-1 p-lg-3"><?php } ?>
              <div class="comment-author vcard d-lg-flex align-items-center justify-content-between">
                 <div class="comment-meta commentmetadata">
				 					<?php  echo get_avatar($comment, '50'); ?>                 
                     <?php  
                  		printf( __( '<cite class="fn"><small>%s</small></cite>' ), get_comment_author_link() ); ?>
                  <?php 
                    if ( $comment->comment_approved == '0' ) { ?>
									 		<em class="comment-awaiting-moderation"><small><?php _e( 'Your comment is awaiting moderation.' ); ?></small></em><br/><?php 
                    } ?>       
                  	<a class="pl-3 small" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    Published <time datetime="<?php comment_time( 'c' ); ?>">
                      <?php
                      printf( _x( '%s ago', '%s = human-readable time difference', 'master' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
                      ?>
                    </time><!-- wp list comments codex -->
                  	</a>
										<small><?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?></small>           
              		</div><!-- comment-meta -->
              	 	<div class="float-right reply btn btn-outline-secondary rounded-pill px-lg-5 text-uppercase trans-500">
                     	<?php 
                      comment_reply_link( 
                          array_merge( 
                              $args, 
                              array( 
                                  'add_below' => $add_below, 
                                  'depth'     => $depth, 
                                  'max_depth' => $args['max_depth'] 
                              ) 
                          ) 
                      ); ?>
               		</div><!-- reply -->
        			</div><!-- comment author, vcard -->
        			<div class="mt-3"><?php comment_text(); ?></div>
          		<?php 
         				if ( 'div' != $args['style'] ) : ?>
          </div>
          <?php endif;
}
// Remove the logout link in comment form
//add_filter( 'comment_form_logged_in', '__return_empty_string' );
/*============================
/* Add post title in contact form
/*===========================*/
add_action( 'wpcf7_init', 'custom_views_post_title' );  
function custom_views_post_title() {
    wpcf7_add_shortcode( 'custom_views_post_title', 'custom_views_post_title_shortcode_handler' );
}  
function custom_views_post_title_shortcode_handler( $tag ) {
    global $post;
    $post = get_post( $post ); 
    $title = isset( $post->post_title ) ? $post->post_title : '';     
		$output .= '<scan class="font-weight-bold">'. $title .  ' </scan>';    
    return $output; 
}
/*============================
/* Add acf in contact form
/*===========================*/
add_action( 'wpcf7_init', 'custom_views_acf' );  
function custom_views_acf() {
    wpcf7_add_shortcode( 'custom_views_acf', 'custom_views_acf_shortcode_handler' );
}  
function custom_views_acf_shortcode_handler( $tag ) {
    global $post;
    $post = get_post( $post ); 
    $start_date = get_post_meta($post->ID, 'start_date', true);
		$start_date = new DateTime($start_date); 
		$output .= '<scan class="font-weight-bold">'. $start_date->format('F j, Y'). ' </scan>';    
    return $output; 
}	
?>




<h3>Comment</h3> 
				<?php
				 // wp_list_comments($args, $comments);
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$label     = $req ? '*' : ' ' . __( '(optional)', 'framework0' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$fields =  array( 
					
				'author' => '<div class="row">
				<div class="col-md-6 mb-3">
				<span class="comment-form-author">
				<label for="author">' . __( 'Name dsfsdfs', 'framework' ) . '<span class="text-danger"> * </span></label> 
				<input id="author" name="author" placeholder="' . esc_attr__( "Your name", "framework" ) . '" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  tabindex="1"' . $aria_req . ' />
				</span>
				</div>',
	
				'email'  => '<div class="col-md-6 mb-3">
				<span class="comment-form-email">
				<label for="email">' . __( 'Email dfsdfsd', 'framework' ) . '<span class="text-danger"> * </span></label> 
				<input id="email" name="email" placeholder="' . esc_attr__( "Your email", "framework" ) . '" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"  tabindex="2" ' . $aria_req . ' />
				</span>
				</div>',	
						'commnet' => '<div class="row">
				<div class="col-12">
				<span class="comment-form-comment">
				<label for="comment">' . __( 'Comment' ) . '</label>
				<textarea id="comment" name="comment" placeholder="Your comment" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="'. esc_attr( $commenter['comment_author_comment'] ) . 
				'" tabindex="3" /></textarea>
				</span>
				</div>
				</div>',	
					
//							'url' => '<div class="row">
//				<div class="col-12">
//				<span class="comment-form-url">
//				<label for="url">' . __( 'Website' ) . '</label>
//				<input id="url" name="url" placeholder="Your url" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) . 
//				'" tabindex="3" />
//				</span>
//				</div>
//				</div>',
//					
		
					
				
				);			