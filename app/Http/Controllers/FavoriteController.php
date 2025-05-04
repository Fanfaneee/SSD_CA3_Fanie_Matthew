<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Display the user's favorite festivals
    public function index()
    {
        $favorites = auth()->user()->favoriteFestivals;
    
        // Use the correct view path
        return view('favourites.index', compact('favorites'));
    }

    // Add a festival to the user's favorites
    public function store(Festival $festival)
    {
        auth()->user()->favoriteFestivals()->attach($festival->id);
        return redirect()->back()->with('success', 'Festival added to favorites!');
    }

    // Remove a festival from the user's favorites
    public function destroy(Festival $festival)
    {
        auth()->user()->favoriteFestivals()->detach($festival->id);
        return redirect()->back()->with('success', 'Festival removed from favorites!');
    }
}
