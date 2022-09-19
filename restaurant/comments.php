<div class="comments container my-5">
	<div class="row">
		<h3>Comment</h3> 
		<div class="col-12 col-md-10 offset-md-1 p-lg-4 py-3 rounded border border-success">	         
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
				<label for="author">' . __( 'Name', 'framework' ) . '<span class="text-danger"> * </span></label> 
				<input id="author" name="author" placeholder="' . esc_attr__( "Your name", "framework" ) . '" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  tabindex="1"' . $aria_req . ' />
				</span>
				</div>',
	
				'email'  => '<div class="col-md-6 mb-3">
				<span class="comment-form-email">
				<label for="email">' . __( 'Email', 'framework' ) . '<span class="text-danger"> * </span></label> 
				<input id="email" name="email" placeholder="' . esc_attr__( "Your email", "framework" ) . '" class="border-top-0 border-right-0 border-left-0 w-100 p-2" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"  tabindex="2" ' . $aria_req . ' />
				</span>
				</div>
				</div>',	
				);			
				$comments_args = array(
						'logged_in_as' => '<div class="row">
						<p class="logged-in-as col-12">' . sprintf(
						__( 'You are currently logged in as <a href="%1$s">%2$s</a>.  <a href="%3$s" title="Log out of this account"> <span class="ml-2">Log out?</span></a>' ), admin_url( 'profile.php' ),  $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div>',
							'fields'=> apply_filters( 'comment_form_default_fields', $fields ),					
							'must_log_in'          => ' ',
							'comment_notes_before' => ' ',
							// remove "Text or HTML to be displayed after the set of comment fields"
							'comment_notes_after'  => '',
							'id_form'              => 'commentform',
							'id_submit'            => 'submit',
							// change the title of the reply section
							'title_reply'          => __( '' ),
							'title_reply_to'       => __( 'Leave a Reply to %s' ),
							'cancel_reply_link'    => __( '<button class="btn btn-outline-secondary">Cancel reply</button>' ),
							// change the title of send button 
							'label_submit'         => __( 'Post Comment' ),															
							// redefine your own textarea (the comment body)
//						  refer to comment_addField            
				);
				comment_form($comments_args);
				?>
			</div>
	</div><!-- end of row -->
	<?php if ( have_comments() ) : ?>   
			<h6 class="comments-title my-5">
					Total Comment (<?php echo get_comments_number(); ?>)
			</h6> 
			 <?php global $post;
				$post_id = $post->ID; ?>
				<ul class="comment-list pl-0 rounded shadow-sm">
					<?php wp_list_comments( array(
									  'post_id' => $post_id,
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 50,
                    'type' => 'comment',
                    'callback' => 'mytheme_comment',
                    'reply_text' => 'reply',
						) );
				 ?>      
				</ul><!-- .comment-list --> 	
		
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :	?>
					<div class="py-5">
						<nav class="navigation comment-navigation" role="navigation">
								<div class="nav-previous h5 font-weight-bolder float-left">
									<?php previous_comments_link( __( '&larr; Older Comments', 'master' ) ); ?>
								</div>
								<div class="nav-next h5 font-weight-bolder float-right">
									<?php next_comments_link( __( 'Newer Comments &rarr;', 'master' ) ); ?>
								</div>
						</nav><!-- .comment-navigation -->            
					</div>    
			<?php endif; // Check for comment navigation ?> 
			<?php if ( ! comments_open() /*&& get_comments_number()*/ ) : ?>
				<p class="no-comments"><?php _e( 'Comments are closed.' , 'master' ); ?></p>
			<?php endif; ?> 
	<?php else: // have_comments() ?> 	
			<div class="h6 mt-5 clear text-center">There is no comment for this post currently, be the first one to write a comment.</div>
	<?php endif; ?>
</div><!-- end of container -->