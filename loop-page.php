<?php
/**
 * The loop that displays a page
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage ifma
 * @since IFMA 1.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( ! is_singular() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<p class="entry-date"><?php echo get_the_date( 'm/d/y', get_the_ID() ); ?></p>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ifma' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'ifma' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php if ( is_singular() && ! is_front_page() ) { comments_template( '', true ); } ?>

<?php endwhile; // end of the loop. ?>
