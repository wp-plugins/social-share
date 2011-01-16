<?php
class FB_LikeBox_Widget extends WP_Widget
{
	function FB_LikeBox_Widget()
	{	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'share_links', 'description' => 'Display the Facebook Like Box on your website.' );
		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 400, 'id_base' => 'fb-light-box-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'fb-light-box-widget', 'Facebook Like Box', $widget_ops, $control_ops );
	}

	function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
		$title = apply_filters('widget_title', $instance['fb-like-box-title'] );
		echo $before_widget;
		
		$title = empty($instance['fb-like-box-title']) ? ' ' : apply_filters('widget_title', $instance['fb-like-box-title']);
		if (!empty($title))
			echo $before_title . $title . $after_title;
		
		$title = attribute_escape(strip_tags($instance['fb-like-box-title']));
		$width = attribute_escape(strip_tags($instance['fb-like-box-width']));
		if ($width == "") $width = "220";		
		
		$showFaces = attribute_escape(strip_tags($instance['fb-like-box-show-faces']));		
		if ($showFaces == "on")
			$showFaces = "true";
		else
			$showFaces = "false";
			
		$showStream = attribute_escape(strip_tags($instance['fb-like-box-show-stream']));		
		if ($showStream == "on")
			$showStream = "true";
		else
			$showStream = "false";
		
		$showHeader = attribute_escape(strip_tags($instance['fb-like-box-show-header']));		
		if ($showHeader == "on")
			$showHeader = "true";
		else
			$showHeader = "false";
		
		$colorScheme = attribute_escape(strip_tags($instance['fb-like-box-color-scheme']));
		if ($colorScheme == "") $colorScheme = "light";
			
		echo 	'<iframe src="http://www.facebook.com/plugins/likebox.php?href='.
				get_bloginfo('wpurl').'&amp;width='.$width.'&amp;colorscheme='.$colorScheme.'&amp;show_faces='.$showFaces.'&amp;stream='.$showStream.
				'&amp;header='.$showHeader.'&amp;height=427" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:427px;" allowTransparency="true"></iframe>';
			
		echo $after_widget;
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		
		$instance['fb-like-box-title'] = strip_tags($new_instance['fb-like-box-title']);	
		$instance['fb-like-box-width'] = strip_tags($new_instance['fb-like-box-width']);
		$instance['fb-like-box-show-faces'] = strip_tags($new_instance['fb-like-box-show-faces']);	
		$instance['fb-like-box-show-stream'] = strip_tags($new_instance['fb-like-box-show-stream']);		
		$instance['fb-like-box-show-header'] = strip_tags($new_instance['fb-like-box-show-header']);		
		$instance['fb-like-box-color-scheme'] = strip_tags($new_instance['fb-like-box-color-scheme']);				
		$instance[$layout] = strip_tags($new_instance[$layout]);
		
		return $instance;
	}

	function form( $instance )
	{
		$title = attribute_escape(strip_tags($instance['fb-like-box-title']));
		$width = attribute_escape(strip_tags($instance['fb-like-box-width']));
		if ($width == "") $width = "220";
				
		$showFaces = attribute_escape(strip_tags($instance['fb-like-box-show-faces']));
		$showStream = attribute_escape(strip_tags($instance['fb-like-box-show-stream']));
		$showHeader = attribute_escape(strip_tags($instance['fb-like-box-show-header']));
		$colorScheme = attribute_escape(strip_tags($instance['fb-like-box-color-scheme']));
				
		?>
		
		<table style="width:400px;" cellspacing="5px">
			<tr><td colspan="4">Title:</td></tr>
			<tr><td colspan="4"><input class="widefat" id="<?php echo $this->get_field_id('fb-like-box-title'); ?>" name="<?php echo $this->get_field_name('fb-like-box-title'); ?>" type="text" value="<?php echo $title; ?>" /></td></tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
			
			<tr>
				<td><label for="">Width:</label></td>
				<td>
					<input type="text" name="<?php echo $this->get_field_name('fb-like-box-width'); ?>" id="<?php echo $this->get_field_id('fb-like-box-width'); ?>" value="<?php echo $width; ?>" style="width:50px" /> px
				</td>
			</tr>
			<tr>
				<td><label for="">Color Scheme:</label></td>
				<td>
					<select name="<?php echo $this->get_field_name('fb-like-box-color-scheme'); ?>" id="<?php echo $this->get_field_id('fb-like-box-color-scheme'); ?>" style="width:100px">
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
				<td><label for="">Show Faces?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-like-box-show-faces'); ?>" id="<?php echo $this->get_field_id('fb-like-box-show-faces'); ?>" <?php if ($showFaces == "on") echo "checked"; ?>/>
				</td>
			</tr>
			<tr>
				<td><label for="">Show Stream?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-like-box-show-stream'); ?>" id="<?php echo $this->get_field_id('fb-like-box-show-stream'); ?>" <?php if ($showStream == "on") echo "checked"; ?>/>
				</td>
			</tr>
			<tr>
				<td><label for="">Show Header?</label></td>
				<td>
					<input type="checkbox" name="<?php echo $this->get_field_name('fb-like-box-show-header'); ?>" id="<?php echo $this->get_field_id('fb-like-box-show-header'); ?>" <?php if ($showHeader == "on") echo "checked"; ?>/>
				</td>
			</tr>
			<tr><td colspan="4"><p>&nbsp;</p></td></tr>
		</table>
		
		<?php
	}
}
?>
