<?php
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
	rating: {
    required: true
	},
	comment: {
    required: true,
    minlength: 10,
    normalizer: function(value) { return $.trim(value); }
  }
}, 
messages: {
  author: "<div class='text-danger font-weight-bold'>Name should not be blank.</div>",
  email: {
	 required: "<div class='text-danger font-weight-bold'>Email address should not be blank.</div>",
	 email: "<div class='text-danger font-weight-bold'>Email address is not valid.</div>"
	},
  comment: {
	 required: "<div class='text-danger font-weight-bold'>Comment should not be blank.</div>", 
	 minlength: "<div class='text-danger font-weight-bold'>Comment should contain at least 10 characters.</div>"
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
/*==============================================
/* Move comment box to bottom - woocommerce */
/*==============================================*/
// change comment form fields order
add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
function mo_comment_fields_custom_order( $fields ) {
	$comment_field = $fields['comment'];
	$author_field = $fields['author'];
	$email_field = $fields['email'];
	$url_field = $fields['url'];
	unset( $fields['comment'] );
	unset( $fields['author'] );
	unset( $fields['email'] );
	unset( $fields['url'] );
	// the order of fields is the order below, change it as needed:
	$fields['author'] = $author_field;
	$fields['email'] = $email_field;
	$fields['comment'] = $comment_field;
//	$fields['url'] = $url_field;
	// done ordering, now return the fields:
	return $fields;
}
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
/* Move comment box to bottom */
/*===========================*/
//function wpb_move_comment_field_to_bottom( $fields ) {
//$comment_field = $fields['comment'];
//unset( $fields['comment'] );
//$fields['comment'] = $comment_field;
//return $fields;
//} 
//add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
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