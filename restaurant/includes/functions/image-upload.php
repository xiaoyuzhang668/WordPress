<?php 
add_action( 'admin_enqueue_scripts', 'misha_include_myuploadscript' );
function misha_include_myuploadscript() {
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
}

add_action('quick_edit_custom_box',  'misha_add_featured_image_quick_edit', 10, 2);
function misha_add_featured_image_quick_edit( $column_name, $post_type ) {
 
	// add it only if we have featured image column
	if ($column_name != 'riv_post_thumbs') return;
 
	// we add #misha_featured_image to use it in JavaScript in CSS
	echo '<fieldset id="misha_featured_image" class="inline-edit-col-left">
		<div class="inline-edit-col">
			<span class="title">Featured Image</span>
			<div>
				<a href="#" class="misha_upload_featured_image">Set featured image</a>
				<input type="hidden" name="_thumbnail_id" value="" />
				<a href="#" class="misha_remove_featured_image">Remove Featured Image</a>
			</div>
		</div></fieldset>';
 
		// please look at _thumbnail_id as a name attribute - I use it to skip save_post action
 
}

add_action('admin_footer', 'misha_quick_edit_js_update');
function misha_quick_edit_js_update() {
 
	global $current_screen;
 
	// add this JS function only if we are on all posts page
	if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post'))
		return;
 
		?><script>
		jQuery(function($){
 
			$('body').on('click', '.misha_upload_featured_image', function(e){
				e.preventDefault();
				var button = $(this),
				 custom_uploader = wp.media({
					title: 'Set featured image',
					library : { type : 'image' },
					button: { text: 'Set featured image' },
				}).on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					$(button).html('<img src="' + attachment.url + '" />').next().val(attachment.id).parent().next().show();
				}).open();
			});
 
			$('body').on('click', '.misha_remove_featured_image', function(){
				$(this).hide().prev().val('-1').prev().html('Set featured Image');
				return false;
			});
 
			var $wp_inline_edit = inlineEditPost.edit;
			inlineEditPost.edit = function( id ) {
				$wp_inline_edit.apply( this, arguments );
 				var $post_id = 0;
				if ( typeof( id ) == 'object' ) { 
					$post_id = parseInt( this.getId( id ) );
				}
 
				if ( $post_id > 0 ) {
					var $edit_row = $( '#edit-' + $post_id ),
							$post_row = $( '#post-' + $post_id ),
							$featured_image = $( '.column-featured_image', $post_row ).html(),
							$featured_image_id = $( '.column-featured_image', $post_row ).find('img').attr('data-id');
 
 
					if( $featured_image_id != -1 ) {
 
						$( ':input[name="_thumbnail_id"]', $edit_row ).val( $featured_image_id ); // ID
						$( '.misha_upload_featured_image', $edit_row ).html( $featured_image ); // image HTML
						$( '.misha_remove_featured_image', $edit_row ).show(); // the remove link
 
					}
				}
 		}
	});
	</script>
<?php
}
/*==================================
// file name text and alt
/*==================================*/
add_action( 'add_attachment', 'wpse_125805_add_image_meta_data' );
function wpse_125805_add_image_meta_data( $attachment_ID ) {
    $filename   =   $_REQUEST['name']; // or get_post by ID
    $withoutExt =   preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
    $withoutExt =   str_replace(array('-','_'), ' ', $withoutExt);

    $my_post = array(
        'ID'           => $attachment_ID,
        'post_excerpt' => $withoutExt,  // caption
        'post_content' => $withoutExt,  // description
    );
    wp_update_post( $my_post );
    // update alt text for post
    update_post_meta($attachment_ID, '_wp_attachment_image_alt', $withoutExt );
}
/*==================================
// Image upload on front end
/*==================================*/
function insert_attachment($file_handler,$post_id,$setthumb='false') {
  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );

  if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
 	if ($setthumb) update_post_meta($post_id,'_example_meta_key','cz_upload_image'); 
  return $attach_id;
} 

function rt_image_attachment_fields_to_save($post, $attachment) {
    // $attachment part of the form $_POST ($_POST[attachments][postID])
        // $post['post_type'] == 'attachment'
    if( isset($attachment['example_meta_key']) ){
        // update_post_meta(postID, meta_key, meta_value);
        update_post_meta($post['ID'], '_example_meta_key', $attachment['example_meta_key']);
    }
    return $post;
}
// now attach our function to the hook.
add_filter("attachment_fields_to_save", "rt_image_attachment_fields_to_save", null , 2);

//add meta key value for image attachment
//add_action('added_post_meta', 'wpse_20151218_after_post_meta', 10, 4);
//function wpse_20151218_after_post_meta($meta_id, $post_id, $meta_key, $meta_value) {
//    // _wp_attachment_metadata added
//    if($meta_key === '_wp_attachment_metadata') {
//        // Add Custom Field
//        update_post_meta($post_id, '_example_meta_key', 'cz_upload_image');
//        // _wp_attached_file
//        // _wp_attachment_metadata (serialized)
//        // _wp_attachment_image_alt
//        // _example_meta_key
////        $attachment_meta = get_post_meta($post_id);
//    }
//}
/*==================================
//  Other users file restriction
/*==================================*/
add_filter('upload_mimes','restrict_mime');
function restrict_mime($mimes) { 
    global $current_user;
    get_currentuserinfo(); 
    // change users in list
    $users = array(
                     "cathy"
                            );
    if (!in_array($current_user->user_login, $users)) {
    $mimes = array(
                    'jpg|jpeg|jpe' => 'image/jpeg',
                    'png' => 'image/png',
//                    'gif' => 'image/gif',
    );
    }
    return $mimes;
}
/*==================================
// Check if same name file exist
/*==================================*/
//check if exist
function does_file_exists($filename) {
    global $wpdb;    
    return intval( $wpdb->get_var( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%/$filename'" ) );
  }
add_filter( 'sanitize_file_name', 'replace_image_if_same_exists', 10, 1 );
function replace_image_if_same_exists( $name ) 
{
  $args = array(
    'numberposts'   => -1,
    'post_type'     => 'attachment',
    'meta_query' => array(
            array( 
                'key' => '_wp_attached_file',
                'value' => $name,
                'compare' => 'LIKE'
            )
        )
  );
  $attachments_to_remove = get_posts( $args );
  foreach( $attachments_to_remove as $attach )
//    wp_delete_attachment( $attach->ID, true );
			echo '<p class="text-danger upload-errors font-weight-bold">You have uploaded the image of same name "'.$name.'" again. </p>';
 return $name;
}
/*==================================
// Check file name with number 
/*==================================*/
function startsWith($haystack, $needle) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
?>