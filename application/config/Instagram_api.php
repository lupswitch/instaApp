<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'myApp';
$config['instagram_client_id']		= 'af54f552f52e411aa2ec47903b272c93';
$config['instagram_client_secret']	= 'ed17348caa25458c9f59e35b971b910d';
$config['instagram_callback_url']	= 'http://myapp-ccompera.c9.io/index.php/Authorize/get_code';
$config['instagram_website']		= 'http://myapp-ccompera.c9.io/';
$config['instagram_description']	= '';

/**
 * Instagram provides the following scope permissions which can be combined as likes+comments
 * 
 * basic - to read any and all data related to a user (e.g. following/followed-by lists, photos, etc.) (granted by default)
 * comments - to create or delete comments on a user’s behalf
 * relationships - to follow and unfollow users on a user’s behalf
 * likes - to like and unlike items on a user’s behalf
 * 
 */
$config['instagram_scope'] = 'basic';

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= TRUE;
