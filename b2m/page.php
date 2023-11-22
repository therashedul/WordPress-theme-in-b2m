<?php
/**
 * The template for displaying all pages
 *
 */
get_header();
?>
<?php require_once 'breadcurmbe.php'; ?>
<section class="about-panel">
    <div class="container">           
        <div class="row bg-squ">
            <div class="col-xs-12 col-md-12">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/page/content', 'page');
                endwhile; // End of the loop.
                ?>
            </div>                     
        </div>     
    </div>
</section>
<?php
get_footer();
