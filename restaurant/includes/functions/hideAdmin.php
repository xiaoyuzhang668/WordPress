<?php 
/*=======================================================
/* Let Editors manage users, and run this only once.*/
/*=======================================================*/
function isa_editor_manage_users() { 
    if ( get_option( 'isa_add_cap_editor_once' ) != 'done' ) {     
        // let editor manage users 
        $edit_editor = get_role('editor'); // Get the user role
        $edit_editor->add_cap('edit_users');
        $edit_editor->add_cap('list_users');
        $edit_editor->add_cap('promote_users');
        $edit_editor->add_cap('create_users');
        $edit_editor->add_cap('add_users');
        $edit_editor->add_cap('delete_users'); 
        update_option( 'isa_add_cap_editor_once', 'done' );
    } 
}
add_action( 'init', 'isa_editor_manage_users' );
/*======================================================================
//prevent editor from deleting, editing, or creating an administrator
// only needed if the editor was given right to edit users 
/*======================================================================*/
class ISA_User_Caps { 
  // Add our filters
  function __construct() {
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }
  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }
  // If someone is trying to edit or delete an
  // admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){
    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  } 
} 
$isa_user_caps = new ISA_User_Caps();
/*===============================
// Hide admin from user list 
/*===============================*/
add_action('pre_user_query','isa_pre_user_query');
function isa_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if ($user->ID!=1) { // Is not administrator, remove administrator
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.ID<>1",$user_search->query_where);
  }
}
/*=======================================
//editor option to edit theme, category
/*=======================================*/
// get the the role object
$role_object = get_role( 'editor' );
// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options', true );
$role_object->add_cap( 'manage_categories', true );
/*==================================
//allow plugin
/*==================================*/
function activate_plugin_name() {
   $role = get_role( 'editor' );
   $role->add_cap( 'manage_options' ); // capability
}
// Register our activation hook
register_activation_hook( __FILE__, 'activate_plugin_name' );
//function deactivate_plugin_name() {
//  $role = get_role( 'editor' );
//  $role->remove_cap( 'manage_options' ); // capability
//}
//// Register our de-activation hook
//register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );
/*==================================
//new file type allowed for upload
/*==================================*/
function my_custom_mime_types( $mimes ) {     
    // New allowed mime types.
//    $mimes['svg']  = 'image/svg+xml';
//    $mimes['php']  = 'text/html';
//    $mimes['svgz'] = 'image/svg+xml';
//    $mimes['doc']  = 'application/msword';  
////    $mimes['gif']  = 'image/gif';  
//    $mimes['pdf']  = 'application/pdf';  
    $mimes['stp']  = 'application/STEP';  
    $mimes['zip']  = 'application/zip'; 
    $mimes['rar']  = 'application/x-rar-compressed';  
    // Optional. Remove a mime type.
//    unset( $mimes['exe'] ); 
    return $mimes;
} 
add_filter( 'upload_mimes', 'my_custom_mime_types' );
///*==============
////image editor
///*==============*/
//function wpb_image_editor_default_to_gd( $editors ) {
//    $gd_editor = 'WP_Image_Editor_GD';
//    $editors = array_diff( $editors, array( $gd_editor ) );
//    array_unshift( $editors, $gd_editor );
//    return $editors;
//}
//add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );
?>