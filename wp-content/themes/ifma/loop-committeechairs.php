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

		<div class="entry-content">
			
			<?php the_content(); ?>

		</div>

	</div>

<?php endwhile; ?>

<?php

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'committees',
	'pad_counts'               => false 
);

$committees = get_categories( $args ); ?>

<?php foreach ($committees as $committee) { ?>
	<div id="committee-<?php the_ID(); ?>" class="committee-category">
		
		<h2 class="entry-title"><?php echo $committee->name; ?></h2>

		<?php $committee_args = array(
			'post_type' => 'committee-chair',
			'tax_query' => array(
				array(
					'taxonomy' => 'committees',
					'field'    => 'id',
					'terms'    => $committee->cat_ID,
				),
			),
		);
		$committee_query = new WP_Query( $committee_args ); ?>

		<?php if ( $committee_query->have_posts() ) : ?>

			<?php while ( $committee_query->have_posts() ) : $committee_query->the_post(); ?>

			<div class="entry-content committee-entry">
				<div class="committee-part-l">
					<?php print( types_render_field("chair-thumbnail", array("output"=>"html", "width"=>60, "height"=>82, "align"=>"left")) ); ?>
				</div>
				<div class="committee-part-r">
					<h3 class="entry-title"><?php the_title(); ?></h3>
					<span class="entry-contact">
						<a href="mailto:<?php print( types_render_field('email-address', array('output'=>'raw')) ); ?>">Email</a> <a href="<?php print( types_render_field('linkedin-profile', array('output'=>'raw')) ); ?>" target="_blank">LinkedIn Profile</a>
					</span>
					<?php the_content(); ?>
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

<?php } ?>