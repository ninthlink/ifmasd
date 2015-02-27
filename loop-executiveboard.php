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


<div class="boardmembers">
	
	<?php $boardmember_args = array(
		'post_type' => 'executive-board',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);
	$boardmember_query = new WP_Query( $boardmember_args ); ?>

	<?php if ( $boardmember_query->have_posts() ) : ?>

		<?php while ( $boardmember_query->have_posts() ) : $boardmember_query->the_post(); ?>

		<div id="boardmember-<?php the_ID(); ?>" class="entry-content boardmember-entry">
			<div class="boardmember-part-l">
				<?php print( types_render_field("member-thumbnail", array("output"=>"html", "width"=>60, "height"=>82, "align"=>"left")) ); ?>
			</div>
			<div class="boardmember-part-r">
				<h3 class="entry-title"><?php print( types_render_field('member-title', array('output'=>'raw')) ); ?></h3>
				<span class="entry-contact">
					<a href="mailto:<?php print( types_render_field('email-address', array('output'=>'raw')) ); ?>">Email</a> <a href="<?php echo get_permalink(); ?>">Bio</a> <?php if (types_render_field('linkedin-profile', array('output'=>'raw'))) { ?><a href="<?php print( types_render_field('linkedin-profile', array('output'=>'raw')) ); ?>" target="_blank">LinkedIn</a><?php } ?>
				</span>
				<div><?php the_title(); ?></div>
				<?php print( types_render_field("member-awards", array("output"=>"html")) ); ?>
				<?php print( types_render_field("member-association", array("output"=>"html")) ); ?>
				<?php print( types_render_field("member-position", array("output"=>"html")) ); ?>
				<?php print( types_render_field("phone", array("output"=>"html")) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ifma' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'ifma' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		</div><!-- .entry-content -->

		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

</div>
<hr />

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">

			<?php the_content(); ?>

		</div>

	</div>

<?php endwhile; ?>
