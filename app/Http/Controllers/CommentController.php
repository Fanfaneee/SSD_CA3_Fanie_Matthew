<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Update a comment
    public function update(Request $request, Comment $comment)
{
    // Allow only the comment owner or an admin to update the comment
    if ($comment->user_id !== auth()->id() && !auth()->user()->is_admin) {
        return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
    }

    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $comment->update([
        'content' => $request->content,
    ]);

    return redirect()->back()->with('success', 'Comment updated successfully!');
}

public function destroy(Comment $comment)
{
    // Allow only the comment owner or an admin to delete the comment
    if ($comment->user_id !== auth()->id() && !auth()->user()->is_admin) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully!');
}
}