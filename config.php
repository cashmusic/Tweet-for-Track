<?php

/**
 * @file
 * A single location to store configuration.
 */

// add all your twitter credentials
// get your twitter API keys here: http://twitter.com/apps
define('TWITTER_KEY', 'xxxxxxxxxxxxxxxxxxxxxx');
define('TWITTER_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
define('TWITTER_USERNAME', 'cashmusic'); // without the @
define('TWITTER_ID', 15013686); // check the RSS feed on your twitter page to find your twitter id #
define('OAUTH_CALLBACK', 'http://yoursite.com/callback.php');

// set to true to make a user auto-follow you, false to display checkbox
define('AUTO_FOLLOW', false);

// set generic error message — include an email for help
define('ERROR_MESSAGE', 'Something\'s gone wrong.');

// define the default tweet as it should show up in the initial form
define('DEFAULT_TWEET', 'Downloading free code for a tweet-for-track app from @cashmusic: http://tweet.cashmusic.org/');
// set required content, or use an empty string for no requirements
define('REQUIRED_CONTENT', 'http://tweet.cashmusic.org/');

// set secure download to true (for S3 security) or false for straight http download
define('SECURE_DOWNLOAD', false);
// set amazon credentials if you are using a secure download
define('AMAZONS3_KEY', 'xxxxxxxxxxxxxxxxxxxxxx');
define('AMAZONS3_SECRET', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
define('AMAZONS3_BUCKET', 'bucketname');

// set your download title
define('DOWNLOAD_TITLE', 'downloadTitle');
// URL or amazon URI (if amazon, do not include bucket)
define('DOWNLOAD_URI', 'downloadURL');

// add a string to randomize the session variable names. or don't. whatever.
define('RANDOMIZE_SESSION', '123456');
?>