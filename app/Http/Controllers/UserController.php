<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserPic()
    {
        $user = auth()->user();
        if ($user && $user->picture) {
            return asset($user->picture);
        } else {
            return asset('images/person-circle-fill-svgrepo-com.svg');
        }
    }
}