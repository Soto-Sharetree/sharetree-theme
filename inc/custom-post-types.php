<?php
/**
 * The CPTs that need defining and functions for creating them
 *
 * This file is included from  functions.php
 *
 */

build_cpt('page', 'chamber', 'chambers', false, false, 'chamber-rental', 'dashicons-tablet');


function build_cpt($type, $singular, $plural, $tags = false, $categories = false, $slug, $icon = 'dashicons-admin-page')
{
    $singular = strtolower($singular);
    $plural = strtolower($plural);
    $lcSingular = str_replace('_', ' ', $singular);
    $lcPlural = str_replace('_', ' ', $plural);
    $ucSingular = ucwords($lcSingular);
    $ucPlural = ucwords($lcPlural);

    $taxonomies = array();

    if($tags)
    {
        register_taxonomy($singular.'_tag', $singular, array(
            "hierarchical" => "false",
            "public" => true,
            "labels" => array(
                "name" => _x( "{$ucSingular} Tags", "taxonomy general name" ),
                "singular_name" => _x( "{$ucSingular} Tag", "taxonomy singular name" ),
                "search_items" =>__( "Search {$ucSingular} Tags" ),
                "all_items" => __( "All {$ucSingular} Tags" ),
                "parent_item" => __( "Parent {$ucSingular} Tag" ),
                "parent_item_colon" => __( "Parent {$ucSingular} Tag:" ),
                "edit_item" => __( "Edit {$ucSingular} Tag" ),
                "update_item" => __( "Update {$ucSingular} Tag" ),
                "add_new_item" => __( "Add New {$ucSingular} Tag" ),
                "new_item_name" => __( "New {$ucSingular} Tag Name" ),
                "menu_name" => __( "{$ucSingular} Tag" )
            )
        ));

        $taxonomies[] = $singular.'_tag';
    }

    if($categories)
    {
        register_taxonomy($singular.'_category', $singular, array(
            "hierarchical" => "true",
            "public" => true,
            "labels" => array(
                "name" => _x( "{$ucSingular} Categories", "taxonomy general name" ),
                "singular_name" => _x( "{$ucSingular} Category", "taxonomy singular name" ),
                "search_items" =>__( "Search {$ucSingular} Categories" ),
                "all_items" => __( "All {$ucSingular} Categories" ),
                "parent_item" => __( "Parent {$ucSingular} Category" ),
                "parent_item_colon" => __( "Parent {$ucSingular} Category:" ),
                "edit_item" => __( "Edit {$ucSingular} Category" ),
                "update_item" => __( "Update {$ucSingular} Category" ),
                "add_new_item" => __( "Add New {$ucSingular} Category" ),
                "new_item_name" => __( "New {$ucSingular} Category Name" ),
                "menu_name" => __( "{$ucSingular} Category" )
            )
        ));

        $taxonomies[] = $singular.'_category';
    }

    $supports = array("title", "editor", "thumbnail", "excerpt", "author", "revisions", "page-attributes");

    $hierarchical = false;

    $rewrite = true;

    if($slug) $rewrite = array('slug'=>$slug);

    register_post_type($singular,
        array(
            "labels"=>array(
                "name" => __("{$ucSingular}"),
                "singular_name" => __("{$ucSingular}"),
                "add_new" => __("Add {$ucSingular}"),
                "add_new_item" => __("Add New {$ucSingular}"),
                "edit_item" => __("Edit {$ucSingular}"),
                "new_item" => __("New {$ucSingular}"),
                "view_item" => __("View {$ucSingular}"),
                "search_items" => __("Search {$ucPlural}"),
                "not_found" => __("No {$lcPlural} found"),
                "not_found_in_trash" => __("No {$lcPlural} found in trash"),
                "parent_item_colon" => __("Parent {$ucSingular}"),
                "menu_name" => __("{$ucPlural}"),
            ),
            "public" => true,
            "show_ui" => true,
            "has_archive" => false,
            "capability_type" => $type,
            "hierarchical" => $hierarchical,
            "supports" => $supports,
            "taxonomies" => $taxonomies,
			"rewrite" => $rewrite,
			'menu_icon' => $icon,
        )
    );
}


/* leaving this in just in case I need to look at the old talks posts
   there's potentially a lot of useful content that could be made use of */
function create_custom_post_type_talks(){
    $labels = array(
        'name' => 'Talks',
        'singular_name' => 'Talk',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Talk',
        'edit_item' => 'Edit Talk',
        'new_item' => 'New Talk',
        'view_item' => 'View Talk',
        'search_items' => 'Search Talks',
        'not_found' => 'No Talks found',
        'not_found_in_trash' => 'No Talks found in Trash',
        'parent_item_colon' => '',
    );
    
    $args = array(
        'label' => __('Talks'),
        'labels' => $labels, // from array above
        'public' => true,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-megaphone', // from this list
        'hierarchical' => false,
        'rewrite' => array( "slug" => "talks" ), // defines URL base
        'supports'=> array('title', 'thumbnail', 'editor', 'excerpt'),
        'show_in_nav_menus' => true,
        'taxonomies' => array( 'post_tag'), // own categories
        'has_archive' => true
    );
    register_post_type('talks', $args);
}
//add_action('init','create_custom_post_type_talks');