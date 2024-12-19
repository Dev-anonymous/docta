<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Forfait
 * 
 * @property int $id
 * @property float $appel
 * @property float $sms
 * @property int|null $smsgratuit
 * @property float|null $compte
 *
 * @package App\Models
 */
class Forfait extends Model
{
	protected $table = 'forfait';
	public $timestamps = false;

	protected $casts = [
		'appel' => 'float',
		'sms' => 'float',
		'smsgratuit' => 'int',
		'compte' => 'float'
	];

	protected $fillable = [
		'appel',
		'sms',
		'smsgratuit',
		'compte'
	];
}
