<?php
/* Template Name: Service */
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
                    get_template_part('template-parts/page/content', 'service');
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile; // End of the loop.\                
                ?>
            </div>                     
        </div>     
    </div>
</section>
<?php
get_footer();
