<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Preference;
use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $preferences = $user->preferences;

        return view('profile.edit', [
            'user' => $user,
            'preferences' => $preferences,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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


}