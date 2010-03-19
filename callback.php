<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
ini_set('session.gc_maxlifetime',300);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
session_start();
require_once('lib/twitteroauth.php');
require_once('config.php');

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
	$_SESSION['oauth_status'] = 'oldtoken';
	header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(TWITTER_KEY, TWITTER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise start over */
if (200 == $connection->http_code) {
	$_SESSION['status'] = 'verified';
	header('Location: ./');
} else {
	header('Location: ./clearsessions.php');
}
?>