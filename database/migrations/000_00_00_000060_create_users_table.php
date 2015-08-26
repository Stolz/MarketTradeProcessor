<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {

			// Primary key
			$table->increments('id');

			// Ordinary columns
			$table->string('username', 64)->unique();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->unsignedInteger('country_id')->nullable(); // Foreign key

			// Extra keys
			$table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('set null');

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
		Schema::dropIfExists('users');
	}
}
