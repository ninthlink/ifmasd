<?php
/*
Plugin Name: WP Facebook Like
Version: 1.5.2
Description: WP Facebook Like makes it easy to integrate the Facebook Like button. Choose to automatically append the button before or after the content, use a shortcode, or use a template tag to place the button where ever you want.
Author: Johnny Chadda
Plugin URI: http://johnny.chadda.se/projects/wp-facebook-like/
Author URI: http://johnny.chadda.se/
*/

// Check if we are running PHP5 or above, otherwise die with an error message.
function wpfblike_activation_check()
{
	if (version_compare(PHP_VERSION, '5.0.0', '<'))
	{
		deactivate_plugins(basename(__FILE__));
		wp_die("Sorry, but you can't run this plugin, it requires PHP 5 or higher.");
	}
}
register_activation_hook(__FILE__, 'wpfblike_activation_check');


// Shortcode [wpfblike] for inclusion in posts.
// optional arguments:
// - href: the url to like (defaults to the current page)
// - layout: the button layout (default: "button_count") (button_count, standard)
// - show_faces: Show faces of the people who liked this page (bool) (default: true) (true, false)
// - colorscheme: Color of the like button (default: light) (light, dark)
// - width: The width of the iframe (default: 100)
// This function can also be used as a template tag. If you want to include arguments,
// do the function call like this: wpfblike(array('colorcheme'=>'dark','show_faces'=>'false'));

