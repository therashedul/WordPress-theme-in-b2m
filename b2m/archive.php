<?php
/**
 * The template for displaying archive pages
 * @version 1.0
 */
get_header();
?>

<?php require_once 'breadcurmbe.php'; ?>
<section class="about-panel">
    <div class="container">           
        <div class="row bg-squ">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="taxonomy-description">', '</div>');
                    ?>
                </header><!-- .page-header -->
            <?php endif; ?>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php
                    if (have_posts()) :
                        ?>
                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/post/content', get_post_format());
                        endwhile;
                    else :
                        get_template_part('template-parts/post/content', 'none');
                    endif;
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .wrap -->
    </div><!-- .wrap -->
</section>><!-- .wrap -->

<?php
get_footer();
