<?php
/**
 * Displays content for about page *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
  <header class="entry-header">
        <?php the_title('<h1 class="entry-title page-title">', '</h1>'); ?>
        <?php twentyseventeen_edit_link(get_the_ID()); ?>
    </header><!-- .entry-header -->
    <div class="entry-content">
         <div class="page-single-img">
            <?php
            if ( has_post_thumbnail() ) {
            the_post_thumbnail('b2m-featured-image',array( 'class' => 'alignleft' ));
            }
            ?>
        </div>
        <?php
        the_content();
        wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __('Pages:', 'twentyseventeen'),
                    'after' => '</div>',
                )
        );
        ?>
    </div><!-- .entry-content -->
