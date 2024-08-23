<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Download
 * 
 * @property int $id
 * @property string|null $useragent
 * @property string|null $ip
 * @property int|null $nb
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Download extends Model
{
	protected $table = 'download';
	public $timestamps = false;

	protected $casts = [
		'nb' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'useragent',
		'ip',
		'nb',
		'date'
	];
}
