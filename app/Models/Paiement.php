<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paiement
 * 
 * @property int $id
 * @property int $app_id
 * @property string $ref
 * @property Carbon|null $date
 * 
 * @property App $app
 *
 * @package App\Models
 */
class Paiement extends Model
{
	protected $table = 'paiement';
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'app_id',
		'ref',
		'date'
	];

	public function app()
	{
		return $this->belongsTo(App::class);
	}
}
