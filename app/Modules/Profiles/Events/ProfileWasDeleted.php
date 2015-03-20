<?php
namespace App\Modules\Profiles\Events;

use App\Modules\Profiles\Events\Event;
use Illuminate\Queue\SerializesModels;

class ProfileWasDeleted extends Event {

	use SerializesModels;

	public $data;

	public function __construct($data)
	{
//dd($data);
//dd($data->id);

		$this->id				= $data->id;
		$this->email			= $data->email;

	}


}
