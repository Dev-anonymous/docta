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
 * @property string|null $deviceid
 * @property Carbon|null $date
 * @property Carbon|null $last_login
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $nom
 * @property int|null $canmessage
 * @property string|null $fcmtoken
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
        'last_login' => 'datetime',
        'canmessage' => 'int'
    ];

    protected $hidden = [
        'fcmtoken'
    ];

    protected $fillable = [
        'uid',
        'deviceid',
        'date',
        'last_login',
        'telephone',
        'email',
        'nom',
        'canmessage',
        'fcmtoken'
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
