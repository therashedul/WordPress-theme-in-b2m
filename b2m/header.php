<?php
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <html <?php language_attributes(); ?> class="no-js no-svg">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta content="" name="keywords">
            <meta content="" name="description">             
            <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Roboto|Roboto+Condensed" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
            <?php wp_head(); ?>
        </head>
        <body <?php body_class(); ?>>
            <!--header-->
            <div class="top-panel">
                <div class="container ">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 float-left">
                            <div class="top-left">
                                <?php echo of_get_option('address', 'No Entry'); ?>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 float-right">                                
                            <div class="top-right">
                                <?php echo of_get_option('social_icon', 'No Entry'); ?>
<!--                                <ul>
                                    <li><a class="twitter-font" href="https://twitter.com/"><i class="fab fa-2x fa-twitter-square"></i></a></li>
                                    <li><a class="google-font" href="https://plus.google.com/"><i class="fab fa-2x fa-google-plus-square"></i></a></li>
                                    <li><a class="facebook-font" href="https://www.facebook.com/"><i class="fab fa-2x fa-facebook-square"></i></a></li>
                                </ul>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/top header-->
            <header class="header-part">    
                <div class="container">
                    <div class="row bg">                   
                        <div class="col-xs-6 col-md-6 float-left logo-panel">
                            <?php
                            $va = of_get_option('b2m_image');
                            if (!empty($va)):
                                ?>
                                <a href="<?php echo site_url('/'); ?>">  <img src="<?php echo of_get_option('b2m_image', 'no entry'); ?>" /></a>

                            <?php endif; ?>
                        </div>
                        <div class="col-xs-6 col-md-6 float-right logo-right">
                            <?php
                            $va = of_get_option('zing_image');
                            if (!empty($va)):
                                ?>
                                <a href="<?php echo site_url('/'); ?>">  <img class="right-img" src="<?php echo of_get_option('zing_image', 'no entry'); ?>" /></a>

                            <?php endif; ?>
                        </div>                        
                    </div>              
                    <nav class="navbar navbar-expand-lg navbar-dark text-uppercase top-navbar" data-toggle="sticky-onscroll" >
                        <div class="container">
                            <!--<a class="navbar-brand" href="#"></a>-->
                            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <?php
                            wp_nav_menu([
                                'menu' => 'primary',
                                'theme_location' => 'primary',
                                'depth' => 2,
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse justify-content-end',
                                'container_id' => 'collapsibleNavbar',
                                'menu_class' => 'navbar-nav mr-auto',
                                'fallback_cb' => 'bs4navwalker::fallback',
                                'walker' => new bs4navwalker()
                            ]);
                            ?>
                        </div>
                    </nav>
                </div> 
            </header>
            <!--end header-->