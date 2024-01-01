<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App
 * 
 * @property int $id
 * @property string|null $uid
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class App extends Model
{
	protected $table = 'app';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'uid',
		'date'
	];
}
