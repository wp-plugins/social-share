<?php
class SocialShare_Widget extends WP_Widget
{
	function SocialShare_Widget()
	{
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'share_links', 'description' => 'Share you pages with various social networking websites' );
		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 400, 'id_base' => 'socialshare-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'socialshare-widget', 'Social Share', $widget_ops, $control_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;
		
		?>
		
		<div class="socialshare-widget">
			<!-- Twitter -->
			<div class="socialshare-twitter">
			
			<?php
				$displayTwitter = get_option('socialshare-displaytwitter');
				
				if ($displayTwitter == "on")
				{
					echo '<a href="http://twitter.com/share" class="twitter-share-button" data-lang="'.get_option("socialshare-twitterlanguage").'" data-count="'.get_option("socialshare-twitterStyle").'" data-via="'.get_option("socialshare-twitterUsername").'">Tweet</a>';
					echo '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';	
				}					
			?>
			</div>
			
			<!-- StumbleUpon -->
			<div class="socialshare-stumbleupon">
			
			<?php
				$displayStumbleupon = get_option('socialshare-displayStumbleupon');
				$style = get_option('socialshare-stumbleuponStyle');
				
				if ($displayStumbleupon == "on")
				{
					echo '<script src="http://www.stumbleupon.com/hostedbadge.php?s='.$style.'&r='."http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'"></script>';
				}					
			?>
			</div>
			
			<!-- Reddit.com -->
			<div class="socialshare-reddit">
			
			<?php
				$displayReddit = get_option('socialshare-displayreddit');
				$style = get_option('socialshare-redditStyle');
				$arg="";
								
				if ($displayReddit == "on")
				{
					switch(strlen($style))
					{
						case 11:
							$arg = substr($style, 10, 1);
							echo '<script type="text/javascript" src="http://reddit.com/buttonlite.js?i='.$arg.'&newwindow=1"></script>';
						break;
						case 7:
							$arg = substr($style, 6, 1);
							echo '<script type="text/javascript" src="http://reddit.com/static/button/button'.$arg.'.js?newwindow=1"></script>';
						break;
						case 9:
							$arg = substr($style, 8, 1);
							echo 	'<a href="http://reddit.com/submit" onclick="' .
									"window.location = 'http://reddit.com/submit?url='" .
									"+ encodeURIComponent(window.location); return false" .
									'"> <img src="http://reddit.com/static/spreddit'.$arg.'.gif" alt="submit to reddit" border="0" /> </a>';
						break;
						case 10:
							$arg = substr($style, 8, 2);
							echo 	'<a href="http://reddit.com/submit" onclick="' .
									"window.location = 'http://reddit.com/submit?url='" .
									"+ encodeURIComponent(window.location); return false" .
									'"> <img src="http://reddit.com/static/spreddit'.$arg.'.gif" alt="submit to reddit" border="0" /> </a>';
						break;
					}
				}					
			?>
			</div>
			
			<!-- Facebook -->
			<?php	
				$displayFacebook = get_option('socialshare-displayfacebook');
				
				if ($displayFacebook == "on")
				{
					$width = get_option('socialshare-width');
					
					echo '<div class="socialshare-facebook" style="width:'.$width.'px;">';
				
					echo '<iframe src="http://www.facebook.com/plugins/like.php?href=';
					echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					
					$layout = get_option('socialshare-facebookStyle');
					
					$showfaces = get_option('socialshare-showfaces');
					if ($showfaces == "on" || $showfaces == "true")
						$showfaces = "true";
					else
						$showfaces = "false";
					
					$width = get_option('socialshare-width');
					$height = get_option('socialshare-height');
					$action = get_option('socialshare-action');
					$font = get_option('socialshare-font');
					$colorscheme = get_option('socialshare-colorscheme');
					$fblanguage = get_option('socialshare-facebooklanguage');
					
					echo '&layout='.$layout.'&show_faces='.$showfaces.'&width='.$width.'&action='.$action.'&font='.$font.'&colorscheme='.$colorscheme.'&height='.$height.'&locale='.$fblanguage.'"';
					echo 'scrolling="no" frameborder="0" style="width:'.$width.'px; height:'.$height.'px;"></iframe>';
				}
			?>
			</div>
		</div>
		
		<?php
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		foreach ($GLOBALS['SOCIAL_NETWORKS'] as $social_network)
		{
			$display = 'socialshare-display'.$social_network['Name'];
			$layout = 'socialshare-'.$social_network['Name'].'Style';
			
			update_option($display, strip_tags($new_instance[$display]));
			update_option($layout, strip_tags($new_instance[$layout]));
		
			$instance[$display] = strip_tags($new_instance[$display]);
			$instance[$layout] = strip_tags($new_instance[$layout]);
		}
		
		return $instance;
	}

	function form( $instance )
	{
		$title = attribute_escape(strip_tags($instance['title']));
				
		?>
		
		<table style="width:400px">
			<tr><td colspan="4">Title:</td></tr>
			<tr><td colspan="4"><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></td></tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
			
			<?php foreach ($GLOBALS['SOCIAL_NETWORKS'] as $social_network)
			{
				$display = get_option('socialshare-display'.$social_network['Name']);
				$checked = $display == "on" ? "checked" : "";				
			?>
				<tr>
					<td><img src="<?php echo WP_PLUGIN_URL . '/SocialShare/images/'.$social_network['Name'].'-icon.png'; ?>" width="16px" height="16px" /></td>
					<td>				
						<input type="checkbox" name="<?php echo $this->get_field_name('socialshare-display'.$social_network['Name']); ?>" id="<?php echo $this->get_field_id('socialshare-display'.$social_network['Name']); ?>" <?php echo $checked; ?> />				
						<label for="<?php echo $this->get_field_id('socialshare-display'.$social_network['Name']); ?>"><?php echo $social_network['Name']; ?></label>
					</td>
					<td>
						<select id="<?php echo $this->get_field_id('socialshare-'.$social_network['Name'].'Style'); ?>" name="<?php echo $this->get_field_name('socialshare-'.$social_network['Name'].'Style'); ?>" style="width:150px">
						<?php
							$layout = get_option('socialshare-'.$social_network['Name'].'Style');
							$options = $social_network['Options'];
														
							foreach($options as $index => $value)
							{
								echo '<option value="'.$value[0].'"';
								if ($value[0] == $layout)
									echo ' selected';
								echo '>'.$value[1].'</option>';
							}
						?>
						</select>				
					</td>
					<td style="text-align:center"><a href="#" onclick="window.open('<?php echo WP_PLUGIN_URL."/SocialShare/preview/".$social_network['Name'].".html"; ?>','Preview', 'Status=1,height=500,width=550,resizable=0')">Preview</a></td>
				</tr>
			<?php } ?>
			
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
			<tr>
				<td colspan="4"><a href="options-general.php?page=socialshare">Configure</a></td>
			</tr>
		</table>
		
		<?php
	}
}
?>
