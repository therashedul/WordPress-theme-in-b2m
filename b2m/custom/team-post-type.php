<?php
/*
Plugin Name: Portfolio Post Type
Plugin URI: http://www.wptheming.com
Description: Enables a portfolio post type and taxonomies.
Version: 0.3
Author: Devin Price
Author URI: http://wptheming.com/portfolio-post-type/
License: GPLv2
*/

/**
 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404
 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
 */

function blogposttype_activation() {
	blogposttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'blogposttype_activation' );

function blogposttype() {

	/**
	 * Enable the Portfolio custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Blog', 'blogposttype' ),
		'singular_name' => __( 'Blog Item', 'blogposttype' ),
		'add_new' => __( 'Add New Item', 'blogposttype' ),
		'add_new_item' => __( 'Add New Blog Item', 'blogposttype' ),
		'edit_item' => __( 'Edit Blog Item', 'blogposttype' ),
		'new_item' => __( 'Add New Blog Item', 'blogposttype' ),
		'view_item' => __( 'View Item', 'blogposttype' ),
		'search_items' => __( 'Search Blog', 'blogposttype' ),
		'not_found' => __( 'No Blog items found', 'blogposttype' ),
		'not_found_in_trash' => __( 'No Blog items found in trash', 'blogposttype' )
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "Blog"), // Permalinks format
		'menu_position' => 5,
		'has_archive' => true
	); 

	register_post_type( 'blog', $args );
	
	/**
	 * Register a taxonomy for Portfolio Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	 
	
	$taxonomy_portfolio_tag_labels = array(
		'name' => _x( 'Blog Tags', 'blogposttype' ),
		'singular_name' => _x( 'Blog Tag', 'blogposttype' ),
		'search_items' => _x( 'Search Blog Tags', 'blogposttype' ),
		'popular_items' => _x( 'Popular Blog Tags', 'blogposttype' ),
		'all_items' => _x( 'All Blog Tags', 'blogposttype' ),
		'parent_item' => _x( 'Parent Blog Tag', 'blogposttype' ),
		'parent_item_colon' => _x( 'Parent Blog Tag:', 'blogposttype' ),
		'edit_item' => _x( 'Edit Blog Tag', 'blogposttype' ),
		'update_item' => _x( 'Update Blog Tag', 'blogposttype' ),
		'add_new_item' => _x( 'Add New Blog Tag', 'blogposttype' ),
		'new_item_name' => _x( 'New Blog Tag Name', 'blogposttype' ),
		'separate_items_with_commas' => _x( 'Separate Blog tags with commas', 'blogposttype' ),
		'add_or_remove_items' => _x( 'Add or remove Blog tags', 'blogposttype' ),
		'choose_from_most_used' => _x( 'Choose from the most used portfolio tags', 'blogposttype' ),
		'menu_name' => _x( 'Blog Tags', 'blogposttype' )
	);
	
	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'query_var' => true
	);
	
	register_taxonomy( 'blog_tag', array( 'blog' ), $taxonomy_portfolio_tag_args );
	
	/**
	 * Register a taxonomy for Portfolio Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_portfolio_category_labels = array(
		'name' => _x( 'Blog Categories', 'blogposttype' ),
		'singular_name' => _x( 'Blog Category', 'blogposttype' ),
		'search_items' => _x( 'Search Blog Categories', 'blogposttype' ),
		'popular_items' => _x( 'Popular Blog Categories', 'blogposttype' ),
		'all_items' => _x( 'All Blog Categories', 'blogposttype' ),
		'parent_item' => _x( 'Parent Blog Category', 'blogposttype' ),
		'parent_item_colon' => _x( 'Parent Blog Category:', 'blogposttype' ),
		'edit_item' => _x( 'Edit Blog Category', 'blogposttype' ),
		'update_item' => _x( 'Update Blog Category', 'blogposttype' ),
		'add_new_item' => _x( 'Add New Blog Category', 'blogposttype' ),
		'new_item_name' => _x( 'New Blog Category Name', 'blogposttype' ),
		'separate_items_with_commas' => _x( 'Separate Blog categories with commas', 'blogposttype' ),
		'add_or_remove_items' => _x( 'Add or remove Blog categories', 'blogposttype' ),
		'choose_from_most_used' => _x( 'Choose from the most used Blog categories', 'blogposttype' ),
		'menu_name' => _x( 'Blog Categories', 'blogposttype' ),
    );
	
    $taxonomy_portfolio_category_args = array(
		'labels' => $taxonomy_portfolio_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => true,
		'query_var' => true
    );
	
    register_taxonomy( 'blog_category', array( 'blog' ), $taxonomy_portfolio_category_args );
	
}

add_action( 'init', 'blogposttype' );

// Allow thumbnails to be used on portfolio post type
if (function_exists('add_theme_support')) {
add_theme_support('post-thumbnails');
add_image_size('blog-thumb', 105, 140, true);
}

//add_theme_support( 'post-thumbnails', array( 'blog' ) );
 
/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function blogposttype_edit_columns($portfolio_columns){
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name'),
		"thumbnail" => __('Thumbnail', 'blogposttype'),
		"blog_category" => __('Category', 'blogposttype'),
		"blog_tag" => __('Tags', 'blogposttype'),
		"author" => __('Author', 'blogposttype'),
		"comments" => __('Comments', 'blogposttype'),
		"date" => __('Date', 'blogposttype'),
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

add_filter( 'manage_edit-portfolio_columns', 'blogposttype_edit_columns' );
 
function blogposttype_columns_display($portfolio_columns, $post_id){

	switch ( $portfolio_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		case "thumbnail":
			$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'blogposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "blog_category":
			
			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'blogposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "blog_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'blogposttype');
			}
			break;			
	}
}

add_action( 'manage_posts_custom_column',  'blogposttype_columns_display', 10, 2 );

/**
 * Add Portfolio count to "Right Now" Dashboard Widget
 */

function add_portfolio_counts() {
        if ( ! post_type_exists( 'blog' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'blog' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'blog Item', 'blog Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=blog'>$num</a>";
            $text = "<a href='edit.php?post_type=blog'>$text</a>";
        }
        echo '<td class="first b b-blog">' . $num . '</td>';
        echo '<td class="t blog">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'blog Item Pending', 'blog Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=blog'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=blog'>$text</a>";
            }
            echo '<td class="first b b-blog">' . $num . '</td>';
            echo '<td class="t blog">' . $text . '</td>';

            echo '</tr>';
        }
}

add_action( 'right_now_content_table_end', 'add_portfolio_counts' );

/**
 * Add contextual help menu
 */
 


add_action( 'contextual_help', 'blogposttype_add_help_text', 10, 3 );

/**
 * Displays the custom post type icon in the dashboard
 */

function blogposttype_portfolio_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo plugin_dir_url( __FILE__ ); ?>images/portfolio-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-portfolio {background: url(<?php echo plugin_dir_url( __FILE__ ); ?>images/portfolio-32x32.png) no-repeat;}
    </style>
<?php }

add_action( 'admin_head', 'blogposttype_portfolio_icons' );

?>