<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transfert
 * 
 * @property int $id
 * @property int $profil_id
 * @property float|null $montant
 * @property Carbon|null $date
 * @property string|null $ref
 * 
 * @property Profil $profil
 *
 * @package App\Models
 */
class Transfert extends Model
{
	protected $table = 'transfert';
	public $timestamps = false;

	protected $casts = [
		'profil_id' => 'int',
		'montant' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'profil_id',
		'montant',
		'date',
		'ref'
	];

	public function profil()
	{
		return $this->belongsTo(Profil::class);
	}
}
