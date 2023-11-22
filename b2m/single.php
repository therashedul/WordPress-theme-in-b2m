<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<?php require_once 'breadcurmbe.php'; ?>
<section class="about-panel">
    <div class="container">           
        <div class="row bg-squ">   
            <?php
            /* Start the Loop */
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/post/content', get_post_format());
            endwhile; // End of the loop.
            ?>
        </div><!-- #main -->
    </div><!-- #primary -->
</section><!-- .wrap -->

<?php
get_footer();
