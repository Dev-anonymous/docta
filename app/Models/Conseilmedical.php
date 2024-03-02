<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conseilmedical
 * 
 * @property int $id
 * @property string|null $conseil
 *
 * @package App\Models
 */
class Conseilmedical extends Model
{
	protected $table = 'conseilmedical';
	public $timestamps = false;

	protected $fillable = [
		'conseil'
	];
}
