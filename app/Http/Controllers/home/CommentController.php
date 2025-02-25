<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{

    public function store(Request $request, $id){
        $validatedData = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment = new Comments();
        $comment->body = $validatedData['body'];
        $comment->user_id = Auth::id();
        $comment->posts_id = $id;
        $comment->save();

        $comment = Comments::with('user')->find($comment->id);
        $comment->user->photo = $comment->user->photo
        ? Storage::url($comment->user->photo)
        : "https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png";

        Cache::forget("post_comments_{$id}");

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

}
