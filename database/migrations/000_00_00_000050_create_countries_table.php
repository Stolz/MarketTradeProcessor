<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function (Blueprint $table) {

			// Primary key
			$table->increments('id');

			// Ordinary columns
			$table->char('code', 2)->unique(); // ISO 3166 alpha-2
			$table->string('name', 64)->unique();
			$table->unsignedInteger('currency_id'); // Foreign key

			// Extra keys
			$table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onDelete('restrict');

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
		Schema::dropIfExists('countries');
	}
}
