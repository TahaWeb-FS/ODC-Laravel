@extends('layouts.navbar')
@section('title', 'login')
@section('content')
<div class="w-full h-full flex items-center justify-center">
    <div class="w-1/3">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form method="POST" action="{{ route('login.store') }}" class="">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Adresse email</label>
                <input type="email" name="email" id="email" class="w-full mt-1 px-3 py-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full mt-1 px-3 py-2 border rounded @error('password') border-red-500 @enderror" value="{{ old('password') }}" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
            <button type="submit" class="w-1/2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Connexion
            </button>
            </div>
            <p class="mt-4 text-sm text-gray-600 text-center">
                Vous n'avez pas de compte? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">S'inscrire</a>
            </p>
        </form>
    </div>
</div>
@endsection