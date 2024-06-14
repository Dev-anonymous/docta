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
 * @property float|null $montant
 * @property string|null $devise
 * @property Carbon|null $date
 * @property string|null $telephone
 * @property string|null $methode
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
		'montant' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'app_id',
		'ref',
		'montant',
		'devise',
		'date',
		'telephone',
		'methode'
	];

	public function app()
	{
		return $this->belongsTo(App::class);
	}
}
