<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profil
 * 
 * @property int $id
 * @property int $users_id
 * @property string|null $file
 * @property Carbon|null $validto
 * @property int|null $actif
 * @property string|null $code
 * @property float|null $solde
 * @property string|null $bio
 * @property string|null $image
 * @property int $categorie_id
 * 
 * @property Categorie $categorie
 * @property User $user
 * @property Collection|Transfert[] $transferts
 *
 * @package App\Models
 */
class Profil extends Model
{
	protected $table = 'profil';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'validto' => 'datetime',
		'actif' => 'int',
		'solde' => 'float',
		'categorie_id' => 'int'
	];

	protected $fillable = [
		'users_id',
		'file',
		'validto',
		'actif',
		'code',
		'solde',
		'bio',
		'image',
		'categorie_id'
	];

	public function categorie()
	{
		return $this->belongsTo(Categorie::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function transferts()
	{
		return $this->hasMany(Transfert::class);
	}
}
