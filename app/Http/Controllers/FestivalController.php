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
        return view('festivals.show', compact('festival'));
    }



    // Traiter la soumission du formulaire
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
            'location' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'lineup' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }
        // Créer le festival
        Festival::create($validated);

        // Rediriger avec un message de succès
        return redirect()->route('festivals.index')->with('success', 'Festival added successfully!');
    }

    public function create()
    {
        return view('festivals.create');
    } 
}
