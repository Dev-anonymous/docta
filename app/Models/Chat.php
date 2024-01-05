<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 * 
 * @property int $id
 * @property int|null $users_id
 * @property int $app_id
 * @property Carbon|null $date
 * 
 * @property App $app
 * @property User|null $user
 * @property Collection|Message[] $messages
 *
 * @package App\Models
 */
class Chat extends Model
{
	protected $table = 'chat';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'app_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'users_id',
		'app_id',
		'date'
	];

	public function app()
	{
		return $this->belongsTo(App::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function messages()
	{
		return $this->hasMany(Message::class);
	}
}
