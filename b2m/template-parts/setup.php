<?php

function twentyseventeen_setup() {

    load_theme_textdomain('twentyseventeen');
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_image_size('b2m-featured-image', 1100, 380, true);

    add_image_size('service-thum', 390, 190, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 1000;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
            array(
                'primary' => __('Primary Menu', 'twentysixteen'),
                'top' => __('Top Menu', 'twentyseventeen'),
                'footer' => __('footer Menu', 'twentyseventeen'),
            )
    );
    add_theme_support(
            'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
            )
    );

    add_theme_support(
            'post-formats', array(
        'aside',
        'image',
        'quote',
        'gallery',
            )
    );

    // Add theme support for Custom Logo.
    add_theme_support(
            'custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
            )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    add_editor_style(array('assets/css/editor-style.css', twentyseventeen_fonts_url()));

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // Load default block styles.
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    $starter_content = apply_filters('twentyseventeen_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}

add_action('after_setup_theme', 'twentyseventeen_setup');
