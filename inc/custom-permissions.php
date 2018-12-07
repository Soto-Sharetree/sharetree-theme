<?php
/**
 *
 * This file is included from functions.php
 *
 */

// Works in conjunction with the user role plugin, where the role rental-manager is created
function remove_menus_for_rental_manager(){

    if ( current_user_can( 'rental-manager' ) ) {
         remove_menu_page( 'tools.php' );
         remove_menu_page( 'edit-comments.php' );
         remove_menu_page( 'edit.php' );
         remove_menu_page( 'wpcf7' );
    }

}
add_action( 'admin_menu', 'remove_menus_for_rental_manager' );


// Enables the role of rental maanger to access all the chamber CPT posts
// Works in conjunction with the user role plugin
function sharetree_exclude_posts_from_edit_restrictions($post_type) {

  $restrict_it = true;

  if (current_user_can('rental-manager')) {
      if ($post_type=='chamber') {
	        $restrict_it = false;
      }
  }

  return $restrict_it;
}

add_filter('ure_restrict_edit_post_type', 'sharetree_exclude_posts_from_edit_restrictions');