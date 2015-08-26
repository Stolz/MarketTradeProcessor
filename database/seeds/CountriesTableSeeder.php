<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
	public function run()
	{
		$now = Carbon\Carbon::now();

		$countries = [
			['id' => 1, 'code' => 'IE', 'currency_id' => 1, 'created_at' => $now, 'updated_at' => $now, 'name' => 'Ireland'],
			['id' => 2, 'code' => 'GB', 'currency_id' => 2, 'created_at' => $now, 'updated_at' => $now, 'name' => 'United Kingdom'],
			['id' => 3, 'code' => 'AU', 'currency_id' => 3, 'created_at' => $now, 'updated_at' => $now, 'name' => 'Australia'],
		];

		DB::table('countries')->insert($countries);
	}
}
