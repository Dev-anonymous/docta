<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Taux
 * 
 * @property int $id
 * @property float $cdf_usd
 * @property float $usd_cdf
 *
 * @package App\Models
 */
class Taux extends Model
{
	protected $table = 'taux';
	public $timestamps = false;

	protected $casts = [
		'cdf_usd' => 'float',
		'usd_cdf' => 'float'
	];

	protected $fillable = [
		'cdf_usd',
		'usd_cdf'
	];
}
