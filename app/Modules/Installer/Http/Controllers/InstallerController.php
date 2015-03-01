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
use Input;
use File;

class InstallerController extends Controller
{

	/**
	* Check for dependencies
	*/
	public function getIndex()
	{
//dd('start');
		if ( Config::get('rakko.install') == true)
		{
			Flash::warning(trans('installer::install.error.installed'));
			return redirect('/');
		}
		return View('installer::check');
	}


	/**
	* Run database calls
	*/
	public function getArtisan()
	{
dd('artisan');
//$test = Artisan::call('db:seed', array('--path' => 'App/Modules/Installer/Database/Seeds/InstallerDatabaseSeeder'));

		try {
//Artisan::call('module:seed', ['module' => 'manager']);
			Artisan::call('module:migrate', [
				''
				]);
			$flag1 = true;
		} catch (Exception $e) {
			$flag1 = false;
			Log::error( trans('installer::install.error.migrate') . $e->getMessage() );
			Response::make($e->getMessage(), 500);
		}

		try {
//Artisan::call('module:seed', ['module' => 'manager']);
			Artisan::call('module:seed', [
				''
				]);
			$flag2 = true;
		} catch (Exception $e) {
			$flag2 = false;
			Log::error( trans('installer::install.error.seed') . $e->getMessage() );
			Response::make($e->getMessage(), 500);
		}

			return View('installer::artisan',
				compact(
					'flag1',
					'flag2'
				));
	}


	/**
	* get settings
	*/
	public function getSettings()
	{
//dd('get settings');
// work around until config::write can be solved
		$version = '1.0.0';

$file = base_path() . '/config/' . 'rakko.php';
$contents = "hello";

dd(File::isWritable($file));


$bytes_written = File::put($file, $contents);
if ($bytes_written === false)
{
    die("Error writing to file");
}

// rakko app information
if ( Storage::disk('local')->exists('/../../config/rakko.php') ) {
dd('get settings');


}


		return View('installer::settings_show');


		try {
/*
			Config::set('rakko.installed', false);
			Config::set('rakko.version', $version);
			Config::set('rakko.install_date', date('YmdHis'));
*/
			$rakko_config = true;
		} catch (Exception $e) {
			$rakko_config = false;
			Log::error( trans('installer::install.error.rakko_config') . $e->getMessage() );
			Response::make($e->getMessage(), 500);
		}

//		return View('installer::final');



		return View('installer::settings_show');
	}


	/**
	* write settings
	*/
	public function postSettings()
	{
/*
//dd('post settings');
		$input = Input::all();
		$timezone = Input::get('timezone');
		$version = '1.0.0';

// app.timezone
//dd($timezone);
		try {
			Config::write('app.timezone', $timezone);
			$time_zone = true;
dd(Config::write('app.timezone', $timezone));
		} catch (Exception $e) {
			$timeZone = false;
			Log::error( trans('installer::install.error.timeZone') . $e->getMessage() );
			Response::make($e->getMessage(), 500);
		}

// rakko app information
		try {
			Config::set('rakko.installed', false);
			Config::set('rakko.version', $version);
			Config::set('rakko.install_date', date('YmdHis'));
			$rakko_config = true;
		} catch (Exception $e) {
			$rakko_config = false;
			Log::error( trans('installer::install.error.rakko_config') . $e->getMessage() );
			Response::make($e->getMessage(), 500);
		}

		return View('installer::final');
*/
	}


}
