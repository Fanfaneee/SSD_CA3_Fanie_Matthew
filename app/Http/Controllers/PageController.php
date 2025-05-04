<?php

namespace App\Http\Controllers;
use App\Models\Festival;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function home()
    {
        return view('home');
    }

    public function festivals()
    {
        return view('festivals');
    }

    public function map()
{
    $festivals = Festival::select('name', 'location', 'latitude', 'longitude', 'genre', 'lineup', 'price', 'start_date', 'end_date')->get();
    return view('map', compact('festivals'));
}

    public function calendar()
{
    $festivals = Festival::select('name', 'start_date', 'end_date', 'location', 'genre', 'lineup', 'price')->get();
    return view('calendar', compact('festivals'));
}
    public function contact()
    {
        return view('contact');
    }

    


}