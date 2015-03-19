<?php
namespace App\Modules\Profiles\Events;

use App\Modules\Profiles\Events\Event;
use Illuminate\Queue\SerializesModels;

class ProfileWasCreated extends Event {

	use SerializesModels;

	public $data;

	public function __construct($data)
	{
//dd($data);
/*
  +"id": 3
  +"name": "illuminate3"
  +"email": "illuminate3"
  +"password": null
  +"remember_token": "PhPn4hDLwsey4OthKICrHwH9f9HsSbqYLBUZMSV7Oks5TKpjy9QQLYrOMELI"
  +"reset_password_code": null
  +"blocked": 0
  +"banned": 0
  +"confirmed": 1
  +"activated": 1
  +"confirmation_code": "404360e5db537c12e25421ce5db2889c"
  +"activated_at": "2015-03-16 14:20:26"
  +"last_login": "2015-03-19 15:08:58"
  +"avatar": "https://avatars.githubusercontent.com/u/5723311?v=3"
  +"deleted_at": null
  +"created_at": "2015-03-16 14:20:26"
  +"updated_at": "2015-03-19 13:49:52"
*/
//dd($data->id);

		$this->id				= $data->id;
		$this->email			= $data->email;

	}


}
