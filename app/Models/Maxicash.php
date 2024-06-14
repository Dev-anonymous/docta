<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Maxicash
 * 
 * @property int $id
 * @property int|null $saved
 * @property int|null $failed
 * @property string|null $ref
 * @property string|null $paydata
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Maxicash extends Model
{
	protected $table = 'maxicash';
	public $timestamps = false;

	protected $casts = [
		'saved' => 'int',
		'failed' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'saved',
		'failed',
		'ref',
		'paydata',
		'date'
	];
}
