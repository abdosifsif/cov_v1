<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\ville;
use Illuminate\Support\Facades\DB;

class TypeaheadController extends Controller
{
 


    public function myControllerMethod()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            $villes = DB::table('villes')->get();
    
            return view('auth.register', ['villes' => $villes]);
        }
    }
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
    
        $results = DB::table('villes')
        ->where('ville', 'LIKE', '%'.$query.'%')
        ->get(['ville']);
              
        return response()->json($results);
          
    } 
}