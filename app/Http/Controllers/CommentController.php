<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request->merge(['user_id' => Auth::id()]);

        $comment = Comment::create($request->all());

        return new CommentResource($comment->LoadMissing(['commentator:id,username'])); // jangan space di LoadMissing()
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'post_id' => 'exists:posts,id',
            'comments_content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return new CommentResource($comment->LoadMissing(['commentator:id,username']));
    }

    function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }
}
