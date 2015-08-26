<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		$now = Carbon\Carbon::now();

		$users = [
			[
				'id' => 1,
				'username' => 'johndoe',
				'email' => 'john.doe@example.com',
				'password' => str_random(10),
				'country_id' => 1,
				'created_at' => $now,
				'updated_at' => $now
			],
		];

		DB::table('users')->insert($users);
	}
}
