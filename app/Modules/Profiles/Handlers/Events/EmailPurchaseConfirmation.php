<?php namespace App\Handlers\Events;

use App\Events\PodcastWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailPurchaseConfirmation {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PodcastWasPurchased  $event
	 * @return void
	 */
	public function handle(PodcastWasPurchased $event)
	{
		//
	}

}



// php artisan handler:event EmailPurchaseConfirmation --event=PodcastWasPurchased
