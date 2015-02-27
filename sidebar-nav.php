<?php

//if the post has a parent
if($post->post_parent) {
	$parent = $post->post_parent;
}
else{
	$parent = $post->ID;
}

$args = array(
	'post_parent' => $parent,
	'post_type'   => 'any', 
	'posts_per_page' => -1,
	'post_status' => 'any' );

$children = get_children( $args );

if ( !empty( $children ) && ! is_search() ) { ?>
	<div id="nav-sidebar">
		<?php echo wp_nav_menu( array( 'depth' => 2 ) ); ?>
	</div>
<?php } ?>