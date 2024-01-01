<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'message';
	public $timestamps = false;
}
