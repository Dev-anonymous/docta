<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Site
 * 
 * @property int $id
 * @property string|null $text
 * @property string|null $type
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Site extends Model
{
	protected $table = 'site';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'text',
		'type',
		'date'
	];
}
