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
| general
|--------------------------------------------------------------------------
*/
'password_min'					=> 'min:6',

/*
|--------------------------------------------------------------------------
| db settings
|--------------------------------------------------------------------------
*/
'kagi_db' => array(
	'prefix'					=> '', // not fully implemented, also may not make of difference due to models
	'default_role_id'			=> '2',
	'activated'					=> '1',
	'verified'					=> '1',
),


/* SocialLite choices
|
| facebook, twitter, google, and github
|
*/
'kagi_social'					=> 'github',

];
