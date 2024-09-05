<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Slide
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property string|null $file
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Slide extends Model
{
	protected $table = 'slide';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'title',
		'text',
		'file',
		'date'
	];
}
