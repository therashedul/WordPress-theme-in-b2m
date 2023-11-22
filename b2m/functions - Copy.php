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

require_once('bs4navwalker.php');
require get_parent_theme_file_path('/template-parts/custom.php');
require get_parent_theme_file_path('/template-parts/setup.php');

@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

function twentyseventeen_content_width() {
    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (twentyseventeen_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    $GLOBALS['content_width'] = apply_filters('twentyseventeen_content_width', $content_width);
}

add_action('template_redirect', 'twentyseventeen_content_width', 0);

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
    $fonts_url = '';

    $libre_franklin = _x('on', 'Open Sans font: on or off', 'twentyseventeen');

    if ('off' !== $libre_franklin) {
        $font_families = array();

        $font_families[] = 'Open Sans, sans-serif ,Oswald, Roboto, Roboto Condensed';


        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.google.com/');
    }

    return esc_url_raw($fonts_url);
}

function twentyseventeen_resource_hints($urls, $relation_type) {
    if (wp_style_is('twentyseventeen-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2);

/**
 * theme widgets.
 */
require get_parent_theme_file_path('/template-parts/widgets.php');

function twentyseventeen_excerpt_more($link) {
    if (is_admin()) {
        return $link;
    }

    $link = sprintf(
            '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>', esc_url(get_permalink(get_the_ID())),
            /* translators: %s: Name of current post */ sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}

add_filter('excerpt_more', 'twentyseventeen_excerpt_more');

function twentyseventeen_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'twentyseventeen_pingback_header');

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once( get_parent_theme_file_path('/inc/color-patterns.php') );
    $hue = absint(get_theme_mod('colorscheme_hue', 250));

    $customize_preview_data_hue = '';
    if (is_customize_preview()) {
        $customize_preview_data_hue = 'data-hue="' . $hue . '"';
    }
    ?>
    <style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
        <?php echo twentyseventeen_custom_colors_css(); ?>
    </style>
    <?php
}

add_action('wp_head', 'twentyseventeen_colors_css_wrap');

/**
 * Enqueues scripts and styles.
 */
require get_parent_theme_file_path('/template-parts/scripts.php');

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles() {
    // Block styles.
    wp_enqueue_style('twentyseventeen-block-editor-style', get_theme_file_uri('/assets/css/editor-blocks.css'), array(), '1.1');
    // Add custom fonts.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);
}

add_action('enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles');

function twentyseventeen_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];
    if (740 <= $width) {
        $sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
    }
    if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
        if (!( is_page() && 'one-column' === get_theme_mod('page_options') ) && 767 <= $width) {
            $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
        }
    }
    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2);

function twentyseventeen_header_image_tag($html, $header, $attr) {
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}

add_filter('get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3);

function twentyseventeen_post_thumbnail_sizes_attr($attr, $attachment, $size) {
    if (is_archive() || is_search() || is_home()) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3);

function twentyseventeen_front_page_template($template) {
    return is_home() ? '' : $template;
}

add_filter('frontpage_template', 'twentyseventeen_front_page_template');

function twentyseventeen_widget_tag_cloud_args($args) {
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    $args['format'] = 'list';

    return $args;
}

add_filter('widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args');

function twentyseventeen_unique_id($prefix = '') {
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
//add_action( 'some_action_name',  array('WP_Maintenance_Mode', 'method_name') );
//add_action( 'some_action_name',  'WP_Maintenance_Mode::method_name' );
//add_filter( 'some_filter_name',  array('WP_Maintenance_Mode', 'method_name') );

//require get_parent_theme_file_path('/inc/option.php');
//require get_parent_theme_file_path('/inc/another-option.php');

//include_once ('custom/post-service.php');
//include_once ('custom/post-portfolio.php');
// theme 
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/custom/');
    require_once dirname(__FILE__) . '/custom/options-framework.php';
}
?>



<?php
/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

function wpb_remove_version() {
    return "";
}

add_filter('the_generator', 'wpb_remove_version');
