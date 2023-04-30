<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
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
}

