<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Abonnement
 * 
 * @property int $id
 * @property int $users_id
 * @property string|null $key
 * @property Carbon|null $date
 * @property string|null $ref
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Abonnement extends Model
{
	protected $table = 'abonnement';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'users_id',
		'key',
		'date',
		'ref'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
