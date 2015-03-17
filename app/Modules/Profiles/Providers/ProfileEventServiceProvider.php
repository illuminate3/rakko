<?php
namespace App\Modules\Profiles\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Providers\EventServiceProvider;

use App\Modules\Profiles\Events\PodcastWasPurchased;
use App\Modules\Profiles\Handlers\Events\SendPurchaseConfirmation;

use App;

class ProfileEventServiceProvider extends EventServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],

PodcastWasPurchased::class => [
	SendPurchaseConfirmation::class,
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
		$this->app->bind('PodcastWasPurchased', function () {
			return new  App\Modules\Profiles\Events\PodcastWasPurchased();
		});
	}


}
