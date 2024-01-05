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
 * @property float $cout
 *
 * @package App\Models
 */
class Forfait extends Model
{
	protected $table = 'forfait';
	public $timestamps = false;

	protected $casts = [
		'cout' => 'float'
	];

	protected $fillable = [
		'cout'
	];
}
