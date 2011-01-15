setTimeout('UpdateFacebook(), UpdateStumbleUpon(), UpdateReddit()', 1000);

function UpdateTwitter()
{   
	var twitterIFrame = document.getElementById('twitterIFrame');
	
	var dataCount = document.getElementById('socialshare-twitterStyle').value;
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
	var style = document.getElementById('socialshare-stumbleuponStyle').value;
		
	var src = 	'<script src="http://www.stumbleupon.com/hostedbadge.php?s='+style+'&r=http://www.jpreece.com"></script>';
									
	var doc = stumbleuponIFrame.contentDocument;
    if (doc == undefined || doc == null)
        doc = stumbleuponIFrame.contentWindow.document;
    
	doc.open();
    doc.write(src);
    doc.close(); 
}

function UpdateReddit()
{
	var redditIFrame = document.getElementById('redditIFrame');	
	
	var style = document.getElementById('socialshare-redditStyle').value;
	var src = "";
	var arg = "";
	switch(style.length)
	{
		case 11:
			arg = style.substring(10,11);
			src = '<script type="text/javascript" src="http://reddit.com/buttonlite.js?i='+arg+'&newwindow=1"></script>';
		break;
		case 7:
			arg = style.substring(6,7);
			src = '<script type="text/javascript" src="http://reddit.com/static/button/button'+arg+'.js?newwindow=1"></script>';
			break;
		case 9:
			arg = style.substring(8,9);
			src = GetRedditScript(arg);
			break;
		case 10:
			arg = style.substring(8,10);
			src = GetRedditScript(arg);
			break;
	}
						
	var doc = redditIFrame.contentDocument;
    if (doc == undefined || doc == null)
        doc = redditIFrame.contentWindow.document;
    
	doc.open();
    doc.write(src);
    doc.close(); 
}

function GetRedditScript(number)
{
	return 	'<a href="http://reddit.com/submit" onclick="' +
			"window.location = 'http://reddit.com/submit?url='" +
			"+ encodeURIComponent(window.location); return false" + 
			'"> <img src="http://reddit.com/static/spreddit'+number+'.gif" alt="submit to reddit" border="0" /> </a>';
}

function UpdateFacebook()
{	
	var facebookIFrame = document.getElementById('facebookIFrame');
	
	var layout = document.getElementById('socialshare-facebookStyle').value;
	
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