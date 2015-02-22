<?php namespace App\Modules\Profiles\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model;

use Caffeinated\Shinobi\Models\Role as Role;
use App\Modules\Kagi\Http\Domain\Models\User as User;

class ProfilesTableSeeder extends Seeder {

	public function run()
	{

/*
			$table->integer('user_id');
			$table->string('first_name',100)->nullable();
			$table->string('middle_initial',4)->nullable();
			$table->string('last_name',100)->nullable();
			$table->string('prefix',20)->nullable();
			$table->string('suffix',20)->nullable();

			$table->string('email_1',100)->nullable();
			$table->string('email_2',100)->nullable();

			$table->string('phone_1',20)->nullable();
			$table->string('phone_2',20)->nullable();

			$table->string('address',100)->nullable();
			$table->string('city',100)->nullable();
			$table->string('state',60)->nullable();
			$table->string('zipcode',20)->nullable();

//			$table->string('avatar',100)->nullable();
			$table->text('notes')->nullable();
*/

// Create Profiles
		DB::table('profiles')->delete();
			$statement = "ALTER TABLE profiles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$users = DB::table('users')->get();

		foreach ($users as $user)
		{

			$profiles = array(
				'user_id'				=> $user->id,
				'first_name'			=> $user->name,
				'email_1'				=> $user->email
			);

			DB::table('profiles')->insert( $profiles );

		}

	} // run


}
