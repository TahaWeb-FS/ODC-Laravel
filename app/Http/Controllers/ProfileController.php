<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // Récupère l'utilisateur actuellement connecté
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $user = User::findOrFail(Auth::user()->id);

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des informations utilisateur
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Gestion de la photo de profil
        if ($request->hasFile('profile_photo')) {
            // Si l'utilisateur a déjà une photo de profil, on supprime l'ancienne
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Stockage de la nouvelle photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
