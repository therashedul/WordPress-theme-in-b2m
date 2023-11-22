<?php

//Create a custom taxonomies
add_action('init', 'create_service_taxonomies');

//create two taxonomies, genres and writers for the post type "book"
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

    register_taxonomy('service_category', array('book'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    ));
}

//Creation custom post type Contest
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

//register_taxonomy( 'media', 'service', array( 'hierarchical' => false, 'label' => __('Media Type'), 'query_var' => 'media' ) );
//Custom metabox with contest information
add_action('add_meta_boxes', 'add_service_metaboxes');

// Add the Contest Meta Boxes
//function add_service_metaboxes() {
//    add_meta_box('wdc_service', 'Service Information', 'wdc_service', 'service', 'side', 'default');
//}
//function wdc_service(){
//    global $post;
//    // Noncename needed to verify where the data originated
//    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
//    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
//    // Get the location data if its already been entered
//    $rate = get_post_meta($post->ID, '_rate', true);
//	$value = get_post_meta($post->ID, '_value', true);
//	$you_save = get_post_meta($post->ID, '_you_save', true);
//	$discount = get_post_meta($post->ID, '_discount', true);
//	$buy_link = get_post_meta($post->ID, '_buy_link', true);
//	$date = get_post_meta($post->ID, '_date', true);
//	$show_home = get_post_meta($post->ID, '_show_home', true);
//	$button_text = get_post_meta($post->ID, '_button_text', true);
//	$listing_page_text = get_post_meta($post->ID, '_listing_page_text', true);
//	$Home_page_text = get_post_meta($post->ID, '_Home_page_text', true);
//    // Echo out the field
//    //echo '<p><strong>Anrede:</strong> <input type="text" name="_anrede" value="' . $location  . '" class="widefat1" /></p>';	
//	echo '<p><strong>Rate(Per night): </strong> <input type="text" name="_rate" value="' . $rate  . '" class="widefat1" /></p>';
//	echo '<p><strong>Value: </strong> <input type="text" name="_value" value="' . $value  . '" class="widefat1" /></p>';
//	echo '<p><strong>You Save :</strong> <input type="text" name="_you_save" value="' . $you_save  . '" class="widefat1" />';
//	echo '<p><strong>Discount: </strong> <input type="text" name="_discount" value="' . $discount  . '" class="widefat1" />';
//	echo '<p><strong>Buy link: </strong> <input type="text" name="_buy_link" value="' . $buy_link  . '" class="widefat1" /></p>';
//	echo '<p><strong>Date: </strong> <input type="text" name="_date" value="' . $date  . '" class="widefat1" /></p>';
//	echo '<p><strong>Button Text: </strong> <input type="text" name="_button_text" value="' . $button_text  . '" class="widefat1" /></p>';
//	echo '<p><strong>Show on home page (True/False):</strong> <input type="text" name="_show_home" value="' . $show_home  . '" class="widefat1" /></p>';
//	echo '<p><strong>Home page text:</strong> <input type="text" name="_Home_page_text" value="' . $Home_page_text  . '" class="widefat1" /></p>';
//	
//	}
//	
////Save custom meta value
//add_action( 'save_post', 'save_custom_details' );
//function save_custom_details( $post_id ) {
//    global $post;   
//    //skip auto save
//    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
//        return $post_id;
//    }
//    //check for you post type only
//    if( $post->post_type == "service" ) {
//        if( isset($_POST['_rate']) ) { update_post_meta( $post->ID, '_rate', $_POST['_rate'] );}
//        if( isset($_POST['_value']) ) { update_post_meta( $post->ID, '_value', $_POST['_value'] );}
//        if( isset($_POST['_you_save']) ) { update_post_meta( $post->ID, '_you_save', $_POST['_you_save'] );}
//        if( isset($_POST['_discount']) ) { update_post_meta( $post->ID, '_discount', $_POST['_discount'] );}
//        if( isset($_POST['_buy_link']) ) { update_post_meta( $post->ID, '_buy_link', $_POST['_buy_link'] );}
//        if( isset($_POST['_date']) ) { update_post_meta( $post->ID, '_date', $_POST['_date'] );}
//		if( isset($_POST['_button_text']) ) { update_post_meta( $post->ID, '_button_text', $_POST['_button_text'] );}
//        if( isset($_POST['_show_home']) ) { update_post_meta( $post->ID, '_show_home', $_POST['_show_home'] );}
//		if( isset($_POST['_listing_page_text']) ) { update_post_meta( $post->ID, '_listing_page_text', $_POST['_listing_page_text'] );}
//		if( isset($_POST['_Home_page_text']) ) { update_post_meta( $post->ID, '_Home_page_text', $_POST['_Home_page_text'] );}
//
//    }
//}
//add custom column category

add_filter('manage_service_posts_columns', 'ilc_bpt_columns');
add_action('manage_service_posts_custom_column', 'ilc_bpt_custom_column', 10, 2);

function ilc_bpt_columns($defaults) {
    $defaults['service_category'] = 'Service Category';
    return $defaults;
}

function ilc_bpt_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);

    if (!empty($terms)) {
        foreach ($terms as $term)
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join(', ', $post_terms);
    } else
        echo '<i>No terms.</i>';
}

// add custom cocumn show homw

function wdc_add_service_home_column($column) {

    $column['thumb'] = 'Image';


    return $column;
}

add_filter('manage_edit-service_columns', 'wdc_add_service_home_column');

function test_modify_service_user_table_row($column_name, $post_id) {
    $custom_fields = get_post_custom($post_id);
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'admin-thumb', true);
    $serviceinfo_templateurl = get_serviceinfo('template_url');
    $imgsrc = $image[0];
    if ($imgsrc == '') {
        $imgsrc = $serviceinfo_templateurl . '/images/deal.png';
    }

    switch ($column_name) {
        case '_date' :
            echo $custom_fields['_date'][0];
            break;

        case 'thumb':
            echo "<img src='" . $imgsrc . "' />";
            break;

        case '_rate' :
            echo $custom_fields['_rate'][0];
            break;

        case '_show_home' :
            echo $custom_fields['_show_home'][0];
            break;

        default:
    }
}

add_filter('manage_service_posts_custom_column', 'test_modify_service_user_table_row', 2);



//Create page for Service
?>
<?php

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

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback($post) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field('myplugin_meta_box', 'myplugin_meta_box_nonce');

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta($post->ID, '_my_meta_value_key', true);

    echo '<label for="myplugin_new_field">';
    _e('Description for this field', 'myplugin_textdomain');
    echo '</label> ';
    echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr($value) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
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
