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
 * @package sshop
 */

get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">

        <div class="home-content-sidebar sidebar">
        <?php dynamic_sidebar('sidebar-home'); ?>
        </div>


        <main id="main" class="site-main" role="main">

        </main><!-- #main -->

	</div><!-- #primary -->

<?php
//get_sidebar();
?>
</div>
<?php
get_footer();
