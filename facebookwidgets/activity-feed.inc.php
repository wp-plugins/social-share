<?php
class FB_Activity_Feed_Widget extends WP_Widget
{
	function FB_Activity_Feed_Widget()
	{	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'share_links', 'description' => 'Display the Facebook activity feed on your website.' );
		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 400, 'id_base' => 'fb-activity-feed-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'fb-activity-feed-widget', 'Facebook Activity Feed', $widget_ops, $control_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		$title = apply_filters('widget_title', $instance['fb-activity-title'] );
		echo $before_widget;
		
		$title = empty($instance['fb-activity-title']) ? ' ' : apply_filters('widget_title', $instance['fb-activity-title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;
		
		$title = attribute_escape(strip_tags($instance['fb-activity-title']));
		$width = attribute_escape(strip_tags($instance['fb-activity-width']));
		if ($width == "") $width = "220";		
		
		$height = attribute_escape(strip_tags($instance['fb-activity-height']));
		if ($height == "") $height = "300";
		$showHeader = attribute_escape(strip_tags($instance['fb-activity-show-header']));
		
		if ($showHeader == "on")
			$showHeader = "true";
		else
			$showHeader = "false";
		
		$colorScheme = attribute_escape(strip_tags($instance['fb-activity-color-scheme']));
		if ($colorScheme == "") $colorScheme = "light";
		
		$font = attribute_escape(strip_tags($instance['fb-activity-font']));
		$borderColor = attribute_escape(strip_tags($instance['fb-activity-border-color']));
		$showRecommendations = attribute_escape(strip_tags($instance['fb-activity-show-recommendations']));
		
		if ($showRecommendations == "on")
			$showRecommendations = "true";
		else
			$showRecommendations = "false";
				
		echo 	'<iframe src="http://www.facebook.com/plugins/activity.php?site=' .
				get_bloginfo('wpurl').'&amp;width='.$width.'&amp;height='.$height.'&amp;header='.$showHeader.'&amp;colorscheme='.$colorScheme .
				'&amp;font='.$font.'&amp;border_color='.$borderColor.'&amp;recommendations='.$showRecommendations.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		
		$instance['fb-activity-title'] = strip_tags($new_instance['fb-activity-title']);	
		$instance['fb-activity-width'] = strip_tags($new_instance['fb-activity-width']);		
		$instance['fb-activity-height'] = strip_tags($new_instance['fb-activity-height']);		
		$instance['fb-activity-show-header'] = strip_tags($new_instance['fb-activity-show-header']);		
		$instance['fb-activity-color-scheme'] = strip_tags($new_instance['fb-activity-color-scheme']);		
		$instance['fb-activity-font'] = strip_tags($new_instance['fb-activity-font']);		
		$instance['fb-activity-border-color'] = strip_tags($new_instance['fb-activity-border-color']);		
		$instance['fb-activity-show-recommendations'] = strip_tags($new_instance['fb-activity-show-recommendations']);			
		$instance[$layout] = strip_tags($new_instance[$layout]);
		
		return $instance;
	}

	function form( $instance )
	{
		$title = attribute_escape(strip_tags($instance['fb-activity-title']));
		$width = attribute_escape(strip_tags($instance['fb-activity-width']));
		if ($width == "") $width = "220";
		
		$height = attribute_escape(strip_tags($instance['fb-activity-height']));
		if ($height == "") $height = "300";
		
		$showHeader = attribute_escape(strip_tags($instance['fb-activity-show-header']));
		$colorScheme = attribute_escape(strip_tags($instance['fb-activity-color-scheme']));
		$font = attribute_escape(strip_tags($instance['fb-activity-font']));
		$borderColor = attribute_escape(strip_tags($instance['fb-activity-border-color']));
		$showRecommendations = attribute_escape(strip_tags($instance['fb-activity-show-recommendations']));
				
		?>
		
		<table style="width:400px;" cellspacing="5px">
			<tr><td colspan="4">Title:</td></tr>
			<tr><td colspan="4"><input class="widefat" id="<?php echo $this->get_field_id('fb-activity-title'); ?>" name="<?php echo $this->get_field_name('fb-activity-title'); ?>" type="text" value="<?php echo $title; ?>" /></td></tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
			
			<tr>
				<td><label for="">Width:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-activity-width'); ?>" id="<?php echo $this->get_field_id('fb-activity-width'); ?>" value="<?php echo $width; ?>" style="width:50px" /> px
				</td>
			</tr>
			<tr>
				<td><label for="">Height:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-activity-height'); ?>" id="<?php echo $this->get_field_id('fb-activity-height'); ?>" value="<?php echo $height; ?>" style="width:50px" /> px
				</td>
			</tr>
			<tr>
				<td><label for="">Show Header?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-activity-show-header'); ?>" id="<?php echo $this->get_field_id('fb-activity-show-header'); ?>" <?php if ($showHeader == "on") echo "checked"; ?>/>
				</td>
			</tr>
			<tr>
				<td><label for="">Color Scheme:</label></td>
				<td>
					<select name="<?php echo $this->get_field_name('fb-activity-color-scheme'); ?>" id="<?php echo $this->get_field_id('fb-activity-color-scheme'); ?>" style="width:100px">
					<?php
						$options = array(array('light','Light'), array('dark','Dark'));
													
						foreach($options as $index => $value)
						{
							echo '<option value="'.$value[0].'"';
							if ($value[0] == $colorScheme)
								echo ' selected';
							echo '>'.$value[1].'</option>';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="">Font:</label></td>
				<td>
					<select name="<?php echo $this->get_field_name('fb-activity-font'); ?>" id="<?php echo $this->get_field_id('fb-activity-font'); ?>" style="width:100px">
					<?php
						$options = array(array('arial','Arial'), array('lucida grande','Lucida Grande'), array('segoe ui', 'Segoe UI'), array('tahoma', 'Tahoma'), array('trebuchet ms', 'Trebuchet MS'), array('verdana', 'Verdana'));
													
						foreach($options as $index => $value)
						{
							echo '<option value="'.$value[0].'"';
							if ($value[0] == $font)
								echo ' selected';
							echo '>'.$value[1].'</option>';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label for="">Border Color:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-activity-border-color'); ?>" id="<?php echo $this->get_field_id('fb-activity-border-color'); ?>" value="<?php echo $borderColor; ?>" style="width:100px" />
				</td>
			</tr>
			<tr>
				<td><label for="">Show Recommendations?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-activity-show-recommendations'); ?>" id="<?php echo $this->get_field_id('fb-activity-show-recommendations'); ?>" <?php if ($showRecommendations == "on") echo "checked"; ?> />
				</td>
			</tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
		</table>
		
		<?php
	}
}
?>
