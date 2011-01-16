<?php
class FB_Recommendations_Widget extends WP_Widget
{
	function FB_Recommendations_Widget()
	{	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'share_links', 'description' => 'Display the Facebook Recommendations on your website.' );
		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 400, 'id_base' => 'fb-recommendations-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'fb-recommendations-widget', 'Facebook Recommendations', $widget_ops, $control_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		$title = apply_filters('widget_title', $instance['fb-recommendations-title'] );
		echo $before_widget;
		
		$title = empty($instance['fb-recommendations-title']) ? ' ' : apply_filters('widget_title', $instance['fb-recommendations-title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;
		
		$title = attribute_escape(strip_tags($instance['fb-recommendations-title']));
		$width = attribute_escape(strip_tags($instance['fb-recommendations-width']));
		if ($width == "") $width = "220";		
		
		$height = attribute_escape(strip_tags($instance['fb-recommendations-height']));
		if ($height == "") $height = "300";
		$showHeader = attribute_escape(strip_tags($instance['fb-recommendations-show-header']));
		
		if ($showHeader == "on")
			$showHeader = "true";
		else
			$showHeader = "false";
		
		$colorScheme = attribute_escape(strip_tags($instance['fb-recommendations-color-scheme']));
		if ($colorScheme == "") $colorScheme = "light";
		
		$font = attribute_escape(strip_tags($instance['fb-recommendations-font']));
		$borderColor = attribute_escape(strip_tags($instance['fb-recommendations-border-color']));
				
		echo 	'<iframe src="http://www.facebook.com/plugins/recommendations.php?site=' .
				get_bloginfo('wpurl').'&amp;width='.$width.'&amp;height='.$height.'&amp;header='.$showHeader.'&amp;colorscheme='.$colorScheme .
				'&amp;font='.$font.'&amp;border_color='.$borderColor.'&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		
		$instance['fb-recommendations-title'] = strip_tags($new_instance['fb-recommendations-title']);	
		$instance['fb-recommendations-width'] = strip_tags($new_instance['fb-recommendations-width']);		
		$instance['fb-recommendations-height'] = strip_tags($new_instance['fb-recommendations-height']);		
		$instance['fb-recommendations-show-header'] = strip_tags($new_instance['fb-recommendations-show-header']);		
		$instance['fb-recommendations-color-scheme'] = strip_tags($new_instance['fb-recommendations-color-scheme']);		
		$instance['fb-recommendations-font'] = strip_tags($new_instance['fb-recommendations-font']);		
		$instance['fb-recommendations-border-color'] = strip_tags($new_instance['fb-recommendations-border-color']);			
		$instance[$layout] = strip_tags($new_instance[$layout]);
		
		return $instance;
	}

	function form( $instance )
	{
		$title = attribute_escape(strip_tags($instance['fb-recommendations-title']));
		$width = attribute_escape(strip_tags($instance['fb-recommendations-width']));
		if ($width == "") $width = "220";
		
		$height = attribute_escape(strip_tags($instance['fb-recommendations-height']));
		if ($height == "") $height = "300";
		
		$showHeader = attribute_escape(strip_tags($instance['fb-recommendations-show-header']));
		$colorScheme = attribute_escape(strip_tags($instance['fb-recommendations-color-scheme']));
		$font = attribute_escape(strip_tags($instance['fb-recommendations-font']));
		$borderColor = attribute_escape(strip_tags($instance['fb-recommendations-border-color']));
				
		?>
		
		<table style="width:400px;" cellspacing="5px">
			<tr><td colspan="4">Title:</td></tr>
			<tr><td colspan="4"><input class="widefat" id="<?php echo $this->get_field_id('fb-recommendations-title'); ?>" name="<?php echo $this->get_field_name('fb-recommendations-title'); ?>" type="text" value="<?php echo $title; ?>" /></td></tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
			
			<tr>
				<td><label for="">Width:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-recommendations-width'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-width'); ?>" value="<?php echo $width; ?>" style="width:50px" /> px
				</td>
			</tr>
			<tr>
				<td><label for="">Height:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-recommendations-height'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-height'); ?>" value="<?php echo $height; ?>" style="width:50px" /> px
				</td>
			</tr>
			<tr>
				<td><label for="">Show Header?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-recommendations-show-header'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-show-header'); ?>" <?php if ($showHeader == "on") echo "checked"; ?>/>
				</td>
			</tr>
			<tr>
				<td><label for="">Color Scheme:</label></td>
				<td>
					<select name="<?php echo $this->get_field_name('fb-recommendations-color-scheme'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-color-scheme'); ?>" style="width:100px">
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
					<select name="<?php echo $this->get_field_name('fb-recommendations-font'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-font'); ?>" style="width:100px">
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
					<input type="text" name="<?php echo $this->get_field_name('fb-recommendations-border-color'); ?>" id="<?php echo $this->get_field_id('fb-recommendations-border-color'); ?>" value="<?php echo $borderColor; ?>" style="width:100px" />
				</td>
			</tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
		</table>
		
		<?php
	}
}
?>
