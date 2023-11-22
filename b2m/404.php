<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<section class="about-panel">
    <div class="container">           
        <div class="row bg-squ">          
            <header class="page-header title-404">
                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'twentyseventeen'); ?></h1>
            </header><!-- .page-header -->
            <div class="search-text">
                <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'twentyseventeen'); ?></p>
            </div>
            <div class="search-form">
                <?php get_search_form(); ?>
            </div><!-- .search-form -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
</section><!-- .error-404 -->

<?php
get_footer();
