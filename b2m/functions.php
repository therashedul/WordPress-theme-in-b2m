<?php
/**
 * B2M *
 * @link http://www.b2m-tech.com/ *
 * @package B2M
 * @subpackage B2M
 * @since 1.0
 */
/**
 * B2M theme only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

//Custom login url change
// require get_parent_theme_file_path('/template-parts/login_url.php');


//add_filter('site_url',  'wpadmin_filter', 10, 3);
// function wpadmin_filter( $url, $path, $orig_scheme ) {
//  $old  = array( "/(wp-admin)/");
//  $admin_dir = WP_ADMIN_DIR;
//  $new  = array($admin_dir);
//  return preg_replace( $old, $new, $url, 1);
// }
//add_action('init','custom_login');
//
//function custom_login(){
// global $pagenow;
// if( 'wp-login.php' == $pagenow && $_GET['action']!="logout") {
//  wp_redirect('http://192.168.6.20/b2m/');
//  exit();
// }
//}
// Bootstrap nav link styles.
require_once('bs4navwalker.php');
//Cusomt login
require get_parent_theme_file_path('/template-parts/login_page.php');
//Setup part
require get_parent_theme_file_path('/template-parts/setup.php');
require get_parent_theme_file_path('/template-parts/content.php');

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
    $fonts_url = '';
    $libre_franklin = _x('on', 'Libre Franklin font: on or off', 'twentyseventeen');

    if ('off' !== $libre_franklin) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

require get_parent_theme_file_path('/template-parts/resource.php');
require get_parent_theme_file_path('/template-parts/widgets.php');
require get_parent_theme_file_path('/template-parts/excerpt.php');

function twentyseventeen_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'twentyseventeen_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'twentyseventeen_pingback_header');
/**
 * Enqueues scripts and styles.
 */
require get_parent_theme_file_path('/template-parts/scripts.php');

function twentyseventeen_block_editor_styles() {
    // Block styles.
    wp_enqueue_style('twentyseventeen-block-editor-style', get_theme_file_uri('/assets/css/editor-blocks.css'), array(), '1.1');
    // Add custom fonts.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);
}

add_action('enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles');

require get_parent_theme_file_path('/template-parts/content_page.php');

function twentyseventeen_unique_id($prefix = '') {
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string) ++$id_counter;
}

//Cusotm post type
//include_once ('custom/post-service.php');
//theme Option
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/custom/');
    require_once dirname(__FILE__) . '/custom/options-framework.php';
}

require get_parent_theme_file_path('/template-parts/custom_link.php');

//Cusomt post type for shortcode
add_shortcode('service-list', 'bpo_service_list');
function bpo_service_list($atts) {
    $atts = shortcode_atts(array(
        'category' => ''
            ), $atts);
    $terms = get_terms('service_category');
    wp_reset_query();
    $args = array('post_type' => 'service',
        'tax_query' => array(
            array(
                'taxonomy' => 'service_category',
                'field' => 'slug',
                'terms' => $atts,
            ),
        ),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            ?>
            <a href="<?php the_permalink(); ?>"><?= the_title(); ?></a>
            <?php
            echo ' "' . get_the_title() . '" ';
        endwhile;
    }
    else {
        echo 'Sorry, no posts were found';
    }
}
//=====================================================================
