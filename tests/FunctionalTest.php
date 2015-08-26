<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class FunctionalTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * Test home page endpint.
	 *
	 * @return void
	 */
	public function testHomePage()
	{
		// Populate data base
		$this->seed();

		$this
		->visit('/')
		->see('Market Trade Processor')
		->select('1', 'userId')
		->select('IE', 'originatingCountry')
		->select('EUR', 'currencyFrom')
		->select('GBP', 'currencyTo')
		->type('1.1', 'amountSell')
		->type('2.2', 'amountBuy')
		->type('0.9', 'rate')
		->type('2015-01-01 01:01:01', 'timePlaced')
		->press('Submit')
		->seePageIs('/')
		->assertSessionHasNoErrors();
	}
}
