<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Zego
 * 
 * @property int $id
 * @property int|null $appid
 * @property string|null $appsign
 *
 * @package App\Models
 */
class Zego extends Model
{
	protected $table = 'zego';
	public $timestamps = false;

	protected $casts = [
		'appid' => 'int'
	];

	protected $fillable = [
		'appid',
		'appsign'
	];
}
