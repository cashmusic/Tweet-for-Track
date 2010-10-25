<?php
ini_set('session.gc_maxlifetime',300);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',1);
session_start();

if (!isset($_SESSION['oath_begun'])) {
	$_SESSION['oath_begun'] = false;
}

if (!isset($_SESSION['oath_complete'])) {
	$_SESSION['oath_complete'] = false;
}

//
//
// begin logic and display HTML:
if ($_SESSION['oath_begun']) {

	if ($_SESSION['status'] == 'verified') {
		if (!$_SESSION['oath_complete'.RANDOMIZE_SESSION]) {
		
			/* load requred lib files: */
			require_once('lib/twitteroauth.php');
			require_once('config.php');
			
			// if the tweet hasn't been carried over from the session then use the default language:
			if (!isset($_SESSION['user_tweet'])) {
				$_SESSION['user_tweet'] = DEFAULT_TWEET;
			}
			// same for follow status:
			if (!isset($_SESSION['chosenfollow'])) {
				$_SESSION['chosenfollow'] = AUTO_FOLLOW;
			}
			
			/* If access tokens are not available redirect to connect page. */
			if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
			    header('Location: ./clearsessions.php');
			}
			/* Get user access tokens out of the session. */
			$access_token = $_SESSION['access_token'];
			
			/* Create a TwitterOauth object with consumer/user tokens. */
			$connection = new TwitterOAuth(TWITTER_KEY, TWITTER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			
			/* If method is set change API call made. Test is called by default. */
			$content = $connection->get('account/verify_credentials');
			if ($_SESSION['chosenfollow']) {
				$connection->post('friendships/create', array('screen_name' => TWITTER_USERNAME));
			}
			$connection->post('statuses/update', array('status' => $_SESSION['user_tweet']));
			
			// mark the oath process as complete 
			$_SESSION['oath_complete'.RANDOMIZE_SESSION] = true;
		}
		
		/* Include HTML to display on the page */
		include('content_download.php');
	} else {
		require_once('config.php');
		$_SESSION['tweet_error'] = "Twitter reports that you did not verify application access. Please try again.";
		include('content_tweet.php');	
	}	
	

} else {
	
	require_once('config.php');
	if (TWITTER_KEY === '' || TWITTER_SECRET === '') {
	  echo ERROR_MESSAGE;
	  exit;
	}
	 
	/* Include HTML to display on the page. */
	include('content_tweet.php');
	
}
?>