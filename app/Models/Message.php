<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string|null $local_id
 * @property int $chat_id
 * @property string|null $type
 * @property string|null $message
 * @property string|null $file
 * @property int|null $userread
 * @property int|null $appread
 * @property int|null $fromuser
 * @property string|null $username
 * @property Carbon|null $date
 * @property int|null $sent
 * @property int|null $senttouser
 * 
 * @property Chat $chat
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'message';
	public $timestamps = false;

	protected $casts = [
		'chat_id' => 'int',
		'userread' => 'int',
		'appread' => 'int',
		'fromuser' => 'int',
		'date' => 'datetime',
		'sent' => 'int',
		'senttouser' => 'int'
	];

	protected $fillable = [
		'local_id',
		'chat_id',
		'type',
		'message',
		'file',
		'userread',
		'appread',
		'fromuser',
		'username',
		'date',
		'sent',
		'senttouser'
	];

	public function chat()
	{
		return $this->belongsTo(Chat::class);
	}
}
