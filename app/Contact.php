<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @package App
 */
class Contact extends Model {

	/**
	 * Define fillable attributes
	 *
	 * @var array
	 */
	protected $fillable = [
		'fname',
		'lname',
		'email',
		'phone',
		'extra_fields',
		'user_id',
		'ac_id'
	];
}
