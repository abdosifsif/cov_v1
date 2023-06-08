<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
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
    
        // Save the Trajet instance to the database
        $trajet->save();
    
        // Redirect to the home page or another appropriate page
        return view('index');
    }

    public function create()
    {
        return view('AjoutTrajet');
    }

    public function search(Request $request)
{
    // Get the search query from the request
    $depart = $request->input('depart');
    $destination = $request->input('destination');
    $date = $request->input('date');
    $passagers = $request->input('passagers');
    
    // Convert the date format to match the expected format in the database
    $selectedDate = date('F j', strtotime($date));

    // Perform the search using the Trajet model
    $trajets = Trajet::where('L\'adresse_de_Départ', 'like', '%' . $depart . '%')
        ->where("L'adresse_de_Destination", 'like', '%' . $destination . '%')
        ->where('departure_date', '=', $date)
        ->where('nbr_passager', '>=', $passagers)
        ->get();

    // Pass the search results and selected date to the searchResults view
    return view('RechercheResult', ['trajets' => $trajets, 'selectedDate' => $selectedDate]);
}

    
}
