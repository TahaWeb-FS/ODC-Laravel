<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = auth()->id(); 
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'content' => $comment->content,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => [
                'name' => $comment->user->name,
                'profile_photo' => $comment->user->profile_photo,
            ]
        ]);
    }
}