<?php

/**
 * @package WP Equal Columns
 * @author Anthony Acosta
 * @version 1.0
 */

/*

Plugin Name: WP Equal Columns

Plugin URI: http://kennedymedia.com/

Description: Make the columns in your theme of equal length.  NOTE: Your theme must use the following column names: "rightnav","bodycontent","leftnav","sidebar","sidebar1","sidebar2","content".  You can modify the equalcolumns.js Line 2 to contain any column definitions you may have for your theme.

Author: Anthony Acosta

Version: 1.0

Author URI: http://kennedymedia.com/

*/


/*  Copyright 2009  ANTHONY ACOSTA  (email : anthony@kennedymedia.com)



    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License as published by

    the Free Software Foundation; either version 2 of the License, or

    (at your option) any later version.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/



/**
 * Call the Equal Columns javascript
 */

add_action('wp_head', 'addHeaderCode');



function addHeaderCode() {

	echo '<!-- Equal Columns Script Begins -->' . "\n";

	?>

	<script src="<?php echo get_bloginfo('wpurl') . '/' . PLUGINDIR . '/wp-equal-columns/equalcolumns.js'; ?>" type="text/javascript"></script>

    <?

	echo '<!-- Equal Columns Script Ends -->' . "\n";

}

?>