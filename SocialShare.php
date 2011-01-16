<?php
/*
Plugin Name: Social Share
Plugin URI: http://www.jpreece.com/
Description: Simple sharing widget for various social networking sites, including Facebook and Twitter
Author: Jon Preece
Version: 1.3
Author URI: http://www.jpreece.com/
*/

require_once ('widget.php');
require_once ('adminsettings.php');
require_once ('facebookwidgets/activity-feed.inc.php');
require_once ('facebookwidgets/recommendations.inc.php');
require_once ('facebookwidgets/likebox.inc.php');

global $SOCIAL_NETWORKS;
global $CONFIGURABLE_OPTIONS;

function CreateOptionsPage()
{
	add_options_page(__('Social Share','socialshare'), __('Social Share','socialshare'), 'manage_options', 'socialshare', 'LayoutSettingsForm');
}

function share_warning()
{
	$twitterUsername = get_option('socialshare-twitterUsername');
	if ($twitterUsername == "")
	{
		echo "<div id='share-warning' class='updated fade'><p><strong>".__('Social Share needs configuring.')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Twitter username</a> for the plugin to work properly.'), "options-general.php?page=socialshare")."</p></div>";
	}
}

function LoadJavaScript()
{	
	wp_register_script('socialshare-script', WP_PLUGIN_URL . '/SocialShare/Script.js');
	wp_enqueue_script('socialshare-script');
}  

function LoadCSS()
{	
	$myStyleUrl = WP_PLUGIN_URL . "/SocialShare/Styles.css";	
	wp_register_style("socialshare-styles" , $myStyleUrl,array(),1,"screen");
	wp_enqueue_style("socialshare-styles");
}

function LoadGlobals()
{
	$GLOBALS['SOCIAL_NETWORKS'] = array(
		array('Name'=>'Facebook','Options'=>array(1=>array('standard','Standard'),2=>array('button_count','Button Count'),3=>array('box_count','Box Count'))),
		array('Name'=>'Twitter','Options'=>array (1=>array('vertical','Vertical'),2=>array('horizontal','Horizontal'),3=>array('none','None'))),
		array('Name'=>'StumbleUpon','Options'=>array (1=>array('1','Style 1'),2=>array('2','Style 2'),3=>array('3','Style 3'),4=>array('4','Style 4'),5=>array('5', 'Style 5'), 6=>array('6', 'Style 6'))),
		array('Name'=>'Reddit','Options'=>array(1=>array('litebutton1','Lite Button 1'),2=>array('litebutton2','Lite Button 2'),3=>array('litebutton3','Lite Button 3'),4=>array('litebutton4','Lite Button 4'),5=>array('litebutton5','Lite Button 5'),6=>array('litebutton6','Lite Button 6'),7=>array('button1','Button 1'),8=>array('button2','Button 2'),9=>array('button3','Button 3'),10=>array('spreddit1','Spreddit 1'),12=>array('spreddit2','Spreddit 2'),13=>array('spreddit3','Spreddit 3'),14=>array('spreddit4','Spreddit 4'),15=>array('spreddit5','Spreddit 5'),16=>array('spreddit6','Spreddit 6'),17=>array('spreddit7','Spreddit 7'),18=>array('spreddit8','Spreddit 8'),19=>array('spreddit9','Spreddit 9'),20=>array('spreddit10','Spreddit 10'),21=>array('spreddit11','Spreddit 11'),22=>array('spreddit12','Spreddit 12'),23=>array('spreddit13','Spreddit 13'),24=>array('spreddit14','Spreddit 14')))
	);
	
	$GLOBALS['CONFIGURABLE_OPTIONS'] = array(
		'socialshare-displayTwitter','socialshare-twitterUsername','socialshare-twitterStyle','socialshare-twitterlanguage','socialshare-displayFacebook',
		'socialshare-facebookStyle','socialshare-showfaces','socialshare-width','socialshare-height','socialshare-action','socialshare-font','socialshare-colorscheme',
		'socialshare-facebooklanguage','socialshare-displayStumbleupon','socialshare-stumbleuponStyle','socialshare-displayreddit','socialshare-redditStyle'
	);
}

function LoadWidgets()
{
	register_widget('SocialShare_Widget');
	register_widget('FB_Activity_Feed_Widget');
	register_widget('FB_Recommendations_Widget');
	register_widget('FB_LikeBox_Widget');
}

function SocialShare_Activate()
{
	foreach($SOCIAL_NETWORKS as $social_network)
	{
		if (!get_option('socialshare-display'.$social_network['Name']))
		{
			add_option('socialshare-display'.$social_network['Name']);
		}
	}
}

add_action('admin_notices', 'share_warning');
add_action('admin_menu', 'CreateOptionsPage');
add_action('admin_init','LoadJavaScript');
add_action('plugins_loaded','LoadCSS');
add_action('plugins_loaded','LoadGlobals');
add_action('widgets_init', 'LoadWidgets');

register_activation_hook(__FILE__, 'SocialShare_Activate');

?>