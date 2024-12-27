@extends('layouts.sidebar')
@section('content')
<!-- Container principal -->
<div class="max-w-3xl mx-auto mt-6 space-y-6">
    <div class="flex items-center justify-end mb-10">
        <a href="{{route('posts.create')}}"><span class="bg-green-200 rounded text-sm p-2">Create new post</span></a>

    </div>
    @foreach($posts as $post)
    <!-- Un seul Post -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <!-- Header du Post -->
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-500">Published on {{ $post->created_at->format('Y-m-d') }}</p>
            <div class=" w-1/6 flex justify-between">
                <a href="{{route('posts.edit',$post->id)}}"><span class="bg-yellow-200 rounded text-xs p-1">Modifier</span></a>
                <a
                    href="javascript:void(0)"
                    onclick="openDeleteModal({{ $post->id }})"
                    class="bg-red-200 rounded text-xs p-1">
                    Supprimer
                </a>
            </div>
        </div>
        <!-- Contenu du Post -->
        <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
        <p class="text-gray-700 mb-4">
            {{ $post->content }}
        </p>

        <!-- Image dans le Post -->
        <!-- <img src="https://via.placeholder.com/600x300" alt="Post image"
                class="w-full rounded-lg">  -->
    </div>
    @endforeach
    <br /><br />
</div>
<!-- Delete Confirmation Modal -->
<div
    id="deleteModal"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-semibold text-gray-800">Confirmation</h2>
        <p class="text-gray-600 mt-2">
            Are you sure you want to delete this post? This action cannot be undone.
        </p>

        <!-- Form for Deletion -->
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')

            <!-- Buttons -->
            <div class="mt-4 flex justify-end space-x-2">
                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    // Open the delete modal and set the action URL
    function openDeleteModal(postId) {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        // Set the form action dynamically
        deleteForm.action = `/posts/${postId}`;

        // Show the modal
        deleteModal.classList.remove('hidden');
    }

    // Close the delete modal
    function closeDeleteModal() {
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.classList.add('hidden');
    }
</script>

@endsection