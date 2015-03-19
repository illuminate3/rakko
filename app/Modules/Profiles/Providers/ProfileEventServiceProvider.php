<?php
namespace App\Modules\Profiles\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Providers\EventServiceProvider;

use App\Modules\Profiles\Events\ProfileWasCreated;
use App\Modules\Profiles\Handlers\Events\CreateProfile;

//use Illuminate\Foundation\Application;
use App;
use Event;

class ProfileEventServiceProvider extends EventServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
// 		'event.name' => [
// 			'EventListener',
// 		],

		ProfileWasCreated::class => [
			CreateProfile::class,
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

	}


}
