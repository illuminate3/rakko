<?php
namespace App\Modules\Profiles\Handlers\Events;

use App\Modules\Profiles\Events\ProfileWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Modules\Profiles\Http\Domain\Models\Profile;
use App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository;


class DeleteProfile {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
			ProfileRepository $profileRepo
		)
	{
		$this->profileRepo = $profileRepo;
	}


	/**
	 * Handle the event.
	 *
	 * @param  ProfileWasCreated  $email
	 * @return void
	 */
	public function handle(ProfileWasDeleted $data)
	{
		if ($data != null) {
			$this->profileRepo->DeleteProfile($data);
		}
	}


}
