<?php
namespace App\Modules\Profiles\Events;

use App\Modules\Profiles\Events\Event;

use Illuminate\Queue\SerializesModels;

class PodcastWasPurchased extends Event {

	use SerializesModels;

public $userID;
public $podCastID;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userID, $podCastID)
	{
		//
$this->userID = $userID;
$this->podCastID = $podCastID;

	}

}
