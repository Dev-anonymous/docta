<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorie
 * 
 * @property int $id
 * @property string $categorie
 * @property string|null $description
 * 
 * @property Collection|Demandeadhesion[] $demandeadhesions
 * @property Collection|Profil[] $profils
 *
 * @package App\Models
 */
class Categorie extends Model
{
	protected $table = 'categorie';
	public $timestamps = false;

	protected $fillable = [
		'categorie',
		'description'
	];

	public function demandeadhesions()
	{
		return $this->hasMany(Demandeadhesion::class);
	}

	public function profils()
	{
		return $this->hasMany(Profil::class);
	}
}
