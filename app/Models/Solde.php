<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Solde
 * 
 * @property int $id
 * @property int $app_id
 * @property float|null $solde_usd
 * 
 * @property App $app
 *
 * @package App\Models
 */
class Solde extends Model
{
	protected $table = 'solde';
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'int',
		'solde_usd' => 'float'
	];

	protected $fillable = [
		'app_id',
		'solde_usd'
	];

	public function app()
	{
		return $this->belongsTo(App::class);
	}
}
