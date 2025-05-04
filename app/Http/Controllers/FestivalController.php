<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    // Afficher tous les festivals
    public function index()
    {
        $festivals = Festival::all();
        return view('festivals.index', compact('festivals'));
    }

    // Afficher un festival spécifique
    public function show($id)
    {
        $festival = Festival::findOrFail($id);
        $comments = $festival->comments()->with('user')->latest()->get(); // Fetch comments with user info
        return view('festivals.show', compact('festival', 'comments'));

    }



    // Traiter la soumission du formulaire
    public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'location' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'genre' => 'required|string|max:255',
        'lineup' => 'required|string',
        'price' => 'nullable|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Gestion de l'image (si présente)
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('images', 'public');
    }

    // Création du festival
    Festival::create($validated);

    // Redirection après la création
    return redirect()->route('festivals.index')->with('success', 'Festival created successfully!');
}
    public function create()
    {
        return view('festivals.create');
    } 

    
}
