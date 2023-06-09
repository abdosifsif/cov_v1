<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Preference;


class User extends Authenticatable
{
    use CrudTrait;
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'date',
        'sexe',
        'ville',
        'telephone',
        'picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function preferences()
{
    return $this->hasOne(Preference::class);
}
public function voitures()
{
    return $this->hasOne(Voiture::class);
}
}
