<?php
namespace App\Modules\Profiles\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Providers\EventServiceProvider;

use App\Modules\Profiles\Events\ProfileWasCreated;
use App\Modules\Profiles\Handlers\Events\CreateProfile;
use App\Modules\Profiles\Events\ProfileWasDeleted;
use App\Modules\Profiles\Handlers\Events\DeleteProfile;

use App;
use Event;

class ProfileEventServiceProvider extends EventServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

		ProfileWasCreated::class => [
			CreateProfile::class,
		],

		ProfileWasDeleted::class => [
			DeleteProfile::class,
		],

	];


	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		//
	}

	public function register()
	{

		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('ProfileWasCreated', 'App\Modules\Profiles\Events\ProfileWasCreated');

		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('ProfileWasDeleted', 'App\Modules\Profiles\Events\ProfileWasDeleted');

	}


}
