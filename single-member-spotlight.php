<?php
/**
 * Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage ifma
 * @since IFMA 1.0
 */

get_header(); ?>

		<div id="sidebar" class="sidebar-left">
			<?php get_sidebar('memberspotlight'); ?>
		</div>

		<div id="container" class="column-left">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php echo get_the_title(); ?></h1>
			<?php endwhile; // end of the loop. ?>

			<?php
			/*
			 * Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
