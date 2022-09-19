<div class="comments container my-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2 p-4 rounded">
            <div class="mb-4">           
                <h3>Post Comment</h3><!-- COPY COMMENT FORM FROM https://codex.wordpress.org/Function_Reference/comment_form -->
            </div>  
                    <?php $args = array(
                    'walker'            => null,
                    'max_depth'         => '',
                    'style'             => 'div',
                    'callback'          => null,
                    'end-callback'      => null,
                    'type'              => 'all',
                    'reply_text'        => 'Reply',
                    'page'              => '',
                    'per_page'          => '',
                    'avatar_size'       => 60,
                    'reverse_top_level' => null,
                    'reverse_children'  => '',
                    'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
                    'short_ping'        => false,   // @since 3.6
                    'echo'              => true     // boolean, default is true
                ); ?>
                <?php
                    // wp_list_comments($args, $comments);
                    $commenter = wp_get_current_commenter();
                    $req = get_option( 'require_name_email' );
                    $aria_req = ( $req ? " aria-required='true'" : '' );
                    $fields =  array(                    
                    'author' => '<div class="row mb-3"><div class="col-md-6"><span class="comment-form-author float-left">' . '<label for="author">' . __( 'Name' ) . '</label> ' . 
                        '<input id="author" name="author" placeholder="Your name" class="border-top-0 p-2 w-100 border-right-0 border-left-0" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></span></div>',
                    'email'  => '<div class="col-md-6"><span class="comment-form-email float-left"><label for="email">' . __( 'Email' ) . '</label> ' .
                        '<input id="email" name="email" placeholder="Your email" class="border-top-0 p-2 w-100 border-right-0 border-left-0" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></span></div></div>',
                    );
                    $comments_args = array(
                        'logged_in_as' => '<div class="row"><p class="logged-in-as col-12">' . sprintf(
                    __( 'You are currently logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                      admin_url( 'profile.php' ),  $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                    ) . '</p></div>',
                        'fields'=> $fields,
                        // change the title of send button 
                        'label_submit'=>'Post Comment',
                        // change the title of the reply section
                        'title_reply'=>'',
                        // remove "Text or HTML to be displayed after the set of comment fields"
                        'comment_notes_after' => '',
                        // redefine your own textarea (the comment body)
                        'comment_field' => '<div class="comment-form-comment mb-5"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br><textarea id="comment" placeholder="Your message" class="border-top-0 p-2 w-100 border-right-0 border-left-0" name="comment" rows="10" aria-required="true"></textarea></div>',
                        
                );
                comment_form($comments_args);
                ?>
        </div>
    </div>

	<?php if ( have_comments() ) : ?>   
        <h4 class="comments-title my-5">
            Comments (<?php echo get_comments_number(); ?>)
        </h4> 
         <?php global $post;
        $post_id = $post->ID; ?>
        <ul class="comment-list pl-0 rounded shadow">
            <?php wp_list_comments( array(
                    'post_id' => $post_id,
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 50,
                    'type' => 'comment',
                    'callback' => 'mytheme_comment',
                    'reply_text' => 'Reply',
                ) );
            ?>
         
        </ul><!-- .comment-list --> 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
        <div class="py-5">
            <nav class="navigation comment-navigation" role="navigation">
                <div class="nav-previous h5 font-weight-bolder float-left"><?php previous_comments_link( __( '&larr; Older Comments', 'china' ) ); ?></div>
                <div class="nav-next h5 font-weight-bolder float-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'china' ) ); ?></div>
            </nav><!-- .comment-navigation -->            
        </div>    
            <?php endif; // Check for comment navigation ?> 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'china' ); ?></p>
        <?php endif; ?> 
    <?php else: // have_comments() ?> 	
        <div class="h6 mt-5 clear text-center">There is no comment for this post currently.</div>
    <?php endif; ?>
</div>