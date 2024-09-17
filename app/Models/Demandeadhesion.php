<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Demandeadhesion
 * 
 * @property int $id
 * @property int|null $valide
 * @property int $categorie_id
 * @property string|null $data
 * @property Carbon|null $date
 * 
 * @property Categorie $categorie
 *
 * @package App\Models
 */
class Demandeadhesion extends Model
{
	protected $table = 'demandeadhesion';
	public $timestamps = false;

	protected $casts = [
		'valide' => 'int',
		'categorie_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'valide',
		'categorie_id',
		'data',
		'date'
	];

	public function categorie()
	{
		return $this->belongsTo(Categorie::class);
	}
}
