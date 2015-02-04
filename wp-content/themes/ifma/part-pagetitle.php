<?php
/**
 * Render page title
 *
 */
?>
<h1 class="page-title"><?php

if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page
    echo 'Events Calendar';
} elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages
    echo 'Events Calendar' . ' &raquo; ' . single_term_title('', false);
} elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) { // The Main Events List
    echo 'Events List';
} elseif( tribe_is_event() && is_single() ) { // Single Events
    echo get_the_title();
} elseif( tribe_is_day() ) { // Single Event Days
    echo 'Events on: ' . date('F j, Y', strtotime($wp_query->query_vars['eventDate']));
} elseif( tribe_is_venue() ) { // Single Venues
    echo get_the_title();
} else {
    echo get_the_title();
}

?></h1>