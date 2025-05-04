<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Update Comment
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Comment updated successfully!');
    }

    // Delete Comment
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Comment deleted successfully!');
    }
}
