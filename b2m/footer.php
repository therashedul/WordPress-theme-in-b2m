<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
?>
<!--footer-->
<footer class="footer-panel">
    <div class="container"> 
        <div class="row foo bg">
            <div class="col-xs-12 col-md-12">
                <div class="row footer-top">
                    <?php dynamic_sidebar('footer1'); ?>
                    <?php dynamic_sidebar('footer2'); ?>
                    <?php dynamic_sidebar('footer3'); ?>
                    <?php dynamic_sidebar('footer4'); ?>
                </div>
            </div>
        </div>
    </div>         
    <div class="footer-bottom">       
        <div class="col-sm-12 col-md-12">
            <div class="copyright-part">   
                <strong>
                   <?php // echo do_shortcode("[print-theme-setting id='company_name'] ");  ?>
                   <?php  //echo do_shortcode("[print-theme-setting id='company_address'] "); ?>                    
                </strong>
<!--                <img src="<?php // echo do_shortcode("[print-theme_setting id='company_logo'default='http://placehold.it/150*150']"); ?>"> -->

                
                <p><?php echo of_get_option('copyright_text', 'No Entry'); ?></p>              
            </div>
        </div>   
    </div>
    <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
</footer>

<!--end footer-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>-->
<script>
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

// Sticky navbar
// =========================
    $(document).ready(function () {
        // Custom function which toggles between sticky class (is-sticky)
        var stickyToggle = function (sticky, stickyWrapper, scrollElement) {
            var stickyHeight = sticky.outerHeight();
            var stickyTop = stickyWrapper.offset().top;
            if (scrollElement.scrollTop() >= stickyTop) {
                stickyWrapper.height(stickyHeight);
                sticky.addClass("is-sticky");
            }
            else {
                sticky.removeClass("is-sticky");
                stickyWrapper.height('auto');
            }
        };

        // Find all data-toggle="sticky-onscroll" elements
        $('[data-toggle="sticky-onscroll"]').each(function () {
            var sticky = $(this);
            var stickyWrapper = $('<div>').addClass('sticky-wrapper'); // insert hidden element to maintain actual top offset on page
            sticky.before(stickyWrapper);
            sticky.addClass('sticky');

            // Scroll & resize events
            $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
                stickyToggle(sticky, stickyWrapper, $(this));
            });

            // On page load
            stickyToggle(sticky, stickyWrapper, $(window));
        });
    });
</script>
<?php wp_footer(); ?>

</body>
</html>
