<?php
/*
Plugin Name: Social Share
Plugin URI: http://www.jpreece.com/
Description: Simple sharing widget for Facebook and Twitter
Author: Jon Preece
Version: 1.0 (Alpha)
Author URI: http://www.jpreece.com/
*/
  
function widget_DisplayShareLinks()
{ 
	?>
		<div style="width:145px; height:67px; margin-left:auto; margin-right:auto; padding-bottom:25px">
		<div style="width:75px; text-align:center; height:65px; float:left">
			<!-- Twitter -->
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="<?php echo get_option('twitterUsername'); ?>">Tweet</a>
			<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		<div style="width:65px; float:right; padding-top:2px">
			<!-- Facebook -->
			<iframe src="http://www.facebook.com/plugins/like.php?href=
			<?php
				echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			?>
			&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=verdana&amp;colorscheme=light&amp;height=65"
			scrolling="no" frameborder="0" style="width:100px; height:65px"></iframe>
		</div>
	</div>
	<?php
}
 
function DisplayShareLinks_init()
{
	register_sidebar_widget(__('Social Share'), 'widget_DisplayShareLinks');
}

function CreateOptionsPage()
{
	add_options_page(__('Social Share','shareWidget-settings'), __('Social Share','shareWidget-settings'), 'manage_options', 'shareWidget-settings', 'LayoutSettingsForm');
}	

function LayoutSettingsForm()
{
	if (!current_user_can('manage_options'))
	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
?>
	<div class="wrap">
	<h2>Social Share Settings</h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<table class="form-table">

	<tr valign="top">
	<th scope="row">Your Twitter Username:</th>
	<td><input type="text" name="twitterUsername" value="<?php echo get_option('twitterUsername'); ?>" /></td>
	</tr>

	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="twitterUsername" />

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h3>TIP:</h3>
	<p>For more information about this plugin, visit <a href="http://www.jpreece.com/">JPreece.com</a> or follow <a href="http://twitter.com/jonpreecebsc">@jonpreecebsc</a></p>
	</div>
<?php
}

function share_warning()
{
	$twitterUsername = get_option('twitterUsername');
	if ($twitterUsername == "")
	{
		echo "
		<div id='share-warning' class='updated fade'><p><strong>".__('Facebook/Twitter Share needs configuring.')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Twitter username</a> for the plugin to work properly.'), "options-general.php?page=shareWidget-settings")."</p></div>
		";
	}
}

add_action('admin_notices', 'share_warning');
add_action('admin_menu', 'CreateOptionsPage');
add_action("plugins_loaded", "DisplayShareLinks_init");
?>