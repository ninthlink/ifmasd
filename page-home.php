<?php
/**
 * Template Name: Home Page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage ifma
 * @since IFMA 1.0
 */

get_header(); ?>

		<div id="home-widget-bar" class="widget-area" role="complementary">
			<ul class="home-top-widgets">
				<li>
					<ul>
						<?php dynamic_sidebar( 'home-widget-area-1' ); ?>
					</ul>
				</li>
				<li>
					<ul>
						<li id="text-3" class="widget-container widget_text member-spotlight-widget">
							<?php // dynamic_sidebar( 'home-widget-area-2' ); ?>

							<?php $member_loop = new WP_Query( array( 'post_type' => 'member-spotlight', 'posts_per_page' => 1 ) ); ?>
							
							<?php while ( $member_loop->have_posts() ) : $member_loop->the_post(); ?>
							<h3 class="widget-title">MEMBER SPOTLIGHT</h3>
							<div class="textwidget">
								<?php print( types_render_field("member-thumbnail", array("output"=>"html")) ); ?>
								<ul>
									<li><a href="<?php echo get_post_permalink(); ?>"><?php print( types_render_field("member-name", array("output"=>"html")) ); ?></a></li>
									<li><a href="<?php echo get_post_permalink(); ?>"><?php print( types_render_field("member-title", array("output"=>"html")) ); ?></a></li>
									<li><a href="<?php echo get_post_permalink(); ?>"><?php if (types_render_field("member-optional", array("output"=>"ray"))) print( types_render_field("member-optional", array("output"=>"html")) ); ?></a></li>
								</ul>
							</div>
							<?php endwhile;?>

							<?php wp_reset_query(); ?>

						</li>
					</ul>
				</li>
				<li>
					<ul>
						<li id="text-4" class="widget-container widget_text">
							<h3 class="widget-title">SPONSORS</h3>
							<div class="textwidget">				
								<?php putRevSlider( "sponsored" ) ?>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>

		<div id="container" class="column-right">
			<div id="content" role="main">

			<?php get_template_part( 'part', 'pagetitle' ); ?>

			<?php
			/*
			 * Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'home' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

		<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
		</div>

<?php get_footer(); ?>
