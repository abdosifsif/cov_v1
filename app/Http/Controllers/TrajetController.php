<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Voiture;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        "L'adresse_de_Départ" => 'required',
        "L'adresse_de_Destination" => 'required',
        'route_details' => 'required',
        'departure_date' => 'required|date',
        'Heure' => 'required',
        'nbr_passager' => 'required|numeric',
        'prix' => 'required|numeric',
    ]);

    // Add the user ID to the validated data
    $validatedData['user_id'] = auth()->id();

    // Create a new Trajet instance with the validated data
    $trajet = new Trajet([
        "L'adresse_de_Départ" => $validatedData["L'adresse_de_Départ"],
        "L'adresse_de_Destination" => $validatedData["L'adresse_de_Destination"],
        'route_details' => $validatedData['route_details'],
        'departure_date' => $validatedData['departure_date'],
        'Heure' => $validatedData['Heure'],
        'nbr_passager' => $validatedData['nbr_passager'],
        'prix' => $validatedData['prix'],
        'user_id' => $validatedData['user_id'], // Set the user ID value
    ]);

    // Check if the number of passengers is within the capacity of the car
    $voiture = Voiture::where('user_id', auth()->id())->first();
    if ($voiture && $validatedData['nbr_passager'] <= $voiture->nombre_place) {
        // Save the Trajet instance to the database
        $trajet->save();

        // Redirect to the home page or another appropriate page
        return view('dashboard');
    } else {
        // Handle the case when the number of passengers exceeds the car's capacity
        return redirect()->back()->with('error', "Le nombre de passagers dépasse la capacité de votre voiture.");
    }
}


    public function create()
    {
        return view('AjoutTrajet');
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $data = [
            'depart' => $request->input('depart'),
            'destination' => $request->input('destination'),
            'date' => $request->input('date'),
            'passagers' => $request->input('passagers')
        ];
        
        $data['selectedDate'] = date('F j', strtotime($data['date']));
    
        // Perform the search using the Trajet model
        $trajets = Trajet::with('user.preferences')
            ->where('L\'adresse_de_Départ', 'like', '%' . $data['depart'] . '%')
            ->where("L'adresse_de_Destination", 'like', '%' . $data['destination'] . '%')
            ->where('departure_date', '=', $data['date'])
            ->where('nbr_passager', '>=', $data['passagers'])
            ->get();
    
        // Retrieve the route details from each Trajet record
        $trajets->each(function ($trajet) {
            $routeDetails = $trajet->route_details;
            $duration = '';
    
            if (preg_match('/Durée - (\d+) heures (\d+) minutes/', $routeDetails, $matches)) {
                $hours = intval($matches[1]);
                $minutes = intval($matches[2]);
            
                if ($minutes > 30) {
                    $hours++;
                }
            
                $duration = $hours . ' heures';
            }
    
            $trajet->time = $duration;
            if ($trajet->user && $trajet->user->preferences) {
                $trajet->preferences = $trajet->user->preferences;
            }
        });
    
        // Pass the search results and selected date to the searchResults view
        return view('RechercheResult', compact('data', 'trajets'));
    }



    
}
