<?php
namespace App\Modules\Profiles\Handlers\Events;

use App\Modules\Profiles\Events\ProfileWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Modules\Profiles\Http\Domain\Models\Profile;
use App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository;


class CreateProfile {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
			ProfileRepository $profile
		)
	{
		$this->profile = $profile;
	}


	/**
	 * Handle the event.
	 *
	 * @param  ProfileWasCreated  $email
	 * @return void
	 */
	public function handle(ProfileWasCreated $data)
	{
//dd($email);

		if ($data != null) {
			$this->profile->findOrCreateProfile($data);
		}

	}


}
