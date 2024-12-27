<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Enregistrer un utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec réuissite veuillez vous connecter');
    }

    // Formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Connexion de l'utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Régénérer le token CSRF
        return redirect()->route('login')->with('success', 'Déconnexion avec succès');
    }
}