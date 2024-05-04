<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facedes\Session;
use App\Models\User;
use resources\views\admin;
use resources\views\user as userViews;


class AuthManager extends Controller
{
    public function registration()
    {
        if(Auth::check()){
            return redirect(route('login'));
        }
        return view('registration');
    }

    public function registrationPost(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required|in:user,admin',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    if ($user) {
        // Redirect to the login page with user's credentials
        return redirect()->route('login')->with([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    } else {
        return redirect()->route('registration')->with("error", "Registration failed. Please try again.");
    }
}


    
    public function login(){
        if(Auth::check()){
            return redirect(route('welcome'));
        }
        return view('login');
    }
    
    
        
    

    public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        // Vérifier si l'utilisateur est un administrateur avec l'e-mail spécifique
        if (Auth::user()->email == 'imehli.dalal@gmail.com' && Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    } else {
        return redirect()->route('login')->with("error", "Les détails de connexion ne sont pas valides.");
    }
}




    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
