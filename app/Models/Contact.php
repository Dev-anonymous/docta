<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $message
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Contact extends Model
{
	protected $table = 'contact';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'email',
		'subject',
		'message',
		'date'
	];
}
