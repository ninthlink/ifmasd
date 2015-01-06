=== WP Facebook Like ===
Contributors: joch
Donate link: http://johnny.chadda.se/donate/
Tags: widget, social, facebook, like, send
Requires at least: 2.9
Tested up to: 3.9
Stable tag: 1.5.2

WP Facebook Like makes it easy to integrate the Facebook Like and Send buttons.

== Description ==
* Fully automatic — just install and enable the plugin
* Easily place the button before or after your post
* Choose to disable the button on the front page
* Disable the button in specific pages and posts
* Supports the Facebook Send button
* Custom settings available, including a shortcode and template tag
* Full language support for the Like button
* XFBML and Open Graph support
* Disable the button on specific posts

WP Facebook Like makes it easy to integrate the Facebook Like button. 
Choose to automatically append the button before or after the content, 
or use a template tag to place the button where ever you want.

The button will automatically be inserted after the post, but if you 
want the button to appear before the post, change the color or make 
the plugin only show the button and no faces, make those changes in the 
settings panel.

To see all available settings, have a look at the options screenshot.

To manually include the Like button in a post or page, set the plugin to 
disabled in the settings and include the [ wpfblike ] tag within the post.

Note that WP Facebook Like currently only supports PHP5.

= Template developers =

If you are a template developer, you may include the button where ever you 
want, as long as you stay within the WordPress loop. Just call the wpfblike()
function and echo the output to the correct place for your theme.

You can optionally pass arguments to the function if you want different
settings for default button. To get a default button, write the following:

<?php echo wpfblike(); ?>

To get a button with the count layout:

<?php echo wpfblike('layout=button_count'); ?>

You may concatenate multiple options as such:

<?php echo wpfblike('layout=button_count&colorscheme=dark&action=recommend'); ?>

The following options and values are currently recognized:

* layout (default, button_count)
* show_faces (true/false)
* colorscheme (light/dark/evil)
* width (in pixels)
* action (like/recommend)
* fbsend (true/false)

Refer to the options page for the plugin for a description of all options.

= Translations =

Please contact me to include your translation of this plugin at:
http://johnny.chadda.se/contact/

Do consider contacting me before starting to translate as well,
so you know if anyone else has already started.

Happy translating!

= Upcoming =
* Easier way of disabling the button on specific posts
* The ability to choose which image will be used on Facebook

== Screenshots ==
1. Facebook Like and Send button
2. Comment box for the Send button
3. Options page

== Installation ==
This section describes how to install the plugin and get it working.

1. Upload the `wp-facebook-like` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Optionally change the settings to suite your needs.

== Frequently Asked Questions ==

= No questions at the moment =
An answer to that question.


== Changelog ==

= 1.5.2 =
* This is a quick-fix release to make the button work again. It will be updated shortly with
all new features of the Facebook Like API and other reported bugs.
* Fixed an issue where Facebook has changed the button naming, causing the button not to work.

= 1.5.1 =
* Added support for disabling the button on specific posts and pages. Create a custom field 
called "wpfblike" and set the value to "false" to hide the button on that specific post.
* Added support for the new Facebook Send button. It is off by default, but can be enabled 
in the settings.

= 1.4.0 =
* Added options for choosing to insert the button in pages and/or posts.
* Added a check to verify that the correct PHP version is used when activating. (PHP>=5 supported).
* Added settings link from the plugin list. (thanks udi86!)
* Added an automatic language detector, which is now the default. (thanks udi86!)
* Added Open Graph admins property, which will create a Facebook page for your current article.

= 1.3.9 =
* Added new screenshots

= 1.3.8 =
* Fixed a bug where you could get "You do not have sufficient permissions to access this page."

= 1.3.7 =
* Added support for settings a custom priority for the automatic button embedding.
* Added support for automatically insert the button both before and after the article.

= 1.3.6 =
* Added support for entering a custom CSS style.
* Added support for passing custom arguments from the template tag.

= 1.3.5 =
* Fixed WordPress versioning problem.

= 1.3.4 =
* Added the possibility to use the Facebook default height. Just leave height empty in the options.

= 1.3.3 =
* Added an option for setting a custom height for the Like button.

= 1.3.2 =
* Fixed a bug which could invalidate the RSS feed.

= 1.3.1 =
* Fixed version mistake

= 1.3.0 =
* Added support for disabling the automatic inclusion of the Facebook Javascript SDK.
* Added full Facebook language support.
* Added support for Facebook Open Graph.

= 1.2.0 =
* Added support for entering a Facebook App ID.

= 1.1.0 =
* Fixed Removed double URL encoding
* Added option to choose permalink type. Good if you want the button outside the WordPress loop
* Added help text to all settings on the options page to make it easier to know what to do
* Added support for internationalization. To contribute a translation, contact me at the the plugin website.
* Added option to choose to only show the like button on single posts.

= 1.0.4 =
* Fixed problem with Internet Explorer

= 1.0.3 =
* Choose between the xfbml or iframe embedding method (xfbml is default)
* Choose the button text
* CSS class description
* Updated options screenshot to reflect the new settings

= 1.0.2 =
* Made the plugin insert the button after the post by default
* The options page is now much easier to use
* Updated the options screenshot

= 1.0.1 =
* Initial public release

