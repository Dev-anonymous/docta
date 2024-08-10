<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appversion
 * 
 * @property int $id
 * @property string|null $noteadmin
 * @property string|null $noteclient
 * @property string|null $versionadmin
 * @property string|null $versionclient
 * @property int|null $requiredadmin
 * @property int|null $requiredclient
 *
 * @package App\Models
 */
class Appversion extends Model
{
	protected $table = 'appversion';
	public $timestamps = false;

	protected $casts = [
		'requiredadmin' => 'int',
		'requiredclient' => 'int'
	];

	protected $fillable = [
		'noteadmin',
		'noteclient',
		'versionadmin',
		'versionclient',
		'requiredadmin',
		'requiredclient'
	];
}
