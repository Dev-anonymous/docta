<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App
 * 
 * @property int $id
 * @property string $uid
 * @property Carbon|null $date
 * @property Carbon|null $last_login
 * 
 * @property Collection|Chat[] $chats
 * @property Collection|Paiement[] $paiements
 * @property Collection|Solde[] $soldes
 *
 * @package App\Models
 */
class App extends Model
{
	protected $table = 'app';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'last_login' => 'datetime'
	];

	protected $fillable = [
		'uid',
		'date',
		'last_login'
	];

	public function chats()
	{
		return $this->hasMany(Chat::class);
	}

	public function paiements()
	{
		return $this->hasMany(Paiement::class);
	}

	public function soldes()
	{
		return $this->hasMany(Solde::class);
	}
}
