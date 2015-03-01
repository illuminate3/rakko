<?php

// module


return [

	'install_artisan'				=> 'Installation: Artisan Commands',
	'install_check'					=> 'Installation: Check',
	'install_final'					=> 'Rakko Installed: Login to your Rakko Application',
	'install_settings'				=> 'Installation: Settings',
	'please_wait'					=> 'The next step will take a few seconds.',
	'time_zone'						=> 'Time Zone:',
	'title'							=> 'Rakko Installer',

	'ask' => [
		'timezone'					=> 'is this the correct timezone? If not, change it in config/app',
	],

	'button' => [
		'login'						=> 'Login',
		'next'						=> 'Next',
		'retry'						=> 'Retry',
		'submit'					=> 'Submit',
	],

	'command' => [
		'change_installed'			=> 'Change the config/rakko installed setting to "true"',
	],

	'error' => [
		'db_seed'					=> 'Automatic Migration and Seeding Failed. Please do a manual install.',
		'gd'						=> 'GD Extension is Enabled',
		'image'						=> '/images Directory is not Writable',
		'installed'					=> 'Already installed!',
		'pdo'						=> 'PDO is not Enabled',
		'migrate'					=> 'The Table :table was not Migrated',
		'migrations'				=> 'There were error(s) with migrations. Please check the error log.',
		'mcrypt'					=> 'Mcrypt Extension is not Enabled',
		'rakko_config'				=> 'Error Occured: Rakko config file.',
		'seed'						=> 'The Table :table was not Seeded',
		'seeds'						=> 'There were error(s) with seeding. Please check the error log.',
		'storage'					=> '/storage Directory is not Writable',
		'timeZone'					=> 'Error Occured: app time zone setting',
	],

	'final' => [
		'congratualaitons'			=> 'Congratulations! Your Rakko app is ready to go!',
		'password'					=> 'Password:',
		'login'						=> 'Login:',
		'social_login'				=> 'Refer to readme to use social logins',
	],

	'success' => [
		'gd'						=> 'GD Extension is Enabled',
		'image'						=> '/images Directory is Writable',
		'installed'					=> 'Rakko is installed',
		'php_version'				=> 'PHP Version Compatible',
		'pdo'						=> 'PDO is Enabled',
		'migrate'					=> 'The Tables were Migrated',
		'mcrypt'					=> 'Mcrypt Extension is Enabled',
		'seed'						=> 'The Tables were Seeded',
		'storage'					=> '/Storage Directory is Writable',
	],

];
