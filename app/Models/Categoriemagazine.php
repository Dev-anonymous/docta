<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoriemagazine
 * 
 * @property int $id
 * @property string|null $categorie
 * 
 * @property Collection|Magazine[] $magazines
 *
 * @package App\Models
 */
class Categoriemagazine extends Model
{
	protected $table = 'categoriemagazine';
	public $timestamps = false;

	protected $fillable = [
		'categorie'
	];

	public function magazines()
	{
		return $this->hasMany(Magazine::class);
	}
}
