<?php
namespace App\Modules\Profiles\Handlers\Events;

use App\Modules\Profiles\Events\PodcastWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendPurchaseConfirmation {

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
dd($event);
	}

}
