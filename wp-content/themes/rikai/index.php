<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); ?>
    
    <div id="primary" class="content-sidebar-wrap">
        
        <?php do_action( 'before_main_content' ) ?>

        <main id="main" class="site-main" role="main">

            <?php do_action( 'before_loop_main_content' ) ?>
            
            <?php 
				echo '<div id="product">';
					echo do_shortcode('[uniproduct posts_per_page="3" categories="15" style="grid" numcol="3"]');
				echo '</div>';
				echo '<div id="blogs">';
					echo do_shortcode('[uniblog posts_per_page="3" categories="17" number_character="140" style="3"]');
				echo '</div>';
			?>

        </main><!-- #main -->

        <?php do_action( 'after_main_content' );?>
        
    </div><!-- #primary -->
    
<?php
get_footer();