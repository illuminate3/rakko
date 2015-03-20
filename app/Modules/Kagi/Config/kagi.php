<?php

return [

/*
|--------------------------------------------------------------------------
| general
|--------------------------------------------------------------------------
*/
'site_name'						=> 'Kagi',
'separator'						=> ':',
'site_email'					=> 'kagi@example.com',

/*
|--------------------------------------------------------------------------
| Security
|--------------------------------------------------------------------------
*/
'password_min'					=> 'min:6',
'throttle'						=> '3',
'time_out'						=> '2',
'default_role'					=> '2', // Admin is ID 1

/*
|--------------------------------------------------------------------------
| db settings
|--------------------------------------------------------------------------
*/
'kagi_db' => array(
	'prefix'					=> '', // not fully implemented, also may not make of difference due to models
	'default_role_id'			=> '2',
	'activated'					=> '1',
	'blocked'					=> '0',
),


/* SocialLite choices
|
| facebook, twitter, google, and github
|
*/
'kagi_social'					=> 'github',
'kagi_avatar'					=> 'assets/images/usr.png',

];
