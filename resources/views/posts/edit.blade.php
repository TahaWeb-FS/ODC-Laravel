@extends('layouts.sidebar')
@section('content')
<div class="flex justify-center">
    <form action="{{route('posts.update',$post->id)}}" method="post" class="p-8 w-full max-w-md">
        @csrf
        @method('delete')
        <h2 class="text-2xl font-semibold text-start mb-6">Edit a post</h2>
        <!-- Title Input -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" id="title" name="title"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent  @error('title') border-red-500 @enderror"
                value="{{ $post->title }}" placeholder="Enter the title" required>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Content Textarea -->
        <div class="mb-6">
            <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
            <textarea id="content" name="content" rows="5"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                placeholder="Enter the content" required>{{ $post->content }}</textarea>
            @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
            Update
        </button>
    </form>
</div>
@endsection