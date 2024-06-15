<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Error
 * 
 * @property int $id
 * @property string|null $data
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Error extends Model
{
	protected $table = 'error';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'data',
		'date'
	];
}
