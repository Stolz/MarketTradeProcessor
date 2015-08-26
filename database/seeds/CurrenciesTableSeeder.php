<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
	public function run()
	{
		$now = Carbon\Carbon::now();

		$currencies = [
			['id' => 1, 'code' => 'EUR', 'created_at' => $now, 'updated_at' => $now, 'name' => 'Euro'],
			['id' => 2, 'code' => 'GBP', 'created_at' => $now, 'updated_at' => $now, 'name' => 'British Pound'],
			['id' => 3, 'code' => 'AUD', 'created_at' => $now, 'updated_at' => $now, 'name' => 'Australian Dollar'],
		];

		DB::table('currencies')->insert($currencies);
	}
}
