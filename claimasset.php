<?php
ini_set('session.gc_maxlifetime',300);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
session_start();
require_once('config.php');

$okaytodownload = false;
if ($_SESSION['oath_complete'.RANDOMIZE_SESSION]) {
	$okaytodownload = true;
}

$_SESSION = array();
session_destroy();

if ($okaytodownload) {
	if (SECURE_DOWNLOAD) { 
		// use S3 secured download:
		require_once('./lib/S3.php');
		
		// AWS access info
		if (!defined('AMAZONS3_KEY') || !defined('AMAZONS3_SECRET')) {
			$_SESSION['tweet_error'] = 'Amazon S3 has not been defined. Please add your key/secret to config.php or set SECURE_DOWNLOAD to false.';
			header('Location: ./'); 
		}
		
		// Instantiate the class
		$s3 = new S3(AMAZONS3_KEY, AMAZONS3_SECRET);
		
		header("Location: " . S3::getAuthenticatedURL(AMAZONS3_BUCKET, DOWNLOAD_URI, 120));
	} else {
		// simple redirect:
		header('Location: ' . DOWNLOAD_URI);
	}
} else {
	header('Location: ./');
}
?>