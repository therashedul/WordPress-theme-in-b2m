<?php
/**
 * The front page template file

 * @version 1.0
 */
get_header();
?>

<?php require_once 'breadcurmbe.php'; ?>
<section class="about-panel">
    <div class="container">           
        <div class="row bg-squ">
            <?php
            // Show the selected front page content.
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/page/content', 'front-page');
                endwhile;
            else :
                get_template_part('template-parts/post/content', 'none');
            endif;
            ?>

            <?php
            // Get each of our panels and show the post data.
            if (0 !== twentyseventeen_panel_count() || is_customize_preview()) : // If we have pages to show.
                $num_sections = apply_filters('twentyseventeen_front_page_sections', 4);
                global $twentyseventeencounter;
                for ($i = 1; $i < ( 1 + $num_sections ); $i++) {
                    $twentyseventeencounter = $i;
                    twentyseventeen_front_page_section(null, $i);
                }
            endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
            ?>
        </div><!-- #primary -->
    </div><!-- #primary -->
</section>><!-- #primary -->

<?php
get_footer();
