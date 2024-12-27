@extends('layouts.navbar')
@section('content')
<!-- Container principal -->
<div class="max-w-3xl mx-auto mt-10 space-y-6">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    @foreach($posts as $post)
    <div class="bg-white p-4 rounded-lg shadow-md">
        <!-- Header du Post -->
        <div class="flex items-center mb-4">
            <img
                src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : 'https://via.placeholder.com/40' }}"
                alt="Profile Photo"
                class="w-12 h-12 rounded-full object-cover">
            <div class="ml-3">
                <h3 class="text-lg font-semibold">{{ $post->user->name }}</h3>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Contenu du Post -->
        <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
        <p class="text-gray-700 mb-4">
            {{ $post->content }}
        </p>

        <!-- Boutons d'actions (Like, Comment) -->
        <div class="flex justify-between mt-4 text-gray-500">
            <button
                class="flex items-center hover:text-blue-500"
                onclick="toggleCommentSection({{ $post->id }})">
                💬 Comment
            </button>
        </div>

        <!-- Comment Section -->
        <div id="comment-section-{{ $post->id }}" class=" mt-4 transition-all duration-300 hidden">
            <!-- Comment Form -->
            @auth
            <div>
                <textarea
                    id="comment-input-{{ $post->id }}"
                    class="w-full p-2 border border-gray-300 rounded-lg mb-4"
                    placeholder="Write your comment here..."></textarea>
                <button
                    onclick="submitComment({{ $post->id }})"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Submit
                </button>
            </div>
            @endauth
            @guest
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative m-4">
                Vous devez etre authentifié pour rédiger un commentaire
            </div>
            @endguest
            <!-- Existing Comments -->
            <div id="comments-list-{{ $post->id }}" class="mt-4 min-h-0 max-h-36 overflow-auto ">
                @foreach($post->comments as $comment)
                <div class="bg-gray-100 p-2 rounded-lg mb-2">
                    <div class="flex items-center"> <img
                            src="{{ $comment->user->profile_photo ? asset('storage/' . $comment->user->profile_photo) : 'https://via.placeholder.com/40' }}"
                            alt="Profile Photo"
                            class="w-6 h-6 rounded-full object-cover mr-2">
                        <p class="text-sm font-semibold">{{ $comment->user->name }}</p>
                    </div>

                    <p class="text-gray-700">{{ $comment->content }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @endforeach
</div>
<script>
    // Toggle the comment section
    function toggleCommentSection(postId) {
        const section = document.getElementById(`comment-section-${postId}`);
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            section.classList.add('block');

        } else {
            section.classList.remove('block');
            section.classList.add('hidden');
        }
    }

    // Submit a comment via AJAX
    function submitComment(postId) {
        console.log(document.querySelector('meta[name="csrf-token"]'));
        const commentInput = document.getElementById(`comment-input-${postId}`);
        const commentsList = document.getElementById(`comments-list-${postId}`);
        const commentText = commentInput.value.trim();

        if (!commentText) {
            alert('Comment cannot be empty.');
            return;
        }

        // Perform AJAX request
        fetch(`/posts/${postId}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    content: commentText
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to submit comment');
                }
                return response.json();
            })
            .then(data => {
                // Append the new comment to the list
                const newComment = document.createElement('div');
                newComment.className = 'bg-gray-100 p-2 rounded-lg mb-2';
                newComment.innerHTML = `
                 <div class="flex items-center"> <img
                            src="${data.user.profile_photo ? window.location.origin+'/'+data.user.profile_photo : 'https://via.placeholder.com/40'}"
                            alt="Profile Photo"
                            class="w-6 h-6 rounded-full object-cover mr-2">
                <p class="text-sm font-semibold">${data.user.name}</p></div>
                <p class="text-gray-700">${data.content}</p>
                <p class="text-xs text-gray-500">${data.created_at}</p>
            `;
                commentsList.appendChild(newComment);

                // Clear the input field
                commentInput.value = '';
            })
            .catch(error => {
                console.error(error);
                alert('Failed to submit comment. Please try again.');
            });
    }
</script>

@endsection