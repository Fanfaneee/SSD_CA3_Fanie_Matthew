<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        $comments = Comment::with('user', 'festival')->get(); // Fetch all comments with related user and festival
        return view('admin.dashboard', compact('users', 'comments'));
    }
}
