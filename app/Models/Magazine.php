<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Magazine
 * 
 * @property int $id
 * @property int $categoriemagazine_id
 * @property string|null $titre
 * @property string|null $description
 * @property string|null $text
 * @property string|null $image
 * @property string|null $fichier
 * @property Carbon|null $date
 * @property Carbon|null $datepublication
 * @property int|null $free
 * @property int|null $view
 * @property int|null $dl
 * 
 * @property Categoriemagazine $categoriemagazine
 *
 * @package App\Models
 */
class Magazine extends Model
{
	protected $table = 'magazine';
	public $timestamps = false;

	protected $casts = [
		'categoriemagazine_id' => 'int',
		'date' => 'datetime',
		'datepublication' => 'datetime',
		'free' => 'int',
		'view' => 'int',
		'dl' => 'int'
	];

	protected $fillable = [
		'categoriemagazine_id',
		'titre',
		'description',
		'text',
		'image',
		'fichier',
		'date',
		'datepublication',
		'free',
		'view',
		'dl'
	];

	public function categoriemagazine()
	{
		return $this->belongsTo(Categoriemagazine::class);
	}
}
