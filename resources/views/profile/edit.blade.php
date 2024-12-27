@extends('layouts.sidebar')
@section('content')
<div class="max-w-4xl mx-auto p-6 rounded">
    <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700">New Password</label>
            <input type="password" name="password" id="password"
                class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full p-2 border rounded">
        </div>
        <!-- Profile Photo -->
        <div class="mb-4">
            <label for="profile_photo" class="block text-gray-700">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo"
                class="w-full p-2 border rounded @error('profile_photo') border-red-500 @enderror">
            @error('profile_photo')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            @if ($user->profile_photo)
            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="mt-2 w-24 h-24 rounded-full">
            @endif
        </div>
        <!-- Submit Button -->
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection