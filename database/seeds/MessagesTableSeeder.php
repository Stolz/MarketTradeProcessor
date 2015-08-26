<?php

use App\Jobs\ProcessMessageJob;
use App\Message;
use Illuminate\Database\Seeder;
use Laravel\Lumen\Routing\DispatchesJobs;

class MessagesTableSeeder extends Seeder
{
	use DispatchesJobs;

	public function run()
	{
		$now = Carbon\Carbon::now();

		$messages = [
			[
				'user_id' => 1,
				'from_currency_id' => 1,
				'to_currency_id' => 2,
				'country_id' => 1,
				'amount_sell' => 123.456,
				'amount_buy' => 789.012,
				'rate' => 0.333,
				'placed_at' => Carbon\Carbon::now()->subHours(mt_rand(1, 100)),
				'created_at' => $now,
				'updated_at' => $now,
			],
			[
				'user_id' => 1,
				'from_currency_id' => 2,
				'to_currency_id' => 3,
				'country_id' => 1,
				'amount_sell' => 22.33,
				'amount_buy' => 44.555,
				'rate' => 1.5,
				'placed_at' => Carbon\Carbon::now()->subHours(mt_rand(1, 100)),
				'created_at' => $now,
				'updated_at' => $now,
			],
		];

		DB::table('messages')->insert($messages);

		// Queue messages to be processed later
		$messages = App\Message::unprocessed()->get();
		foreach($messages as $message)
			$this->dispatch(new ProcessMessageJob($message));
	}
}
