<?php
function twentyseventeen_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null);

    // Theme Reset stylesheet.
    wp_enqueue_style('twentyseventeen-reset', get_theme_file_uri('assets/css/reset.css'), array('twentyseventeen-style'), '1');
    
    // Theme stylesheet.
    wp_enqueue_style('twentyseventeen-style', get_stylesheet_uri());
    
        
    // Theme bootstrap stylesheet.
    wp_enqueue_style('twentyseventeen-bootstap-style', get_theme_file_uri('assets/bootstrap/css/bootstrap.css'), array('twentyseventeen-style'), '4.1');    

//     Theme block stylesheet.
      wp_enqueue_style('twentyseventeen-block-style', get_theme_file_uri('/assets/css/blocks.css'), array('twentyseventeen-style'), '1.1');

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('twentyseventeen-style'), '1.0');
        

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

    }
    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('twentyseventeen-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('twentyseventeen-style'), '1.0');
        wp_style_add_data('twentyseventeen-ie9', 'conditional', 'IE 9');
    }
    	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
        
  // Theme Responsive stylesheet.
    wp_enqueue_style('twentyseventeen-responsive', get_theme_file_uri('assets/css/responsive.css'), array('twentyseventeen-style'), '1');

    wp_enqueue_script('twentyseventeen-bootstrap', get_theme_file_uri('/assets/bootstrap/js/bootstrap.min.js'), array('jquery'), '4.0', true);
    

//wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

}
add_action('wp_enqueue_scripts', 'twentyseventeen_scripts');