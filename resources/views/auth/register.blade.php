@extends('layouts.navbar')
@section('content')
<div class="w-full h-full flex items-center justify-center">
    <div class="w-1/3">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full mt-1 px-3 py-2 border rounded @error('name') border-red-500 @enderror" required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full mt-1 px-3 py-2 border rounded @error('email') border-red-500 @enderror" required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full mt-1 px-3 py-2 border rounded @error('password') border-red-500 @enderror" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full mt-1 px-3 py-2 border rounded " required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Register
            </button>

            <p class="mt-4 text-sm text-gray-600 text-center">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
            </p>
        </form>
    </div>
</div>
@endsection