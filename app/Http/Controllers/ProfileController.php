<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Trajet;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Ville;
use Illuminate\Support\Facades\File;







class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function edit(Request $request)
    {
        $user = $request->user();
        $preferences = $user->preferences;
        $voiture = $user->voitures;
        $villes = Ville::all();
        $userId = $request->user()->id;
        $trajets = Trajet::where('user_id', $userId)->get();
        return view('profile.edit', compact('user', 'preferences', 'voiture', 'villes', 'trajets'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->date = $request->input('date');
        $user->sexe = $request->input('sexe');
        $user->ville = $request->input('ville');

        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('public/pictures');
            $picturePath = str_replace('public/pictures/', '', $picturePath);
            $user->picture = '/storage/pictures/' . $picturePath;
        } 
        $currentPassword = DB::table('users')->where('id', $user->id)->value('password');

        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => ['required', 'regex:/^(06|07)\d{8}$/'],
            'date' => ['required', 'date', Rule::requiredIf($request->has('date')), 'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'sexe' => 'required|in:Homme,Femme',
            'ville' => 'required',
            'Mot_de_passe_actuel' => 'required|string',
        ], [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'regex' => 'Le champ :attribute doit commencer par 06 ou 07 et contenir 10 chiffres.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'in' => 'Le champ :attribute doit être Homme ou Femme.',
            'before_or_equal' => 'Vous devez avoir au moins 18 ans.',
        ]);

        if (Hash::check($validatedData['Mot_de_passe_actuel'], $currentPassword)) {
            // Password is correct, update the profile
            unset($validatedData['Mot_de_passe_actuel']); // Remove the Mot_de_passe_actuel field from the validated data
            $user->fill($validatedData);
            $user->save();

            return redirect()->route('profile.edit')->with('status', 'profile-updated');
        } else {
            // Password is incorrect, show error message
            return redirect()->route('profile.edit')->withErrors(['Mot_de_passe_actuel' => 'Mot de passe incorrect. Veuillez réessayer.']);
        }
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $music = intval($request->input('music', 0));
        $animal = intval($request->input('animal', 0));
        $fumeur = intval($request->input('fumeur', 0));
        $discussion = intval($request->input('discussion', 0));

        // Check if the user has a preference
        $preferenceExists = DB::table('preferences')
            ->where('user_id', $userId)
            ->exists();

        if ($preferenceExists) {
            // Update the existing preference
            DB::table('preferences')
                ->where('user_id', $userId)
                ->update([
                    'music' => $music,
                    'animal' => $animal,
                    'fumeur' => $fumeur,
                    'discussion' => $discussion
                ]);
        } else {
            // Create a new preference for the user
            DB::table('preferences')
                ->insert([
                    'user_id' => $userId,
                    'music' => $music,
                    'animal' => $animal,
                    'fumeur' => $fumeur,
                    'discussion' => $discussion,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
        }

        return redirect()->route('profile.edit')->with('status', 'preferences-updated');
    }

    public function saveVoiture(Request $request)
    {
        $validatedData = $request->validate([
            'marque' => ['required', 'string'],
            'confort' => ['required', 'string'],
            'nombre_de_place' => ['required', 'integer'],
            'modele' => ['nullable', 'string'],
        ]);

        $user = $request->user();
        $userId = $user->id;

        // Check if the user already has a car
        $carExists = DB::table('voitures')->where('user_id', $userId)->exists();

        if ($carExists) {
            // Update the existing car information
            $modele = $validatedData['modele'] ?? ''; // Set default value if 'modele' is not provided
            DB::table('voitures')
                ->where('user_id', $userId)
                ->update([
                    'marque' => $validatedData['marque'],
                    'modele' => $modele,
                    'confort' => $validatedData['confort'],
                    'nombre_de_place' => $validatedData['nombre_de_place'],
                    'updated_at' => now(),
                ]);
        } else {
            // Create a new car entry for the user
            DB::table('voitures')->insert([
                'user_id' => $userId,
                'marque' => $validatedData['marque'],
                'modele' => $validatedData['modele'] ?? '',
                // Set default value if 'modele' is not provided
                'confort' => $validatedData['confort'],
                'nombre_de_place' => $validatedData['nombre_de_place'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('profile.edit')->with('status', 'voiture-saved');
    }
    public function updateTrajet(Request $request, $id)
    {
        $trajet = Trajet::findOrFail($id);
        $nbrPassager = intval($request->input('nbr_passager'));

        if ($nbrPassager == 0) {
            $trajet->disponible = 'non';
        } else {
            $trajet->disponible = 'oui';
        }

        $trajet->nbr_passager = $nbrPassager;
        $trajet->save();

        return redirect()->back()->with('status', 'Trajet updated successfully.');
    }




}