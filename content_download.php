<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<title>CASH Music</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="icon" type="image/png" href="http://cashmusic.org/images/icons/cash.png" /> 
 
<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.4/mootools-yui-compressed.js" type="text/javascript"></script> 
<script type="text/javascript">
//<![CDATA[ 
window.addEvent('domready', function() {
	document.id('tweetlink').addEvent('click', function() {
		document.id('tweetlinkspc').set('html','Thank You!');
	});
});
//]]> 
</script>

<link href="assets/css/main.css" rel="stylesheet" type="text/css" /> 
 
</head> 
<body> 
 
<div id="wrap"> 
	<div id="cash_sitelogo"><a href="http://cashmusic.org/"><img src="assets/images/cash.png" alt="CASH Music" width="30" height="30" /></a></div> 
	<div id="mainspc"> 
	
		<h2>Thank You!</h2>
		<p>
			Click here to download a zip containing the tweet-for-track code:
		</p><p style="font-size:1.5em;" id="tweetlinkspc">
			<a href="claimasset.php" id="tweetlink"><?php echo DOWNLOAD_TITLE; ?></a>			
		</p>
		
		<br /><br /><br />
		<h2>So Now What?</h2>
		<p>
		All you need to do to get this up and working on your own server is:
		</p>
		<ol>
			<li>download the zipfile above</li>
			<li>unzip and upload it to your server</li>
			<li>edit 'config.php' to add your amazon/twitter credentials</li>
			<li>point it to your download</li>
			<li>make it pretty</li>
		</ol>
		<p>
		This is still a very DIY pre-release thing, so there is some tinkering needed.
		But not a lot of tinkering! We figured it might come in handy 
		for someone. We'll work it into a proper release soon, but for now: enjoy!
		</p>
 
	</div> 
</div> 
 
</body> 
</html>
