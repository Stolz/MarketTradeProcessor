<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CurrenciesTableSeeder');
		$this->call('CountriesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('MessagesTableSeeder');

		Model::reguard();
	}
}
