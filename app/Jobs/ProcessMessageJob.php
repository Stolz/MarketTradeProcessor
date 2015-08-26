<?php namespace App\Jobs;

use App\Message;

class ProcessMessageJob extends Job
{
	protected $message;

	/**
	 * Create a new job instance.
	 *
	 * @param  Message $message
	 * @return void
	 */
	public function __construct(Message $message)
	{
		$this->message = $message;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->message->process();
	}
}
