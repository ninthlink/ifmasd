<?php
/**
 * The loop that displays user list
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
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ifma' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'ifma' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>


<form id="search-users-form" action method="post">
	<table>
		<tbody>
			<tr>
				<td>
					<label for="">Last Name:</label>
				</td>
				<td>
					<input type="text" name="last_name" value="<?php echo $_POST['last_name']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="">First Name:</label>
				</td>
				<td>
					<input type="text" name="first_name" value="<?php echo $_POST['first_name']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="">Company Name:</label>
				</td>
				<td>
					<input type="text" name="company" value="<?php echo $_POST['company']; ?>" />
				</td>
			</tr>
			<?php /*
			<tr>
				<td>
					<label for="">Business Type:</label>
				</td>
				<td>
					<input type="text" name="business_type" value="<?php echo $_POST['business_type']; ?>" />
				</td>
			</tr>
			*/ ?>
			<tr>
				<td>
					<label for="">City:</label>
				</td>
				<td>
					<input type="text" name="city" value="<?php echo $_POST['city']; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="buttons" value="Search" />
				</td>
			</tr>
		</tbody>
	</table>
</form>

<?php

if ( $_POST ) {

	$args = array(
		'role' => 'Subscriber',
		'meta_query' => array(
			'relation' => 'AND',
			0 => array(
				'key' => '_expire_user_date',
				'value' => time(),
				'compare' => '>'
				)
			),
	);

	foreach ($_POST as $key => $value) {
		if ( ! empty($value) ) {
			$args['meta_query'][] = array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE'
			);
		}
	}

	$users = get_users( $args );

	?>

	<?php foreach ( $users as $user ) { ?>
		<div id="user-<?php echo esc_html( $user->ID ); ?>" class="search-users-results">
			<?php echo esc_html( $user->first_name ); ?> <?php echo esc_html( $user->last_name ); ?><?php echo ( !empty( $user->designation ) ) ? ', ' . esc_html( $user->designation ) : ''; ?><br />
			<?php echo ( !empty($user->member_title) ) ? esc_html( $user->member_title ) . '<br />' : ''; ?>
			<?php echo ( !empty($user->company) ) ? esc_html( $user->company ) . '<br />' : ''; ?>
			<?php echo ( !empty($user->addr1) ) ? esc_html( $user->addr1 ) : ''; ?><?php echo ( !empty($user->addr2) ) ? ', ' . esc_html( $user->addr2 ) : ''; ?><br>
			<?php echo ( !empty($user->city) ) ? esc_html( $user->city ) . ', ': ''; ?><?php echo esc_html( $user->theState ); ?> <?php echo esc_html( $user->zip ); ?><br />
			<?php echo esc_html( $user->user_email ); ?><br />
			<?php echo ( !empty($user->phone_number) ) ? 'Work Phone: ' . esc_html( $user->phone_number ) . '<br />' : ''; ?>
			<?php echo ( !empty($user->phone3) ) ? 'Fax: ' . esc_html( $user->phone3 ) . '<br />' : ''; ?>
			<?php //echo ( !empty($user->business_type) ) ? 'Busniess Type: ' . esc_html( $user->business_type ) : ''; ?>
		</div>
		<hr />
	<?php } ?>

<?php } ?>
