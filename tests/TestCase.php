<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{
	/**
	 * Creates the application.
	 *
	 * @return \Laravel\Lumen\Application
	 */
	public function createApplication()
	{
		return require __DIR__.'/../bootstrap/app.php';
	}

	/**
	 * Assert session has no errors.
	 *
	 * @param  string
	 *
	 * @return $this
	 */
	protected function assertSessionHasNoErrors($label = null)
	{
		$session = $this->app['session.store'];

		if($session->has('errors'))
		{
			$errors = $session->get('errors', new Illuminate\Support\MessageBag)->all();
			$this->assertEmpty($errors, "$label has errors: " . print_r($errors, true));
		}

		return $this;
	}
}
