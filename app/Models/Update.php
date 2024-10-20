<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Update
 * 
 * @property int $id
 * @property int|null $app_id
 * @property string|null $type
 * @property string|null $data
 *
 * @package App\Models
 */
class Update extends Model
{
	protected $table = 'update';
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'int'
	];

	protected $fillable = [
		'app_id',
		'type',
		'data'
	];
}
