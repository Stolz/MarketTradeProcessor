<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
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
	 * The attributes that should be hidden.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	/**
	 * What should be returned when this model is casted to string.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->username;
	}

	// ORM Relationships ===========================================================

	public function country()
	{
		return $this->belongsTo('App\Country')->withTrashed();
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
}
