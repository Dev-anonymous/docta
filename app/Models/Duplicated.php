<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Duplicated
 * 
 * @property int $id
 * @property string|null $deviceid
 * @property string|null $uid
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Duplicated extends Model
{
	protected $table = 'duplicated';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'deviceid',
		'uid',
		'date'
	];
}
