<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       // $this->middleware('auth')->only('logout');
    }

    /**
     * Handle the authenticated user redirection.
     *
     * @param Request $request
     * @param mixed $user
     * @return \Illuminate\Http\RedirectResponse
     */

     protected function authenticated(Request $request, $user)
    {
        // Vérifier si l'utilisateur a le rôle 'Admin'
        if ($user->hasRole('Admin')) {
            return redirect()->route('dashboard'); // Redirection vers le dashboard
        }

        // Pour les autres utilisateurs, redirection vers la page d'accueil
        return redirect()->to('/'); // Redirection vers la page d'accueil
    }
}
