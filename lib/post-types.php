<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>
 
<style>
#menu-posts-collection .dashicons-admin-post:before {
    content: '\f319';
}
</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_collection' );

function register_cpt_collection() {

    $labels = array( 
        'name' => _x( 'Collections', 'collection' ),
        'singular_name' => _x( 'Collection', 'collection' ),
        'add_new' => _x( 'Add New', 'collection' ),
        'add_new_item' => _x( 'Add New Collection', 'collection' ),
        'edit_item' => _x( 'Edit Collection', 'collection' ),
        'new_item' => _x( 'New Collection', 'collection' ),
        'view_item' => _x( 'View Collection', 'collection' ),
        'search_items' => _x( 'Search Collections', 'collection' ),
        'not_found' => _x( 'No Collections found', 'collection' ),
        'not_found_in_trash' => _x( 'No Collections found in Trash', 'collection' ),
        'parent_item_colon' => _x( 'Parent Collection:', 'collection' ),
        'menu_name' => _x( 'Collections', 'collection' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'collection', $args );
}
