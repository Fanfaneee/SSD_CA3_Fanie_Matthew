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
}
