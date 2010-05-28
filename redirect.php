<?php

/* Start session and load library. */
ini_set('session.gc_maxlifetime',300);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
session_start();
require_once('config.php');

// if magic quotes are on, strip them from the tweet
if (get_magic_quotes_gpc()) {
	$_REQUEST['tweetthis'] = stripslashes($_REQUEST['tweetthis']);
}

// check for reqired string
$validatedtweet = true;
if (strlen(REQUIRED_CONTENT) > 0) {
	if (!stripos($_REQUEST['tweetthis'],REQUIRED_CONTENT)) {
		$validatedtweet = false;
	}
}

if (!$validatedtweet) {
	// throw error if required content was not found
	$_SESSION['tweet_error'] = "Sorry, but your tweet must contain “". REQUIRED_CONTENT . "” — the rest is up to you.";
	header('Location: ./'); 
} else {
	$_SESSION['user_tweet'] = $_REQUEST['tweetthis'];
	$_SESSION['chosenfollow'] = AUTO_FOLLOW;
	if (isset($_REQUEST['chosenfollow'])) {
		$_SESSION['chosenfollow'] = true;
	}
	
	require_once('lib/twitteroauth.php');
	
	/* Build TwitterOAuth object with client credentials. */
	$connection = new TwitterOAuth(TWITTER_KEY, TWITTER_SECRET);
	 
	/* Get temporary credentials. */
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	
	/* Save temporary credentials to session. */
	$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	 
	/* If last connection failed don't display authorization link. */
	switch ($connection->http_code) {
	case 200:
		$_SESSION['oath_begun'] = true;
		/* Build authorize URL and redirect user to Twitter. */
		$url = $connection->getAuthorizeURL($token);
		header('Location: ' . $url); 
		break;
	default:
		/* Show notification if something went wrong. */
		$_SESSION['tweet_error'] = 'Could not connect to Twitter. Refresh the page or try again later.';
		header('Location: ./'); 
	}
}
?>