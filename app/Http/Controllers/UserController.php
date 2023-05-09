<?php

namespace App\Http\Controllers;

use DB;
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

    public function checkEmail(Request $request)
{
    $email = $request->input('email');
    
    // Query the database to check if the email address exists
    $emailExists = DB::table('users')->where('email', $email)->exists();

    // Return a JSON response indicating whether the email address exists
    return response()->json(['exists' => $emailExists]);
}
}