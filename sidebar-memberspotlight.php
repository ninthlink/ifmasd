<?php
/**
 * Sidebar template containing the primary and secondary widget areas
 *
 * @package WordPress
 * @subpackage ifma
 * @since IFMA 1.0
 */
?>

<?php

$parent_id = get_the_ID();
$args = array( 'post_type' => 'member-spotlight', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
						

?>
	<div id="nav-sidebar">
		<div class="menu-menu-1-container">
			<ul id="menu-menu-2" class="menu">
				<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item current_page_item menu-item-has-children"><a href="<?php echo get_bloginfo('url'); ?>/member-spotlight/">Member Spotlight</a>
					<ul class="sub-menu">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php $page_id = get_the_ID(); ?>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?php echo $page_id; ?> <?php echo ( is_single() && $parent_id == $page_id) ? 'current-menu-item current_page_item' : '' ?>"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>


	<?php
	/*
	 * When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */

	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

	<?php endif; ?>
