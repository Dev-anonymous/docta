<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gopay
 * 
 * @property int $id
 * @property int|null $issaved
 * @property int|null $isfailed
 * @property string|null $ref
 * @property string|null $paydata
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Gopay extends Model
{
	protected $table = 'gopay';
	public $timestamps = false;

	protected $casts = [
		'issaved' => 'int',
		'isfailed' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'issaved',
		'isfailed',
		'ref',
		'paydata',
		'date'
	];
}
