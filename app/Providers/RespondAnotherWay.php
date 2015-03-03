<?php namespace App\Providers;

use App\Providers\DidSomethingEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RespondAnotherWay {

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
	 * @param  DidSomethingEvent  $event
	 * @return void
	 */
	public function handle(DidSomethingEvent $event)
	{
		//
	}

}
