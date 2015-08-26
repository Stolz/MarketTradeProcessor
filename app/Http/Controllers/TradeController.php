<?php namespace App\Http\Controllers;

use App\Country;
use App\Currency;
use App\Jobs\ProcessMessageJob;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stolz\LaravelFormBuilder\Pagination;

class TradeController extends Controller
{
	/**
	 * Number of results per page.
	 *
	 * @var integer
	 */
	protected $perPage = 10;

	/**
	 * Show messages list.
	 *
	 * @return Response
	 */
	public function showMessages()
	{
		// Data required for the list
		$relations = ['user', 'fromCurrency', 'toCurrency', 'country'];
		$messages = Message::latest()->with($relations)->paginate($this->perPage);
		$pagination = new Pagination($messages);

		// Data required for the form
		$users = User::lists('username', 'id')->all();
		$countries = Country::lists('name', 'code')->all();
		$currencies = Currency::lists('name', 'code')->all();

		// Load view
		return view('messages', compact('messages', 'pagination', 'users', 'countries', 'currencies'));
	}

	/**
	 * Queue a new message.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function queueMessage(Request $request)
	{
		// Validate request
		$this->validate($request, $rules = [
			'userId'             => 'required|integer|exists:users,id',
			'originatingCountry' => 'required|alpha|size:2|exists:countries,code',
			'currencyFrom'       => 'required|alpha|size:3|exists:currencies,code',
			'currencyTo'         => 'required|alpha|size:3|different:currencyFrom|exists:currencies,code',
			'amountSell'         => 'required|numeric|min:1',
			'amountBuy'          => 'required|numeric|min:1',
			'rate'               => 'required|numeric|min:0.001',
			'timePlaced'         => 'required|before:' . Carbon::now()->toDateTimeString(),
		]);

		// Process input
		$input = $this->processInput($request->only(array_keys($rules)));

		// Create message
		$message = Message::create([
			'user_id'          => $input->userId,
			'country_id'       => $input->originatingCountry,
			'from_currency_id' => $input->currencyFrom,
			'to_currency_id'   => $input->currencyTo,
			'amount_sell'      => $input->amountSell,
			'amount_buy'       => $input->amountBuy,
			'rate'             => $input->rate,
			'placed_at'        => $input->timePlaced,
		]);

		// Queue message to be processed later
		$this->dispatch(new ProcessMessageJob($message));

		return redirect('/')->withSuccess(sprintf('Message %d successfully created', $message->getKey()));
	}

	/**
	 * Convert from human friendly form input to database safe input.
	 *
	 * @param  array
	 * @return stdClass
	 */
	protected function processInput(array $input)
	{
		$input = (object) $input;

		$input->originatingCountry = Country::whereCode($input->originatingCountry)->firstOrFail()->getKey();
		$input->currencyFrom       = Currency::whereCode($input->currencyFrom)->firstOrFail()->getKey();
		$input->currencyTo         = Currency::whereCode($input->currencyTo)->firstOrFail()->getKey();
		$input->amount_sell        = sprintf('%F', $input->amountSell);
		$input->amount_buy         = sprintf('%F', $input->amountBuy);
		$input->rate               = sprintf('%F', $input->rate);
		$input->placed_at          = new Carbon($input->timePlaced);

		return $input;
	}
}
