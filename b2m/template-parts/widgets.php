<?php
function twentyseventeen_widgets_init() {
    register_sidebar(
            array(
                'name' => __('Blog Sidebar', 'twentyseventeen'),
                'id' => 'sidebar-1',
                'description' => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
    );

    register_sidebar(
            array(
                'name' => __('Footer 1', 'twentyseventeen'),
                'id' => 'footer1',
                'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
                'before_widget' => '<div class="widget col-sm-3 social-part">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title footer-title">',
                'after_title' => '</h3>',
            )
    );

    register_sidebar(
            array(
                'name' => __('Footer 2', 'twentyseventeen'),
                'id' => 'footer2',
                'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
                'before_widget' => '<div id="%1$s" class="widget col-sm-3">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title footer-title">',
                'after_title' => '</h3>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Footer 3', 'twentyseventeen'),
                'id' => 'footer3',
                'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
                'before_widget' => '<div id="%1$s" class="widget col-sm-3">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title footer-title">',
                'after_title' => '</h3>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Footer 4', 'twentyseventeen'),
                'id' => 'footer4',
                'description' => __('Add widgets here to appear in your footer.', 'twentyseventeen'),
                'before_widget' => '<div id="%1$s" class="widget col-sm-3">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title footer-title">',
                'after_title' => '</h3>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Home About', 'twentyseventeen'),
                'id' => 'home-about',
                'description' => __('Add widgets here to appear in your about text.', 'twentyseventeen'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="first-title">',
                'after_title' => '</h2>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Home Service', 'twentyseventeen'),
                'id' => 'home-service',
                'description' => __('Add widgets here to appear in service text.', 'twentyseventeen'),
                'before_widget' => '<div id="%1$s" class="home-service-panel">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="home-service-title first-title">',
                'after_title' => '</h2>',
            )
    );
}

add_action('widgets_init', 'twentyseventeen_widgets_init');