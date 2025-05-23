<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    // Afficher tous les festivals
    public function index(Request $request)
{
    $query = Festival::query();

    // Search
    if ($request->has('search') && $request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%')
              ->orWhere('genre', 'like', '%' . $request->search . '%');
    }

    // Filter by genre
    if ($request->has('genre') && $request->genre) {
        $query->where('genre', $request->genre);
    }

    // Sorting
    if ($request->has('sort') && $request->sort) {
        $query->orderBy($request->sort, $request->get('direction', 'asc'));
    }

    // Paginate results
    $festivals = $query->paginate(9);

    // Get distinct genres for filtering
    $genres = Festival::select('genre')->distinct()->pluck('genre');

    return view('festivals.index', compact('festivals', 'genres'));
}

    // Afficher un festival spécifique
    public function show($id)
    {
        $festival = Festival::findOrFail($id);
        $comments = $festival->comments()->with('user')->latest()->get(); // Fetch comments with user info
        return view('festivals.show', compact('festival', 'comments'));

    }

    // Show the edit form
    public function edit($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    
        $festival = Festival::findOrFail($id);
        return view('festivals.edit', compact('festival'));
    }

    // Update the festival
    public function update(Request $request, $id)
    {
        $request->validate([
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
    
        $festival = Festival::findOrFail($id);
    
        $festival->update([
            'name' => $request->name,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'genre' => $request->genre,
            'lineup' => $request->lineup,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        if ($request->hasFile('image')) {
            $festival->image = $request->file('image')->store('images', 'public');
            $festival->save();
        }
    
        return redirect()->route('festivals.index')->with('success', 'Festival updated successfully!');
    }

    // Delete the festival
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    
        $festival = Festival::findOrFail($id);
        $festival->delete();
    
        return redirect()->route('festivals.index')->with('success', 'Festival deleted successfully!');
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
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('festivals.create');
    } 

    
}
