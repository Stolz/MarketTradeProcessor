<?php namespace App;

use Carbon\Carbon;
use DomainException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
	// Meta ========================================================================

	use SoftDeletes;

	/**
	 * The attributes that are not mass-assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'processed_at', 'created_at', 'updated_at', 'deleted_at'];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['placed_at', 'processed_at'];

	/**
	 * What should be returned when this model is casted to string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->id;
	}

	// ORM Relationships ===========================================================

	/**
	 * Define the 'one' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function user()
	{
		return $this->belongsTo('App\User')->withTrashed();
	}

	/**
	 * Define the 'one' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function fromCurrency()
	{
		return $this->belongsTo('App\Currency', 'from_currency_id')->withTrashed();
	}

	/**
	 * Define the 'one' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function toCurrency()
	{
		return $this->belongsTo('App\Currency', 'to_currency_id')->withTrashed();
	}

	/**
	 * Define the 'one' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function country()
	{
		return $this->belongsTo('App\Country')->withTrashed();
	}

	// Bussines Logic ==============================================================

	/**
	 * Check if the message has been processed already.
	 *
	 * @return bool
	 */
	public function isProcessed()
	{
		return ( ! is_null($this->processed_at));
	}

	/**
	 * Process a message.
	 *
	 * @return bool
	 * @throws DomainException
	 */
	public function process()
	{
		// Check if the message has been processed already
		if($this->isProcessed())
			throw new DomainException('The message has already been processed', $this->getKey());

		// NOTE: Here is where the real bussines logic should go.
		// Now there is only a silly empty function for demonstration purposes.

		$this->processed_at = Carbon::now();

		return $this->save();
	}

	/**
	 * Scope a query to only include proccesed messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeProcessed($query)
	{
		return $query->whereNotNull('processed_at');
	}

	/**
	 * Scope a query to only include proccesed messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeUnprocessed($query)
	{
		return $query->whereNull('processed_at');
	}

	/**
	 * Get the rate formatted with grouped thousands.
	 *
	 * @param int     $decimals
	 * @param string  $decimalPoint
	 * @param string  $thousandsSeparator
	 * @return string
	 */
	public function getRate($decimals = 4, $decimalPoint = ',', $thousandsSeparator = '.')
	{
		return number_format($this->rate, $decimals, $decimalPoint, $thousandsSeparator);
	}
}
