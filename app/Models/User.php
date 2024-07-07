<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $phone
 * @property Carbon|null $derniere_connexion
 * @property string|null $user_role
 * @property string|null $fcmtoken
 *
 * @property Collection|Chat[] $chats
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'derniere_connexion' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'fcmtoken'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'phone',
		'derniere_connexion',
		'user_role',
		'fcmtoken'
	];

	public function chats()
	{
		return $this->hasMany(Chat::class, 'users_id');
	}
}
