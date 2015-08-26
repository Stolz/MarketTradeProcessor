<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function (Blueprint $table) {

			// Primary key
			$table->increments('id');

			// Ordinary columns
			$table->unsignedInteger('user_id');          // Foreign key
			$table->unsignedInteger('from_currency_id'); // Foreign key
			$table->unsignedInteger('to_currency_id');   // Foreign key
			$table->unsignedInteger('country_id');       // Foreign key
			$table->decimal('amount_sell', 20, 5);
			$table->decimal('amount_buy', 20, 5);
			$table->decimal('rate', 20, 5);
			$table->dateTime('placed_at');
			$table->dateTime('processed_at')->nullable();

			// Extra keys
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
			$table->foreign('from_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
			$table->foreign('to_currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');
			$table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('restrict');

			// Automatic columns
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('messages');
	}
}
