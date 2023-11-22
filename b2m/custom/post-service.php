<?php

// Register Custom Post Type
//Author: Md Rashedul Karim
// Hook <strong>lc_custom_post_movie()</strong> to the init action hook
//Creation custom post type Contest
//Create a custom taxonomies

add_action('init', 'create_service_taxonomies');

//create two taxonomies, genres and writers for the post type "service"
function create_service_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Service Categories', 'taxonomy general name'),
        'singular_name' => _x('Service Category', 'taxonomy singular name'),
        'search_items' => __('Search Service Categories'),
        'all_items' => __('All Service Categories'),
        'parent_item' => __('Parent Service Category'),
        'parent_item_colon' => __('Parent Service Category:'),
        'edit_item' => __('Edit Service Category'),
        'update_item' => __('Update Service Category'),
        'add_new_item' => __('Add Service Category'),
        'new_item_name' => __('New Service Category Name'),
        'menu_name' => __('Service Category'),
    );

    register_taxonomy('service_category', array('service'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    ));
}

add_action('init', 'service');

function service() {
    $labels = array(
        'name' => _x('Service', 'post type general name'),
        'singular_name' => _x('Service', 'post type singular name'),
        'add_new' => _x('Add New', 'Service'),
        'add_new_item' => __('Add New Service'),
        'edit_item' => __('Edit Service'),
        'new_item' => __('New Service'),
        'view_item' => __('View Service'),
        'search_items' => __('Search Service'),
        'not_found' => __('No contest found'),
        'not_found_in_trash' => __('No contest found in Trash'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 3,
        '_builtin' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'cats', 'author'),
        'taxonomies' => array('service_category')
    );
    register_post_type('service', $args);
//Tags service start
    $taxonomy_service_tag_labels = array(
        'name' => _x('Service Tags', 'serviceposttype'),
        'singular_name' => _x('Service Tag', 'serviceposttype'),
        'search_items' => _x('Search Service Tags', 'serviceposttype'),
        'popular_items' => _x('Popular Service Tags', 'serviceposttype'),
        'all_items' => _x('All Service Tags', 'serviceposttype'),
        'parent_item' => _x('Parent Service Tag', 'serviceposttype'),
        'parent_item_colon' => _x('Parent Service Tag:', 'serviceposttype'),
        'edit_item' => _x('Edit Service Tag', 'serviceposttype'),
        'update_item' => _x('Update Service Tag', 'serviceposttype'),
        'add_new_item' => _x('Add New Service Tag', 'serviceposttype'),
        'new_item_name' => _x('New Service Tag Name', 'serviceposttype'),
        'separate_items_with_commas' => _x('Separate Service tags with commas', 'serviceposttype'),
        'add_or_remove_items' => _x('Add or remove Service tags', 'serviceposttype'),
        'choose_from_most_used' => _x('Choose from the most used service tags', 'serviceposttype'),
        'menu_name' => _x('Service Tags', 'serviceposttype')
    );

    $taxonomy_service_tag_args = array(
        'labels' => $taxonomy_service_tag_labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => false,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy('service_tag', array('service'), $taxonomy_service_tag_args);
}

add_action('init', 'bar_add_default_boxes');

function bar_add_default_boxes() {
    register_taxonomy_for_object_type('service_category', 'bar');
}

add_filter('manage_service_posts_columns', 'ilc_bpt_columns');


function ilc_bpt_columns($defaults) {
    $defaults['service_category'] = 'Service Category';
    return $defaults;
}

function myplugin_save_meta_box_data($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if (!isset($_POST['myplugin_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if (!isset($_POST['myplugin_new_field'])) {
        return;
    }
    // Sanitize user input.
    $my_data = sanitize_text_field($_POST['myplugin_new_field']);

    // Update the meta field in the database.
    update_post_meta($post_id, '_my_meta_value_key', $my_data);
}

add_action('save_post', 'myplugin_save_meta_box_data');

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {

    $screens = array('post', 'page');

    foreach ($screens as $screen) {

        add_meta_box(
                'myplugin_sectionid', __('My Post Section Title', 'myplugin_textdomain'), 'myplugin_meta_box_callback', $screen
        );
    }
}

add_action('add_meta_boxes', 'myplugin_add_meta_box');

/*
 * Cusotm post review  * 
 */
// Hook <strong>lc_custom_post_movie_reviews()</strong> to the init action hook

add_action('init', 'lc_custom_post_movie_reviews');
// The custom function to register a movie review post type
function lc_custom_post_movie_reviews() {
    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name' => __('Movie Reviews'),
        'singular_name' => __('Movie Review'),
        'add_new' => __('Add New Movie Review'),
        'add_new_item' => __('Add New Movie Review'),
        'edit_item' => __('Edit Movie Review'),
        'new_item' => __('New Movie Review'),
        'all_items' => __('All Movie Reviews'),
        'view_item' => __('View Movie Reviews'),
        'search_items' => __('Search Movie Reviews')
    );

    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels' => $labels,
        'description' => 'Holds our movie reviews',
        'public' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'has_archive' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'has_archive' => true
    );
    
    

    // Call the actual WordPress function
    // Parameter 1 is a name for the post type
    // $args array goes in parameter 2.
    register_post_type('review', $args);
}

//End of review
/*
 * End Custom post Type
 */



