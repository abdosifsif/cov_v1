<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)//: RedirectResponse
{
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'date' => ['required', 'date'],
        'sexe' => ['required', 'string'],
        'ville' => ['required', 'string', 'max:255'],
        'telephone' => ['required', 'string', 'max:255'],
        'picture' => ['image', 'max:2048'],
    ]);

    $picturePath = null;
    if ($request->hasFile('picture')) {
        $picturePath = $request->file('picture')->storePublicly('public/pictures');
    }

    $picture = $picturePath ? Storage::url($picturePath) : 'images/Default_pfp.svg.png';

    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'date' => $request->date,
        'sexe' => $request->sexe,
        'ville' => $request->ville,
        'telephone' => $request->telephone,
        'picture' => $picture,
    ]);

    event(new Registered($user));

    Auth::login($user);
    return redirect(RouteServiceProvider::HOME);
}

}

