<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<title>CASH Music</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="icon" type="image/png" href="http://cashmusic.org/images/icons/cash.png" /> 
 
<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js" type="text/javascript"></script>
<script type="text/javascript">
// <![CDATA[
function updateRemaining(labelid) {
	max_chars = 140;
	current_value = $('tweetthis').value;
	current_length = current_value.length;
	remaining_chars = max_chars-current_length;
	document.id(labelid).innerHTML = 'Remaining: ' + remaining_chars;
		
	if(remaining_chars<=13){
		document.id(labelid).setStyle('color', '#900');
	} else {
		document.id(labelid).setStyle('color', '#999');
	}
}

window.addEvent('domready', function() {
	document.id('tweetthis').addEvent('keyup', function() {
		updateRemaining('tweetlabel');
	});
	
	$('tweetthis').addEvent('keydown', function(e) {
		updateRemaining('tweetlabel');
			
		if(remaining_chars<1 && e.key != 'delete' && e.key != 'backspace'){
			e.stop();
		}
	});
	
	updateRemaining('tweetlabel');
});
// ]]>
</script>
 
<link href="assets/css/main.css" rel="stylesheet" type="text/css" /> 
 
</head> 
<body> 
 
<div id="wrap"> 
	<div id="cash_sitelogo"><a href="http://cashmusic.org/"><img src="assets/images/cash.png" alt="CASH Music" width="30" height="30" /></a></div> 
	<div id="mainspc"> 
			
		<h2>Tweet For A Track— err, Download</h2>
		<p>
		Just tweet from this page and you'll unlock a download of, well, this site. The code
		is easily configured php using open-source libraries and allows for required text 
		in the tweet, following-back, and can work with or without Amazon S3 security.
		</p>
		<?php
			if (isset($_SESSION['tweet_error'])) {
				echo "<p style=\"color:#c00;\">{$_SESSION['tweet_error']}</p>";
			}
		?>
		<label for="tweetthis" id="tweetlabel">Remaining: 140</label>
		<form id="tweetThis" action="redirect.php" method="get">
			<div class="tweet">
				<textarea cols="65" rows="5" id="tweetthis" name="tweetthis"><?php echo DEFAULT_TWEET; ?></textarea>	
			</div>
			<?php if (!AUTO_FOLLOW) { ?>
				<div style="color:#aaa;font-size:0.85em;display:inline;"><input type="checkbox" checked="checked" name="chosenfollow" value="1" class="checkorradio" /> also follow @<?php echo TWITTER_USERNAME; ?><br /><br /></div>
	  		<?php } ?>
	  		<div class="button">
	  			<input class="button" type="submit" value="tweet" /> 
	  		</div>
		</form>
 		
 		<br /><br /><br />
 		<p style="font-size:0.85em;color:#aaa;">
 		And if you don't feel like tweeting, you can just <a href="http://github.com/cashmusic/Tweet-for-Track" style="color:#c90;">download it from GitHub</a>.
 		</p>
 		
	</div> 
</div> 
 
<script type="text/javascript"> 
//<![CDATA[ 
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
//]]> 
</script><script type="text/javascript"> 
//<![CDATA[ 
try {var pageTracker = _gat._getTracker("UA-7451645-1");pageTracker._trackPageview();} catch(err) {}
//]]> 
</script> 
</body> 
</html>
