<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pushnotification
 * 
 * @property int $id
 * @property string|null $data
 * @property int|null $retry
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Pushnotification extends Model
{
	protected $table = 'pushnotification';
	public $timestamps = false;

	protected $casts = [
		'retry' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'data',
		'retry',
		'date'
	];
}
