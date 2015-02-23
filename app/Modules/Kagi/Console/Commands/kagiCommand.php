<?php
namespace App\Modules\Kagi\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class KagiCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'kagi:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Kagi Module: Installer';

	/**
	 * user data
	 *
	 * @var array
	 */
	protected $userData = array(
		'name'			=> null,
		'email'			=> null,
		'password'		=> null
	);

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute console command
	 *
	 * @return void
	 */
	public function fire()
	{

// Step 1
		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Step: 1');
		$this->comment('');
		$this->info('    Create Admin User');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');

// Get Admin Information
		$this->askUserName();
		$this->askUserEmail();
		$this->askUserPassword();

// Step 2
		$this->comment('');
		$this->comment('');
		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Step: 2');
		$this->comment('');
		$this->info('    Seed the Permission and Role database');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');

// Run migrations
		$this->call('module:migrate kagi');

// Seed tables
		$this->call('module:seed kagi');

// Create Admin and insert Admin data
		$this->dataInstaller();

// Step 3
		$this->comment('');
		$this->comment('');
		$this->comment('=====================================');
		$this->comment('');
		$this->info('  Step: 3');
		$this->comment('');
		$this->info('    Publish Config files for the Kagi Module');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');

// Publish
		$this->call('php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider"');

// Step 3
		$this->comment('');
		$this->comment('');
		$this->comment('-------------------------------------');
		$this->comment('');
		$this->info('  Step: 4');
		$this->comment('');
		$this->info('    Congratulations! Finished');
		$this->comment('');
		$this->comment('=====================================');
		$this->comment('');

	} // end fire function


	/**
	 * group install functions
	 *
	 * @return void
	 */
	protected function dataInstaller()
	{

// Create Permissioins
		$this->createPermissions();

// Create Roles
		$this->createRoles();

// Create Admin user
		$this->createUser();

	}

	/**
	 * Asks Admin name
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserName()
	{
		do
		{
// Ask for Admin name
			$first_name = $this->question('Please enter the Admin name: ');

// Check if name is blank
			if ($first_name == '')
			{
// Return an error message
				$this->error('The Admin name is blank. Please try again.');
			}

// Store name
			$this->userData['name'] = $name;
		}
		while( ! $name);
	}

	/**
	 * Ask Admin Email
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserEmail()
	{
		do
		{
// Ask for Admin email
			$email = $this->question('Please enter the Admin email address: ');

// Check if email is blank
			if ($email == '')
			{
// Return an error message
				$this->error('The Admin Email is blank. Please try again.');
			}

// Store email
			$this->userData['email'] = $email;
		}
		while ( ! $email);
	}

	/**
	 * Asks Admin password.
	 *
	 * @return void
	 * @todo   Use the Laravel Validator
	 */
	protected function askUserPassword()
	{
		do
		{
// Ask for Admin password
			$password = $this->question('Please enter the Admin password: ');

// Check if password is blank
			if ($password == '')
			{
// Return an error message
				$this->error('Password is blank. Please try again.');
			}

// Store password
			$this->userData['password'] = bcrypt($password);
		}
		while( ! $password);
	}

	/**
	 * Create base permissions
	 *
	 * @return void
	 */
	protected function createPermissions()
	{

		$permissions = array(
			[
				'name'				=> 'Manage Admin',
				'slug'				=> 'manage_admin',
				'description'		=> 'Give permission to user to access the admin area.'
			],
		 );

		DB::table('permissions')->delete();
		DB::table('permissions')->insert( $permissions );

// Show success message
		$this->comment('');
		$this->info('Success: Permission Table and Seeder');

	}

	/**
	 * Create bae role
	 *
	 * @return void
	 */
	protected function createRoles()
	{

		$roles = array(
			[
				'name'				=> 'Admin',
				'slug'				=> 'admin',
				'description'		=> 'Give user full permission to site functions.'
			],
		 );

		DB::table('roles')->delete();
		DB::table('roles')->insert( $roles );

		$role = Role::find(1);
		$role->permissions()->attach(1);
// 		$role->syncPermissions([1]);

// Show success message.
		$this->comment('');
		$this->info('Success: Role Table and Seeder');

	}

	/**
	 * Create the Admin User, fill defaults, attach permission
	 *
	 * @return void
	 */
	protected function createUser()
	{
// Prepare data
		$data = array_merge($this->userData, array(
			'activated_at'			=> date("Y-m-d H:i:s"),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'confirmation_code'		=> md5(microtime().Config::get('app.key'))
		));

// Create the Admin user
		$user = User::create($data);

// Sync permission to Admin
		$user = User::find(1);
		$user->roles()->attach(1);
// 		Auth::user()->syncRoles([1]);

// Show the success message
		$this->comment('');
		$this->info('Success: Admin User');
		$this->comment('');
	}


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
// 		return [
// 			['example', InputArgument::REQUIRED, 'An example argument.'],
// 		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
// 		return [
// 			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
// 		];
	}

}
