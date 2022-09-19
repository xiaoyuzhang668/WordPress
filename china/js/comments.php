<div class="comments container p-4 my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
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
                        'fields'=> $fields,
                        // change the title of send button 
                        'label_submit'=>'Post Comment',
                        // change the title of the reply section
                        'title_reply'=>'',
                        // remove "Text or HTML to be displayed after the set of comment fields"
                        'comment_notes_after' => '',
                        // redefine your own textarea (the comment body)
                        'comment_field' => '<div class="comment-form-comment mb-5"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br><textarea id="comment" class="border-top-0 p-2 w-100 border-right-0 border-left-0" name="comment" rows="10" aria-required="true"></textarea></div>',
                );
                comment_form($comments_args);
                ?>
        </div>
    </div>

	<?php if ( have_comments() ) : ?>
        <h4 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'china' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h4> 
        <ol class="comment-list">
            <?php wp_list_comments( array(
                    'style'       => 'div',
                    'short_ping'  => true,
                    'avatar_size' => 50,
                    'type' => 'comment',
                ) );
            ?>
        </ol><!-- .comment-list --> 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'china' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&&larr; Older Comments', 'china' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &&rarr;', 'china' ) ); ?></div>
            </nav><!-- .comment-navigation -->            
            <?php endif; // Check for comment navigation ?> 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'china' ); ?></p>
        <?php endif; ?> 
    <?php endif; // have_comments() ?> 	
</div>