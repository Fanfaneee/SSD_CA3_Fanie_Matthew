<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Contact; // Import the Contact model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        $comments = Comment::with('user', 'festival')->get(); // Fetch all comments with related user and festival
        $contacts = Contact::all(); // Fetch all contact submissions

        return view('admin.dashboard', compact('users', 'comments', 'contacts'));
    }

    // Delete a contact submission
    public function destroyContact(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Contact submission deleted successfully!');
    }
}