<?php
/**
 * The main template file
 */
get_header();
?>
<div class="slider carousel slide">
    <?php echo do_shortcode('[smartslider3 slider=2]'); ?>
</div>
<!--------------------/Slider-->
<!--main content-->
<section class="about-panel">
    <div class="container">
        <div class="row bg-squ">
            <div class="about-panel">
                <div class="col-xs-12 col-md-12">
                    <?php dynamic_sidebar('home-about'); ?>
                    <a href="<?php echo get_page_link(get_page_by_path('about')); ?>"> <img
                            src="<?php bloginfo('stylesheet_directory'); ?>/img/button-read-more.png"
                            style="width: 150px; margin-bottom: 30px;" /></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/About-->
<section class="service-panel">
    <div class="container">
        <!--service-->
        <div class="row bg-dot">
            <div class="col-xs-12">
                <div class="bottom-margin">
                    <?php dynamic_sidebar('home-service'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/service-->
<?php
get_footer();