class WPFBLike
{
	function __construct()
	{
		// Initialize the internationalization support
		// Function deprecated
		//load_plugin_textdomain('wpfblike', dirname(__FILE__));
		
		// Get stored values or set defaults
		$this->layout = get_option('wpfblike_layout', 'standard');
		$this->show_faces = get_option('wpfblike_show_faces', 'true');
		$this->colorscheme = get_option('wpfblike_colorscheme', 'light');
		$this->width = get_option('wpfblike_width', '400');
		$this->autoinsert = get_option('wpfblike_autoinsert', 'after');
		$this->embedmethod = get_option('wpfblike_embedmethod', 'xfbml');
		$this->action = get_option('wpfblike_action', 'like');
		$this->show_singleonly = get_option('wpfblike_show_singleonly', 'false');
		$this->show_posts = get_option('wpfblike_show_posts', 'true');
		$this->show_pages = get_option('wpfblike_show_pages', 'true');
		$this->permalinktype = get_option('wpfblike_permalinktype', 'permalink');
		$this->fbappid = get_option('wpfblike_fbappid', 'null');
		$this->fbadmins = get_option('wpfblike_fbadmins', '');
		$this->fbsdkenable = get_option('wpfblike_fbsdkenable', 'true');
		$this->fblanguage = get_option('wpfblike_fblanguage', 'automatic');
		$this->opengraph = get_option('wpfblike_opengraph', 'false');
		$this->height = get_option('wpfblike_height', '');
		$this->cssstyle = get_option('wpfblike_cssstyle', '');
		$this->buttonpriority = get_option('wpfblike_buttonpriority', '10');
		$this->fbsend = get_option('wpfblike_fbsend', 'false');
		
		// Fix default options
		if ($this->fbappid == '')
		{
			$this->fbappid = 'null';
		}
		
		// Fix the language
		if ($this->fblanguage == 'automatic')
		{
			$this->fblanguage = strtr(get_bloginfo('language', false), '-', '_');
		}
		
		// Add options page and settings
		add_action('admin_menu', array(&$this, 'register_settings'));
		add_action('admin_menu', array(&$this, 'get_settings_menu'));
		
		// Insert the Open Graph headers if enabled
		add_action('wp_head', array(&$this, 'insert_opengraph'));
		
		// Enqueue the Facebook Javascript SDK
		add_action('loop_start', array(&$this, 'get_footer'));
		
		// Autoinsert the button if configured
		add_action('loop_start', array(&$this, 'autoinsert'));
		
		// Add shortcode for handling the [wpfblike] shortcode
		add_shortcode('wpfblike', array(&$this, 'get_button'));
		
		// Add a settings link in the plugin listing
		add_filter('plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2);
	}
		
	function register_settings()
	{
		register_setting('wpfblike_options', 'wpfblike_layout');
		register_setting('wpfblike_options', 'wpfblike_show_faces');
		register_setting('wpfblike_options', 'wpfblike_colorscheme');
		register_setting('wpfblike_options', 'wpfblike_width');
		register_setting('wpfblike_options', 'wpfblike_autoinsert');
		register_setting('wpfblike_options', 'wpfblike_embedmethod');
		register_setting('wpfblike_options', 'wpfblike_action');
		register_setting('wpfblike_options', 'wpfblike_show_singleonly');
		register_setting('wpfblike_options', 'wpfblike_show_posts');
		register_setting('wpfblike_options', 'wpfblike_show_pages');
		register_setting('wpfblike_options', 'wpfblike_permalinktype');
		register_setting('wpfblike_options', 'wpfblike_fbappid');
		register_setting('wpfblike_options', 'wpfblike_fbadmins');
		register_setting('wpfblike_options', 'wpfblike_fbsdkenable');
		register_setting('wpfblike_options', 'wpfblike_fblanguage');
		register_setting('wpfblike_options', 'wpfblike_opengraph');
		register_setting('wpfblike_options', 'wpfblike_height');
		register_setting('wpfblike_options', 'wpfblike_cssstyle');
		register_setting('wpfblike_options', 'wpfblike_buttonpriority');
		register_setting('wpfblike_options', 'wpfblike_fbsend');
	}
	
	function autoinsert()
	{
		if ($this->autoinsert != 'false')
		{
			if ($this->check_insert_granted())
			{
				$this->insert_button();
			}
		}
	}
	
	function insert_opengraph()
	{
		if ($this->opengraph == 'true' && $this->check_insert_granted())
		{
			echo "<meta property='og:title' content='".get_the_title()."'/>\r\n";
			echo "<meta property='og:url' content='".get_permalink()."'/>\r\n";
			echo "<meta property='og:site_name' content='".get_bloginfo('name')."'/>\r\n";
			echo "<meta property='og:type' content='website'/>\r\n";
			echo "<meta property='fb:app_id' content='".$this->fbappid."'/>\r\n";
			echo "<meta property='fb:admins' content='".$this->fbadmins."'/>\r\n";
		}
	}
	
	function insert_button()
	{
		switch($this->autoinsert)
		{			
			case 'before':
				add_action('the_content', array(&$this, 'get_content_button_before'), $this->buttonpriority);
			break;
			
			case 'after':
				add_action('the_content', array(&$this, 'get_content_button_after'), $this->buttonpriority);
			break;
			
			case 'both':
				add_action('the_content', array(&$this, 'get_content_button_before'), $this->buttonpriority);
				add_action('the_content', array(&$this, 'get_content_button_after'), $this->buttonpriority);
			break;
			
			default:
			break;
		}
	}
	
	function get_settings_menu()
	{
		add_options_page('WP Facebook Like', 'WP Facebook Like', 'administrator', 'wpfblike-options', array(&$this, 'get_settings_page'));
	}
	
	function get_settings_page()
	{
		include(dirname(__FILE__) . '/admin-options.php');
	}
	
	function get_footer()
	{
		switch ($this->embedmethod)
		{
			case 'xfbml':
				if ($this->fbsdkenable == 'true' && $this->check_insert_granted())
				{
					echo "<div id='fb-root'></div>
					<script type='text/javascript'>
						window.fbAsyncInit = function()
						{
							FB.init({appId: $this->fbappid, status: true, cookie: true, xfbml: true});
						};
						(function()
						{
							var e = document.createElement('script'); e.async = true;
							e.src = document.location.protocol + '//connect.facebook.net/$this->fblanguage/all.js';
							document.getElementById('fb-root').appendChild(e);
						}());
					</script>	
					";
				}
			break;
			
			case 'iframe':
			break;
			
			default:
			break;
		}
	}
	
	function get_button($atts = null)
	{
		// Get the permalink using the chosen method
		$href_def = '';
		
		switch ($this->permalinktype)
		{
			case 'permalink':
				$href_def =  get_permalink();
			break;
			
			case 'server':
				$href_def = $this->get_current_url();
			break;
			
			default:
				$href_def =  get_permalink();
			break;
		}
		
		// Parse the parameters. They are dynamically created as local variables.
		extract(shortcode_atts(array(
			'href'=> $href_def,
			'layout' => $this->layout,
			'show_faces' => $this->show_faces,
			'colorscheme' => $this->colorscheme,
			'width' => $this->width,
			'action' => $this->action,
			'fbsend' => $this->fbsend
		), $atts));
		
		$style = '';
		if ($this->cssstyle != '')
		{
			$style = "style='{$this->cssstyle}'";
		}
		elseif ($this->height != '')
		{
			$style = "style='height: {$this->height}px;'";
		}

		// Fix for Facebook changing the layout parameter value
		if ($layout == "default")
		{
			$layout = "standard";
		}
		
		$fbtn  = '';
		switch ($this->embedmethod)
		{
			case 'xfbml':
				$fbtn = "<div class='wpfblike' $style><fb:like href='$href' layout='$layout' show_faces='$show_faces' width='$width' action='$action' colorscheme='$colorscheme' send='$fbsend' /></div>";
			break;
			
			case 'iframe':
				$fbtn = "<div class='wpfblike' $style><iframe src='http://www.facebook.com/plugins/like.php?href=$href&amp;layout=$layout&amp;show_faces=$show_faces&amp;width=$width&amp;action=$action&amp;colorscheme=$colorscheme&amp;send=$fbsend' scrolling='no' frameborder='0' allowTransparency='true' style='border:none; overflow:hidden; width:{$width}px;'></iframe></div>";
			break;
			
			default:
			break;
		}
		
		return $fbtn;
	}
	
	function get_content_button_before($content)
	{
		if ($this->check_insert_post())
		{
			return $this->get_button() . $content;
		}
		
		return $content;
	}
	
	function get_content_button_after($content)
	{
		if ($this->check_insert_post())
		{
			return $content . $this->get_button();
		}
		
		return $content;
	}
	
	function get_current_url()
	{
		$url = 'http';
		
		if (array_key_exists('HTTPS', $_SERVER))
		{
			$url .= 's';
		}
		
		$url .= '://';
		
		if ($_SERVER['SERVER_PORT'] != '80' && $_SERVER['SERVER_PORT'] != '443')
		{
			$url .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
		}
		else
		{
			$url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		}
		
		return $url;
	}
	
	function check_insert_granted()
	{
		$check = false;
		
		// Check if okay to show on front page
		if (!is_singular())
		{
			if ($this->show_singleonly == 'false' && 
				$this->permalinktype != 'server' && 
				$this->opengraph == 'false')
			{
				$check = true;
			}
		}
		
		// Show on posts
		if (is_single() && $this->show_posts == 'true')
		{
			$check = true;
		}
		
		// Show on pages
		if (is_page() && $this->show_pages == 'true')
		{
			$check = true;
		}
		
		return $check;
	}
	
	function check_insert_post()
	{
		$check = false;
		$meta_flag = get_post_meta(get_the_ID(), "wpfblike", true);
		
		if ($meta_flag != "false")
		{
			$check = true;
		}
		
		return $check;
	}
	
	function plugin_action_links($links, $file)
	{
		static $this_plugin;
		if (!$this_plugin)
		{
			$this_plugin = plugin_basename(__FILE__);
		}
		
		if ($file == $this_plugin)
		{
			$settings_link = '<a href="options-general.php?page=wpfblike-options">' . __('Settings') . '</a>';
			array_unshift($links, $settings_link);
		}
		
		return $links;
	}
}

$wpfblike = new WPFBLike();

// Get a custom button. Input argument as the array below
// or in URL format.
function wpfblike($args = null)
{
	global $wpfblike;
	
	$button_default = array(
		'layout' => $wpfblike->layout,
		'show_faces' => $wpfblike->show_faces,
		'colorscheme' => $wpfblike->colorscheme,
		'width' => $wpfblike->width,
		'action' => $wpfblike->action
	);
	
	$button_args = wp_parse_args($args, $button_default);
	
	return $wpfblike->get_button($button_args);
}

function wpfblikeisselected($option, $compare)
{
	if ($option == $compare)
	{
		return 'selected="selected"';
	}
	return '';
}

?>
