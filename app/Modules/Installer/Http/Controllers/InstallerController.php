<?php
namespace App\Modules\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Foundation\Validation\ValidatesRequests;
//use October\Rain\Config\Rewrite as NewConfig;

use Artisan;
use Config;
use Flash;

class InstallerController extends Controller
{

	/**
	* Check for dependencies
	*/
	public function getIndex()
	{
//dd('start');
		if(Config::get('rakko.install'))
		{
			Flash::warning(trans('installer::install.error.installed'));
			return redirect('/');
		}
		else
		{
			return View('installer::check');
		}
	}


	/**
	* Run database calls
	*/
	public function getArtisan()
	{
//dd('artisan');
//$test = Artisan::call('db:seed', array('--path' => 'App/Modules/Installer/Database/Seeds/InstallerDatabaseSeeder'));

		try {
			Artisan::call('module:migrate', [
				''
				]);
			$flag1 = true;
		} catch (Exception $e) {
			$flag1 = false;
			Response::make($e->getMessage(), 500);
		}

		try {
			Artisan::call('module:seed', [
				''
				]);
			$flag2 = true;
		} catch (Exception $e) {
			$flag2 = false;
			Response::make($e->getMessage(), 500);
		}

			return View('installer::artisan',
				compact(
					'flag1',
					'flag2'
				));
	}


	/**
	* settings
	*/
	public function getSettings()
	{
		return View::make('install.settings');
	}

	public function postTimeZone()
	{
		$timeZone = Input::get('timezone');
		$newAppConfig = new NewConfig;
		$newAppConfig->toFile(app_path().'/config/app.php', [
              'timezone'=> $timeZone
            ]);
		return View::make('install.adminaccount');
	}
	public function postAdminAccount()
	{
		$data = Input::all();
		//return View::make('install.done');

		try
        {

            $new92fiveConfig = new NewConfig;
			$new92fiveConfig->toFile(app_path().'/config/92five.php', [
              'install'=> true,
              'version' => '1.0',
              'installationDate'=>$installationDate,
              'installationHost' =>$installationHost
            ]);
            return View::make('install.done');
        }
        catch(Exception $e)
        {
            Log::error('Something Went Wrong in Install Controller Repository - addUserWithDetails():'. $e->getMessage());
            throw new Exception ('Something Went Wrong in Install Controller Repository - addUserWithDetails()');
        }
	}
}
