<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request)
    {
        $request->validate([
            'festival_id' => 'required|exists:festivals,id',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'festival_id' => $request->festival_id,
            'content' => $request->content,
            'user_id' => auth()->id(), // Assuming the user is logged in
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    // Update a comment
    public function update(Request $request, Comment $comment)
    {
        // Ensure the user owns the comment
        if ($comment->user_id !== auth()->id()) {
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

    // Delete a comment
    public function destroy(Comment $comment)
    {
        // Ensure the user owns the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}