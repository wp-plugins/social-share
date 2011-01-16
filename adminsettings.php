<?php

function LayoutSettingsForm()
{
	if (isset($_POST['social-share-update-settings']))
	{
		foreach($GLOBALS['CONFIGURABLE_OPTIONS'] as $option)
		{		
			$value = strip_tags($_POST[$option]);
			update_option($option, $value);
		}				
	}

	if (!current_user_can('manage_options') || !is_user_logged_in() || !is_admin())
	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
?>
	<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div> 
	
	<h2>Social Share Settings</h2>

	<div style="width:650px; float:left;">
		<form method="post" action="options-general.php?page=socialshare">
		<?php wp_nonce_field('update-options'); ?>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php foreach($GLOBALS['CONFIGURABLE_OPTIONS'] as $option) { echo $option . ","; } ?>" />
		
		<div style="float:left">
			<h3>Twitter</h3>
			<table class="form-table" style="margin-bottom:25px; width:400px;">
				<tr>
					<th scope="row">Display:</th>
					<td>
						<?php
							$displayTwitter = get_option('socialshare-displayTwitter');		
							$checked = "";
							if ($displayTwitter == "on" || $displayTwitter == "true")
								$checked = "checked";
							else
								$checked = "";
							
							echo '<input type="checkbox" name="socialshare-displayTwitter" id="socialshare-displayTwitter" '.$checked.' />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Username:</th>
					<td>
						<input type="text" name="socialshare-twitterUsername" id="socialshare-twitterUsername" value="<?php echo get_option('socialshare-twitterUsername'); ?>" style="width:200px" onchange="UpdateTwitter()" />
					</td>
				</tr>
				<tr>
					<th scope="row">Button Style:</th>
					<td>
						<select name="socialshare-twitterStyle" id="socialshare-twitterStyle" style="width:200px" onchange="UpdateTwitter()">						
						<?php
							$layout = get_option('socialshare-twitterStyle');
							$social_network = $GLOBALS['SOCIAL_NETWORKS'][1];
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
				</tr>
				<tr>
					<th scope="row">Language:</th>
					<td>
						<select name="socialshare-twitterlanguage" id="socialshare-twitterlanguage" style="width:200px" onchange="UpdateTwitter()">
						<?php
							$language = get_option('socialshare-twitterlanguage');
							$options = array(1=>array('en','English'), 2=>array('fr','French'),3=>array('de','German'),4=>array('es','Spanish'),5=>array('ja','Japanese'));
						
							foreach($options as $index => $value)
							{
								echo '<option value="'.$value[0].'"';
								if ($value[0] == $language)
									echo ' selected';
								echo '>'.$value[1].'</option>';
							}
						?>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div style="float:right; margin-top:41px; width:225px; height:60px">
			<iframe id="twitterIFrame" onload="UpdateTwitter()"></iframe>
		</div>
		
		<div style="float:left">
			<h3>StumbleUpon</h3>
			<table class="form-table" style="margin-bottom:25px; width:400px;">
				<tr>
					<th scope="row">Display:</th>
					<td>
						<?php
							$displayStumbleupon = get_option('socialshare-displayStumbleupon');		
							$checked = "";
							if ($displayStumbleupon == "on" || $displayStumbleupon == "true")
								$checked = "checked";
							else
								$checked = "";
							
							echo '<input type="checkbox" name="socialshare-displayStumbleupon" id="socialshare-displayStumbleupon" '.$checked.' />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Button Style:</th>
					<td>
						<select name="socialshare-stumbleuponStyle" id="socialshare-stumbleuponStyle" style="width:200px" onchange="UpdateStumbleUpon()">						
						<?php
							$layout = get_option('socialshare-stumbleuponStyle');
							$social_network = $GLOBALS['SOCIAL_NETWORKS'][2];
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
				</tr>
			</table>
		</div>
		<div style="float:right; margin-top:41px; width:225px; height:60px">
			<iframe id="stumbleuponIFrame"></iframe>
		</div>
		
		<div style="float:left">
			<h3>reddit.com</h3>
			<table class="form-table" style="margin-bottom:25px; width:400px;">
				<tr>
					<th scope="row">Display:</th>
					<td>
						<?php
							$displayreddit = get_option('socialshare-displayreddit');		
							$checked = "";
							if ($displayreddit == "on" || $displayreddit == "true")
								$checked = "checked";
							else
								$checked = "";
							
							echo '<input type="checkbox" name="socialshare-displayreddit" id="socialshare-displayreddit" '.$checked.' />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Button Style:</th>
					<td>
						<select name="socialshare-redditStyle" id="socialshare-redditStyle" style="width:200px" onchange="UpdateReddit()">						
						<?php
							$layout = get_option('socialshare-RedditStyle');
							$social_network = $GLOBALS['SOCIAL_NETWORKS'][3];
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
				</tr>
			</table>
		</div>
		<div style="float:right; margin-top:41px; width:225px; height:60px">
			<iframe id="redditIFrame"></iframe>
		</div>
		
		<div style="float:left">
			<h3>Facebook</h3>
			<table class="form-table" style="margin-bottom:25px; width:400px;">
				<tr>
					<th scope="row">Display:</th>
					<td>
						<?php
							$displayFacebook = get_option('socialshare-displayFacebook');
							$checked = "";
							if ($displayFacebook == "on" || $displayFacebook == "true")
								$checked = "checked";
							else
								$checked = "";
							
							echo '<input type="checkbox" name="socialshare-displayFacebook" id="socialshare-displayFacebook" '.$checked.' />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Button Style:</th>
					<td>
						<select id="socialshare-facebookStyle" name="socialshare-facebookStyle" style="width:200px" onchange="UpdateFacebook()">
						<?php
							$layout = get_option('socialshare-FacebookStyle');
							$social_network = $GLOBALS['SOCIAL_NETWORKS'][0];
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
				</tr>
				<tr>
					<th scope="row">Show Faces:</th>
					<td>
						<?php 
							$showfaces = get_option('socialshare-showfaces');
							$checkState = "";
							
							if ($showfaces == "on")
								$checkState = 'checked="yes"';
								
							echo '<input type="checkbox" name="socialshare-showfaces" id="socialshare-showfaces" onchange="UpdateFacebook()" '.$checkState.'/>';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Width:</th>
					<td>
						<?php
							$width = get_option('socialshare-width');
							if ($width == "")
								$width="75";
							
							echo '<input type="text" name="socialshare-width" id="socialshare-width" value="'.$width.'" style="width:200px" onchange="UpdateFacebook()" />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Height:</th>
					<td>
						<?php
							$height = get_option('socialshare-height');
							if ($height == "")
								$height="75";
								
							echo '<input type="text" name="socialshare-height" id="socialshare-height" value="'.$height.'" style="width:200px" onchange="UpdateFacebook()" />';
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">Verb To Display:</th>
					<td>
						<select name="socialshare-action" id="socialshare-action" style="width:200px" onchange="UpdateFacebook()">
						
						<?php
							$action = get_option('socialshare-action');
							$options = array(1=>array('like','Like'),2=>array('recommend','Recommend'));
							
							foreach($options as $index => $value)
							{
								echo '<option value="'.$value[0].'"';
								if ($value[0] == $action)
									echo ' selected';
								echo '>'.$value[1].'</option>';
							}							
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">Font:</th>
					<td>
						<select name="socialshare-font" id="socialshare-font" style="width:200px" onchange="UpdateFacebook()">
							
							<?php
								$font = get_option('socialshare-font');
								$options = array(1=>array('',''),2=>array('arial','Arial'),3=>array('lucida grande','Lucida Grande'),4=>array('segoe ui','Segoe UI'),5=>array('tahoma', 'Tahoma'),6=>array('trebuchet ms','Trebuchet MS'),7=>array('verdana','Verdana'));
							
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
					<th scope="row">Color Scheme:</th>
					<td>
						<select name="socialshare-colorscheme" id="socialshare-colorscheme" style="width:200px" onchange="UpdateFacebook()">
							
							<?php
								$colorscheme = get_option('socialshare-colorscheme');
								$options = array(1=>array('light','Light'),2=>array('dark','Dark'));
							
								foreach($options as $index => $value)
								{
									echo '<option value="'.$value[0].'"';
									if ($value[0] == $colorscheme)
										echo ' selected';
									echo '>'.$value[1].'</option>';
								}
							?>
							
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">Language:</th>
					<td>
						<select name="socialshare-facebooklanguage" id="socialshare-facebooklanguage" style="width:200px" onchange="UpdateFacebook()">
						
						<?php
						
							$fblanguage = get_option('socialshare-facebooklanguage');
							$options = array(0=>array('','Standard English'),1=>array('ca_ES','Catalan'),2=>array('cs_CZ','Czech'),3=>array('cy_GB','Welsh'),4=>array('da_DK','Danish'),5=>array('de_DE','German'),6=>array('eu_ES','Basque'),7=>array('en_PI','English (Pirate)'),8=>array('en_UD','English (Upside Down)'),9=>array('ck_US','Cherokee'),10=>array('en_US','English (US)'),11=>array('es_LA','Spanish'),12=>array('es_CL','Spanish (Chile)'),13=>array('es_CO','Spanish (Colombia)'),14=>array('es_ES','Spanish (Spain)'),15=>array('es_MX','Spanish (Mexico)'),16=>array('es_VE','Spanish (Venezuela)'),17=>array('fb_FI','Finnish (test)'),18=>array('fi_FI','Finnish'),19=>array('fr_FR','French (France)'),20=>array('gl_ES','Galician'),21=>array('hu_HU','Hungarian'),22=>array('it_IT','Italian'),23=>array('ja_JP','Japanese'),24=>array('ko_KR','Korean'),25=>array('nb_NO','Norwegian (bokmal)'),26=>array('nn_NO','Norwegian (nynorsk)'),27=>array('nl_NL','Dutch'),28=>array('pl_PL','Polish'),29=>array('pt_BR','Portuguese (Brazil)'),30=>array('pt_PT','Portuguese (Portugal)'),31=>array('ro_RO','Romanian'),32=>array('ru_RU','Russian'),33=>array('sk_SK','Slovak'),34=>array('sl_SI','Slovenian'),35=>array('sv_SE','Swedish'),36=>array('th_TH','Thai'),37=>array('tr_TR','Turkish'),38=>array('ku_TR','Kurdish'),39=>array('zh_CN','Simplified Chinese (China)'),40=>array('zh_HK','Traditional Chinese (Hong Kong)'),41=>array('zh_TW','Traditional Chinese (Taiwan)'),42=>array('fb_LT','Leet Speak'),43=>array('af_ZA','Afrikaans'),44=>array('sq_AL','Albanian'),45=>array('hy_AM','Armenian'),46=>array('az_AZ','Azeri'),47=>array('be_BY','Belarusian'),48=>array('bn_IN','Bengali'),49=>array('bs_BA','Bosnian'),50=>array('bg_BG','Bulgarian'),51=>array('hr_HR','Croatian'),52=>array('nl_BE','Dutch (België)'),53=>array('en_GB','English (UK)'),54=>array('eo_EO','Esperanto'),55=>array('et_EE','Estonian'),56=>array('fo_FO','Faroese'),57=>array('fr_CA','French (Canada)'),58=>array('ka_GE','Georgian'),59=>array('el_GR','Greek'),60=>array('gu_IN','Gujarati'),61=>array('hi_IN','Hindi'),62=>array('is_IS','Icelandic'),63=>array('id_ID','Indonesian'),64=>array('ga_IE','Irish'),65=>array('jv_ID','Javanese'),66=>array('kn_IN','Kannada'),67=>array('kk_KZ','Kazakh'),68=>array('la_VA','Latin'),69=>array('lv_LV','Latvian'),70=>array('li_NL','Limburgish'),71=>array('lt_LT','Lithuanian'),72=>array('mk_MK','Macedonian'),73=>array('mg_MG','Malagasy'),74=>array('ms_MY','Malay'),75=>array('mt_MT','Maltese'),76=>array('mr_IN','Marathi'),77=>array('mn_MN','Mongolian'),78=>array('ne_NP','Nepali'),79=>array('pa_IN','Punjabi'),80=>array('rm_CH','Romansh'),81=>array('sa_IN','Sanskrit'),82=>array('sr_RS','Serbian'),83=>array('so_SO','Somali'),84=>array('sw_KE','Swahili'),85=>array('tl_PH','Filipino'),86=>array('ta_IN','Tamil'),87=>array('tt_RU','Tatar'),88=>array('te_IN','Telugu'),89=>array('ml_IN','Malayalam'),90=>array('uk_UA','Ukrainian'),91=>array('uz_UZ','Uzbek'),92=>array('vi_VN','Vietnamese'),93=>array('xh_ZA','Xhosa'),94=>array('zu_ZA','Zulu'),95=>array('km_KH','Khmer'),96=>array('tg_TJ','Tajik'),97=>array('ar_AR','Arabic'),98=>array('he_IL','Hebrew'),99=>array('ur_PK','Urdu'),100=>array('fa_IR','Persian'),101=>array('sy_SY','Syriac'),102=>array('yi_DE','Yiddish'),103=>array('gn_PY','Guaraní'),104=>array('qu_PE','Quechua'),105=>array('ay_BO','Aymara'),106=>array('se_NO','Northern Sámi'),107=>array('ps_AF','Pashto'),108=>array('tl_ST','Klingon'));
						
							foreach($options as $index => $value)
							{
								echo '<option value="'.$value[0].'"';
								if ($value[0] == $fblanguage)
									echo ' selected';
								echo '>'.$value[1].'</option>';
							}
						?>
							
						</select>
					</td>
				</tr>
			</table>

			<p class="submit">
			<input type="submit" id="social-share-update-settings" name="social-share-update-settings" class="button-primary" value="<?php _e('Save Changes') ?>" />
			<input type="reset" value="<?php _e('Reset Changes') ?>" />
			</p>			
		</div>
		
		<div style="float:right; margin-top:41px; width:225px; height:60px">
			<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.jpreece.com%2F&amp;layout=standard&amp;show_faces=false&amp;width=225&amp;action=like&amp;colorscheme=light&amp;height=150" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:225px; height:150px;" allowTransparency="true" id="facebookIFrame"></iframe>
		</div>
		
		</form>
	</div>
	
	<div class="updated fade" style="margin-top:25px; padding-top:10px; width:300px; float:right; text-align:center">
		<h3>Support</h3>
		<p>For support, contact us direct;</p>
		<p>&nbsp;</p>
		<p>Website: <a href="http://www.jpreece.com/contact/">jpreece.com</a></p>
		<p>Twitter: <a href="http://twitter.com/jonpreecebsc">@jonpreecebsc</a></p>
		<p>&nbsp;</p>
		<p>Please help us continue development.</p>
		<p>		
			<div class="paypalButton">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
					<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</p>
	</div>
	</div>
<?php
}
?>