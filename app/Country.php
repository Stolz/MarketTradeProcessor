<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
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
	 * Define the 'one' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function currency()
	{
		return $this->belongsTo('App\Currency')->withTrashed();
	}

	/**
	 * Define the 'many' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function messages()
	{
		return $this->hasMany('App\Message');
	}

	/**
	 * Define the 'many' side of a one-to-many relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\Relation
	 */
	public function users()
	{
		return $this->hasMany('App\User');
	}
}
