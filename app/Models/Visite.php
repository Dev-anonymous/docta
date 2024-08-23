<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Visite
 * 
 * @property int $id
 * @property string|null $useragent
 * @property string|null $ip
 * @property int|null $nb
 * @property string|null $url
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Visite extends Model
{
	protected $table = 'visite';
	public $timestamps = false;

	protected $casts = [
		'nb' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'useragent',
		'ip',
		'nb',
		'url',
		'date'
	];
}
