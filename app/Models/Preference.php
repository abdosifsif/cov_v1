<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Preference extends Model
{
    protected $fillable = [
        'music',
        'animal',
        'fumeur',
        'discussion',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
