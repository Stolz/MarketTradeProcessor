<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
	// Meta ========================================================================

	use SoftDeletes;

	/**
	 * The attributes that are not mass-assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

	/**
	 * What should be returned when this model is casted to string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->name;
	}

	// ORM Relationships ===========================================================

	/**
	 * Define the 'many' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function countries()
	{
		return $this->hasMany('App\Country');
	}

	/**
	 * Define the 'many' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function originMessages()
	{
		return $this->hasMany('App\Message', 'from_currency_id');
	}

	/**
	 * Define the 'many' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function destinationMessages()
	{
		return $this->hasMany('App\Message', 'to_currency_id');
	}

	// Bussines Logic ==============================================================

	/**
	 * Format a currency amount with with grouped thousands and ISO 4217 code.
	 *
	 * @param float   $number
	 * @param int     $decimals
	 * @param string  $decimalPoint
	 * @param string  $thousandsSeparator
	 * @return string
	 */
	public function format($number, $decimals = 2, $decimalPoint = ',', $thousandsSeparator = '.')
	{
		return number_format($number, $decimals, $decimalPoint, $thousandsSeparator) . ' ' . $this->code;
	}
}
