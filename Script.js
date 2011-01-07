setTimeout('UpdateFacebook(), UpdateStumbleUpon()', 1000);

function UpdateTwitter()
{   
	var twitterIFrame = document.getElementById('twitterIFrame');
	
	var dataCount = document.getElementById('socialshare-buttonstyle').value;
	var datavia = document.getElementById('socialshare-twitterUsername').value;
	var datalang = document.getElementById('socialshare-twitterlanguage').value;
		
	var src = 	'<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>' + 
				'<a href="http://twitter.com/share" class="twitter-share-button" data-count="' + dataCount + '" ' +
				'data-via="' + datavia + '" data-lang="' + datalang + '">Tweet</a>';
									
	var doc = twitterIFrame.contentDocument;
    if (doc == undefined || doc == null)
        doc = twitterIFrame.contentWindow.document;
    
	doc.open();
    doc.write(src);
    doc.close(); 
}

function UpdateStumbleUpon()
{   
	var stumbleuponIFrame = document.getElementById('stumbleuponIFrame');	
	var style = document.getElementById('socialshare-stumbleStyle').value;
		
	var src = 	'<script src="http://www.stumbleupon.com/hostedbadge.php?s='+style+'&r=http://www.jpreece.com"></script>';
									
	var doc = stumbleuponIFrame.contentDocument;
    if (doc == undefined || doc == null)
        doc = stumbleuponIFrame.contentWindow.document;
    
	doc.open();
    doc.write(src);
    doc.close(); 
}

function UpdateFacebook()
{	
	var facebookIFrame = document.getElementById('facebookIFrame');
	
	var layout = document.getElementById('socialshare-layout').value;
	
	var show_faces = document.getElementById('socialshare-showfaces').value;
	if (show_faces == "on")
		show_faces = "true";
	else
		show_faces = "false";
	
	var width = document.getElementById('socialshare-width').value;
	var action = document.getElementById('socialshare-action').value;
	var color = document.getElementById('socialshare-colorscheme').value;
	var height = document.getElementById('socialshare-height').value;
	var font = document.getElementById('socialshare-font').value;
	var language = document.getElementById('socialshare-facebooklanguage').value;
	
	var url = 	'http://www.facebook.com/plugins/like.php?href=http://www.jpreece.com/&layout=' + layout + '&' +
				'show_faces=' + show_faces + '&' +
				'width=' + width + '&' +
				'action=' + action + '&' +
				'colorscheme=' + color + '&' +
				'font=' + font + '&' +
				'height=' + height + '&' +
				'locale=' + language;
			
	facebookIFrame.src = url;
}