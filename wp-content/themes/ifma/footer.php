<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage ifma
 * @since IFMA 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/*
	 * A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				IFMA San Diego • PO Box 712322 • Santee, CA 92072 • Phone (877) 443-6273 • Fax (858) 228-4365 • <a href="mailto:administrator@ifmasandiego.org">administrator@ifmasandiego.org</a> • <a href="mailto:webmaster@ifmasandiego.org">webmaster@ifmasandiego.org</a>
			</div><!-- #site-info -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/*
	 * Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
