<?php

namespace Backpack\CRUD\app\Http\Controllers;

use App\Models\User;
use App\Models\Trajet;
use App\Models\ville;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];
    
        $this->data['registeredUsers'] = User::count();
        $this->data['trajetCount'] = Trajet::count();
        $this->data['newUserCount'] = User::whereDate('created_at', '>=', now()->subDays(7))->count();
        
        $lastTrajet = Trajet::latest('created_at')->first();
        $daysSinceLastTrajet = $lastTrajet ? now()->diffInDays($lastTrajet->created_at) : null;
        $this->data['daysSinceLastTrajet'] = $daysSinceLastTrajet;
    
        return view(backpack_view('dashboard'), $this->data);
    }
    
    
    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(backpack_url('dashboard'));
    }
}
