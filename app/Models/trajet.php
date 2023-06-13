<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Trajet extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        "L'adresse_de_Départ",
        "L'adresse_de_Destination",
        'route_details',
        'departure_date',
        'Heure',
        'nbr_passager',
        'prix',
        'user_id', // Add user_id to the fillable array
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}

